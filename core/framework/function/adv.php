<?php

defined('TTShop') or exit('Access Invalid!');
/**
 * 取广告内容
 *
 * @param unknown_type $ap_id
 * @param unknown_type $type html,js,array
 */
function advshow($ap_id, $type = 'js'){
	if($ap_id < 1)return;
	$time    = time();

    $ap_info = Model('adv')->getApById($ap_id);
    if (!$ap_info)
        return;

	$list = $ap_info['adv_list'];unset($ap_info['adv_list']);
	extract($ap_info);
	if($is_use !== '1'){
	    return ;
	}
	$adv_list = array();
	$adv_info = array();//异步调用的数组格式
	foreach ((array)$list as $k=>$v){
		if($v['adv_start_date'] < $time && $v['adv_end_date'] > $time && $v['is_allow'] == '1'){
		    $adv_list[] = $v;
		}
	}

    if(empty($adv_list)){
    		
        if($ap_class == '1'){//文字广告
			$content .= "<a href=''>";
	        $content .= $default_content;
	        $content .= "</a>";
        }else{
			$width   = $ap_width;
	        $height  = $ap_height;
			$content .= "<a href='' title='".$ap_name."'>";
	        $content .= "<img style='width:{$width}px;height:{$height}px' border='0' src='";
	        $content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$default_content;
            $content .= "' alt=''/>";
	        $content .= "</a>";
	        $adv_info['adv_title'] = $ap_name;
	        $adv_info['adv_img'] = UPLOAD_SITE_URL."/".ATTACH_ADV."/".$default_content;
	        $adv_info['adv_url'] = '';
        }
    }else {
        $select = 0;
        if($ap_display == '1'){//多广告展示
            $select = array_rand($adv_list);
        }
        $adv_select = $adv_list[$select];
        extract($adv_select);
		//图片广告
		if($ap_class == '0'){
			$width   = $ap_width;
			$height  = $ap_height;
			$pic_content = unserialize($adv_content);
			$pic     = $pic_content['adv_pic'];
			$url     = $pic_content['adv_pic_url'];
			$content .= "<a href='https://".$pic_content['adv_pic_url']."' target='_blank' title='".$adv_title."'>";
			$content .= "<img style='width:{$width}px;height:{$height}px' border='0' src='";
			$content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$pic;
		    $content .= "' alt='".$adv_title."'/>";
			$content .= "</a>";
	        $adv_info['adv_title'] = $adv_title;
	        $adv_info['adv_img'] = UPLOAD_SITE_URL."/".ATTACH_ADV."/".$pic;
	        $adv_info['adv_url'] = 'https://'.$pic_content['adv_pic_url'];
		}
		//文字广告
		if($ap_class == '1'){
			$word_content = unserialize($adv_content);
			$word    = $word_content['adv_word'];
			$url     = $word_content['adv_word_url'];
			$content .= "<a href='https://".$pic_content['adv_word_url']."' target='_blank'>";
			$content .= $word;
			$content .= "</a>";
		}
        //Flash广告
		if($ap_class == '3'){
			$width   = $ap_width;
			$height  = $ap_height;
			$flash_content = unserialize($adv_content);
			$flash   = $flash_content['flash_swf'];
			$url     = $flash_content['flash_url'];
			$content .= "<a href='https://".$url."' target='_blank'><button style='width:".$width."px; height:".$height."px; border:none; padding:0; background:none;' disabled><object id='FlashID' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='".$width."' height='".$height."'>";
			$content .= "<param name='movie' value='";
			$content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$flash;
			$content .= "' /><param name='quality' value='high' /><param name='wmode' value='opaque' /><param name='swfversion' value='9.0.45.0' /><!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 --><param name='expressinstall' value='";
			$content .= RESOURCE_SITE_URL."/js/expressInstall.swf'/><!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 --><!--[if !IE]>--><object type='application/x-shockwave-flash' data='";
			$content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$flash;
			$content .= "' width='".$width."' height='".$height."'><!--<![endif]--><param name='quality' value='high' /><param name='wmode' value='opaque' /><param name='swfversion' value='9.0.45.0' /><param name='expressinstall' value='";
			$content .= RESOURCE_SITE_URL."/js/expressInstall.swf'/><!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 --><div><h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4><p><a href='http://www.adobe.com/go/getflashplayer'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='获取 Adobe Flash Player' width='112' height='33' /></a></p></div><!--[if !IE]>--></object><!--<![endif]--></object></button></a>";
		}

		//多图轮播
		if ($ap_class == '4') {
			$width   = $ap_width;
			$height  = $ap_height;
			$anniu_weizhi = $ap_setting_anniu_weizhi;
			$anniu_ys = $ap_setting_anniu_ys;
			$anniu_wenzi = $ap_setting_anniu_wenzi;
			$anniu_ys_after = $ap_setting_anniu_ys_after;

			$content .="<div class='slide_floor_ad' style='float: left;width: ".$width."px;height: ".$height."px;border-bottom: 1px solid #E6E6E6;overflow: hidden;position: relative;'>";
			$content .="<ul style='width: ".$width."px;height: ".$height."px'>";

			foreach ($adv_list as $kt=> &$vlist) {
				$pic_content1 = unserialize($vlist['adv_content']);

				$pic1     = $pic_content1['adv_pic'];
				$url1     = $pic_content1['adv_pic_url'];
				if($kt == 0){
					$content .="<li style='display: list-item;'> ";
				}else{
					$content .="<li style='display: none;'> ";
					

				}
			
				$content .="<a href='https://".$url1."' target='_blank'><img class='lazy' src='";
				$content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$pic1;
				$content.="'alt='".$vlist['adv_title']."'";
				$content.="title='".$vlist['adv_title']."'></a>";
				$content .="</li>";
			}
			$content .="</ul>";

			if($anniu_wenzi){
				if(!$anniu_weizhi){
					$content .="<div  class='slide_flad_a' style='width:".$width."px;".$anniu_weizhi."'>";
				}else{
					$content .="<div  class='slide_flad_a' style='width:".$width."px;position: absolute;bottom: 0px;height:35px;background:rgba(0,0,0,0.5); '>";
				}
				
				foreach ($adv_list as $kt=> &$vlist) {
					if($kt ==0 ){
						if(!$anniu_ys){
						
							$content .="<span style='".$anniu_ys."'></span>";
						}else{
							$content .="<span style='width: ".$width."px;display: inline-block;height: 35px;color:#fff;line-height:35px;text-indent:1em;'>".$vlist['adv_title']."</span>";
							$after = "#f60";
						}
				
					}else{
						if(!$anniu_ys_after){
						
							$content .="<div style='".$anniu_ys_after."'></span>";
						}else{
							$content .="<span style='width: ".$width."px;display: inline-block;height: 35px;color:#fff;line-height:35px;text-indent:1em;'>".$vlist['adv_title']."</span>";
							
						}
						
					}
			
		        }                      
				$content .="</div>";
			}else{
				if($anniu_weizhi){
					$content .="<div  class='slide_flad_a' style='".$anniu_weizhi."'>";
				}else{
					$content .="<div  class='slide_flad_a' style='position: absolute;right: 10px;bottom: 10px;'>";
				}
		
				foreach ($adv_list as $kt=> &$vlist) {
					if($kt ==0 ){
						if($anniu_ys){
							$yslist = explode(';', $anniu_ys);
							$after = explode(':', $yslist[1]);
							$after = $after[1];
							$content .="<span style='".$anniu_ys."'></span>";
						}else{
							$content .="<span style='display: inline-block;margin: 0px 3px;border: 1px solid #f60;background: #f60;width: 8px;height: 8px;border-radius: 8px;'></span>";
							$after = "#f60";
						}
						
					}else{
						if($anniu_ys_after){
							$ysafterlist = explode(';', $anniu_ys_after);
							$next = explode(':', $ysafterlist[1]);
							$next = $next[1];
							$content .="<span style='".$anniu_ys_after."'></span>";
						}else{
							$content .="<span style='display: inline-block;margin: 0px 3px;border: 1px solid #999;background: #CCC;width: 8px;height: 8px;border-radius: 8px;'></span> ";
							$next = "#ccc";
						}
						
					}
			
		        }                      
				$content .="</div>";
			}
				

			$content .="</div>";
			$content .="<script type='text/javascript'>$('.slide_floor_ad').each(function(){var the=$(this);var fla=the.find('.slide_flad_a');var a=fla.find('span');var b=the.find('li');autoBanner(a,b,'cur',3500,".$anniu_wenzi.",'".$after."','".$next."')});</script>";


						
		}
		//wap端轮播
		if ($ap_class == '5') {
			$width   = $ap_width;
			$height  = $ap_height;

			$content .="<div class='vadbox' id='vadbox'>";
			$content .="<div class='vad'><ul>";
 
			foreach ($adv_list as $kt=> &$vlist) {
				$pic_content1 = unserialize($vlist['adv_content']);

				$pic1     = $pic_content1['adv_pic'];
				$url1     = $pic_content1['adv_pic_url'];
				$content .="<li><a href='https://".$url1."'> <img class='lazy' src='" ;
				$content .= UPLOAD_SITE_URL."/".ATTACH_ADV."/".$pic1;
				$content.="' alt='".$vlist['adv_title']."'";
				$content.=" title='".$vlist['adv_title']."'></a>";
				$content .="</li>";
			}
			$content .="</ul>";
			$content .=" <div class='vad-nav'> <ul>";
			foreach ($adv_list as $kt=> &$vlist) {
				if($kt ==0 ){
					$content .=" <li class='on'></li>";
				}else{
					$content .=" <li></li>";
				}
		
	        } 
	       $site_url = MOBILE_SITE_URL.'/templates/'.TPL_MOBILE_NAME;                   
			$content .="</ul></div></div></div>";
			$content .='<script type="text/javascript" src="'.$site_url.'/js/TouchSlide.1.1.js"></script>';
			$content .="<script type='text/javascript'>$(function(){TouchSlide({slideCell:'#vadbox',titCell:'.vad-nav ul',mainCell:'.vad ul', effect:'leftLoop', delayTime:1000,interTime:4000,autoPage:true,autoPlay:true })})</script>";



						
		}
    }
 
	if ($type == 'array' && $ap_class == '0'){
		return $adv_info;
	}

	if ($type == 'js'){
		$content = "document.write(\"".$content."\");";
	}
	return $content;
}
