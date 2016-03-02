<?php
function wp_bac_breadcrumb() {
    $delimiter = '<span class="sep">→</span>';
    $delimiter1 = '';
            $main = get_bloginfo('name');
            $maxLength= 30;
    if (!is_front_page()) {
		echo '<div id="breadcrumb">';
        global $post, $cat;
        echo '<span class="t">您当前所在位置：</span><a href="' . home_url() . '" class="home " title="'.get_bloginfo('name').'">首页</a>' . $delimiter;  
		$output = '';
		if(is_singular('soft')){
		  $terms = get_the_terms( $post->ID, 'softs' );
		  //$output = '<a href="'.get_post_type_archive_link( 'softs' ).'" title="软件中心">软件中心</a>';
		  if ( $terms && ! is_wp_error( $terms ) ) :
        $parent_f = current($terms);
        $parent = $parent_f->parent;
        $parents[] = $parent_f->term_id;
        while ( $parent ):
          $parents[] = $parent;
          $new_parent = get_term_by( 'id', $parent,'softs' );
          $parent = $new_parent->parent;
        endwhile;
        if ( !empty( $parents ) ):
          $parents = array_reverse( $parents );
          foreach ( $parents as $parent ):
            $item = get_term_by( 'id', $parent,'softs' );
            $output .= '<a href="'.get_term_link((int)$item->term_id,'softs').'">'.$item->name.'</a>'.$delimiter;
          endforeach;
        endif;
      endif;
      $output .= '<span class="c">'.get_the_title().'</span>';
      echo $output;
		}elseif(is_singular('topic')){
		  $terms = get_the_terms( $post->ID, 'topics' );
		  $output = '<a href="'.get_post_type_archive_link( 'topic' ).'" title="专题汇总">专题汇总</a>'. $delimiter;;
		  if ( $terms && ! is_wp_error( $terms ) ) :
        $parent_f = current($terms);
        $parent = $parent_f->parent;
        $parents[] = $parent_f->term_id;
        while ( $parent ):
          $parents[] = $parent;
          $new_parent = get_term_by( 'id', $parent,'topics' );
          $parent = $new_parent->parent;
        endwhile;
        if ( !empty( $parents ) ):
          $parents = array_reverse( $parents );
          foreach ( $parents as $parent ):
            $item = get_term_by( 'id', $parent,'topics' );
            $output .= '<a href="'.get_term_link((int)$item->term_id,'topics').'">'.$item->name.'</a>'.$delimiter;
          endforeach;
        endif;
      endif;
      $output .= '<span class="c">'.get_the_title().'</span>';
      echo $output;
		}elseif(is_single()) {
		  $terms = get_the_terms( $post->ID, 'category' );
		  
		  if ( $terms && ! is_wp_error( $terms ) ) :
        $parent_f = current($terms);
        $parent = $parent_f->parent;
        $parents[] = $parent_f->term_id;
        while ( $parent ):
          $parents[] = $parent;
          $new_parent = get_term_by( 'id', $parent,'category' );
          $parent = $new_parent->parent;
        endwhile;
        if ( !empty( $parents ) ):
          $parents = array_reverse( $parents );
          foreach ( $parents as $parent ):
            $item = get_term_by( 'id', $parent,'category' );
            $output .= '<a href="'.get_term_link((int)$item->term_id,'category').'">'.$item->name.'</a>'.$delimiter;
          endforeach;
        endif;
      endif;
      $output .= '<span class="c">'.get_the_title().'</span>';
      echo $output;
		}elseif(is_tax('softs')){
			//$output = '<a href="'.get_post_type_archive_link( 'softs' ).'" title="软件中心">软件中心</a>'.$delimiter;
			$currentterm = get_queried_object();
			$parent = $currentterm->parent;
			while ( $parent ):
				$parents[] = $parent;
				$new_parent = get_term_by( 'id', $parent,'softs' );
				$parent = $new_parent->parent;
			endwhile;
			if ( !empty( $parents ) ):
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ):
					$item = get_term_by( 'id', $parent,'softs' );
					$output .= '<a href="'.get_term_link((int)$item->term_id,'softs').'">'.$item->name.'</a>'.$delimiter;
				endforeach;
			endif;
			$output .= '<span class="c">'.$currentterm->name .'</span>';
			echo $output;
		}elseif(is_tax('topics')){
			$output = '<a href="'.get_post_type_archive_link( 'topic' ).'" title="专题汇总">专题汇总</a>'.$delimiter;
			$currentterm = get_queried_object();
			$parent = $currentterm->parent;
			while ( $parent ):
				$parents[] = $parent;
				$new_parent = get_term_by( 'id', $parent,'topics' );
				$parent = $new_parent->parent;
			endwhile;
			if ( !empty( $parents ) ):
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ):
					$item = get_term_by( 'id', $parent,'topics' );
					$output .= '<a href="'.get_term_link((int)$item->term_id,'topics').'">'.$item->name.'</a>'.$delimiter;
				endforeach;
			endif;
			$output .= '<span class="c">'.$currentterm->name .'</span>';
			echo $output;
		}elseif (is_category()) {
      $output='';
		  $currentterm = get_queried_object();
		  $parent = $currentterm->parent;
		  while ( $parent ):
        $parents[] = $parent;
        $new_parent = get_term_by( 'id', $parent,'category' );
        $parent = $new_parent->parent;
		  endwhile;
		  if ( !empty( $parents ) ):
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ):
					$item = get_term_by( 'id', $parent,'category' );
					$output .= '<a href="'.get_term_link((int)$item->term_id,'category').'">'.$item->name.'</a>'.$delimiter;
				endforeach;
			endif;
			$output .= '<span class="c">'.$currentterm->name .'</span>';
			echo $output;
    }elseif(is_post_type_archive('soft')){
      echo '<span class="c">软件中心</span>';
		}elseif(is_post_type_archive('topic')){
      echo '<span class="c">专题汇总</span>';
		}elseif ( is_tag() ) {
      echo '<span class="c">标签: "' . single_tag_title("", false) . '"</span>';
    }elseif ( is_search() ) {
      echo '<span class="c">搜索结果</span>';
    }elseif ( is_page() && !$post->post_parent ) {
      echo '<span class="c">'.get_the_title().'</span>';
    }elseif ( is_page() && $post->post_parent ) {
      $post_array = get_post_ancestors($post);
      krsort($post_array); 
      foreach($post_array as $key=>$postid){
        $post_ids = get_post($postid);
        $title = $post_ids->post_title;
        echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
      }
      echo '<span class="c">'.get_the_title().'</span>';
    }elseif ( is_author() ) {
            global $author;
            $user_info = get_userdata($author);
            echo  '作者: ' . $user_info->display_name ;
        }
        elseif ( is_404() ) {
            echo  '404.';
        }
        else {
        }
		echo '</div>';
    }else{
		return;
		//echo '<div class="breadcrumbs"><strong>当前位置：</strong>'.get_bloginfo('name').'</div>';
	}
}
?>