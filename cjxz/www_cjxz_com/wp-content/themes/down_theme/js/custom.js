jQuery(document).ready(function($){
  $('#carosel_wrap').slick({
    autoplay: false,
    infinite:true,
    slidesToShow: 8,
    slidesToScroll: 8
  });
  $('#topic_carosel').slick({
    autoplay: false,
    infinite:true,
    slidesToShow: 4,
    slidesToScroll: 4
  });
  
  $('#topic_side a').hover(function(){
    next = $(this).next();
    next.addClass('hover_next');
  },function(){
    all_brother = $(this).siblings();
    all_brother.removeClass('hover_next');
  });
  
  $('.controls a').each(function(index){
    $(this).hover(function(){
      $(this).siblings().removeClass('active');
      $(this).addClass('active');
      $('#new_tab .tab_show .item_pane').removeClass('active');
      $("#new_tab .tab_show .item_pane:eq(" + index + ")").addClass('active');
    },function(){
      
    });
  });
  
  $('.topic_lists ul li .topic_wrap').matchHeight();
  $('#four_left dl').matchHeight();
  
  $('#addcollect').click(function(){
    var title="超级下载站：" + document.title;
    var url=window.location.href;
    try{
      window.external.addFavorite(url,title);
    } catch (e){
      try {
        window.sidebar.addPanel(title, url, "");
      } catch (e) {
        alert("对不起，您的浏览器不支持此操作!\n请您使用菜单栏或Ctrl+D收藏");}
    }
  });	
  

  function getCookie(name) {
    var start = document.cookie.indexOf( name + "=" );
    var len = start + name.length + 1;

    if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) )
        return null;

    if ( start == -1 )
        return null;

    var end = document.cookie.indexOf( ';', len );

    if ( end == -1 )
        end = document.cookie.length;
    return unescape( document.cookie.substring( len, end ) );
  }
  function ashu_isCookieEnable() {
      var today = new Date();
      today.setTime( today.getTime() );
      var expires_date = new Date( today.getTime() + (1000 * 60) );

      document.cookie = 'ashu_cookie_test=test;expires=' + expires_date.toGMTString() + ';path=/';
      var cookieEnable = (getCookie('ashu_cookie_test') == 'test') ?  true : false;
      return cookieEnable;
  }
  
  var ashu_token = 1;   
  $('.digg a').click(function(){
    //检查浏览器是否启用cookie功能   
    if( !ashu_isCookieEnable() ) {
      alert("很抱歉，您不能给本文投票！");
      return;   
    }   
    if( ashu_token != 1 ) {
      alert("您的鼠标点得也太快了吧？！");
      return false;
    }
    ashu_token = 0;
    
    var full_info = $(this).attr( 'rel' );
    var arr_param = full_info.split( '_' );
    
    $.ajax({
      url:ashuwp.ajaxurl, //ajax地址
      type:'POST',
      data:'action=vote_soft&rating=' + arr_param[ 0 ] + '&postid=' + arr_param[ 1 ],
      success:function(results){
        if(results=='n'){ 
          alert('投票失败');
          ashu_token = 1;
        }
        if (results=='y'){
          $('#ding').find('.digg_text').text('已投票');
          $('#cai').find('.digg_text').text('已投票');
          
          ashu_token = 1;
        }
        if (results=='h'){
          ashu_token = 1;
          alert('已经发表过评价了');
        }
        if (results=='e'){
          ashu_token = 1;
          alert('评价失败');
        }
      }
    });
    return false;
  });
  
  $('.ajax_nav').on('click','a',function(){
    var page_link = $(this).attr( 'href' );
    leng = page_link.lastIndexOf('/')
    page_num = page_link.substr(leng+1);
    
    soft_list = $(this).closest('.tab-pane').find('.soft_list');
    ajax_nav = $(this).closest('.ajax_nav');
    
    term_id = ajax_nav.attr( 'term_id' );
    
    if(page_num && term_id){
      $.ajax({
        url:ashuwp.ajaxurl, //ajax地址
        type:'POST',
        data:'action=ajax_nav&pagenum=' + page_num + '&term_id=' + term_id,
        success:function(data){
          if(data){
          var $res = $(data).find(".grid_item");
          var $nav = $(data).find(".page_nav");
          
          soft_list.fadeOut('fast',function(){
            soft_list.html($res);
          });
          
          soft_list.fadeIn();
          ajax_nav.html($nav);
          }
        }
      });
    }
    return false;
  });
  
  $(".fancybox").fancybox();  
});