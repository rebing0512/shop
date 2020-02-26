+<?php
/**
 * 文章
 *
 *
 *
 ***/


defined('TTShop') or exit('Access Invalid!');

class articleControl extends BaseHomeControl {
	/**
	 * 默认进入页面
	 */
	public function indexOp(){
		/**
		 * 读取语言包
		 */
		Language::read('home_article_index');
		/**
		 * TOP分类导航
		 */
		$article_class_model	= Model('article_class');
		$condition	= array();
		$condition['ac_parent_id']	= $article_class['ac_id'];
		$sub_class_list	= $article_class_model->getClassList($condition);
		if(empty($sub_class_list) || !is_array($sub_class_list)){
			$condition['ac_parent_id']	= $article_class['ac_parent_id'];
			$sub_class_list	= $article_class_model->getClassList($condition);
		}
		Tpl::output('sub_class_list',$sub_class_list);
	    //获取推荐商品
		$tuijian = Model('goods')->where(array('tag'=>5,"goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_edittime desc")->select();
		Tpl::output('tuijian',$tuijian);//商品分类

		//获取推荐商品
		$rexiao = Model('goods')->where(array('tag'=>2,"goods_state"=>1,"goods_verify"=>1))->limit(4)->Order("goods_edittime desc")->select();
		Tpl::output('rexiao',$rexiao);//商品分类
		//获取最新一条资讯
		$topnews = Model()->table('article')->limit(1)->order("article_id desc")->select();
		Tpl::output('topnews',$topnews);


		//获取top6
		$tongzhi = Model()->table('article')->where("ac_id = 1")->limit(10)->order("article_id desc")->select();
		Tpl::output('tongzhi',$tongzhi);
		//获取最新资讯
		$topnewslist = Model()->table('article')->limit("1,11")->order("article_id desc")->select();
		foreach($topnewslist as &$tl){
			$ac_name = Model()->table('article_class')->where(array('ac_id' => $tl['ac_id']))->limit(1)->order("ac_id desc")->select();

			$tl['ac_name'] = $ac_name[0]['ac_name'];
		}
		Tpl::output('topnewslist',$topnewslist);
		//获取分类2,3项
		$aclist = Model()->table('article_class')->limit("1,3")->order("ac_id asc")->select();
		foreach ($aclist as &$valc) {
			$valc['alist'] = Model()->table('article')->where(array('ac_id'=>$valc['ac_id']))->limit(10)->order("article_id desc")->select();
		}
		Tpl::output('aclist',$aclist);




		//获取10条帮助信息
		$helpshi = Model()->table('article')->where("ac_id = 2")->limit(10)->order("article_id desc")->select();
		Tpl::output('helpshi',$helpshi);
		//获取行业资讯
		$hynews = Model()->table('article')->where("ac_id = 8")->limit(9)->order("article_id desc")->select();
		foreach($hynews as &$vhy){
			$vhy['article_thumb'] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$vhy['article_thumb'];
		}

		Tpl::output('hynews',$hynews);
		Tpl::output('html_title',C('site_name').' - '.'新闻资讯');
		Tpl::showpage('article_index');
	}
	/**
	 * 文章列表显示页面
	 */
	public function articleOp(){
		/**
		 * 读取语言包
		 */
		Language::read('home_article_index');
		$lang	= Language::getLangContent();

		if(empty($_GET['ac_id'])){
			showMessage($lang['para_error'],'','html','error');//'缺少参数:文章类别编号'
		}
		/**
		 * 得到导航ID
		 */
		$nav_id = intval($_GET['nav_id']) ? intval($_GET['nav_id']) : 0 ;
		Tpl::output('index_sign',$nav_id);
		/**
		 * 根据类别编号获取文章类别信息
		 */
		$article_class_model	= Model('article_class');
		$condition	= array();
		if(!empty($_GET['ac_id'])){
			$condition['ac_id']	= intval($_GET['ac_id']);
		}
		$article_class	= $article_class_model->getOneClass(intval($_GET['ac_id']));
		Tpl::output('class_name', $article_class['ac_name']);
		Tpl::output('class_icon', UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE_LOGO.DS.$article_class['ac_logo']));
		if(empty($article_class) || !is_array($article_class)){
			showMessage($lang['article_article_class_not_exists'],'','html','error');//'该文章分类并不存在'
		}
		$default_count	= 5;//定义最新文章列表显示文章的数量
		/**
		 * 分类导航
		 */
		$nav_link = array(
			array(
				'title'=>$lang['homepage'],
				'link'=>SHOP_SITE_URL
			),
			array(
					'title'=>"资讯首页",
					'link' => urlShop('article', 'index')
			),
			array(
				'title'=>$article_class['ac_name']
			)
		);

		Tpl::output('nav_link_list',$nav_link);

		/**
		 * 左侧分类导航
		 */
		$condition	= array();
		$condition['ac_parent_id']	= $article_class['ac_id'];
		$sub_class_list	= $article_class_model->getClassList($condition);
		if(empty($sub_class_list) || !is_array($sub_class_list)){
			$condition['ac_parent_id']	= $article_class['ac_parent_id'];
			$sub_class_list	= $article_class_model->getClassList($condition);
		}
		Tpl::output('sub_class_list',$sub_class_list);
		/**
		 * 文章列表
		 */
		$child_class_list	= $article_class_model->getChildClass(intval($_GET['ac_id']));
		$ac_ids	= array();
		if(!empty($child_class_list) && is_array($child_class_list)){
			foreach ($child_class_list as $v){
				$ac_ids[]	= $v['ac_id'];
			}
		}
		$ac_ids	= implode(',',$ac_ids);
		$article_model	= Model('article');
		$condition 	= array();
		$condition['ac_ids']	= $ac_ids;
		$condition['article_show']	= '1';
		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		$article_list	= $article_model->getArticleList($condition,$page);
		if(is_array($article_list) && !empty($article_list)){
		foreach($article_list as &$vhy){
				if ($vhy['article_img']!= '') {
			       $vhy['article_img'] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$vhy['article_img'];
			    }else{
			       $vhy['article_img'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_article.png';
			    }
		 }
		}
		Tpl::output('article',$article_list);

		   //获取推荐商品
		$tuijian = Model('goods')->where(array('tag'=>5,"goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_edittime desc")->select();
		Tpl::output('tuijian',$tuijian);

		Tpl::output('show_page',$page->show());
		/**
		 * 最新文章列表
		 */
		$count	= count($article_list);
		$new_article_list	= array();
		if(!empty($article_list) && is_array($article_list)){
			for ($i=0;$i<($count>$default_count?$default_count:$count);$i++){
				$new_article_list[]	= $article_list[$i];
			}
		}
		Tpl::output('new_article_list',$new_article_list);

		Model('seo')->type('article')->param(array('article_class'=>$article_class['ac_name']))->show();
		Tpl::showpage('article_list');
	}
	/**
	 * 单篇文章显示页面
	 */
	public function showOp(){
		/**
		 * 读取语言包
		 */
		Language::read('home_article_index');
		$lang	= Language::getLangContent();
		if(empty($_GET['article_id'])){
			showMessage($lang['para_error'],'','html','error');//'缺少参数:文章编号'
		}
		/**
		 * 根据文章编号获取文章信息
		 */

		$article_model	= Model('article');
		Model()->table('article')->where(array('article_id'=> intval($_GET['article_id'])))->update(array('article_view'=>array('exp', 'article_view + 1')));
		$article	= $article_model->getOneArticle(intval($_GET['article_id']));
		if(empty($article) || !is_array($article) || $article['article_show']=='0'){
			showMessage($lang['article_show_not_exists'],'','html','error');//'该文章并不存在'
		}
		Tpl::output('article',$article);

		/**
		 * 根据类别编号获取文章类别信息
		 */
		$article_class_model	= Model('article_class');
		$condition	= array();
		$article_class	= $article_class_model->getOneClass($article['ac_id']);
		if(empty($article_class) || !is_array($article_class)){
			showMessage($lang['article_show_delete'],'','html','error');//'该文章已随所属类别被删除'
		}

		$default_count	= 5;//定义最新文章列表显示文章的数量
		/**
		 * 分类导航
		 */
		$nav_link = array(
			array(
				'title'=>$lang['homepage'],
				'link'=>SHOP_SITE_URL
			),
			array(
				  'title'=>"资讯首页",
					'link' => urlShop('article', 'index')
			),
			array(
				'title'=>$article_class['ac_name'],
			    'link' => urlShop('article', 'article', array('ac_id' => $article_class['ac_id']))
			),
			array(
				'title'=>$article['article_title']
			)
		);

		Tpl::output('nav_link_list',$nav_link);
		/**
		 * 左侧分类导航
		 */
		$condition	= array();
		$condition['ac_parent_id']	= $article_class['ac_id'];
		$sub_class_list	= $article_class_model->getClassList($condition);
		if(empty($sub_class_list) || !is_array($sub_class_list)){
			$condition['ac_parent_id']	= $article_class['ac_parent_id'];
			$sub_class_list	= $article_class_model->getClassList($condition);
		}
		//p($sub_class_list);
		Tpl::output('sub_class_list',$sub_class_list);
		/**
		 * 文章列表
		 */
		$child_class_list	= $article_class_model->getChildClass($article_class['ac_id']);
		$ac_ids	= array();
		if(!empty($child_class_list) && is_array($child_class_list)){
			foreach ($child_class_list as $v){
				$ac_ids[]	= $v['ac_id'];
			}
		}
		$ac_ids	= implode(',',$ac_ids);
		$article_model	= Model('article');
		$condition 	= array();
		$condition['ac_ids']	= $ac_ids;
		$condition['article_show']	= '1';
		$article_list	= $article_model->getArticleList($condition);
		/**
		 * 寻找上一篇与下一篇
		 */
		$pre_article	= $next_article	= array();
		if(!empty($article_list) && is_array($article_list)){
			$pos	= 0;
			foreach ($article_list as $k=>$v){
				if($v['article_id'] == $article['article_id']){
					$pos	= $k;
					break;
				}
			}
			if($pos>0 && is_array($article_list[$pos-1])){
				$pre_article	= $article_list[$pos-1];
			}
			if($pos<count($article_list)-1 and is_array($article_list[$pos+1])){
				$next_article	= $article_list[$pos+1];
			}
		}
		Tpl::output('pre_article',$pre_article);
		Tpl::output('next_article',$next_article);
		/**
		 * 最新文章列表
		 */
		$count	= count($article_list);
		$new_article_list	= array();
		if(!empty($article_list) && is_array($article_list)){
			for ($i=0;$i<($count>$default_count?$default_count:$count);$i++){
				$new_article_list[]	= $article_list[$i];
			}
		}
		Tpl::output('new_article_list',$new_article_list);
		  //获取推荐商品
		$tuijian = Model('goods')->where(array('tag'=>5,"goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_edittime desc")->select();
		Tpl::output('tuijian',$tuijian);
		//小编推荐
		$xbtj = Model('goods')->where(array('goods_id'=>$article['article_goods_id'],"goods_state"=>1,"goods_verify"=>1))->find();
		Tpl::output('xbtj',$xbtj);
		//获得相关文章
		$xgwz = Model()->table('article')->where(array('ac_id' =>$article['ac_id']))->limit(10)->order("article_id desc")->select();
		Tpl::output('xgwz',$xgwz);
		//获取评论

		$pages	= new Page();
		$pages->setEachNum(10);
		$pages->setStyle('admin');
		$wheres['s_conmmet_article_id'] =intval($_GET['article_id']);
  		$article_comment_list = $article_model->getArticleCommentList($wheres,$pages);
  		if(is_array($article_comment_list) && !empty($article_comment_list)){
  			foreach($article_comment_list as &$vhy){
				$infos = Model('member')->where(array('member_id'=>$vhy['s_conmmet_uid']))->find();
				$vhy['member_name'] = $infos['member_name'];
				$vhy['member_avatar'] = getMemberAvatar($infos['member_avatar']);
			}
  		}



		Tpl::output('article_comment_list',$article_comment_list);
		Tpl::output('show_page',$pages->show());
		$seo_param = array();
		$seo_param['name'] = $article['article_title'];
		$seo_param['article_class'] = $article_class['ac_name'];
		Model('seo')->type('article_content')->param($seo_param)->show();
		Tpl::showpage('article_show');
	}

	/**
	*ajax_zan ajax赞
	*/
	public function ajax_zanOp(){
		$newsId	= intval($_POST['newsId']);
		if(!empty($newsId)){

			$up =Model()->table('article')->where(array('article_id'=> $newsId))->update(array('article_zan'=>array('exp', 'article_zan + 1')));

			if($up){
				  echo json_encode(array('status'=>1));
			}else{
				 echo json_encode(array('status'=>0,'info'=>'点赞失败'));
			}
		}else{
			 echo json_encode(array('status'=>0,'info'=>'点赞失败'));
		}
	}

	/**
	*ajax评论
	*/
	public function  ajax_contentOp(){
		    //检查是否可以评论
        if(!$_SESSION['member_id']){
             echo json_encode(array('status'=>3));
        }
        $add_array['s_comment_content'] = $_POST['Pcontent'];
        $add_array['s_conmmet_uid'] = intval($_POST['uid']);
        $add_array['s_conmmet_article_id'] = intval($_POST['nid']);
        $add_array['s_comment_time'] = time();
        $find = Model('article_comment')->where(array('s_conmmet_uid'=> intval($_POST['uid']),'s_conmmet_article_id'=>intval($_POST['nid'])))->find();

        $return_array[0] = $add_array;
        $return_array[0]['member_name'] = $_SESSION['member_name'];
        $return_array[0]['member_img'] = getMemberAvatar($_SESSION['avatar']);
        $return_array[0]['s_comment_time'] = date("Y-m-d H:i:s",$add_array['s_comment_time']);
        if($find){
        	echo json_encode(array('status'=>2));
        }else{
        	$up =Model()->table('article_comment')->insert($add_array);
        	if($up){
        		echo json_encode(array('status'=>1,'data'=>$return_array));
        	}else{
        		echo json_encode(array('status'=>0));
        	}

        }

	}

}
?>
