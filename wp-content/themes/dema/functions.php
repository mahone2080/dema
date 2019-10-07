<?php

function dema_setup()
{
//	load_theme_textdomain( 'dema', get_template_directory() . '/languages' );

    // 注册菜单
    register_nav_menu('primary', __('主菜单', 'dema'));

    // 为文章和评论在 <head> 标签上添加 RSS feed 链接。
    add_theme_support('automatic-feed-links');

    // 主题支持的文章格式形式。
    // add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

    // 主题为特色图像使用自定义图像尺寸，显示在 '标签' 形式的文章上。
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(650, 9999);
}

add_action('after_setup_theme', 'dema_setup');

function add_alnp_theme_support() {
    add_theme_support( 'auto-load-next-post', array(
        'content_container' => '.content',
        'title_selector' => '.list',
        'navigation_container' => '.pager',
        'plugin_support' => 'yes',
        'load_js_in_footer' => 'yes',
        'lock_js_in_footer' => 'yes',
    ) );
}
add_action( 'after_setup_theme', 'add_alnp_theme_support' );

/**
 * Load javascripts used by the theme
 */
function custom_theme_js() {
    wp_register_script('infinite_scroll', get_stylesheet_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array('jquery'), null, true);
    if (!is_singular()) {
        wp_enqueue_script('infinite_scroll');
    }
}

add_action('wp_enqueue_scripts', 'custom_theme_js');

/**
 * Infinite Scroll
 */
function custom_infinite_scroll_js() {
    if (!is_singular() ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                /**
                 * Customize the previous navitation menu
                 */
                var infinite_scroll = {
                    loading: {
                        img: "<?php echo get_template_directory_uri(); ?>/img/ajax-loader.gif",
                        msgText: "<?php _e('Loading the next set of posts...', 'tt_child'); ?>",
                        finishedMsg: "<?php _e('All posts loaded.', 'tt_child'); ?>"
                    },
                    nextSelector:".next > a",
                    navSelector:".pager",
                    itemSelector:".list",
                    contentSelector:".content"
                };
                jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
            });
        </script>
        <?php
    }
}

//add_action('wp_footer', 'custom_infinite_scroll_js', 100);

//add_shortcode();
//do_shortcode();
/*
 * 网站的页面标题，来自 Twenty Twelve 1.0
 */

function dema_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed())
        return $title;

    // 添加网站名称
    $title .= get_bloginfo('name');

    // 为首页添加网站描述
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    // 在页面标题中添加页码
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'dema'), max($paged, $page));

    return $title;
}

add_filter( 'wp_title', 'dema_wp_title', 10, 2 );

/*
 * 自定义搜索框
 */

function dema_search_form($form)
{

    $form = '<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
    <div class="input-append pull-right" id="search"><label class="hide screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input class="span3" type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input class="btn" type="submit" id="searchsubmit" value="' . esc_attr__('Search') . '" />
    </div>
    </form>';

    return $form;
}

add_filter('get_search_form', 'dema_search_form');

/*
 * Bootstrap 导航菜单
 */

class dema_Nav_Walker extends Walker_Nav_Menu
{

    /*
     * @see Walker_Nav_Menu::start_lvl()
     */
    function start_lvl(&$output, $depth=0,$args=[])
    {
        $output .= "\n<ul class=\"second-level\">\n";
    }

    /*
     * @see Walker_Nav_Menu::start_el()
     */
    function start_el(&$output, $item, $depth=0, $args=[],$id=0)
    {
        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $li_attributes = $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

//        if ($args->has_children) {
//            $classes[] = (1 > $depth) ? 'dropdown' : 'dropdown-submenu';
//            $li_attributes .= ' data-dropdown="dropdown"';
//        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

//        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
//        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        if($depth==1){

            $output .= $indent . '<li><p class="a"></p></li><li ' . $value . '' . $li_attributes . '>';
        }else{
            if($item->title == '产品及服务' || $item->title =='PRODUCTS & SERVICE'){
                $output .= $indent . '<li ' . $value . 'class="location t t_a"' . $li_attributes . '>';
            }elseif($item->title == '公司介绍') {
                $output .= $indent . '<li ' . $value . 'class="location t "' . $li_attributes . '>';
            }else{

                $output .= $indent . '<li ' . $value . '' . $li_attributes . '>';
            }

        }


        $attributes = $item->attr_title ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= $item->target ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= $item->xfn ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= $item->url ? ' href="' . esc_attr($item->url) . '"' : '';
//        $attributes .= $args->has_children ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
        $attributes .= $args->has_children ? '' : '';
        if(in_array($item->title,['公司介绍','产品及服务'])){
            $item_output = "<div class='new'>" . '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children AND 1 > $depth) ? ' <img src="/wp-content/themes/dema/img/icon-1.png">' : '';
            $item_output .= '</a>' . "</div>";

        }else{
            $item_output = $args->before . '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children AND 1 > $depth) ? ' <img src="/wp-content/themes/dema/img/icon-1.png">' : '';
            $item_output .= '</a>' . $args->after;

        }



        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /*
     * @see Walker::display_element()
     */
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if (!$element)
            return;
        $id_field = $this->db_fields['id'];
        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = (bool)(!empty($children_elements[$element->$id_field]) AND $depth != $max_depth - 1);
        elseif (is_object($args[0]))
            $args[0]->has_children = (bool)(!empty($children_elements[$element->$id_field]) AND $depth != $max_depth - 1);

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 OR $max_depth > $depth + 1) AND isset($children_elements[$id])) {

            foreach ($children_elements[$id] as $child) {

                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) AND $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}

/*
 * 给激活的导航菜单添加 .active
 */
function dema_nav_menu_css_class($classes)
{
    if (in_array('current-menu-item', $classes) OR in_array('current-menu-ancestor', $classes))
        $classes[] = 'active';

    return $classes;
}

add_filter('nav_menu_css_class', 'dema_nav_menu_css_class');


/*
 * 显示前进与后退导航链接
 */
if (!function_exists('dema_content_nav')) :

    function dema_content_nav($html_id)
    {
        global $wp_query;

        $html_id = esc_attr($html_id);

        if ($wp_query->max_num_pages > 1) : ?>
            <ul id="<?php echo $html_id; ?>" class="pager">
                <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'dema')); ?></li>
                <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'dema')); ?></li>
            </ul>
        <?php endif;
    }
endif;

/*
 * 改变头像图片的 Class
 */

function dema_avatar_css($class)
{
    $class = str_replace("class='avatar", "class='img-circle", $class);
    return $class;
}

add_filter('get_avatar', 'dema_avatar_css');

/*
 * 小工具
 */

function dema_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Bottom', 'dema'),
        'id' => 'sidebar-bottom',
        'description' => __('Sidebar Bottom', 'dema'),
        'before_widget' => '<div id="%1$s" class="%2$s"><section>',
        'after_widget' => '</section></div>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => __('Sidebar Right', 'dema'),
        'id' => 'sidebar-right',
        'description' => __('Sidebar Right', 'dema'),
        'before_widget' => '<div id="%1$s" class="%2$s"><section>',
        'after_widget' => '</section></div>',
        'before_title' => '<div class="title-line"><h3>',
        'after_title' => '</h3></div>',
    ));

}

add_action('widgets_init', 'dema_widgets_init');

/*
 * 自定义字段列表的显示 
 */
function dema_the_meta()
{
    if ($keys = get_post_custom_keys()) {
        echo "<dl class='dl-horizontal'>\n";
        foreach ((array)$keys as $key) {
            $keyt = trim($key);
            if (is_protected_meta($keyt, 'post'))
                continue;
            $values = array_map('trim', get_post_custom_values($key));
            $value = implode($values, ', ');
            echo apply_filters('the_meta_key', "<dt>$key</dt><dd>$value</dd>\n", $key, $value);
        }
        echo "</dl>\n";
    }
}

/*
 * 脚本与样式
 */
function dema_scripts_styles()
{
    global $wp_styles;
    //  需要时加载回复评论的脚本文件
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
}

add_action('wp_enqueue_scripts', 'dema_scripts_styles');


// 调用方法wpb_list_child_pages();
function wpb_list_child_pages()
{
    global $post;
    if (is_page() && $post->post_parent)
        $childpages = wp_list_pages("sort_column=menu_order&title_li=&child_of=" . $post->post_parent . "&echo=0");
    else
        $childpages = wp_list_pages("sort_column=menu_order&title_li=&child_of=" . $post->ID . "&echo=0");
    if ($childpages) {
        $string = "<ul>" . $childpages . "</ul>";
    }
    return $string;
}

add_shortcode("wpb_childpages", "wpb_list_child_pages");


function show_post($id)
{
    $post = get_post($id);
    $content = apply_filters('the_content', $post->post_content);
    echo $content;
}





