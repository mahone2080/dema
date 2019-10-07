// Variables
var process_loadmore     = ssp_frontend_js_params.smartscroll_load_ajax_type;
var MainClass            = ssp_frontend_js_params.smartscroll_MainClass;
var ajax_container       = ssp_frontend_js_params.smartscroll_ajax_container;
var markup_type          = ssp_frontend_js_params.smartscroll_markup_type;
var order_next_posts     = ssp_frontend_js_params.smartscroll_order_next_posts;
var post_link_target     = ssp_frontend_js_params.smartscroll_post_link_target;
var posts_featured_size     = ssp_frontend_js_params.smartscroll_posts_featured_size;

var replace_url          = ssp_frontend_js_params.smartscroll_replace_url;
var AjaxURL              = ssp_frontend_js_params.smartscroll_ajaxurl;
var loadertype           = ssp_frontend_js_params.smartscroll_loader_type;
var image_loader_ajax    = ssp_frontend_js_params.smartscroll_loader_img;
var curr_url             = window.location.href;
var curr_title           = window.document.title;
var current_id           = ssp_frontend_js_params.smartscroll_postid;
var cat_options          = ssp_frontend_js_params.smartscroll_category_options;
var default_loader       = ssp_frontend_js_params.smartscroll_default_loader;
var postperpage          = ssp_frontend_js_params.smartscroll_posts_limit;
var postsajax = [];
jQuery.noConflict();
jQuery(function($){
  var categoryid = $('#ssp_main_cateid').val();
  if(cat_options.indexOf(categoryid) >= 0 || cat_options.indexOf('all') >= 0) { 
    /*if(image_loader_ajax == '' || loadertype == 'default_loader'){
      image_loader_ajax = default_loader;
      
    }*/
   $('<div class="ssp_divider" data-title="' + curr_title + '" data-url="' + curr_url+ '" id="'+current_id+'" ></div>').prependTo('.'+MainClass);
  $( "<div id='smart-ajax-loader' style='display:none;'><img src='"+image_loader_ajax+"' alt='ajaxloadergif'/></div><div class='clear' style='clear:both;margin-top:12px;'></div><div class='show_no_posts'></div>").insertAfter( "." + MainClass );
   $('.show_no_posts').css('display','none');
 }
    var processing;
   
    $(window).scroll(function(){ 
         if (processing)
            return false;
          
    //  var hH = $('.smart_content_wrapper').offset().top; 
      //if ( ($(document).height() <= ( $(window).scrollTop() + $(window).height() + hH)) &&  !processing ) { 
     
       var hH = $('.smart_content_wrapper').outerHeight();
       var scrollTop     = $(window).scrollTop();
       var elementOffset = $('.smart_content_wrapper').offset().top;
       var distance      = (elementOffset - scrollTop);    //return div position from window top to div top 
       var divHeight     =  $( '.smart_content_wrapper').offset().top;
       var divHh         =  $( '.smart_content_wrapper').height(); 
 
if ( (distance <= 91 && divHh <= 250 ) || ($(document).height() <= ( scrollTop + $(window).height() + hH)) && !processing) {                
  
         processing = true;
         
        
          setTimeout(function() {
            var post_id    = $('#ssp_main_postid').val();  
            if(post_id){
              if(cat_options.indexOf(categoryid) >= 0 || cat_options.indexOf('all') >= 0) {     
                 if(postperpage != ''){
                 if(postsajax.length <= postperpage - 1){
                    myssp_load_morefunc(post_id,categoryid);
                    postsajax.push(post_id);
                  }else{
                       $("#smart-ajax-loader").hide();
                       $('.show_no_posts').html('NO MORE POSTS');
                       $('.show_no_posts').show();
                  }
                 }else{
                    myssp_load_morefunc(post_id,categoryid);
                 }
                    processing = false; 

                }
            }else{
               $('.show_no_posts').css('display','block');
            }
           

         }, 2000 );
           //console.log("totalpost="+postsajax);
         //console.log("counttotalpost="+postsajax.length);
              
    }

    });



	 function myssp_load_morefunc(value,categoryid){ 

       $.ajax({
          type: 'POST',
          url: AjaxURL,
          data: {
          	  'ID'          : value,
              'catid'       : categoryid,
              'markup_type' : markup_type,
              'order_next_posts': order_next_posts,
              'post_link_target': post_link_target,
              'posts_featured_size': posts_featured_size,
              '_wpnonce'    : ssp_frontend_js_params.smartscroll_ajax_nonce,
              'action'      :'ssp_populate_posts'
          },

          beforeSend: function() {
            $("#smart-ajax-loader").show();
          },
              
          success: function(data){
            
            if (data != false) {
               $('.'+ MainClass).append("<div class='"+ajax_container+"'>"+data+"</div>").delay(5000);
	            var lastPostId = $('.'+ MainClass + ' div.ssp_divider:last').attr('id');
	            $('#ssp_main_postid').val(lastPostId);
             	$("#smart-ajax-loader").hide();         
            }else{
              $('#ssp_main_postid').val('');
              $("#smart-ajax-loader").hide();
              $('.show_no_posts').html('NO MORE POSTS');
              $('.show_no_posts').show();

            }
          }
       });
        
        
       return false;
    };

  if(replace_url == '1'){
    var last_scroll = 0;
    $( window ).scroll( function() {
      var scroll_pos = $( window ).scrollTop();

      if ( Math.abs( scroll_pos - last_scroll ) > $( window ).height() * 0.1 ) {

        last_scroll = scroll_pos;

        $( '.'+ MainClass+' div.ssp_divider').each( function() {

          var scroll_pos = $( window ).scrollTop();
          var window_height = $( window ).height();
          var el_top = $( this ).offset().top;
          var el_height = $( this ).outerHeight();
          var el_bottom = el_top + el_height;

          if ( ( el_bottom > scroll_pos ) ) {
            if ( window.location.href !== $( this ).attr( "data-url" ) ) {
              history.replaceState( null, null, $( this ).attr( "data-url" ) );

              $( "meta[property='og:title']" ).attr( 'content', $( this ).attr( "data-title" ) );
              $( "title" ).html( $( this ).attr( "data-title" ) );
              $( "meta[property='og:url']" ).attr( 'content', $( this ).attr( "data-url" ) );

            }
            return( false );
          }

        } );
        
      }
    } );

  }

});