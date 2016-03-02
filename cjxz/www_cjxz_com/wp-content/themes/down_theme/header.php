<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php global $ashu_option; ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="renderer" content="webkit">
  <title>
  <?php
  $val=get_option('aioseop_options');
  $title = esc_attr(stripslashes($val['aiosp_home_title']));
  if (is_home()) {
    echo $title ;
  }elseif(is_search()) {
    echo '搜索结果 - '. $title;
  }else{
    wp_title(''); echo ' - '; bloginfo('name');
  }
  ?> 
  <?php //wp_title( '|', true, 'right' ); ?></title>
  <?php include("seo.php");?>
  <meta name="keywords" content="<?php echo $keywords; ?>" />
  <meta name="description" content="<?php echo $description; ?>" />
  <?php
  if( isset($ashu_option['general']['site_ico']) ){
  ?>
    <link rel="icon" href="<?php echo $ashu_option['general']['site_ico'];?>" type="image/x-icon" />
  <?php } ?>
  
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body <?php body_class(); ?>>
  <div id="site-page">
    <header id="header" class="clearfix">
      <a href="<?php echo home_url(); ?>" id="logo">
      <?php
        $home_logo = (isset($ashu_option['general']['home_logo']) && $ashu_option['general']['home_logo'] != '') ?$ashu_option['general']['home_logo'] : get_template_directory_uri().'/images/logo.png';
      ?>
      <img src="<?php echo $home_logo;?>" alt="<?php bloginfo('name');?>"/>
      </a>
      <div id="search_wrap">
        <form action="<?php echo home_url(); ?>" method="get">
          <div id="input_wrap" class="clearfix">
          <input type="search" class="search-field" placeholder="Search..." name="s">
          <button type="submit" class="search-submit">搜索</button>
          </div>
        </form>
        <div class="hot_key">
          <a href="<?php echo get_term_link('necessary','softs'); ?>">装机必备</a>
          <a href="<?php echo get_term_link('news','category'); ?>">软件资讯</a>
          <a href="<?php echo get_post_type_archive_link('topic'); ?>">软件专题</a>
        </div>
      </div>
      <div id="nav_wrap">
        <nav id="main-nav">
          <ul>
            <?php
            if ( has_nav_menu( 'primary' ) ) {
            $args = array(
              'container' => false,
              'items_wrap' => '%3$s',
              'sort_column' => 'menu_order',
              'menu_id'=>'main_nav',
              'depth'=>2,
              'menu_class'=>'nav_c',
              'theme_location' => 'primary'
            );
            wp_nav_menu($args);
            }
            ?>
          </ul>
        </nav>
      </div>
    </header>
    <div id="main-wrap">