<?php
/**
 * 商城板块初始化文件
 *
 *
 *
 */
// $site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/main.php')).'/ynlmscms/index.php?con=cms_index');
// echo $site_url;
// @header('Location: '.$site_url);

// if($_SERVER['HTTP_HOST'] !== 'www.ynlmsc.pw' && $_SERVER['HTTP_HOST'] !== 'm.ynlmsc.pw') {
// 	header('HTTP/1.1 301 Moved Permanently');//发出301头部
// 	header('Location: http://www.ynlmsc.pw');//跳转到我的新域名地址
// 	exit();
// }

define('APP_ID','shop');
define('BASE_PATH',str_replace('\\','/',dirname(__DIR__)));

require __DIR__ . '/runshop.php';

define('APP_SITE_URL',SHOP_SITE_URL);
define('TPL_NAME',TPL_SHOP_NAME);
define('SHOP_RESOURCE_SITE_URL',SHOP_SITE_URL.DS.'resource');
define('SHOP_TEMPLATES_URL',SHOP_SITE_URL.'/templates/'.TPL_NAME);
define('BASE_TPL_PATH',BASE_PATH.'/templates/'.TPL_NAME);
//cms框架扩展
require(BASE_PATH.'/framework/function/function.php');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
	$wapurl = WAP_SITE_URL;
	
	$agent = $_SERVER['HTTP_USER_AGENT'];
	if(strpos($agent,"comFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS")){
		global $config;

        if(!empty($config['wap_site_url'])){
            $url = $config['wap_site_url'];
            switch ($_GET['con']){
			case 'login':
			  $url .= '/index.php?con=register&fun=index&inviterid=' . $_GET['inviterid'];
			  break;
			}
        } else {
            header("Location:" . $wapurl);
        }
	
			 header('Location:' . $url);
			exit();	
	
       
		
        
	}

Base::run();
