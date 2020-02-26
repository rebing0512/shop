<?php
/**
 * 我的地址
 *
 *
 *
 
 */
defined('TTShop') or exit('Access Invalid!');
class addressModel extends Model {

    public function __construct() {
        parent::__construct('address');
    }

    public function remote_address_sync($appid, $system_id, $member_id){
        //todo 取出本地地址最后更新时间
        $local_address = $this->getAddressList(['member_id' => $member_id]);
        if ($local_address){
            $local_data = [];
            foreach ($local_address as $item){
                array_push($local_data, strtotime($item['update_at']));
            }
            $local_time = max($local_data);
        }

        $url = 'https://gateway.confolsc.com/services/address/shop/lists';
        if ($appid > 0 && $system_id > 0){
            $resource = curlPost($url, [
                'appid' => $appid,
                'userid' => $system_id
            ]);
            if (!is_null($resource)){
                $result = json_decode($resource, 1);
                if ($result['code'] == 1){
                    if (is_array($result['result']['address']) && !empty($result['result']['address'])){
                        $remote_data = [];
                        foreach ($result['result']['address'] as $item){
                            array_push($remote_data, strtotime($item['updated_at']));
                        }
                        $remote_time = max($remote_data);//todo 远程地址最后更新时间
                        if ($local_address){
                            //todo 本地存在数据情况下
                            if ($local_time < $remote_time){
                                //todo 本地更新慢于地址中心，清空本地重新同步
                                $this->delAddress(['member_id' => $member_id]);
                                $insert = [];
                                foreach ($result['result']['address'] as $key => $item){
                                    //todo 远程数据构造
                                    if ($item['is_del'] != 1){
                                        $insert[$key]['member_id'] = $_SESSION['member_id'];
                                        $insert[$key]['true_name'] = $item['receiver_name'];
                                        $insert[$key]['area_id'] = 2348;
                                        $insert[$key]['city_id'] = 205;
                                        $insert[$key]['area_info'] = $item['city'];
                                        $insert[$key]['address'] = $item['derailed_address'];
                                        $insert[$key]['tel_phone'] = NULL;
                                        $insert[$key]['mob_phone'] = $item['phone'];
                                        $insert[$key]['is_default'] = $item['is_default'];
                                    }
                                }
                                $this->table('address')->insertAll($insert);
                            }
                        } else {
                            //todo 本地数据为空情况下,直接同步远程
                            $insert = [];
                            foreach ($result['result']['address'] as $key => $item){
                                //todo 远程数据构造
                                $insert[$key]['member_id'] = $_SESSION['member_id'];
                                $insert[$key]['true_name'] = $item['receiver_name'];
                                $insert[$key]['area_id'] = 2348;
                                $insert[$key]['city_id'] = 205;
                                $insert[$key]['area_info'] = $item['city'];
                                $insert[$key]['address'] = $item['derailed_address'];
                                $insert[$key]['tel_phone'] = NULL;
                                $insert[$key]['mob_phone'] = $item['phone'];
                                $insert[$key]['is_default'] = $item['is_default']==1?1:0;
                            }
                            $this->table('address')->insertAll($insert);
                        }
                    } elseif (empty($result['result']['address'])){
                        //todo 远程地址中心为空，直接清除本地存储
                        $this->delAddress(['member_id' => $member_id]);
                    }
                }
            }
        }
    }

    /**
     * 取得买家默认收货地址
     *
     * @param array $condition
     */
    public function getDefaultAddressInfo($condition = array(), $order = 'is_default desc,address_id desc') {
        if (!empty($condition) && is_numeric($condition['member_id']))
        {
            $member = Model('member')->getMemberInfo($condition, 'weixin_unionid');
            if (is_numeric($member['weixin_unionid']))
            {
                $this->remote_address_sync(getAppId(C('app_alias')), $member['weixin_unionid'], $condition['member_id']);
            }
        }
        //同步远程地址中心信息

        return $this->getAddressInfo($condition, $order);
    }

    /**
     * 取得单条地址信息
     * @param array $condition
     * @param string $order
     */
    public function getAddressInfo($condition, $order = '') {
        $addr_info = $this->where($condition)->order($order)->find();
        if (C('delivery_isuse') && $addr_info['dlyp_id']) {
            $model_delivery = Model('delivery_point');
            $dlyp_info = $model_delivery->getDeliveryPointOpenInfo(array('dlyp_id' => $addr_info['dlyp_id']));
            if (!empty($dlyp_info)) {
                $addr_info['dlyp_mobile'] = $dlyp_info['dlyp_mobile'];
                $addr_info['dlyp_telephony'] = $dlyp_info['dlyp_telephony'];
                $addr_info['dlyp_address_name'] = $dlyp_info['dlyp_address_name'];
                $addr_info['dlyp_area_info'] = $dlyp_info['dlyp_area_info'];
                $addr_info['dlyp_address'] = $dlyp_info['dlyp_address'];
                $addr_info['dlyp_mobile'] = $dlyp_info['dlyp_mobile'];
                $addr_info['area_id'] = $dlyp_info['dlyp_area_3'];
                $addr_info['area_info'] = $dlyp_info['dlyp_area_info'];
                $addr_info['address'] = '（'.$dlyp_info['dlyp_address_name'].') '.$dlyp_info['dlyp_address']
                . '，电话：'.trim($dlyp_info['dlyp_mobile'].'，'.$dlyp_info['dlyp_telephony'],'，');
            }
        }
        return $addr_info;
    }

    /**
     * 读取地址列表
     *
     * @param
     * @return array 数组格式的返回结果
     */
    public function getAddressList($condition, $order = 'address_id desc'){
        $address_list = $this->where($condition)->order($order)->select();
        if (empty($address_list)) return array();
        if (C('delivery_isuse')) {
            $dlyp_ids = array();$dlyp_new_list = array();
            foreach ($address_list as $k => $v) {
                if ($v['dlyp_id']) {
                    $dlyp_ids[] = $v['dlyp_id'];
                }
            }
            if (!empty($dlyp_ids)) {
                $model_delivery = Model('delivery_point');
                $condition = array();
                $condition['dlyp_id'] = array('in',$dlyp_ids);
                $dlyp_list = $model_delivery->getDeliveryPointOpenList($condition);
                foreach ($dlyp_list as $k => $v) {
                    $dlyp_new_list[$v['dlyp_id']]= $v;
                }
            }
            if (!empty($dlyp_new_list)) {
                foreach ($address_list as $k => $v) {
                    if (!$v['dlyp_id']) continue;
                    $dlyp_info = $dlyp_new_list[$v['dlyp_id']];
                    $address_list[$k]['area_info'] = $dlyp_info['dlyp_area_info'];
                    $address_list[$k]['address'] = $dlyp_info['dlyp_address_name'].'（'.$dlyp_info['dlyp_address'].'）'
                        . '，电话：'.trim($dlyp_info['dlyp_mobile'].'，'.$dlyp_info['dlyp_telephony'],'，');
                    $address_list[$k]['type'] = '[自提服务站]';
                }
            }
        }
        return $address_list;
    }

    /**
     * 取数量
     * @param unknown $condition
     */
    public function getAddressCount($condition = array()) {
        return $this->where($condition)->count();
    }

    /**
     * 构造检索条件
     *
     * @param array $condition 检索条件
     * @return string 数组形式的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

        if ($condition['member_id'] != ''){
            $condition_str .= " member_id = '". intval($condition['member_id']) ."'";
        }

        return $condition_str;
    }

    /**
     * 新增地址
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addAddress($param){
        return $this->insert($param);
    }

    /**
     * 取单个地址
     *
     * @param int $area_id 地址ID
     * @return array 数组类型的返回结果
     */
    public function getOneAddress($id){
        if (intval($id) > 0){
            $param = array();
            $param['table'] = 'address';
            $param['field'] = 'address_id';
            $param['value'] = intval($id);
            $result = Db::getRow($param);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 更新地址信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function editAddress($update, $condition){
        return $this->where($condition)->update($update);
    }
    /**
     * 验证地址是否属于当前用户
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function checkAddress($member_id,$address_id) {
        /**
         * 验证地址是否属于当前用户
         */
        $check_array = self::getOneAddress($address_id);
        if ($check_array['member_id'] == $member_id){
            unset($check_array);
            return true;
        }
        unset($check_array);
        return false;
    }
    /**
     * 删除地址
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function delAddress($condition){
        return $this->where($condition)->delete();
    }
}
