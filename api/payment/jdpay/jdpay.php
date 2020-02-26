<?php




/**
 * 网银在线接口类
 *
 
 */
defined('TTShop') or exit('Access Invalid!');

class jdpay{
	/**
	 * 网银在线网关
	 *
	 * @var string
	 */
/*	private $gateway   = 'https://Pay3.jdpay.com.cn/PayGate';*/
	private $gateway   = 'https://plus.jdpay.com/nPay.htm';
	/**
	 * 支付接口标识
	 *
	 * @var string
	 */
    private $code      = 'jdpay';
    /**
	 * 支付接口配置信息
	 *
	 * @var array
	 */
    private $payment;
     /**
	 * 订单信息
	 *
	 * @var array
	 */
    private $order;
    /**
	 * 发送至网银在线的参数
	 *
	 * @var array
	 */
    private $parameter;
    /**
     * 支付状态
     * @var unknown
     */
    private $pay_result;
    
    public function __construct($payment_info,$order_info){
    
    	$this->jdpay($payment_info,$order_info);
    }
    public function jdpay($payment_info = array(),$order_info = array()){
    	if(!empty($payment_info) and !empty($order_info)){
    		$this->payment	= $payment_info;
    		$this->order	= $order_info;
    	}
    }
	/**
	 * 支付表单
	 *获取支付接口的请求地址
	 */
	public function submit(){
	require_once ("class/signUtil.php");		
		$v_oid = $this->order['pay_sn'];															//订单号
		$v_amount = $this->order['api_pay_amount']*100;                  			//支付金额                 
        $v_moneytype = "CNY";                                           //币种
        $ip = getIp();
        $subject = $this->order['subject'];
		$v_mid = $this->payment['payment_config']['jdpay_account'];	// 商户号，这里为测试商户号1001，替换为自己的商户号(老版商户号为4位或5位,新版为8位)即可
		$v_url = SHOP_SITE_URL."/api/payment/jdpay/return_url.php";	// 请填写返回url,地址应为绝对路径,带有http协议
		$n_url =  SHOP_SITE_URL."/api/payment/jdpay/notify_url.php";
		$key   = $this->payment['payment_config']['jdpay_key'];			// 如果您还没有设置MD5密钥请登陆我们为您提供商户后台，地址：https://merchant3.jdpay.com.cn/

		$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;       //md5加密拼凑串,注意顺序不能变
        $v_md5info = strtoupper(md5($text));                            //md5函数加密并转化成大写字母


		$param = array();
		$param["currency"] = $v_moneytype;
		$param["ip"] = $ip;
		$param["merchantNum"] = $v_mid;
		$param["merchantRemark"] = $subject;
		$param["notifyUrl"] = $n_url;
		$param["successCallbackUrl"] = $v_url;
		$param["tradeAmount"] = $v_amount;
		$param["tradeDescription"] = $subject;
		$param["tradeName"] = $subject;
		$param["tradeNum"] = $v_oid;
		$param["tradeTime"] = date('Y-m-d H:i:s', time());
		$param["version"] = '1.1.5';
		$param["token"] ='';

		$sign = SignUtil::signWithoutToHex($param);
		$param["merchantSign"] = $sign;
		
		$_SESSION['tradeAmount'] = $v_amount;
		$_SESSION['tradeName'] = $subject;
		$_SESSION['tradeInfo'] = $param;


		$html = '<html><meta charset="utf-8"/><head></head><body>';
		$html .= '<form method="post" name="E_FORM" action="https://plus.jdpay.com/nPay.htm">';
		foreach ($param as $key => $val){
			$html .= "<input type='hidden' name='$key' value='$val' />";
		}
		$html .= '</form><script type="text/javascript">document.E_FORM.submit();</script>';
		$html .= '</body></html>';
		echo $html;
		exit;
	}

/*================================================================================*/







/*================================================================================*/
	/**
	 * 返回地址验证(同步)
	 *
	 * @param 
	 * @return boolean
	 */
	public function return_verify(){
		
		// $key   = $this->payment['payment_config']['jdpay_key'];		
			
		// $v_oid     =trim($_POST['v_oid']);       // 商户发送的v_oid定单编号   
		// $v_pmode   =trim($_POST['v_pmode']);    // 支付方式（字符串）   
		// $v_pstatus =trim($_POST['v_pstatus']);   //  支付状态 ：20（支付成功）；30（支付失败）
		// $v_pstring =trim($_POST['v_pstring']);   // 支付结果信息 ： 支付完成（当v_pstatus=20时）；失败原因（当v_pstatus=30时,字符串）； 
		// $v_amount  =trim($_POST['v_amount']);     // 订单实际支付金额
		// $v_moneytype  =trim($_POST['v_moneytype']); //订单实际支付币种    
		// $remark1   =trim($_POST['remark1']);      //备注字段1
		// $remark2   =trim($_POST['remark2']);     //备注字段2
		// $v_md5str  =trim($_POST['v_md5str']);   //拼凑后的MD5校验值 

		/**
		 * 重新计算md5的值
		 */                   
		// $md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));
		
		/**
		 * 判断返回信息，如果支付成功，并且支付结果可信，则做进一步的处理
		 */
		// if ($v_md5str==$md5string){
		    
		// 	if($v_pstatus=="20"){
		// 	    $this->pay_result = true;
		// 		//支付成功，可进行逻辑处理！
		// 		return true;
		// 	}else{
		// 		return false;//echo "支付失败";
		// 	}
		// }else{
		// 	return false;//echo "<br>校验失败,数据可疑";
		// }
	

		$param = array();
		$param["token"] = $_GET["token"];
		$param["tradeAmount"] = $_GET["tradeAmount"];
		$param["tradeCurrency"] = $_GET["tradeCurrency"];
		$param["tradeDate"] = $_GET["tradeDate"];
		$param["tradeNote"] = $_GET["tradeNote"];
		$param["tradeNum"] = $_GET["tradeNum"];
		$param["tradeStatus"] = $_GET["tradeStatus"];
		$param["tradeTime"] = $_GET["tradeTime"];		
		include './class/SignUtil.php';
		
		$data = SignUtil::signString ( $param, SignUtil::$unSignKeyList );
		error_log($data, 0);
		//1.解密签名内容
		$decryptStr = RSAUtils::decryptByPublicKey($_GET["sign"]);
		
		//2.对data进行sha256摘要加密
		$sha256SourceSignString = hash ( "sha256",$data);
		error_log($decryptStr, 0);
		error_log($sha256SourceSignString, 0);
		
		//3.比对结果
		if ($decryptStr == $sha256SourceSignString) {
			return true;
		}else{
			return false;
		}

	}


/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	/**
	 * 返回地址验证(异步)
	 * @return boolean
	 */
	public function notify_verify() {
	  	$resp =$_POST ( "resp" );
		$desKey = 'ta4E/aspLA3lgFGKmNDNRYU92RkZ4w2t';
		$md5Key ='test';
		// 获取通知原始信息
		// echo "异步通知原始数据:" . $resp . "\n";
		if (null == $resp) {
			return;
		}

		// 获取配置密钥
		// echo "desKey:" . $desKey . "\n";
		// echo "md5Key:" . $md5Key . "\n";
		// 解析XML
		$params = $this->xml_to_array ( base64_decode ( $resp ) );

		$ownSign = $this->generateSign ( $params, $md5Key );
		$params_json = json_encode ( $params );
		// echo "解析XML得到对象:" . $params_json . '\n';
		// echo "根据传输数据生成的签名:" . $ownSign . "\n";
		
		if ($params ['SIGN'] [0] == $ownSign) {
			// 验签不对
			echo "签名验证正确!" . "\n";
		} else {
			echo "签名验证错误!" . "\n";
			return;
		}
		include './class/DesUtils.php';
		// 验签成功，业务处理
		// 对Data数据进行解密
		$des = new DesUtils (); // （秘钥向量，混淆向量）
		$decryptArr = $des->decrypt ( $params ['DATA'] [0], $desKey ); // 加密字符串
		if($decryptArr['status']==0){
			return true;
		}else{
			return false;
		}
		 echo "对<DATA>进行解密得到的数据:" . $decryptArr . "\n";
		 $params ['data'] = $decryptArr;
		 echo "最终数据:" . json_encode ( $params ) . '\n';
		 echo "**********接收异步通知结束。**********";
		
		return;
    
	}

	/**
	 * 取得订单支付状态，成功或失败
	 *
	 * @param array $param
	 * @return array
	 */
	public function getPayResult($param){

	    return $param['tradeStatus']?false:true;
	}

	public function __get($name){
	    return $this->$name;
	}

	public function xml_to_array($xml) {
		$array = ( array ) (simplexml_load_string ( $xml ));
		foreach ( $array as $key => $item ) {
			$array [$key] = $this->struct_to_array ( ( array ) $item );
		}
		return $array;
	}
	public function struct_to_array($item) {
		if (! is_string ( $item )) {
			$item = ( array ) $item;
			foreach ( $item as $key => $val ) {
				$item [$key] = $this->struct_to_array ( $val );
			}
		}
		return $item;
	}
	
	/**
	 * 签名
	 */
	public function generateSign($data, $md5Key) {
		$sb = $data ['VERSION'] [0] . $data ['MERCHANT'] [0] . $data ['TERMINAL'] [0] . $data ['DATA'] [0] . $md5Key;
		
		return md5 ( $sb );
	}
}
