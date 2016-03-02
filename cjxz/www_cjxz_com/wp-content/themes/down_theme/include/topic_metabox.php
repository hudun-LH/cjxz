<?php
add_action('admin_menu', 'topic_add_metabox');
function topic_add_metabox(){
  if ( function_exists('add_meta_box') ){
    add_meta_box( 'topic_metabox_display', '专题软件', 'topic_metabox_display', 'topic', 'normal', 'high' );
  }
}

function topic_metabox_display(){
  if(isset($_GET['post']))
    $post_id = $_GET['post'];
  else
    $post_id = 0;
  
  $softs = get_post_meta($post_id,'topic_softs',true);
  
  /*
  $softs = array(
    '32' => '百度地图虽然...',
    '35' => '高德地图...'，
    
  );
  */
  
  echo '<div class="topic_softs_wrap"><p class="add_notice">请点击添加软件，可拖动排序，前面三个分别为小编推荐、最多下载、最受欢迎。</p><div class="topic_lists"><ul class="clearfix">';
  if($softs){
    foreach ( $softs as $id=>$desc ) {
      $soft = get_post($id);
      $ico = get_soft_ico_src($id);
      $size = get_post_meta($id,'rjdx_value',true);
      if($size=='')
        $size = '0M';
    ?>
    <li class="soft_item">
      <div class="topic_wrap">
        <a href="#" class="img"><img src="<?php echo $ico; ?>"></a>
        <a class="t" href="#"><?php echo $soft->post_title; ?></a><span class="size"><?php echo mysql2date( 'Y-m-d', $soft->post_date ); ?>  /  <?php echo $size; ?></span>
        <div class="post-ratings">
          
        </div>
        <a class="down" href="#" target="_blank">下载</a>
        <p><span>推荐理由:</span><textarea name="<?php echo 'topic_softs['.$id.']';?>"/><?php echo $desc; ?></textarea>
      </div>
      <a href="#" class="remove">移除</a>
    </li>
    <?php
    } 
  }
  echo '</ul></div>';
  echo '<a href="#add_soft_modal" id="soft_add_btn" class="btn btn-primary btn-large" data-toggle="modal">增加一个软件</a>';
  echo '</div>';
  
}

add_action( 'admin_footer', 'wp_soft_dialog' );
function wp_soft_dialog() {
  ?>
  <div id="add_soft_modal" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加软件</h4>
      </div>
      <div class="modal-body">
		<form id="wp-soft">
		<?php wp_nonce_field( 'internal-soft_add', '_ajax_soft_add_nonce', false ); ?>
		<div id="soft-selector">
			<p class="howto"><span id="wp-soft-search-toggle">在下面列表中选择,请点击按钮索搜，勿使用回车搜索</span></p>
			<div id="soft-search-panel">
				<div class="soft-search-wrapper">
					<label>
						<input type="search" id="soft-search-field" class="soft-search-field" value=""/>
						<a href="#" class="button-primary" id="soft-search-btn">搜索</a>
					</label>
				</div>
				<div id="soft-recent-results" class="query-results" tabindex="0">
					
					<ul>
            <?php
            $query = array(
              'post_type' => 'soft',
              'post_status' => 'publish',
              'posts_per_page' => 20,
            );
            $get_posts = new WP_Query;
            $posts = $get_posts->query( $query );
            if ( ! $get_posts->post_count )
              return false;
            $class = 'class="alternate"';
            foreach ( $posts as $post ) {
              $results = array();
              if($class!='')
                $class = '';
              else
                $class = 'class="alternate"';
              
              $ico = get_post_meta($post->ID,'rjtb_value',true);
              $size = get_post_meta($post->ID,'rjdx_value',true);
              if($size=='')
                $size = '0M';
              
              $results['id'] = $post->ID;
              $results['title'] = $post->post_title;
              $results['ico'] = $ico;
              $results['size'] = $size;
              $results['date'] = mysql2date( 'Y-m-d', $post->post_date );
            ?>
            <li <?php echo $class; ?>>
              <input type="hidden" class="item-permalink" value='<?php echo json_encode( $results ); ?>'>
              <span class="item-title"><?php echo $post->post_title; ?></span>
            </li>
            <?php } ?>
          </ul>
					<div id="page_nav_wrap"><div class="page_nav">
						<?php
            $pagination = paginate_links( array(
              'base' => add_query_arg( 'pagenum', '%#%' , admin_url( 'admin-ajax.php?action=wp_soft_ajax' )),
              'format' => '',
              'prev_text' => '上一页',
              'next_text' => '下一页',
              'total' => $get_posts->max_num_pages,
              'current' => 1
              )
            );
            if ( $pagination ) {
              echo $pagination;
            }
            ?>
					</div></div>
				</div>
			</div>
		</div>
		</form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" id="wp-soft-submit" class="btn btn-primary">添加</button>
      </div>
    </div>
  </div>
  </div>
		<?php
	}
?>