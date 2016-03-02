<?php
/******Slider*******/
$slider_boxinfo = array('title' => 'Info', 'id'=>'bgbox', 'page'=>array('slider'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'');

$slider_options[] = array(
  'name' => '图片',
  'desc' => '请保持所有幻灯片的图片大小统一。',
  'std'=>'',
  'button_label'=>'Upload',
  'id' => 'slider_bg',
  'type' => 'upload'
);
$slider_options[] = array(
  'name' => '链接',
  'id'   => 'slider_link',
  'desc' => '请填写完整地址，如 http://www.example.com，可留空',
  'std'  => '',
  'size' => 40,
  'type' => 'text'
);
$slider_box = new ashuwp_class_metabox($slider_options, $slider_boxinfo);

/***phone option***/
$phone_info = array(
  'full_name' => '手机站设置',
  'optionname'=>'phone',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'phonepage'
);
$phone_option = array();
$phone_option[] = array(
  'name'=>'手机站LOGO',
  'id'=>'phone_logo',
  'std'=>'',
  'desc'=>'',
  'type'=>'upload'
);
$phone_option[] = array(
  'name'=>'手机站软件顶级分类',
  'id'=>'phone_soft_term',
  'std'=>'',
  'desc'=>'',
  'subtype'=>'softs',
  'type'=>'select'
);
$phone_option[] = array(
  'name'=>'手机站游戏分类',
  'id'=>'phone_game_term',
  'std'=>'',
  'desc'=>'',
  'subtype'=>'softs',
  'type'=>'select'
);
$phone_option[] = array(
  'name'=>'手机站专题顶级分类',
  'id'=>'phone_topic_term',
  'std'=>'',
  'desc'=>'',
  'subtype'=>'topics',
  'type'=>'select'
);
$phone_option[] = array(
  'name'=>'首页精选专题',
  'id'=>'phone_topic_recommend',
  'std'=>'',
  'desc'=>'请输入3个专题ID，用英文都好分割，如:1,2,3。注意是专题的ID.',
  'type'=>'numbers_array'
);
$phone_option[] = array(
  'name'=>'热门搜索词',
  'id'=>'phone_hot_key',
  'std'=>'',
  'desc'=>'请输热门关键词，用英文都好分割，如: 360手机关机,手机QQ,支付宝',
  'type'=>'text'
);

$phone_option[] = array(
  'name'=>'首页内容-软件专题',
  'id'=>'jxzt',
  'std'=>'',
  'desc'=>'请直接输入完整地址如：http://www.cjxz.com',
  'type'=>'text'
);
$phone_option[] = array(
  'name'=>'首页内容-装机必备',
  'id'=>'zjbb',
  'std'=>'',
  'desc'=>'请直接输入完整地址如：http://www.cjxz.com',
  'type'=>'text'
);
$phone_option[] = array(
  'name'=>'首页内容-必玩游戏',
  'id'=>'bwyx',
  'std'=>'',
  'desc'=>'请直接输入完整地址如：http://www.cjxz.com',
  'type'=>'text'
);
$phone_page = new ashuwp_class_options($phone_option, $phone_info);
?>