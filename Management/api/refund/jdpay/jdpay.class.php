<?php
/**
 * 网银支付退款
 *
 * 
 */
defined('TTShop') or exit('Access Invalid!');


class jdpayNotify {
    /**
     * HTTPS形式消息验证地址
     */
	var $https_verify_url = 'https://mapi.jdpay.com/gateway.do?service=notify_verify&';
	/**
     * HTTP形式消息验证地址
     */
	var $http_verify_url = 'http://notify.jdpay.com/trade/notify_query.do?';
	var $jdpay_config;

	function __construct($jdpay_config){
		$jdpay_config['sign_type'] = strtoupper('MD5');
		$this->jdpay_config = $jdpay_config;
	}
    function jdpayNotify($jdpay_config) {
    	$this->__construct($jdpay_config);
    }
    /**
     * 针对notify_url验证消息是否是支付宝发出的合法消息
     * @return 验证结果
     */
	function verifyNotify(){
		if(empty($dats)) {//判断POST来的数组是否为空
			return false;
		}
		else {
			//生成签名结果
			$isSign = $this->getSignVeryfy($dats, $dats["sign"]);
			//获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
			$responseTxt = 'true';
			if (! empty($dats["notify_id"])) {$responseTxt = $this->getResponse($dats["notify_id"]);}
			if (preg_match("/true$/i",$responseTxt) && $isSign) {
				return true;
			} else {
				return false;
			}
		}
	}
	
    /**
     * 获取返回时的签名验证结果
     * @param $para_temp 通知返回来的参数数组
     * @param $sign 返回的签名结果
     * @return 签名验证结果
     */
	function getSignVeryfy($para_temp, $sign) {
		//除去待签名参数数组中的空值和签名参数
		$para_filter = paraFilter($para_temp);
		
		//对待签名参数数组排序
		$para_sort = argSort($para_filter);
		
		//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = createLinkstring($para_sort);
		
		$isSgin = false;
		switch (strtoupper(trim($this->jdpay_config['sign_type']))) {
			case "MD5" :
				$isSgin = md5Verify($prestr, $sign, $this->jdpay_config['key']);
				break;
			default :
				$isSgin = false;
		}
		
		return $isSgin;
	}

    /**
     * 获取远程服务器ATN结果,验证返回URL
     * @param $notify_id 通知校验ID
     * @return 服务器ATN结果
     * 验证结果集：
     * invalid命令参数不对 出现这个错误，请检测返回处理中partner和key是否为空 
     * true 返回正确信息
     * false 请检查防火墙或者是服务器阻止端口问题以及验证时间是否超过一分钟
     */
	function getResponse($notify_id) {
		$partner = trim($this->jdpay_config['partner']);
		$veryfy_url = '';
		if(extension_loaded('openssl')) {
			$veryfy_url = $this->https_verify_url;
		}
		else {
			$veryfy_url = $this->http_verify_url;
		}
		$veryfy_url = $veryfy_url."partner=" . $partner . "&notify_id=" . $notify_id;
		$responseTxt = getHttpResponseGET($veryfy_url, getcwd().'/cacert.pem');
		return $responseTxt;
	}
}
class JdpaySubmit {

	var $jdpay_config;
	/**
	 *支付宝网关地址（新）
	 */
	var $jdpay_gateway_new = 'https://m.jdpay.com/wepay/refund';

	function __construct($jdpay_config){
		$jdpay_config['sign_type'] = strtoupper('MD5');
		$this->jdpay_config = $jdpay_config;
	}
    function JdpaySubmit($jdpay_config) {
    	$this->__construct($jdpay_config);
    }
	

	

	/**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组字符串
     */
	function buildRequestParaToString($para_temp) {
		// //待请求参数数组
		// $para = $this->buildRequestPara($para_temp);
		
		// //把参数组中所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
		// $request_data = $this->jdpay_gateway_new.createLinkstringUrlencode($para);
		
		// return $request_data;
		include './class/RSAUtils.php';
		include './class/TDESUtil.php';
		include './class/HttpUtils.php';
		$params = $this->prepareParms($para_temp);
		$data = json_encode ($params);
		list ( $return_code, $return_content ) =  HttpUtils :: httpdats_data ($this->jdpay_gateway_new, $data );
		$return_content = str_replace("\n", '', $return_content);
		$return_data = json_decode ($return_content,true);
		
		$_SESSION ['errorMsg'] = null;
		$_SESSION ['resultData'] =null;
		//执行状态 成功
		if ($return_data['resultCode'] == 0) {
			$mapResult =  $return_data ['resultData'];

			//有返回数据
			if (null != $mapResult) {
				$data = $mapResult["data"];
				$sign = $mapResult["sign"];
				//1.解密签名内容
				$decryptStr = RSAUtils::decryptByPublicKey($sign);
		
				//2.对data进行sha256摘要加密
				$sha256SourceSignString = hash ( "sha256",$data);
		
				//3.比对结果
				if ($decryptStr == $sha256SourceSignString) {
					/**
					 * 验签通过
					 */
					//解密data
					$decrypData = TDESUtil::decrypt4HexStr(base64_decode($this->jdpay_config['jdpay_account']),$data);
		
					//退款结果实体
					$resultData= json_decode($decrypData,true);
		
					//错误消息
					if(null==$resultData){
						$_SESSION['errorMsg'] = $decrypData;
					}
					else{
						$_SESSION['resultData'] = $resultData;
					}
				} else {
					/**
					 * 验签失败  不受信任的响应数据
					 * 终止
					 */
					$_SESSION ['errorMsg'] ="签名失败!";
		
				}
			}
		}
		//执行退款 失败
		else{
			$_SESSION['errorMsg'] = $return_data['resultMsg'];
		}
	}

	public function  prepareParms($dats){
		
		$tradeJsonData= "{\"tradeNum\": \"".$dats["tradeNum"]."\",\"oTradeNum\": \"".$dats["oTradeNum"]."\",\"tradeAmount\":\"".$dats["tradeAmount"]."\",\"tradeCurrency\": \"".$dats["tradeCurrency"]."\",\"tradeDate\": \"".$dats["tradeDate"]."\",\"tradeTime\": \"".$dats["tradeTime"]."\",\"tradeNotice\": \"".$dats["tradeNotice"]."\",\"tradeNote\": \"".$dats["tradeNote"]."\"}";

		$tradeData = TDESUtil::encrypt2HexStr(base64_decode(ConfigUtil::get_val_by_key("desKey")),$tradeJsonData);
        
		$sha256SourceSignString = hash ( "sha256", $tradeData);	
        $sign = RSAUtils::encryptByPrivateKey ($sha256SourceSignString);

		$params= array();
		$params["version"] = $dats["version"];
		$params["merchantNum"] = $dats["merchantNum"];
		$params["merchantSign"] = $sign;
		$params["data"] = $tradeData;
		
		return $params;
	}

}
?>