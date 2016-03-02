<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 4.0
**/

/**soft**/
$soft_info = array('title' => '软件基本信息', 'id'=>'soft_basic', 'page'=>array('soft'), 'context'=>'normal', 'priority'=>'high');
$soft_meta[] = array(
  'name' => '图标',
  'id'   => 'rjtb_value',
  'desc' => '非必填项，正方形图片100x100像素，jpg、png均可',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);
$soft_meta[] = array(
  'name' => '星评等级',
  'id'   => 'xxdj_value',
  'desc' => '',
  'std'  => '4',
  'type' => 'text',
  'class' => 'col-3'
);
$soft_meta[] = array(
  'name' => '软件大小',
  'id'   => 'rjdx_value',
  'desc' => '必填项，不用填写单位',
  'std'  => '',
  'type' => 'text',
  'class' => 'col-3'
);
$soft_meta[] = array(
  'name'    => '软件单位',
  'id'      => 'rjdw_value',
  'desc'    => '请选择软件的单位KB或MB?',
  'std'     => 'MB',
  'buttons' => array(
    'KB'  => 'KB',
    'MB' => 'MB'
  ),
  'type'    => 'radio'
);
/*$soft_meta[] = array(
  'name' => '软件语言',
  'id'   => 'jmyy_value',
  'desc' => '',
  'std'  => '中文',
  'type' => 'text',
  'class' => 'col-3'
);*/
$soft_meta[] = array(
  'name'    => '软件语言',
  'id'      => 'jmyy_value',
  'desc'    => '请选择软件的语言:',
  'std'     => 'cn',
  'buttons' => array(
    'cn'  => '中文',
    'en' => '英文',
	'tw' => '繁体中文',
	'other' => '多国语言'
  ),
  'type'    => 'radio'
);

/*$soft_meta[] = array(
  'name' => '授权方式',
  'id'   => 'sqfs_value',
  'desc' => '',
  'std'  => '免费软件',
  'type'    => 'text',
  'class' => 'col-3'
);*/

$soft_meta[] = array(
  'name'    => '授权方式',
  'id'      => 'sqfs_value',
  'desc'    => '请选择软件的授权方式:',
  'std'     => 'shares',
  'buttons' => array(
    'shares'  => '共享版',
    'frees' => '免费版',
	'trys' => '试用版'
  ),
  'type'    => 'radio'
);

$soft_meta[] = array(
  'name' => '软件官网',
  'id'   => 'soft_site',
  'desc' => '非必填项，填写示例http://www.cjxz.com',
  'std'  => '',
  'type' => 'text'
);
$soft_meta[] = array(
  'name' => '下载次数',
  'id'   => 'views',
  'desc' => '',
  'std'  => rand(5, 20),
  'type' => 'text'
);
$soft_meta[] = array(
  'name' => '官方下载地址',
  'id'   => 'gfgs_value',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_meta[] = array(
  'name' => '迅雷下载地址',
  'id'   => 'xlgs_value',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_meta[] = array(
  'name' => '百度网盘下载地址',
  'id'   => 'bdwp_value',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_basic_box = new ashuwp_class_metabox($soft_meta, $soft_info);


/**soft content**/
/*
$soft_info2 = array('title' => '软件详情', 'id'=>'soft_content', 'page'=>array('soft'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');
$soft_meta2[] = array(
  'name' => '特色功能',
  'id'   => 'tab_first',
  'type' => 'open'
);
$soft_meta2[] = array(
  'name'  => '特色功能',
  'id'    => 'soft_feature',
  'desc'  => '',
  'std'   => '',
  'media' => 1,
  'type'  => 'tinymce'
);
$soft_meta2[] = array(
  'type' => 'close'
);
$soft_meta2[] = array(
  'name' => '功能介绍',
  'id'   => 'tab_second',
  'type' => 'open'
);
$soft_meta2[] = array(
  'name'  => '功能介绍',
  'id'    => 'soft_function',
  'desc'  => '',
  'std'   => '',
  'media' => 1,
  'type'  => 'tinymce'
);

$soft_meta2[] = array(
  'type' => 'close'
);
$soft_meta2[] = array(
  'name' => '下载地址',
  'id'   => 'tab_third',
  'type' => 'open'
);
$soft_meta2[] = array(
  'name' => '本地下载地址',
  'id'   => 'soft_down_local',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_meta2[] = array(
  'name' => '迅雷下载地址',
  'id'   => 'soft_down_thunder',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_meta2[] = array(
  'name' => '百度网盘下载地址',
  'id'   => 'soft_down_baidu',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);
$soft_meta2[] = array(
  'type' => 'close'
);
$work_box2 = new ashuwp_class_metabox($soft_meta2, $soft_info2);
*/
/**专题**/
$topic_boxinfo = array('title' => '专题详情', 'id'=>'topic_basic', 'page'=>array('topic'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'','tab'=>true);
$topic_meta[] = array(
  'name' => '专题图片',
  'id'   => 'topic_ico',
  'desc' => '建议: 使用png格式图片，图片名称避免中文字符。建议尺寸：750*310',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);
/*
$topic_meta[] = array(
  'name'  => '专题描述',
  'id'    => 'topic_desc',
  'desc'  => '',
  'std'   => '',
  'media' => 1,
  'type'  => 'tinymce'
);
*/
$topic_basic_box = new ashuwp_class_metabox($topic_meta, $topic_boxinfo);

/*****SEO Box********/
/*
$seo_meta = array();
$seoinfo = array('title' => 'SEO设置', 'id'=>'seobox', 'page'=>array('page','post','soft','topic'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'','tab'=>true);
$seo_meta[] = array(
  'name' => 'Title',
  'id'   => 'title_meta',
  'desc' => '',
  'std'  => '',
  'size' => 40,
  'type' => 'text'
);

$seo_meta[] = array(
  'name' => '关键词',
  'id'   => 'keywords',
  'desc' => '',
  'std'  => '',
  'size' => 40,
  'type' => 'text'
);

$seo_meta[] = array(
  'name' => '描述',
  'id'   => 'description',
  'desc' => '',
  'std'  => '',
  'size' => array(60,5),
  'type' => 'textarea'
);
$seo_box = new ashuwp_class_metabox($seo_meta, $seoinfo);
*/
/*****Category key words******/
$feilds = array();
$taxonomyinfo = array('category','softs','topics');

$feilds[] = array(
  'name' => 'Title',
  'id'   => 'title_meta',
  'desc' => '',
  'std'  => '',
  'size' => 40,
  'type' => 'text'
);
$feilds[] = array(
  'name' => '关键词',
  'desc' => '',
  'id' => 'keywords',
  'std' => '',
  'edit_only'=>false,
  'size' => 40,
  'type' => 'text'
);
$feilds[] = array(
  'name' => '描述信息',
  'desc' => '',
  'id' => 'description',
  'std' => '',
  'edit_only'=>false,
  'size' => 40,
  'type' => 'text'
);
$new_taxonomy_feild = new ashuwp_taxonomy_feild($feilds, $taxonomyinfo);

$softs_meta = array();
$soft_cat_info = array('softs');
$softs_meta[] = array(
  'name' => '分类图标',
  'id'   => 'softs_ico',
  'desc' => '用于手机站',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);
$new_softs_feild = new ashuwp_taxonomy_feild($softs_meta, $soft_cat_info);

/*********Options************/
$page_info = array(
  'full_name' => '基本设置',
  'optionname'=>'general',
  'child'=>false,
  'filename' => 'generalpage'
);
$ashu_option = array();

$ashu_option[] = array(
  'type' => 'open',
  'desc' => '',
  'id'   => '基本'
);
$ashu_option[] = array(
  'name'=>'首页Titile(default)',
  'id'=>'title_meta',
  'size'=>'60',
  'std'=>'',
  'desc'=>'',
  'type'=>'text'
);

$ashu_option[] = array(
  'name'=>'首页关键词(default)',
  'id'=>'keywords',
  'size'=>'60',
  'std'=>'',
  'desc'=>'',
  'type'=>'text'
);
$ashu_option[] = array(
  'name'=>'首页描述(default)',
  'id'=>'description',
  'desc'=>'',
  'std'=>'',
  'type'=>'textarea'
);

$ashu_option[] = array(
  'name' => 'Icon',
  'desc' => 'please upload a logo image',
  'std'=>'',
  'id' => 'site_ico',
  'type' => 'upload'
);

$ashu_option[] = array(
  'name' => 'LOGO',
  'desc' => 'please upload a logo image',
  'std'=>'',
  'id' => 'home_logo',
  'type' => 'upload'
);
/*
$ashu_option[] = array(
  'name'=>'百度统计',
  'id'=>'tongji_baidu',
  'size'=>'80',
  'std'=>'',
  'desc'=>'',
  'type'=>'text'
);
*/
$ashu_option[] = array(	'type' => 'close');
$general_page = new ashuwp_class_options($ashu_option, $page_info);

/***footer option***/
$footer_info = array(
  'full_name' => '底部设置',
  'optionname'=>'footer',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'footerpage'
);
$footer_option = array();

$footer_option[] = array(
  'type' => 'open',
  'desc' => '',
  'id'   => '底部设置'
);


$footer_option[] = array(
  'name'=>'底部版权文字',
  'id'=>'tinymce_copyright',
  'desc'=>'',
  'std'=>'',
  'type'=>'tinymce'
);

$footer_option[] = array(
  'name'=>'第三方代码',
  'id'=>'_code_tongji',
  'desc'=>'将第三方代码添加在 &lt;/body&gt; 标签之前',
  'std'=>'',
  'type'=>'textarea'
);

$footer_option[] = array(	'type' => 'close');
$footer_page = new ashuwp_class_options($footer_option, $footer_info);

/***home option***/
$home_info = array(
  'full_name' => '首页设置',
  'optionname'=>'home',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'homepage'
);
$home_option = array();
$home_option[] = array(
  'type' => 'open',
  'name'=>'精品推荐',
  'desc' => '',
  'id'   => 'tab1'
);
$home_option[] = array(
  'name'=>'推荐精品',
  'id'=>'boutique_soft',
  'std'=>'',
  'desc'=>'请输入要推荐的软件ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'合集推荐',
  'id'=>'boutique_topic',
  'std'=>'',
  'desc'=>'请输入要推荐的合集分类，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(	'type' => 'close' );

$home_option[] = array(
  'type' => 'open',
  'name'=>'板块二',
  'desc' => '',
  'id'   => 'tab2'
);
$home_option[] = array(
  'name'=>'精选推荐(1)',
  'id'=>'block_2_1',
  'std'=>'',
  'desc'=>'共四组，请输入要推荐的软件ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'精选推荐(2)',
  'id'=>'block_2_2',
  'std'=>'',
  'desc'=>'共四组，请输入要推荐的软件ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'精选推荐(3)',
  'id'=>'block_2_3',
  'std'=>'',
  'desc'=>'共四组，请输入要推荐的软件ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'精选推荐(4)',
  'id'=>'block_2_4',
  'std'=>'',
  'desc'=>'共四组，请输入要推荐的软件ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);

$home_option[] = array(
  'name'=>'最近更新',
  'id'=>'block_2_5',
  'std'=>'',
  'desc'=>'请设置约6个软件分类ID，留空的默认调用6个软件分类',
  'type'=>'numbers_array'
);

$home_option[] = array(	'type' => 'close' );

$home_option[] = array(
  'type' => 'open',
  'name'=>'板块三',
  'desc' => '',
  'id'   => 'tab3'
);
$home_option[] = array(
  'name'=>'六块分类',
  'id'=>'block_3',
  'std'=>'',
  'desc'=>'请输入6个分类ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(	'type' => 'close' );

$home_option[] = array(
  'type' => 'open',
  'name'=>'板块四',
  'desc' => '',
  'id'   => 'tab4'
);
$home_option[] = array(
  'name'=>'分类',
  'id'=>'block_4',
  'std'=>'',
  'desc'=>'请输入15个分类ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(	'type' => 'close' );

$home_option[] = array(
  'type' => 'open',
  'name'=>'板块五',
  'desc' => '',
  'id'   => 'tab5'
);
$home_option[] = array(
  'name'=>'应用导航',
  'id'=>'daohang_1',
  'std'=>'',
  'desc'=>'请输入10个软件分类ID，用英文都好分割，如:1,2,3。注意是软件的分类ID',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'软件合集',
  'id'=>'daohang_2',
  'std'=>'',
  'desc'=>'请输入10个专题分类ID，用英文都好分割，如:1,2,3。注意是专题的分类ID',
  'type'=>'numbers_array'
);
$home_option[] = array(
  'name'=>'精选专区',
  'id'=>'daohang_3',
  'std'=>'',
  'desc'=>'请输入10个专题ID，用英文都好分割，如:1,2,3。注意是专题的ID',
  'type'=>'numbers_array'
);
$home_option[] = array(	'type' => 'close' );

$home_option[] = array(
  'type' => 'open',
  'name'=>'板块六',
  'desc' => '',
  'id'   => 'tab6'
);
$home_option[] = array(
  'name'=>'精选专区',
  'id'=>'cat_new1',
  'std'=>'',
  'desc'=>'请输入6-7个软件分类ID，用英文都好分割，如:1,2,3',
  'type'=>'numbers_array'
);
$home_option[] = array(	'type' => 'close' );
$home_page = new ashuwp_class_options($home_option, $home_info);

/**
*
*import-export page
*
**/
/****import-export*****/
$import_info = array(
  'full_name' => 'Import/Export',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'import_page'
);
$import_page = new ashu_option_import_class($import_info);
?>