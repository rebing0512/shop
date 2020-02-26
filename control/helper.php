<?php

class helperControl
{
    public function syncuserOp()
    {
        if ($_SERVER['REMOTE_ADDR']!='127.0.0.1')
            exit(json_encode([
                'code' => 1,
                'result' => [
                    'msg' => 'Forbidden from : '.$_SERVER['REMOTE_ADDR']
                ]
            ]));


        Model('member')->editMember([
            'weixin_unionid' => $_POST['id']
        ],[
            'member_name' => $_POST['name'],
            'hashkey' => $_POST['hashkey'],
            'login_mobile' => $_POST['mobile']
        ]);

        $member = Model('member')->getMemberInfo([
            'weixin_unionid' => $_POST['id'],
        ]);
        if ($member)
        {
            Model('seller')->editSeller([
                'seller_login_mobile' => $_POST['mobile'],
                'seller_name' => $member['member_name']
            ],[
                'member_id' => $member['member_id'],
            ]);
            Model('store')->editStore([
                'member_name' => $member['member_name'],
                'seller_name' => $member['member_name'],
            ],[
                'member_id' => $member['member_id']
            ]);
        }

        echo json_encode([
            'code' => 1,
            'result' => [
                'app' => 'shop:'.$_SERVER['HTTP_HOST']
            ]
        ]);
    }
}