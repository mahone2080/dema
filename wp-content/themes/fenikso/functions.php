<?php 

function fenikso_setup() {
	load_theme_textdomain( 'fenikso', get_template_directory() . '/languages' );
	
	// 注册菜单
	register_nav_menu( 'primary', __( 'Primary Menu', 'fenikso' ) );  
	
	// 为文章和评论在 <head> 标签上添加 RSS feed 链接。
	add_theme_support( 'automatic-feed-links' );

	// 主题支持的文章格式形式。
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// 主题为特色图像使用自定义图像尺寸，显示在 '标签' 形式的文章上。
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 650, 9999 );  
	}
add_action( 'after_setup_theme', 'fenikso_setup' );

/*
 * 网站的页面标题，来自 Twenty Twelve 1.0
 */

function fenikso_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// 添加网站名称
	$title .= get_bloginfo( 'name' );

	// 为首页添加网站描述
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// 在页面标题中添加页码
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fenikso' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fenikso_wp_title', 10, 2 );

/*
 * 自定义搜索框
 */
 
function fenikso_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div class="input-append pull-right" id="search"><label class="hide screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input class="span3" type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input class="btn" type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'fenikso_search_form' );

/*
 * Bootstrap 导航菜单
 */

class fenikso_Nav_Walker extends Walker_Nav_Menu {

     /*
      * @see Walker_Nav_Menu::start_lvl()
      */
     function start_lvl( &$output, $depth ) {
          $output .= "\n<ul class=\"dropdown-menu\">\n";
     }

     /*
      * @see Walker_Nav_Menu::start_el()
      */
     function start_el( &$output, $item, $depth, $args ) {
          global $wp_query;
         
          $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
          $li_attributes = $class_names = $value = '';
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-item-' . $item->ID;

          if ( $args->has_children ) {
               $classes[] = ( 1 > $depth) ? 'dropdown': 'dropdown-submenu';
               $li_attributes .= ' data-dropdown="dropdown"';
          }

          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

          $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

          $attributes     =     $item->attr_title     ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
          $attributes     .=     $item->target          ? ' target="' . esc_attr( $item->target     ) .'"' : '';
          $attributes     .=     $item->xfn               ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
          $attributes     .=     $item->url               ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          $attributes     .=     $args->has_children     ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

          $item_output     =     $args->before . '<a' . $attributes . '>';
          $item_output     .=     $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
          $item_output     .=     ( $args->has_children AND 1 > $depth ) ? ' <b class="caret"></b>' : '';
          $item_output     .=     '</a>' . $args->after;

          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
     }

     /*
      * @see Walker::display_element()
      */
     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
          if ( ! $element )
               return;
          $id_field = $this->db_fields['id'];
          //display this element
          if ( is_array( $args[0] ) )
               $args[0]['has_children'] = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );
          elseif ( is_object(  $args[0] ) )
               $args[0]->has_children = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );

          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'start_el' ), $cb_args );

          $id = $element->$id_field;

          // descend only when the depth is right and there are childrens for this element
          if ( ( $max_depth == 0 OR $max_depth > $depth+1 ) AND isset( $children_elements[$id] ) ) {

               foreach ( $children_elements[ $id ] as $child ) {

                    if ( ! isset( $newlevel ) ) {
                         $newlevel = true;
                         //start the child delimiter
                         $cb_args = array_merge( array( &$output, $depth ), $args );
                         call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
               }
               unset( $children_elements[ $id ] );
          }

          if ( isset( $newlevel ) AND $newlevel ) {
               //end the child delimiter
               $cb_args = array_merge( array( &$output, $depth ), $args );
               call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
          }

          //end this element
          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'end_el' ), $cb_args );
     }
}

/*
 * 给激活的导航菜单添加 .active
 */
function fenikso_nav_menu_css_class( $classes ) {
     if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
          $classes[]     =     'active';

     return $classes;
}
add_filter( 'nav_menu_css_class', 'fenikso_nav_menu_css_class' );


/*
 * 显示前进与后退导航链接
 */
if ( ! function_exists( 'fenikso_content_nav' ) ) :

function fenikso_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<ul id="<?php echo $html_id; ?>" class="pager">
			<li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'fenikso' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'fenikso' ) ); ?></li>
		</ul>
	<?php endif;
}
endif;

/*
 * 改变头像图片的 Class
 */

function fenikso_avatar_css($class) {
	$class = str_replace("class='avatar", "class='img-circle", $class) ;
return $class;
}
add_filter('get_avatar','fenikso_avatar_css');

/*
 * 小工具
 */

function fenikso_widgets_init() {
  register_sidebar( array(
    'name'          =>  __( 'Sidebar Bottom', 'fenikso' ),
    'id'            =>  'sidebar-bottom',
    'description'   =>  __( 'Sidebar Bottom', 'fenikso' ),
    'before_widget' =>  '<div id="%1$s" class="%2$s"><section>',
    'after_widget'  =>  '</section></div>',
    'before_title'  =>  '<h3><span>',
    'after_title'   =>  '</span></h3>',
  ) );
  register_sidebar( array(
    'name'          =>  __( 'Sidebar Right', 'fenikso' ),
    'id'            =>  'sidebar-right',
    'description'   =>  __( 'Sidebar Right', 'fenikso' ),
    'before_widget' =>  '<div id="%1$s" class="%2$s"><section>',
    'after_widget'  =>  '</section></div>',
    'before_title'  =>  '<div class="title-line"><h3>',
    'after_title'   =>  '</h3></div>',
  ) );
  
}
add_action( 'widgets_init', 'fenikso_widgets_init' );

/*
 * 自定义字段列表的显示 
 */
function fenikso_the_meta() {
   if ( $keys = get_post_custom_keys() ) {
      echo "<dl class='dl-horizontal'>\n";
      foreach ( (array) $keys as $key ) {
              $keyt = trim($key);
                if ( is_protected_meta( $keyt, 'post' ) )
                      continue;
              $values = array_map('trim', get_post_custom_values($key));
              $value = implode($values,', ');
              echo apply_filters('the_meta_key', "<dt>$key</dt><dd>$value</dd>\n", $key, $value);
      }
      echo "</dl>\n";
    }
}

/*
 * 脚本与样式
 */
function fenikso_scripts_styles() {
	global $wp_styles;
  //  需要时加载回复评论的脚本文件
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'fenikso_scripts_styles' );

/*
 * 评论列表的显示
 */
if ( ! function_exists( 'fenikso_comment' ) ) :
function fenikso_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	  // 用不同于其它评论的方式显示 trackbacks 。
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'fenikso' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'fenikso' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	<?php
		break;
		default :
		// 开始正常的评论
		global $post;
	 ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="media comment">
			<div class="pull-left">
  			<?php // 显示评论作者头像 
  			  echo get_avatar( $comment, 64 ); 
  			?>
			</div>
			<?php // 未审核的评论显示一行提示文字
			  if ( '0' == $comment->comment_approved ) : ?>
  			<p class="comment-awaiting-moderation">
  			  <?php _e( 'Your comment is awaiting moderation.', 'fenikso' ); ?>
  			</p>
			<?php endif; ?>
			<div class="media-body">
				<h4 class="media-heading">
  				<?php // 显示评论作者名称
  				    printf( '%1$s %2$s',
  						get_comment_author_link(),
  						// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
  						( $comment->user_id === $post->post_author ) ? '<span class="label label-info"> ' . __( 'Post author', 'fenikso' ) . '</span>' : ''
  					);
  				?>
  		    <small>
    				<?php // 显示评论的发布时间
    				    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
    						esc_url( get_comment_link( $comment->comment_ID ) ),
    						get_comment_time( 'c' ),
    					  // 翻译: 1: 日期, 2: 时间
    						sprintf( __( '%1$s %2$s', 'fenikso' ), get_comment_date(), get_comment_time() )
    					);
    				?>
  				</small>
				</h4>
				<?php // 显示评论内容
				  comment_text(); 
				?>
				<?php // 显示评论的编辑链接 
				  edit_comment_link( __( 'Edit', 'fenikso' ), '<p class="edit-link">', '</p>' ); 
				?>
				<div class="reply">
					<?php // 显示评论的回复链接 
					  comment_reply_link( array_merge( $args, array( 
					    'reply_text' =>  __( 'Reply', 'fenikso' ), 
					    'after'      =>  ' <span>&darr;</span>', 
					    'depth'      =>  $depth, 
					    'max_depth'  =>  $args['max_depth'] ) ) ); 
					?>
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch; // end comment_type check
}
endif;







