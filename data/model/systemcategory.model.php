<?php

class systemcategoryModel
{
    public static function getSystemCategory()
    {
        $cache_key = C('app_alias');

        if (extension_loaded('apcu') && apcu_exists($cache_key))
            return apcu_fetch($cache_key);

        $ch = curl_init();
        curl_setopt_array($ch,[
            CURLOPT_URL => 'https://mbcsc.confolsc.com/get_app_category.php?app_alias='.C('app_alias'),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 5
        ]);
        $res = curl_exec($ch);

        $ch = json_decode($res,true);

        if (!$ch)
            throw_exception("分类数据读取失败");

        if (extension_loaded('apcu'))
            apcu_add($cache_key,$ch,60*30);

        return $ch;
    }

    public static function getCategoryText($category_id=null,$attribute_id=null,$texture_id=null)
    {
        $texts = [];

//        if (apcu_exists('attribute'.$attribute_id) && apcu_exists('texture'.$texture_id) && apcu_exists('category'.$category_id))
//        {
//            return [
//                'category' => apcu_fetch('category'.$category_id),
//                'attribute' => apcu_fetch('attribute'.$attribute_id),
//                'texture' => apcu_fetch('texture'.$texture_id),
//                'kind' => apcu_fetch('kind'.$attribute_id)
//            ];
//        }

        $category = static::getSystemCategory();
        foreach ($category['result']['category'] as $item)
        {
            if ($item['id'] == $category_id) {
                // cache
                apcu_add('category'.$category_id,$item['name']);
                $texts['category'] = $item['name'];
                foreach ($item['kinds'] as $kind)
                {
                    foreach ($kind['attributes'] as $attribute)
                    {
                        if ($attribute['id'] == $attribute_id)
                        {
                            //cache
                            apcu_add('attribute'.$attribute_id,$attribute['name']);
                            apcu_add('kind'.$attribute_id,$kind['name']);
                            $texts['kind'] = $kind['name'];
                            $texts['attribute'] = $attribute['name'];
                        }
                    }
                }
                foreach ($item['textures'] as $texture)
                {
                    if ($texture['id'] == $texture_id) {
                        //cache
                        if (!empty($texture['sub_name'])){
                            apcu_add('texture'.$texture_id,$texture['sub_name'].'（'.$texture['name'].'）');
                            $texts['texture'] = $texture['sub_name'].'（'.$texture['name'].'）';
                        } else {
                            apcu_add('texture'.$texture_id,$texture['name']);
                            $texts['texture'] = $texture['name'];
                        }
                    }
                }
            }
        }

        if (empty($texts['attribute'])||empty($texts['texture']))
        {
            return false;
        }

        return $texts;
    }
}