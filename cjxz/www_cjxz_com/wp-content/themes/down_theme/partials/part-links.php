      <div id="friend_links">
        <div class="t_title clearfix">
          <h3><a href="">友情链接</a></h3>
        </div>
        <div class="links_wrap">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          $args = array(
            'echo'=>false,
            'container' => false,
            'items_wrap' => '%3$s',
            'sort_column' => 'menu_order',
            'menu_id'=>'main_nav',
            'depth'=>1,
            'menu_class'=>'nav_c',
            'theme_location' => 'links',
            'walker' => new ashuwp_manu_line()
          );
          $footer_na = wp_nav_menu($args);
          echo strip_tags($footer_na ,'<span><a>');
        }
        ?>
        </div>
      </div>