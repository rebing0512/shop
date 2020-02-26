<?php
/**
 * 邀请返利
 *
 * @User      noikiy
 * @File      invite.php
 * @Link     
 * @Copyright 
 */

//20160906
defined('TTShop') or exit('Access Invalid!');

class inviteControl extends BaseHomeControl
{
    public function indexOp(){
        Tpl::showpage('invite');
    }
}
