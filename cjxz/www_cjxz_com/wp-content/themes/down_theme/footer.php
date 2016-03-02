<?php global $ashu_option; ?>
    </div>
    <footer id="footer">
      <div class="foot_nav">
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
            'theme_location' => 'footer',
            'walker' => new ashuwp_manu_line()
          );
          $footer_na = wp_nav_menu($args);
          echo strip_tags($footer_na ,'<span><a>');
        }
        ?>
        
      </div>
      <div id="copy_right">
        <?php
        if( isset($ashu_option['footer']['tinymce_copyright']) ){
          $desc_content = apply_filters('the_content', $ashu_option['footer']['tinymce_copyright']);
          $desc_content = str_replace(']]>', ']]&gt;', $desc_content);
          echo $desc_content;
        }
        ?>
        <?php
        if(isset($ashu_option['footer']['_code_tongji']) && ($ashu_option['footer']['_code_tongji'] != '')){
          echo htmlspecialchars_decode($ashu_option['footer']['_code_tongji']);
        }
        ?>
      </div>
    </footer>
  </div>
  <?php wp_footer() ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?07099cfb4c34717b6dab38965d0aebd3";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>