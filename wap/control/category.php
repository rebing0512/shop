<?php

class categoryControl extends mobileHomeControl
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexOp()
    {
        $systemcategoryModel = Model('systemcategory');

        $ch = $systemcategoryModel::getSystemCategory();

        Tpl::output('client',$this->judge_client());

        Tpl::output('ch',$ch);

        Tpl::showpage('category.index','null_layout');

    }

    public function screenOp(){

        $systemcategoryModel = Model('systemcategory');

        $ch = $systemcategoryModel::getSystemCategory();

        if ($ch['result']['application']['sort']=='kind'){
            $title = [
                ['class'=>'category' , 'name'=>$ch['result']['application']['kind_name']],
                ['class'=>'attribute' , 'name'=>$ch['result']['application']['texture_name']]
            ];
        } else {
            $title = [
                ['class'=>'attribute' , 'name'=>$ch['result']['application']['texture_name']],
                ['class'=>'category' , 'name'=>$ch['result']['application']['kind_name']]
            ];
        }
        Tpl::output('classify', empty($ch['result']['application']['texture_name'])||empty($ch['result']['application']['kind_name']));

        Tpl::output('sort',$ch['result']['application']['sort']);

        Tpl::output('title',$title);

        $session_id = $_GET['__ccid']?:$_SESSION['__ccid'];

        foreach ($ch['result']['category'] as $item){
            if ($item['id'] == $session_id){
                $ch = $item;
            }
        }

        Tpl::output('ch',$ch);

        Tpl::showpage('screen');

    }
}