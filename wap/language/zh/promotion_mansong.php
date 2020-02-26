<?php
defined('TTShop') or exit('Access Invalid!');

$lang['promotion_unavailable'] = '商品促銷功能尚未開啟';
$lang['promotion_mansong'] = '滿即送';

$lang['promotion_active_list'] 	= '活動列表';
$lang['promotion_quota_list'] 	= '套餐列表';
$lang['promotion_join_active'] 	= '添加活動';
$lang['promotion_buy_product'] 	= '購買套餐';
$lang['promotion_goods_manage'] = '商品管理';
$lang['promotion_add_goods'] 	= '添加商品';

$lang['state_new'] = '新申請';
$lang['state_verify'] = '已審核';
$lang['state_cancel'] = '已取消';
$lang['state_verify_fail'] = '審核失敗';
$lang['mansong_quota_state_activity'] = '正常';
$lang['mansong_quota_state_cancel'] = '取消';
$lang['mansong_quota_state_expire'] = '失效';
$lang['mansong_state_unpublished'] = '未發佈';
$lang['mansong_state_published'] = '已發佈';
$lang['mansong_state_cancel'] = '已取消';
$lang['all_state'] = '全部狀態';

$lang['mansong_quota_start_time'] = '開始時間';
$lang['mansong_quota_end_time'] = '結束時間';
$lang['mansong_quota_times_limit'] = '活動次數限制';
$lang['mansong_quota_times_published'] = '已發佈活動次數';
$lang['mansong_quota_times_publish'] = '剩餘活動次數';
$lang['mansong_quota_goods_limit'] = '商品限制';
$lang['mansong_name'] = '活動名稱';
$lang['mansong_status'] = '活動狀態';
$lang['mansong_active_content'] = '活動內容';
$lang['mansong_apply_date'] = '套餐申請時間';
$lang['mansong_apply_quantity'] = '申請數量(月)';
$lang['apply_date'] = '申請時間';
$lang['apply_quantity'] = '申請數量';
$lang['apply_quantity_unit'] = '（包月）';
$lang['mansong_discount'] = '折扣';
$lang['mansong_buy_limit'] = '購買限制';

$lang['start_time'] = '開始時間';
$lang['end_time'] = '結束時間';
$lang['xianshi_list'] = '限時折扣';
$lang['mansong_list'] = '滿即送';
$lang['mansong_add'] = '添加活動';
$lang['mansong_quota'] = '套餐列表';
$lang['mansong_apply'] = '申請列表';
$lang['mansong_detail'] = '活動詳情';
$lang['mansong_quota_add'] = '購買套餐';
$lang['mansong_quota_add_quantity'] = '套餐購買數量';
$lang['mansong_quota_add_confirm'] = '確認購買?您總共需要支付';
$lang['goods_add'] = '添加商品';
$lang['choose_goods'] = '選擇商品';
$lang['goods_name'] = '商品名稱';
$lang['goods_store_price'] = '商品價格';
$lang['mansong_goods_selected'] = '已選商品';
$lang['mansong_publish'] = '發佈活動';
$lang['ensure_publish'] = '確認發佈該活動?';
$lang['level_price'] = '消費限額';
$lang['shipping_free'] = '包郵';
$lang['level_discount'] = '減現金';
$lang['gift_name'] = '送禮品';
$lang['gift_link'] = '禮品連結';
$lang['mansong_price'] = '購買滿即送所需金幣數';
$lang['mansong_price_explain1'] = '購買單位為月(30天)，一次最多購買12個月，購買後您可以發佈滿即送活動，但同時只能有一個活動進行';
$lang['mansong_price_explain2'] = '每月您需要支付';
$lang['mansong_price_explain3'] = '套餐時間從審批後的第二天零點開始計算';
$lang['mansong_add_explain1'] = '滿即送活動包括店舖所有商品，活動時間不能和已有活動重疊';
$lang['mansong_add_explain2'] = '每個滿即送活動最多可以設置3個價格級別，點擊新增級別按鈕可以增加新的級別，價格級別應該由低到高';
$lang['mansong_add_explain3'] = '每個級別可以有減現金、包郵、送禮品3種促銷方式，至少需要選擇一種';
$lang['mansong_add_start_time_explain'] = '開始時間不能為空且不能早于%s';
$lang['mansong_add_end_time_explain'] = '結束時間不能為空且不能晚于%s';
$lang['mansong_discount_explain'] = '折扣必須為0.1-9.9之間的數字';
$lang['mansong_buy_limit_explain'] = '購買限制必須為正整數';
$lang['time_error'] = '時間格式錯誤';
$lang['param_error'] = '參數錯誤';
$lang['greater_than_start_time'] = '結束時間必須大於開始時間';
$lang['mansong_price_error'] = '不能為空且必須為正整數';
$lang['mansong_name_explain'] = '活動名稱最多為25個字元';
$lang['mansong_name_error'] = '活動名稱不能為空';
$lang['mansong_remark_explain'] = '活動備註最多為100個字元';
$lang['mansong_quota_quantity_error'] = '數量不能為空，且必須為1-12之間的整數';
$lang['mansong_quota_add_success'] = '滿即送套餐購買成功';
$lang['mansong_quota_add_fail'] = '滿即送套餐購買申請失敗';
$lang['mansong_quota_add_fail_nogold'] = '滿即送套餐購買申請失敗，您沒有足夠的金幣';
$lang['mansong_quota_current_error'] = '當前沒有可用的滿即送套餐，請先購買套餐';
$lang['mansong_quota_current_error1'] = '您當前的滿即送套餐已用完，請等待下期套餐或購買新的套餐';
$lang['mansong_quota_current_error2'] = '您已經購買了滿即送套餐';
$lang['mansong_add_success'] = '滿即送活動添加成功';
$lang['mansong_add_fail'] = '滿即送活動添加失敗';
$lang['mansong_goods_none'] = '您還沒有添加活動商品';
$lang['mansong_goods_add_success'] = '滿即送活動商品添加成功';
$lang['mansong_goods_add_fail'] = '滿即送活動商品添加失敗';
$lang['mansong_goods_delete_success'] = '滿即送活動商品刪除成功';
$lang['mansong_goods_delete_fail'] = '滿即送活動商品刪除失敗';
$lang['mansong_goods_cancel_success'] = '滿即送活動商品取消成功';
$lang['mansong_goods_cancel_fail'] = '滿即送活動商品取消失敗';
$lang['mansong_goods_limit_error'] = '已經超過了活動商品數限制';
$lang['mansong_goods_is_exist'] = '該商品已經參加了本期滿即送，請選擇其它商品';
$lang['mansong_publish_success'] = '滿即送活動發佈成功';
$lang['mansong_publish_fail'] = '滿即送活動發佈失敗';
$lang['mansong_cancel_success'] = '滿即送活動取消成功';
$lang['mansong_cancel_fail'] = '滿即送活動取消失敗';
$lang['mansong_level_price_error'] = '消費額必須為正整數';
$lang['mansong_level_discount_null'] = '優惠金額不能為空';
$lang['mansong_level_discount_error'] = '優惠金額必須為正整數';
$lang['mansong_level_gift_error'] = '贈品名稱不能為空';
$lang['mansong_level_rule_select_error'] = '請至少選擇一種促銷方式';
$lang['mansong_level_error'] = '高級別的銷售額必須大於低級別';

$lang['setting_save_success'] = '設置保存成功';
$lang['setting_save_fail'] = '設置保存失敗';
$lang['mansong_explain1'] = '已參加限時折扣、團購等促銷活動的商品不再參加滿即送活動';
$lang['mansong_explain2'] = '參加滿即送活動的商品必須使用購物車進行結算';

$lang['text_month'] = '月';
$lang['text_gold'] = '金幣';
$lang['text_jian'] = '件';
$lang['text_ci'] = '次';
$lang['text_goods'] = '商品';
$lang['text_normal'] = '正常';
$lang['text_invalidation'] = '失效';
$lang['text_default'] = '預設';
$lang['text_add'] = '添加';
$lang['text_back'] = '返回';
$lang['text_level'] = '級別';
$lang['text_level_condition'] = '消費滿';
$lang['text_reduce'] = '減';
$lang['text_yuan'] = '元';
$lang['text_cash'] = '現金';
$lang['text_give'] = '贈送';
$lang['text_gift'] = '禮品';
$lang['text_link'] = '連結';
$lang['link_explain'] = '禮品連結必須為包含http://的完整url';
$lang['text_new_level'] = '新增級別';
$lang['text_remark'] = '備註';
$lang['text_not_join'] = '未參加';

$lang['mansong_apply_verify_success_glog_desc'] = '購買滿即送活動%s個月，單價%s金幣，總共花費%s金幣';
