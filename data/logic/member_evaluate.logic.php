<?php
/**
 * 晒单
 */
defined('TTShop') or exit('Access Invalid!');
class member_evaluateLogic {

    public function evaluateListDity($goods_eval_list) {
        foreach($goods_eval_list as $key=>$value){
			$goods_eval_list[$key]['member_avatar'] = getMemberAvatarForID($value['geval_frommemberid']);
		}
		return $goods_eval_list;
    }
    /*
    *获取晒单
    */
    public function validation($order_id, $member_id){
    	
    	$model_order = Model('order');
        $model_store = Model('store');
        $model_evaluate_goods = Model('evaluate_goods');
        $model_evaluate_store = Model('evaluate_store');

        //获取订单信息
        $order_info = $model_order->getOrderInfo(array('order_id' => $order_id));

        //判断订单身份
        if($order_info['buyer_id'] != $member_id) {
             $msg = '参数错误';
        }
        //订单为'已收货'状态，并且未评论
        $order_info['evaluate_able'] = $model_order->getOrderOperateState('evaluation',$order_info);
        if (empty($order_info) || !$order_info['evaluate_able']){
            $msg = '订单信息错误1';
        }

        //查询店铺信息
        $store_info = $model_store->getStoreInfoByID($order_info['store_id']);
        if(empty($store_info)){
            $msg = '店铺信息错误';
        }

        //获取订单商品
        $order_goods = $model_order->getOrderGoodsList(array('order_id'=>$order_id));
        if(empty($order_goods)){
            $msg = '订单信息错误2';
        }

      
        for ($i = 0, $j = count($order_goods); $i < $j; $i++) {
            $order_goods[$i]['goods_image_url'] = cthumb($order_goods[$i]['goods_image'], 60, $store_info['store_id']);
        }
        
        if(empty($msg)){
        	$return['data']['order_info'] = $order_info;
	        $return['data']['order_goods'] = $order_goods;
	        $return['data']['store_info'] = $store_info;
	        $return['state'] = 1;
        }else{
        	$return['msg'] = $msg;
        }

        return $return; 
    }

    /*
    *晒单保存
    */

    public function save($datas, $order_info, $store_info, $order_goods, $member_id, $member_name){
    	$model_order = Model('order');
        $model_store = Model('store');
        $model_evaluate_goods = Model('evaluate_goods');
        $model_evaluate_store = Model('evaluate_store');

        //判断是否提交
            if(!empty($datas) && !empty($order_info)  && !empty($store_info)  && !empty($order_goods)  && !empty($member_id)  && !empty($member_name)){
                $msg = "参数错误！";
            }
            $evaluate_goods_array = array();
            $goodsid_array = array();
            foreach ($order_goods as $value){
                //如果未评分，默认为5分
                $evaluate_score = intval($datas['goods'][$value['rec_id']]['score']);
                if($evaluate_score <= 0 || $evaluate_score > 5) {
                    $evaluate_score = 5;
                }
                //默认评语
                $evaluate_comment = $datas['goods'][$value['rec_id']]['comment'];
                if(empty($evaluate_comment)) {
                    $evaluate_comment = '不错哦';
                }
                
                $geval_image = '';
                if (isset($datas['goods'][$value['rec_id']]['evaluate_image']) && is_array($datas['goods'][$value['rec_id']]['evaluate_image'])) {
                    foreach ($datas['goods'][$value['rec_id']]['evaluate_image'] as $val) {
                        if(!empty($val)) {
                            $geval_image .= $val . ',';
                        }
                    }
                }
                $geval_image = rtrim($geval_image, ',');
                
                $evaluate_goods_info = array();
                $evaluate_goods_info['geval_orderid'] = $order_info['order_id'];
                $evaluate_goods_info['geval_orderno'] = $order_info['order_sn'];
                $evaluate_goods_info['geval_ordergoodsid'] = $value['rec_id'];
                $evaluate_goods_info['geval_goodsid'] = $value['goods_id'];
                $evaluate_goods_info['geval_goodsname'] = $value['goods_name'];
                $evaluate_goods_info['geval_goodsprice'] = $value['goods_price'];
                $evaluate_goods_info['geval_goodsimage'] = $value['goods_image'];
                $evaluate_goods_info['geval_scores'] = $evaluate_score;
                $evaluate_goods_info['geval_content'] = $evaluate_comment;
                $evaluate_goods_info['geval_isanonymous'] = $datas['goods'][$value['rec_id']]['anony']?1:0;
                $evaluate_goods_info['geval_addtime'] = TIMESTAMP;
                $evaluate_goods_info['geval_storeid'] = $store_info['store_id'];
                $evaluate_goods_info['geval_storename'] = $store_info['store_name'];
                $evaluate_goods_info['geval_frommemberid'] = $member_id;
                $evaluate_goods_info['geval_frommembername'] = $member_name;
                $evaluate_goods_info['geval_image'] = $geval_image;
                $evaluate_goods_info['geval_content_again'] = '';
                $evaluate_goods_info['geval_image_again'] = '';
                $evaluate_goods_info['geval_explain_again'] = '';
                $evaluate_goods_array[] = $evaluate_goods_info;
                $goodsid_array[] = $value['goods_id'];
            }
            $pl = $model_evaluate_goods->addEvaluateGoodsArray($evaluate_goods_array, $goodsid_array);
            if(!$pl){
                $msg ="商品评论失败!";
            }
            $store_desccredit = intval($datas['store_desccredit']);
            if($store_desccredit <= 0 || $store_desccredit > 5) {
                $store_desccredit= 5;
            }
            $store_servicecredit = intval($datas['store_servicecredit']);
            if($store_servicecredit <= 0 || $store_servicecredit > 5) {
                $store_servicecredit = 5;
            }
            $store_deliverycredit = intval($datas['store_deliverycredit']);
            if($store_deliverycredit <= 0 || $store_deliverycredit > 5) {
                $store_deliverycredit = 5;
            }
            //添加店铺评价
            if (!$store_info['is_own_shop']) {
                $evaluate_store_info = array();
                $evaluate_store_info['seval_orderid'] = $order_info['order_id'];
                $evaluate_store_info['seval_orderno'] = $order_info['order_sn'];
                $evaluate_store_info['seval_addtime'] = time();
                $evaluate_store_info['seval_storeid'] = $store_info['store_id'];
                $evaluate_store_info['seval_storename'] = $store_info['store_name'];
                $evaluate_store_info['seval_memberid'] = $member_id;
                $evaluate_store_info['seval_membername'] = $member_name;
                $evaluate_store_info['seval_desccredit'] = $store_desccredit;
                $evaluate_store_info['seval_servicecredit'] = $store_servicecredit;
                $evaluate_store_info['seval_deliverycredit'] = $store_deliverycredit;
            }
            $dppl = $model_evaluate_store->addEvaluateStore($evaluate_store_info);
            if(!$dppl){
                $msg ="店铺评论失败!";
            }
            //更新订单信息并记录订单日志
            $state = $model_order->editOrder(array('evaluation_state'=>1), array('order_id' => $order_info['order_id']));
            $model_order->editOrderCommon(array('evaluation_time'=>TIMESTAMP), array('order_id' => $order_info['order_id']));
            if ($state){
                $data = array();
                $data['order_id'] = $order_info['order_id'];
                $data['log_role'] = 'buyer';
                $data['log_msg'] = L('order_log_eval');
                $model_order->addOrderLog($data);
            }

            //添加会员积分
            if (C('points_isuse') == 1){
                $points_model = Model('points');
                $points_model->savePointsLog('comments',array('pl_memberid'=>$member_id,'pl_membername'=>$member_name));
            }
            //添加会员经验值
            Model('exppoints')->saveExppointsLog('comments',array('exp_memberid'=>$member_id,'exp_membername'=>$member_name));;
           
 
             if(empty($msg)){
                $return['state'] = 1;
            }else{
                $return['msg'] = $msg;
            }

            return $return; 

        }
        /*
        *again再次追加晒单
        */
        public function validationAgain($order_id,$member_id){
            if (!$order_id){
                $msg = '参数错误';
            }
        
            $model_order = Model('order');
            $model_store = Model('store');
            $model_evaluate_goods = Model('evaluate_goods');
            $model_evaluate_store = Model('evaluate_store');
        
            //获取订单信息
            $order_info = $model_order->getOrderInfo(array('order_id' => $order_id));
            //判断订单身份
            if($order_info['buyer_id'] != $member_id) {
                $msg = '参数错误';
            }
            //订单为已评价状态，为追加评论
            $order_info['evaluation_again'] = $model_order->getOrderOperateState('evaluation_again',$order_info);
            if (empty($order_info) || !$order_info['evaluation_again']){
                $msg = '订单信息错误';
            }
        
            //查询店铺信息
            $store_info = $model_store->getStoreInfoByID($order_info['store_id']);
            if(empty($store_info)){
                $msg = '店铺信息错误';
            }
        
            //获取订单商品
            $evaluate_goods = $model_evaluate_goods->getEvaluateGoodsList(array('geval_orderid'=>$order_id));
       
            if(empty($evaluate_goods)){
                $msg = '订单信息错误';
            }
            for ($i = 0, $j = count($evaluate_goods); $i < $j; $i++) {
                $evaluate_goods[$i]['geval_goodsimage'] = cthumb($evaluate_goods[$i]['geval_goodsimage'], 240, $store_info['geval_storeid']);
            }

            if(empty($msg)){
                $return['data']['evaluate_goods'] = $evaluate_goods;
                $return['data']['order_info'] = $order_info;
                $return['data']['store_info'] = $store_info;
                $return['state'] = 1;
            }else{
                $return['msg'] = $msg;
            }

            return $return; 
              
          
        }

        /*
        *再次评价晒单保存
        */
        public function saveAgain($datas, $order_info, $evaluate_goods){
            $model_order = Model('order');
            $model_evaluate_goods = Model('evaluate_goods');
            $goodsid_array = array();
            foreach ($evaluate_goods as $value){
                //默认评语
                $evaluate_comment = $datas['goods'][$value['geval_id']]['comment'];
                if(empty($evaluate_comment)) {
                    $evaluate_comment = '不错哦';
                }
    
                $geval_image = '';
                foreach ($datas['goods'][$value['geval_id']]['evaluate_image'] as $val) {
                    if(!empty($val)) {
                        $geval_image .= $val . ',';
                    }
                }
                $geval_image = rtrim($geval_image, ',');
    
                $evaluate_goods_info = array();
                $evaluate_goods_info['geval_content_again'] = $evaluate_comment;
                $evaluate_goods_info['geval_addtime_again'] = TIMESTAMP;
                $evaluate_goods_info['geval_image_again'] = $geval_image;

                $pj = $model_evaluate_goods->editEvaluateGoods($evaluate_goods_info, array('geval_id' => $value['geval_id']));
                if(!$pj){
                    $msg = '评价出错!';
                }
            }

            //更新订单信息并记录订单日志
            $state = $model_order->editOrder(array('evaluation_again_state'=>1), array('order_id' => $order_info['order_id']));
            if ($state){
                $data = array();
                $data['order_id'] = $order_info['order_id'];
                $data['log_role'] = 'buyer';
                $data['log_msg'] = '追加评价';
                $model_order->addOrderLog($data);
            }
            
            if(empty($msg)){
                $return['state'] = 1;
            }else{
                $return['msg'] = $msg;
            }

            return $return; 

        }
    
}
