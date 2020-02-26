<?php
/**
 * 实物订单行为
 *
 */
defined('TTShop') or exit('Access Invalid!');
class orderLogic {

    //通知gateway变更用户余额
    public function receive($system_id,$seller_id,$trade_no,$type = 'trade_no'){
        //POST /services/order/confirm 确认订单完成支付货款给卖家
        //查询地址 https://gateway.confolsc.com/services/order/confirm  user_id trade_no
        $url = 'https://gateway.confolsc.com/services/order/confirm';
        $data = [
            'user_id' => $system_id,
            'seller_id' => $seller_id,
            $type => $trade_no
        ];
        $ch = curl_init();
        curl_setopt_array($ch,[
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CONNECTTIMEOUT => 5
        ]);
        $resource = curl_exec($ch);
        curl_close($ch);
        if (!empty($resource)){
            $arr = json_decode($resource,true);
            return $arr;
        } else {
            return false;
        }
    }

    /**
     * 取消订单
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $user 操作人
     * @param string $msg 操作备注
     * @param boolean $if_update_account 是否变更账户金额
     * @param array $cancel_condition 订单更新条件,目前只传入订单状态，防止并发下状态已经改变
     * @return array
     */
    public function changeOrderStateCancel($order_info, $role, $user = '', $msg = '', $if_update_account = true, $cancel_condition = array()) {
        try {
            $model_order = Model('order');
            $model_order->beginTransaction();
            $order_id = $order_info['order_id'];

            //库存销量变更
            $goods_list = $model_order->getOrderGoodsList(array('order_id'=>$order_id));
            $data = array();
            foreach ($goods_list as $goods) {
                $data[$goods['goods_id']] = $goods['goods_num'];
            }
            $result = Logic('queue')->cancelOrderUpdateStorage($data);
            if (!$result['state']) {
                throw new Exception('还原库存失败');
            }
            if ($order_info['chain_id']) {
                $result = Logic(queue)->cancelOrderUpdateChainStorage($data,$order_info['chain_id']);
                if (!$result['state']) {
                    throw new Exception('还原门店库存失败');
                }
            }

            if ($if_update_account) {
                $model_pd = Model('predeposit');
                //解冻充值卡
                $rcb_amount = floatval($order_info['rcb_amount']);
                if ($rcb_amount > 0) {
                    $data_pd = array();
                    $data_pd['member_id'] = $order_info['buyer_id'];
                    $data_pd['member_name'] = $order_info['buyer_name'];
                    $data_pd['amount'] = $rcb_amount;
                    $data_pd['order_sn'] = $order_info['order_sn'];
                    $model_pd->changeRcb('order_cancel',$data_pd);
                }

                //解冻预存款
                $pd_amount = floatval($order_info['pd_amount']);
                if ($pd_amount > 0) {
                    $data_pd = array();
                    $data_pd['member_id'] = $order_info['buyer_id'];
                    $data_pd['member_name'] = $order_info['buyer_name'];
                    $data_pd['amount'] = $pd_amount;
                    $data_pd['order_sn'] = $order_info['order_sn'];
                    $model_pd->changePd('order_cancel',$data_pd);
                }
            }

            //更新订单信息
            $update_order = array('order_state'=>ORDER_STATE_CANCEL);
            $cancel_condition['order_id'] = $order_id;
            $update = $model_order->editOrder($update_order,$cancel_condition);
            if (!$update) {
                throw new Exception('保存失败');
            }

            //添加订单日志
            $data = array();
            $data['order_id'] = $order_id;
            $data['log_role'] = $role;
            $data['log_msg'] = '取消了订单';
            $data['log_user'] = $user;
            if ($msg) {
                $data['log_msg'] .= ' ( '.$msg.' )';
            }
            $data['log_orderstate'] = ORDER_STATE_CANCEL;
            $model_order->addOrderLog($data);
            $model_order->commit();

            return callback(true,'操作成功');

        } catch (Exception $e) {
            $model_order->rollback();
            return callback(false,'操作失败');
        }
    }

    /**
     * 收货
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system,chain 分别代表买家、商家、管理员、系统、门店
     * @param string $user 操作人
     * @param string $msg 操作备注
     * @return array
     */
    public function changeOrderStateReceive($order_info, $role, $user = '', $msg = '',$system_id = '') {
        Model()::beginTransaction();
        try {

            $order_id = $order_info['order_id'];
            $seller_info = Model('')->table('store,member')->join('left')->on('store.member_id = member.member_id')->field('weixin_unionid')->where('store_id='.$order_info['store_id'])->find();

            $model_order = Model('order');
            //system_id
            if (!empty($order_info['trade_no'])){
                $trade_no = $order_info['trade_no'];
                $type = 'trade_no';
            } else {
                $trade_no = $order_info['order_sn'];
                $type = 'out_trade_no';
            }
            //请求gateway确认收货
            $result = $this->receive($system_id,$seller_info['weixin_unionid'],$trade_no,$type);
            if ($result['code'] == 0){
                throw new Exception('确认收货失败');
            } elseif ($result['code'] == 2) {
                throw new Exception('不可重复确认收货');
            }

            //消息推送app&weixin，任何情况下都请求app，openid为空的时候不做微信推送
            //app


            //更新订单状态
            $update_order = array();
            $update_order['finnshed_time'] = TIMESTAMP;
            $update_order['order_state'] = ORDER_STATE_SUCCESS;
            $update = $model_order->editOrder($update_order,array('order_id'=>$order_id));
            if (!$update) {
                throw new Exception('保存失败');
            }

            //添加订单日志
            $data = array();
            $data['order_id'] = $order_id;
            $data['log_role'] = $role;
            $data['log_msg'] = $msg;
            $data['log_user'] = $user;
            $data['log_orderstate'] = ORDER_STATE_SUCCESS;
            $model_order->addOrderLog($data);

            if ($order_info['buyer_id'] > 0 && $order_info['order_amount'] > 0) {
                //添加会员积分
                if (C('points_isuse') == 1){
                    Model('points')->savePointsLog('order',array('pl_memberid'=>$order_info['buyer_id'],'pl_membername'=>$order_info['buyer_name'],'orderprice'=>$order_info['order_amount'],'order_sn'=>$order_info['order_sn'],'order_id'=>$order_info['order_id']),true);
                }
                //添加会员经验值
                Model('exppoints')->saveExppointsLog('order',array('exp_memberid'=>$order_info['buyer_id'],'exp_membername'=>$order_info['buyer_name'],'orderprice'=>$order_info['order_amount'],'order_sn'=>$order_info['order_sn'],'order_id'=>$order_info['order_id']),true);  
                /**
                 * 邀请返利 20160906
                 */
                $model_member = Model('member');
                $inviter_info = $model_member->getInviterInfoByMemberId($order_info['buyer_id']);
                $rebate_amount = ceil(0.01 * $order_info['order_amount'] * C('points_rebate'));
                Model('points')->savePointsLog('rebate', array('pl_memberid' => $inviter_info['member_id'], 'pl_membername' => $order_info['buyer_name'], 'rebate_amount' => $rebate_amount), true);
                $this->addStoreMoney($order_info);
                $this->addCommision($order_info);
            }
            Model::commit();
            return callback(true,'操作成功');
        } catch (Exception $e) {
            Model::rollback();
            return callback(false,$e->getMessage());
        }
    }

    /**
     * 更改运费
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $user 操作人
     * @param float $price 运费
     * @return array
     */
    public function changeOrderShipPrice($order_info, $role, $user = '', $price) {
        try {

            $order_id = $order_info['order_id'];
            $model_order = Model('order');

            $data = array();
            $data['shipping_fee'] = abs(floatval($price));
            $data['order_amount'] = array('exp','goods_amount+'.$data['shipping_fee']);
            $update = $model_order->editOrder($data,array('order_id'=>$order_id));
            if (!$update) {
                throw new Exception('保存失败');
            }
            //记录订单日志
            $data = array();
            $data['order_id'] = $order_id;
            $data['log_role'] = $role;
            $data['log_user'] = $user;
            $data['log_msg'] = '修改了运费'.'( '.$price.' )';;
            $data['log_orderstate'] = $order_info['payment_code'] == 'offline' ? ORDER_STATE_PAY : ORDER_STATE_NEW;
            $model_order->addOrderLog($data);
            return callback(true,'操作成功');
        } catch (Exception $e) {
            return callback(false,'操作失败');
        }
    }
    /**
     * 更改价格
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $user 操作人
     * @param float $price 价格
     * @return array
     */
    public function changeOrderSpayPrice($order_info, $role, $user = '', $price) {
        Model::beginTransaction();
        try {

            $order_id = $order_info['order_id'];
            $model_order = Model('order');

            $data = array();
            $data['goods_amount'] = abs(floatval($price));
            $data['order_amount'] = array('exp','shipping_fee+'.$data['goods_amount']);
            if ($data['goods_amount'] != $order_info['goods_amount']) {
                $data['trade_no'] = NULL;
                $data['p_trade_no'] = NULL;
            }
            $update = $model_order->editOrder($data,array('order_id'=>$order_id));
            if (!$update) {
                throw new Exception('本地订单修改失败');
            }
            //关闭remote支付单，POST /services/order/close 关闭订单 | user_id,trade_no,out_trade_no
            //remote 修改远程订单 /services/order/changePrice | user_id,trade_no,out_trade_no,amount
            if ($data['goods_amount'] != $order_info['goods_amount']) {
                $remote_data = [];
                $url = "https://gateway.confolsc.com/services/order/close";
                //获取原订单买家系统id，本地订单号，系统订单号
                $user_info = Model()->table('orders,member')->join('left')->on('orders.buyer_id=member.member_id')->field('weixin_unionid,order_sn,trade_no')->where('order_id='.$order_id)->find();
                if (!empty($user_info['trade_no'])){
                    $remote_data['trade_no'] = $user_info['trade_no'];
                } else {
                    $remote_data['out_trade_no'] = $user_info['order_sn'];
                }
                $remote_data['user_id'] = $user_info['weixin_unionid'];
//            $remote_data['amount'] = $data['order_amount'];
                //curl 数据传输
                $ch = curl_init();
                curl_setopt_array($ch,[
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_HEADER => 0,
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS => $remote_data,
                        CURLOPT_CONNECTTIMEOUT => 5]
                );
                $resource = json_decode(curl_exec($ch),true);
                curl_close($ch);
//                if ($resource['code']!=1){
//                    var_dump($resource);exit;
//                    //远端请求失败，输出错误，事物回滚
//                    throw new Exception($resource['result']);
//                }
            }
            //记录订单日志
            $data = array();
            $data['order_id'] = $order_id;
            $data['log_role'] = $role;
            $data['log_user'] = $user;
            $data['log_msg'] = '修改了价格'.'( '.$price.' )';;
            $data['log_orderstate'] = $order_info['payment_code'] == 'offline' ? ORDER_STATE_PAY : ORDER_STATE_NEW;
            $model_order->addOrderLog($data);
            Model::commit();
            return callback(true,'操作成功');
        } catch (Exception $e) {
            Model::rollback();
            return callback(false,$e->getMessage());
        }
    }
    /**
     * 回收站操作（放入回收站、还原、永久删除）
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $state_type 操作类型
     * @return array
     */
    public function changeOrderStateRecycle($order_info, $role, $state_type) {
        $order_id = $order_info['order_id'];
        $model_order = Model('order');
        //更新订单删除状态
        $state = str_replace(array('delete','drop','restore'), array(ORDER_DEL_STATE_DELETE,ORDER_DEL_STATE_DROP,ORDER_DEL_STATE_DEFAULT), $state_type);
        $update = $model_order->editOrder(array('delete_state'=>$state),array('order_id'=>$order_id));
        if (!$update) {
            return callback(false,'操作失败');
        } else {
            return callback(true,'操作成功');
        }
    }

    /**
     * 发货
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $user 操作人
     * @return array
     */
    public function changeOrderSend($order_info, $role, $user = '', $post = array()) {
        $order_id = $order_info['order_id'];
        $model_order = Model('order');
        try {
            $model_order->beginTransaction();
            $data = array();
            if (!empty($post['reciver_name'])) {
                $data['reciver_name'] = $post['reciver_name'];
            }
            if (!empty($post['reciver_info'])) {
                $data['reciver_info'] = $post['reciver_info'];
            }
            $data['deliver_explain'] = $post['deliver_explain'];
            $data['daddress_id'] = intval($post['daddress_id']);
            $data['shipping_express_id'] = intval($post['shipping_express_id']);
            $data['shipping_time'] = TIMESTAMP;

            $condition = array();
            $condition['order_id'] = $order_id;
            $condition['store_id'] = $order_info['store_id'];
            $update = $model_order->editOrderCommon($data,$condition);
            if (!$update) {
                throw new Exception('操作失败');
            }

            $data = array();
            $data['shipping_code']  = $post['shipping_code'];
            $data['order_state'] = ORDER_STATE_SEND;
            $data['delay_time'] = TIMESTAMP;
            $update = $model_order->editOrder($data,$condition);
            if (!$update) {
                throw new Exception('操作失败');
            }
            $model_order->commit();
        } catch (Exception $e) {
            $model_order->rollback();
            return callback(false,$e->getMessage());
        }

        //更新表发货信息
        if ($post['shipping_express_id'] && $order_info['extend_order_common']['reciver_info']['dlyp']) {
            $data = array();
            $data['shipping_code'] = $post['shipping_code'];
            $data['order_sn'] = $order_info['order_sn'];
            $express_info = Model('express')->getExpressInfo(intval($post['shipping_express_id']));
            $data['express_code'] = $express_info['e_code'];
            $data['express_name'] = $express_info['e_name'];
            Model('delivery_order')->editDeliveryOrder($data,array('order_id' => $order_info['order_id']));
        }

        //添加订单日志
        $data = array();
        $data['order_id'] = $order_id;
        $data['log_role'] = 'seller';
        $data['log_user'] = $user;
        $data['log_msg'] = '发出货物(编辑信息)';
        $data['log_orderstate'] = ORDER_STATE_SEND;
        $model_order->addOrderLog($data);

        // 发送买家消息
        $param = array();
        $param['code'] = 'order_deliver_success';
        $param['member_id'] = $order_info['buyer_id'];
        $param['param'] = array(
            'order_sn' => $order_info['order_sn'],
            'order_url' => urlShop('member_order', 'show_order', array('order_id' => $order_id))
        );
        QueueClient::push('sendMemberMsg', $param);

        return callback(true,'操作成功');
    }

    /**
     * 收到货款
     * @param array $order_info
     * @param string $role 操作角色 buyer、seller、admin、system 分别代表买家、商家、管理员、系统
     * @param string $user 操作人
     * @return array
     */
    public function changeOrderReceivePay($order_list, $role, $user = '', $post = array()) {
        $model_order = Model('order');

        try {
            $model_order->beginTransaction();

            $model_pd = Model('predeposit');
            foreach($order_list as $order_info) {
                $order_id = $order_info['order_id'];
                if (!in_array($order_info['order_state'],array(ORDER_STATE_NEW))) continue;
                //下单，支付被冻结的充值卡
                $rcb_amount = floatval($order_info['rcb_amount']);
                if ($rcb_amount > 0) {
                    $data_pd = array();
                    $data_pd['member_id'] = $order_info['buyer_id'];
                    $data_pd['member_name'] = $order_info['buyer_name'];
                    $data_pd['amount'] = $rcb_amount;
                    $data_pd['order_sn'] = $order_info['order_sn'];
                    $model_pd->changeRcb('order_comb_pay',$data_pd);
                }

                //下单，支付被冻结的预存款
                $pd_amount = floatval($order_info['pd_amount']);
                if ($pd_amount > 0) {
                    $data_pd = array();
                    $data_pd['member_id'] = $order_info['buyer_id'];
                    $data_pd['member_name'] = $order_info['buyer_name'];
                    $data_pd['amount'] = $pd_amount;
                    $data_pd['order_sn'] = $order_info['order_sn'];
                    $model_pd->changePd('order_comb_pay',$data_pd);
                }

                //更新订单相关扩展信息
                $result = $this->_changeOrderReceivePayExtend($order_info,$post);
                if (!$result['state']) {
                    throw new Exception($result['msg']);
                }

                //添加订单日志
                $data = array();
                $data['order_id'] = $order_id;
                $data['log_role'] = $role;
                $data['log_user'] = $user;
                $data['log_msg'] = '收到货款(外部交易号:'.$post['trade_no'].')';
                $data['log_orderstate'] = ORDER_STATE_PAY;
                $insert = $model_order->addOrderLog($data);
                if (!$insert) {
                    throw new Exception('操作失败');
                }

                //更新订单状态
                $update_order = array();
                $update_order['order_state'] = ORDER_STATE_PAY;
                $update_order['payment_time'] = ($post['payment_time'] ? strtotime($post['payment_time']) : TIMESTAMP);
                $update_order['payment_code'] = $post['payment_code'];
                if ($post['trade_no'] != '') {
                    $update_order['trade_no'] = $post['trade_no'];
                }
                $condition = array();
                $condition['order_id'] = $order_info['order_id'];
                $condition['order_state'] = ORDER_STATE_NEW;
                $update = $model_order->editOrder($update_order,$condition);
                if (!$update) {
                    throw new Exception('操作失败');
                }
            }

            //更新支付单状态
            $data = array();
            $data['api_pay_state'] = 1;
            $update = $model_order->editOrderPay($data,array('pay_sn'=>$order_info['pay_sn']));
            if (!$update) {
                throw new Exception('更新支付单状态失败');
            }

            $model_order->commit();
        } catch (Exception $e) {
            $model_order->rollback();
            return callback(false,$e->getMessage());
        }

        foreach($order_list as $order_info) {

            $order_id = $order_info['order_id'];
            //支付成功发送买家消息
            $param = array();
            $param['code'] = 'order_payment_success';
            $param['member_id'] = $order_info['buyer_id'];
            $param['param'] = array(
                    'order_sn' => $order_info['order_sn'],
                    'order_url' => urlShop('member_order', 'show_order', array('order_id' => $order_info['order_id']))
            );
            QueueClient::push('sendMemberMsg', $param);

            //非预定订单下单或预定订单全部付款完成
            if ($order_info['order_type'] != 2 || $order_info['if_send_store_msg_pay_success']) {
                //支付成功发送店铺消息
                $param = array();
                $param['code'] = 'new_order';
                $param['store_id'] = $order_info['store_id'];
                $param['param'] = array(
                        'order_sn' => $order_info['order_sn']
                );
                QueueClient::push('sendStoreMsg', $param);
                //门店自提发送提货码
                if ($order_info['order_type'] == 3) {
                    $_code = rand(100000,999999);
                    $result = $model_order->editOrder(array('chain_code'=>$_code),array('order_id'=>$order_info['order_id']));
                    if (!$result) {
                        throw new Exception('订单更新失败');
                    }
                    $param = array();
                    $param['chain_code'] = $_code;
                    $param['order_sn'] = $order_info['order_sn'];
                    $param['buyer_phone'] = $order_info['buyer_phone'];
                    QueueClient::push('sendChainCode', $param);
                }
            }
        }

        return callback(true,'操作成功');
    }

    /**
     * 更新订单相关扩展信息
     * @param unknown $order_info
     * @return unknown
     */
    private function _changeOrderReceivePayExtend($order_info, $post) {
        //预定订单收款
        if ($order_info['order_type'] == 2) {
            $result = Logic('order_book')->changeBookOrderReceivePay($order_info, $post);
        }
        return callback(true);
    }
	
	/**添加相关预存款**/
		public function addInviteRate($order_info){
			$model_order = Model('order');
			$invite_info=Model('member')->table('member')->where(array('member_id'=>$order_info['buyer_id']))->find();
			$invite_money=0;
			//取得拥金金额
			 $field = 'SUM(ROUND(goods_num*invite_rates)) as commis_amount';
			 $order_goods_condition['order_id'] = $order_info['order_id'];
		     $order_goods_condition['buyer_id'] = $order_info['buyer_id'];
             $order_goods_info = $model_order->getOrderGoodsInfo($order_goods_condition,$field);
             $commis_rate_totals_array[] = $order_goods_info['commis_amount'];
			 $commis_amount_sum=floatval(array_sum($commis_rate_totals_array)); 
			  
			 if($commis_amount_sum>0)
			 {
				  $invite_money=$commis_amount_sum;
				  $invite_money2 = ceil($commis_amount_sum * $GLOBALS['setting_config']['shopwwi_invite2']*0.01);
				  $invite_money3 = ceil($commis_amount_sum * $GLOBALS['setting_config']['shopwwi_invite3']*0.01);
			 }
			//检测是否货到付款方式
			$is_offline=($order_info['payment_code']=="offline");
			$model_member = Model('member');
			//取得一级推荐会员
			$invite_one_id = $model_member->table('member')->getfby_member_id($invite_info['member_id'],'invite_one');
			$invite_one_name = $model_member->table('member')->getfby_member_id($invite_one_id,'member_name');
			//取得二级推荐会员
			$invite_two_id = $model_member->table('member')->getfby_member_id($invite_info['member_id'],'invite_two');
			$invite_two_name = $model_member->table('member')->getfby_member_id($invite_two_id,'member_name');
			//取得三级推荐会员
			$invite_three_id = $model_member->table('member')->getfby_member_id($invite_info['member_id'],'invite_three');
			$invite_three_name = $model_member->table('member')->getfby_member_id($invite_three_id,'member_name');
			
		     if($invite_money>0&&$is_offline==false){
			    
				//变更会员预存款
			   $model_pd = Model('predeposit');
			   if($invite_one_id!=0){
		       $data = array();
			   $data['invite_member_id'] = $order_info['buyer_id'];
		       $data['member_id'] = $invite_one_id;
		       $data['member_name'] = $invite_one_name;
		       $data['amount'] = $invite_money;
		       $data['order_sn'] = $order_info['order_sn'];
		       $model_pd->changePd('order_invite',$data);}
			   
			   if($invite_two_id!=0){
		       $data_pd = array();
			   $data_pd['invite_member_id'] = $order_info['buyer_id'];
		       $data_pd['member_id'] = $invite_two_id;
		       $data_pd['member_name'] = $invite_two_name;
		       $data_pd['amount'] = $invite_money2;
		       $data_pd['order_sn'] = $order_info['order_sn'];
		       $model_pd->changePd('order_invite',$data_pd);}
			   
			   if($invite_three_id!=0){
		       $datas = array();
			   $datas['invite_member_id'] = $order_info['buyer_id'];
		       $datas['member_id'] = $invite_three_id;
		       $datas['member_name'] = $invite_three_name;
		       $datas['amount'] = $invite_money3;
		       $datas['order_sn'] = $order_info['order_sn'];
		       $model_pd->changePd('order_invite',$datas);}
			   
			   
			 }	 
	}
	/**写入卖家预存款账号**/
		public function addStoreMony($order_info){
			$model_order = Model('order');
			$store_info=Model('store')->table('store')->where(array('store_id'=>$order_info['store_id']))->find();
			$seller_info=Model('member')->table('member')->where(array('member_id'=>$store_info['member_id']))->find();
			$refund=Model('refund_return')->table('refund_return')->where(array('order_id'=>$order_info['order_id'],'refund_state'=>3))->find();
			$seller_money=0;
            if($refund){
                $seller_money=$order_info['order_amount']-$refund['refund_amount'];
            }else{
                $seller_money=$order_info['order_amount'];
            }
			//取得拥金金额
			 $field = 'SUM(ROUND(goods_pay_price*commis_rate/100,2)) as commis_amount';
			 $order_goods_condition['order_id'] = $order_info['order_id'];
		     $order_goods_condition['buyer_id'] = $order_info['buyer_id'];
             $order_goods_info = $model_order->getOrderGoodsInfo($order_goods_condition,$field);
             $commis_rate_totals_array[] = $order_goods_info['commis_amount'];
			 $commis_amount_sum=floatval(array_sum($commis_rate_totals_array)); 
			  
			 if($commis_amount_sum>0)
			 {
				  $seller_money=$seller_money-$commis_amount_sum;
			 }
			//检测是否货到付款方式
			$is_offline=($order_info['payment_code']=="offline");
		     if($seller_money>0&&$is_offline==false)
			 {
			    //变更会员预存款
			   $model_pd = Model('predeposit');
		       $data = array();
			   $data['msg']="";
			   if($commis_amount_sum>0)
			   {
				    $data['msg']=$commis_amount_sum;
			   }
		       $data['member_id'] = $store_info['member_id'];
		       $data['member_name'] = $store_info['member_name'];
		       $data['amount'] = $seller_money;
		       $data['pdr_sn'] = $order_info['order_sn'];
		       $model_pd->changePd('seller_money',$data);
			 }
	}

    //返佣 20160906
    private function _addCommision($member_id, $member_name, $money, $commision_level, $goods_num, $goods_id, $buyer_name, $order_sn, $order_amount, $add_time, $seller_id, $seller_name) {
        $dateline = TIMESTAMP;
        $model_mingxi = Model('mingxi');
        $model_member = Model('member');

        //会员返佣以及返佣明细
        $condition = array();
        $condition['member_id'] = $member_id;
        $model_member->where($condition)->setInc('available_predeposit', $money);
        $this->_addCommisionPdLog($member_id, $member_name, 'add_commision', $money, $commision_level . '级返佣收入，订单号：' . $order_sn);
        $mingxi_data = array(
            'user_id' => $member_id,
            'username' => $member_name,
            'shijian' => '获取佣金',
            'je' => $money,
            'commision_level' => $commision_level,
            'goods_num' => $goods_num,
            'goods_id' => $goods_id,
            'addtime' => $dateline,
            'memo' => "交易人" . $buyer_name . "，交易号" . $order_sn . ",消费金额：" . $order_amount,
            'buyer_name' => $buyer_name,
            'order_sn' => $order_sn,
            'order_time' => $add_time
        );
        $model_mingxi->insert($mingxi_data);        
        
        //商家支付佣金
        $condition = array();
        $condition['member_id'] = $seller_id;
        $model_member->where($condition)->setDec('available_predeposit', $money);
        $this->_addCommisionPdLog($seller_id, $seller_name, 'pay_commision', -$money, $commision_level . '级返佣支出，订单号：' . $order_sn);
    }

    //写日志
    private function _addCommisionPdLog($member_id, $member_name, $lg_type, $lg_av_amount, $lg_desc) {
        $data_log = array(
            'lg_member_id' => $member_id,
            'lg_member_name' => $member_name,
            'lg_type' => $lg_type,
            'lg_av_amount' => $lg_av_amount,
            'lg_freeze_amount' => 0,
            'lg_add_time' => TIMESTAMP,
            'lg_desc' => $lg_desc
        );
        $insert = Model('pd_log')->table('pd_log')->insert($data_log);
        if (!$insert) {
            throw new Exception('写日志操作失败');
        }
    }
   /**
     * 生成返利
     * 推荐人获得推广佣金
     */
    public function addCommision($order_info) {
        $model_goods = Model('goods');
        $model_order = Model('order');
        $model_member = Model('member');
        $model_store = Model('store');

        //订单商品列表
        $order_goods_list = $model_order->getOrderGoodsList(array('order_id' => $order_info['order_id']));

        //推荐人佣金
        $first_money  = '0.00';
        $second_money = '0.00';
        $third_money  = '0.00';

        if($order_goods_list) {
            foreach ($order_goods_list as $goods) {
                $goods_info = $model_goods->getGoodsInfo(array('goods_id' => $goods['goods_id']));
                $condition = array('goods_commonid' => $goods_info['goods_commonid'], 'store_id' => $order_info['store_id']);
                $goods_common_info = $model_goods->getGoodsCommonInfo($condition);
                $first_money = ncPriceFormat($goods_common_info['fencheng1'] * $goods['goods_num']);
                $second_money = ncPriceFormat($goods_common_info['fencheng2'] * $goods['goods_num']);
                $third_money = ncPriceFormat($goods_common_info['fencheng3'] * $goods['goods_num']);  
                $store_info = $model_store->getStoreInfoByID($goods_common_info['store_id']);
                $seller_id = $store_info['member_id'];
                $seller_name = $store_info['member_name'];
                $buyer_info = $model_member->getMemberInfoByID($order_info['buyer_id']);
                
                //一级推荐人
                if ($buyer_info['inviter_id'] != 0) {
                    $first_level_referee = $model_member->getMemberInfoByID($buyer_info['inviter_id']);
                    if ($first_level_referee) {
                        $this->_addCommision($first_level_referee['member_id'], $first_level_referee['member_name'], $first_money, 1, $goods['goods_num'], $goods['goods_id'], $buyer_info['member_name'], $order_info['order_sn'], $order_info['order_amount'], $order_info['add_time'], $seller_id, $seller_name);
                        
                        //二级推荐人
                        if ($first_level_referee['inviter_id']) {
                            $second_level_referee = $model_member->getMemberInfoByID($first_level_referee['inviter_id']);
                            
                            if ($second_level_referee['member_id'] != 0) {
                                $this->_addCommision($second_level_referee['member_id'], $second_level_referee['member_name'], $second_money, 2, $goods['goods_num'], $goods['goods_id'], $buyer_info['member_name'], $order_info['order_sn'], $order_info['order_amount'], $order_info['add_time'], $seller_id, $seller_name);
                                
                                //三级推荐人
                                if($second_level_referee['inviter_id']) {
                                    $third_level_referee = $model_member->getMemberInfoByID($second_level_referee['inviter_id']); 
                                    if ($third_level_referee['member_id'] != 0) {
                                        $this->_addCommision($third_level_referee['member_id'], $third_level_referee['member_name'], $third_money, 3, $goods['goods_num'], $goods['goods_id'], $buyer_info['member_name'], $order_info['order_sn'], $order_info['order_amount'], $order_info['add_time'], $seller_id, $seller_name);
                                    }
                                }
                            }
                        }
                    }
                }
            }               
        }     
    }

   //增加商家金钱
    public function addStoreMoney($order_info) {
        $model_order = Model('order');
        $store_info = Model('store')->table('store')->where(array('store_id' => $order_info['store_id']))->find();
        $seller_info = Model('member')->table('member')->where(array('member_id' => $store_info['member_id']))->find();
        $refund = Model('refund_return')->table('refund_return')->where(array('order_id' => $order_info['order_id'], 'refund_state' => 3))->find();
        $seller_money = 0;
        if ($refund) {
            $seller_money = $order_info['order_amount'] - $refund['refund_amount'];
        } else {
            $seller_money = $order_info['order_amount'];
        }
        //取得佣金金额
        $condition = array();
        $condition['order_id'] = $order_info['order_id'];
        $condition['buyer_id'] = $order_info['buyer_id'];
        $order_goods_info = $model_order->getOrderGoodsInfo($condition);

        //更新佣金比例
        if ($order_goods_info['commis_rate'] == 200) {
            $model_order->getOrderGoodsCommisRate($order_goods_info);
        }

        $fields = 'SUM(ROUND(goods_pay_price*commis_rate/100,2)) as commis_amount';
        $order_goods_info = $model_order->getOrderGoodsInfo($condition, $fields);
        $commis_rate_totals_array[] = $order_goods_info['commis_amount'];
        $commis_amount_sum = floatval(array_sum($commis_rate_totals_array)); 
        if ($commis_amount_sum > 0) {
            $seller_money = $seller_money - $commis_amount_sum;
        }

        //检测是否货到付款方式
        $is_offline = ($order_info['payment_code'] == "offline");

        if ($seller_money > 0 && $is_offline == false) {
            //变更会员预存款
            $model_pd = Model('predeposit');
            $data = array();
            $data['msg'] = "";
            if ($commis_amount_sum > 0) {
                $data['msg'] = $commis_amount_sum;
            }
            $data['member_id'] = $store_info['member_id'];
            $data['member_name'] = $store_info['member_name'];
            $data['amount'] = $seller_money;
            $data['pdr_sn'] = $order_info['order_sn'];
            $model_pd->changePd('seller_money', $data);
        }
    }








}
