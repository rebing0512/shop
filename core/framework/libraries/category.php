<?php
// +----------------------------------------------------------------------
// | I can because i think i can
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.hfine520.tk All rights reserved.
// +----------------------------------------------------------------------
// | Author: hfine <hfine520@163.com> 
// +----------------------------------------------------------------------
defined('TTShop') or exit('Access Invalid!');
	Class Category{
		//无限极分类1维数组
		Static Public function unlimitedForLevel($cate , $html ='***********',$color ='#e44d4d', $pid = 0 , $level = 0){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$v['level'] = $level + 1;
					$v['html'] = str_repeat($html, $level);
					$v['color'] = str_repeat($color, $level);
					$arr[] = $v;
					$arr = array_merge($arr,self::unlimitedForLevel($cate , $html ,$color, $v['id'] , $level + 1));
				}
			}

			return $arr;
		}

		//无限极分类多维数组
		Static Public function unlimitedForLayer($cate,$name = 'child', $pid = 0){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid ) {
					$v[$name] = self::unlimitedForLayer($cate , $name ,$v['id']);
					$arr[] = $v;
				}
			}
			return $arr;
		}
		//依据子id查找父类id包含的所有子类
		Static Public function getParents($cate , $id){
			$arr = array();
			foreach ($cate as $v) {
			    if ($v['catid'] == $id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate , $v['parentid']) , $arr);			
				}
			}
			return $arr;
		}
		//传递父类id返回所有子类id

		Static 	Public function getChildsId($cate , $pid ){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['parentid'] == $pid) {
					$arr[] = $v['catid'];
					$arr = array_merge($arr , self::getChildsId($cate , $v['catid']));
				}
			}
			return $arr;
		}
		//传递父类id返回所有子类
		Static 	Public function getChilds($cate , $pid ){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['parentid'] == $pid) {
					$arr[] = $v;
					$arr = array_merge($arr , self::getChildsId($cate , $v['catid']));
				}
			}
			return $arr;
		}

}



?>