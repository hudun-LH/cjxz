jQuery(document).ready(function($){
  soft_ul = $('#soft-recent-results ul');
  soft_ul.on('click','li',function(){
    soft_ul.find('li').removeClass('select');
    $(this).addClass('select');
  });
  
  $('#wp-soft-submit').on('click',function(){
    soft_item = '';
    soft_item = soft_ul.find('li.select').find('.item-permalink').val();
    soft_info = $.parseJSON(soft_item); 
    html = '<li class="soft_item"><div class="topic_wrap"><a href="#" class="img"><img src="' + soft_info.ico + '"></a><a class="t" href="#">' + soft_info.title + '</a><span class="size">' + soft_info.date + '  /  ' + soft_info.size + '</span><div class="post-ratings"></div><a class="down" href="#" target="_blank">下载</a><p><span>推荐理由:</span><textarea name="topic_softs[' + soft_info.id + ']"/></textarea></div><a href="#" class="remove">移除</a></li>';
    
    $('.topic_lists ul').append(html);
    $('#add_soft_modal').modal('hide');
  });
  
  $('#soft-recent-results').on('click','a',function(){
    $this = $(this);
    var href = $this.attr("href");
    if (href != undefined) {
      $.ajax( {
        url: href,
        type: "get",
        
        error: function(request) {
          
        },
        success: function(data) {
          var softs = $(data).find("li");
          var pagenav = $(data).find(".page_nav");
          $('#soft-recent-results ul').html(softs);
          $('#page_nav_wrap').html(pagenav);
        }
      });
    }
    return false;
  });
  
  $('#soft-search-btn').on('click',function(){
    serch_key = $('#soft-search-field').val();
    if(serch_key){
      $.ajax( {
        url: ashu_file_preview.ajaxurl,
        type: "get",
        data:'action=wp_soft_ajax&pagenum=1&search=' + serch_key,
        error: function(request) {
          
        },
        success: function(data) {
          var softs = $(data).find("li");
          var pagenav = $(data).find(".page_nav");
          $('#soft-recent-results ul').html(softs);
          $('#page_nav_wrap').html(pagenav);
        }
      });
    }
    return false;
  });
  
  $('.topic_lists').on('click','a.remove',function(){
    $(this).closest('li.soft_item').remove();
    return false;
  });
  
  $('.topic_softs_wrap .topic_lists').sortable({
    items: 'li.soft_item',
    cursor: 'move',
    scrollSensitivity:40,
    forcePlaceholderSize: true,
    forceHelperSize: false,
    helper: 'clone',
    opacity: 0.65,
    placeholder: 'wc-metabox-sortable-placeholder',
    start:function(event,ui){
      ui.item.css('background-color','#f6f6f6');
    },
    stop:function(event,ui){
      ui.item.removeAttr('style');
    }
  });
});