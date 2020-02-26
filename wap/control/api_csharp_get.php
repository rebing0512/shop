<?php

function get_shidiao_arr(){
		//confing
		//   http://www.zgqtsw.cn/IDcard/show.asp  
		//   http://www.zgqtsw.cn/IDcard/show.asp?txtSBNumber=HC3982
		//   http://www.zgqtsw.cn/shidiao/bh-QTSD020577
		$tdomian = "http://www.zgqtsw.cn";
		//$api_str = "bh-HC3982";
		$api_str = trim($_GET['keyword']);
		$get_html_url = $tdomian."/IDcard/show.asp?txtSBNumber=".$api_str;
		
		//header("Content-type: text/html; charset=utf-8"); 
		
		
		//echo $html;
		//$html_WC_left = $html->find('div[class=WC_left]',0);
		
		$echo_arr = array();
		$echo_arr_name =  array("SBNumber","Title","Category","Author","Size","Weight","CreateTime","Picture");

//		$html = file_get_html($get_html_url);
		// 新建一个Dom实例
        //$html = new simple_html_dom();

        $ch = curl_init();
        curl_setopt_array($ch,array(
            CURLOPT_URL => $get_html_url,
            CURLOPT_RETURNTRANSFER=>1,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $html = curl_exec($ch);
        curl_close($ch);
        $html = str_get_html($html);

		//var_dump($html_WC_left);
		//文字
		$WC_left = $html->find('div[class=WC_left] ul li'); 
		
		if(!empty($WC_left)){
		
		//////////////////////////////////////////////////////////////////////
		//* 内容存在
		//////////////////////////////////////////////////////////////////////
		
			  //图片
			  $WC_right = $html->find('div[class=WC_right] img'); //#thumbs .slideshowItem
			  //var_dump($WC_left);
			  $i=0;
			  //文字解析
			  foreach($WC_left as $val){
					 //echo $val. '<br>';
					 //echo $val->plaintext . '<br>';
					 unset($tstr);
					 unset($tarr);
					 $tstr = $val->plaintext;
					 //$tstr = str_replace(' ', '', $tstr);
					 //$tstr = str_replace('&nbsp;', '', $tstr);
					 $tarr = explode("：",$tstr);
					 $echo_arr[$echo_arr_name[$i]]['title'] = $tarr[0];
					 $echo_arr[$echo_arr_name[$i]]['value'] = $tarr[1];
					 $i++;
			  }
			  //图片解析
			  $img_temp = array();
			  foreach($WC_right as $val){
					 unset($tstr);
					 unset($tarr);
					 $img_temp[] = $tdomian.$val->src;
			  }
			  $echo_arr[$echo_arr_name[$i]]['title'] = "图片";
			  $echo_arr[$echo_arr_name[$i]]['value'] = $img_temp;
		}else{
		//////////////////////////////////////////////////////////////////////
		//* 内容不存在
		//////////////////////////////////////////////////////////////////////
		
		}
		//输出演示
		//var_dump($echo_arr);
		
		$html->clear();
		//返回值
		return $echo_arr;
}


/*

array(8) {
  ["SBNumber"]=>
  array(2) {
    ["title"]=>
    string(9) "商标号"
    ["value"]=>
    string(6) "HC3982"
  }
  ["Title"]=>
  array(2) {
    ["title"]=>
    string(6) "品名"
    ["value"]=>
    string(12) "浩然正气"
  }
  ["Category"]=>
  array(2) {
    ["title"]=>
    string(6) "石种"
    ["value"]=>
    string(15) "封门夹板冻"
  }
  ["Author"]=>
  array(2) {
    ["title"]=>
    string(6) "作者"
    ["value"]=>
    string(9) "名石苑"
  }
  ["Size"]=>
  array(2) {
    ["title"]=>
    string(6) "规格"
    ["value"]=>
    string(6) "32×32"
  }
  ["Weight"]=>
  array(2) {
    ["title"]=>
    string(6) "重量"
    ["value"]=>
    string(0) ""
  }
  ["CreateTime"]=>
  array(2) {
    ["title"]=>
    string(12) "创作时间"
    ["value"]=>
    string(6) "2007.9"
  }
  ["Picture"]=>
  array(2) {
    ["title"]=>
    string(6) "图片"
    ["value"]=>
    array(1) {
      [0]=>
      string(54) "http://www.zgqtsw.cn/SBCXupload/200802/9/185366545.jpg"
    }
  }
}


*/