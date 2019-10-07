<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/*
	Plugin name: Smart Scroll Posts
	Plugin URI: https://accesspressthemes.com/wordpress-plugins/smart-scroll-posts/
	Description: An awesome and most powerful plugin for infinite posts load on page scroll functionality to your website.
	Version: 2.0.6
	Author: AccessPress Themes
	Author URI: http://accesspressthemes.com
	Text Domain: smart-scroll-posts
	Domain Path: /languages/
	License: GPLv2 or later
*/

//Decleration of the necessary constants for plugin
if( !defined( 'SSP_VERSION' ) ) {
    define( 'SSP_VERSION', '2.0.6' );
}

if( !defined( 'SSP_IMAGE_DIR' ) ) {
    define( 'SSP_IMAGE_DIR', plugin_dir_url( __FILE__ ) . 'images/' );
}

if( !defined( 'SSP_JS_DIR' ) ) {
    define( 'SSP_JS_DIR', plugin_dir_url( __FILE__ ) . 'js/' );
}

if( !defined( 'SSP_CSS_DIR' ) ) {
    define( 'SSP_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css/' );
}

if( !defined( 'SSP_LANG_DIR' ) ) {
    define( 'SSP_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages/' );
}

if( !defined( 'SSP_SETTINGS' ) ) {
    define( 'SSP_SETTINGS', 'ssp-settings' );
}
//Declaration of the class for necessary configuration of a plugin
if( !class_exists( 'SSP_Smart_Scroll_Posts' ) ) {
    class SSP_Smart_Scroll_Posts
    {
     
     var $ssp_settings;

	   function __construct() {
           /* backend section */
           $this->ssp_settings = get_option('SSP_SETTINGS');
           add_action( 'init', array($this, 'session_init') );                                     //start the session if not started yet.
           register_activation_hook(__FILE__,array($this,'ssp_plugin_activation'));               //load the default setting for the plugin while activating
           add_action( 'init', array($this, 'ssp_plugin_text_domain') );                       //load the plugin text domain
           add_action('admin_menu', array($this, 'ssp_control_menu'));                      //register the plugin menu/submenu in backend
           add_action('admin_enqueue_scripts',array($this,'ssp_register_admin_assets'));     //registers all the assets required for wp-admin
	         add_action( 'admin_post_ssp_save_options', array($this, 'ssp_save_options') ); //save the options in the wordpress options table.
           add_action( 'admin_post_ssp_restore_default_settings', array($this, 'ssp_restore_default_settings') ); //save the options in the wordpress options table.
           
          /* Frontend section */
           add_action('wp_enqueue_scripts',array($this,'ssp_register_frontend_assets'));        //registers assets for frontend
           add_action('wp_footer', array($this,'add_content_footer'),5);
           add_action('wp_ajax_ssp_populate_posts',array($this,'ssp_populate_posts'));
           add_action('wp_ajax_nopriv_ssp_populate_posts',array($this,'ssp_populate_posts'));
           add_filter( 'the_content', array($this,'smart_ajax_page_content'));
           // add_action( 'wp_head', array($this,'ssp_count_views' ));
      }

       /**
       * Session Start with the call of Init Hook
       * */
        function session_init() {
            if( !session_id() ) {
                session_start();
            }
        }

          /*  function ssp_count_views()
          {
            if( is_singular() ) {
              global $post;
              if ( ! get_post_meta($post->ID, 'total_count_views', true ) ) { 
                 add_post_meta( $post->ID, 'total_count_views', 0 );
              }else{
                $count = get_post_meta( $post->ID, 'total_count_views', true );
               $count++;
               update_post_meta( $post->ID, 'total_count_views', $count );
              }

            }
          } */

        /**
          * Plugin Activation and default field values set.
         * */
	    function ssp_plugin_activation(){
          // if( !get_option( SSP_SETTINGS ) ) {
                include( 'inc/backend/activation.php' );
           // }
	    }

      function ssp_plugin_text_domain(){
          load_plugin_textdomain( 'smart-scroll-posts', false, SSP_LANG_DIR );
      }

        /**
          * Add Plugin Menu with submenu in Backend
         * */
      function ssp_control_menu(){
        add_menu_page( 'Smart Scroll Posts', 'Smart Scroll Posts', 'manage_options', 'ssp_scroll_form', array($this, 'fn_ssp_scroll_posts') );
      }

        /**
          * Plugin Menu Main Page 
         * */
        function fn_ssp_scroll_posts(){
           include( 'inc/backend/add-infinite-scroll-posts.php');
        }

       /**
       * Backend CSS And JS
       * */
        function ssp_register_admin_assets(){
           if( isset( $_GET['page'] ) && $_GET['page'] == 'ssp_scroll_form') {
               wp_enqueue_script('media-upload');
               wp_enqueue_script('thickbox');
               wp_enqueue_style('thickbox');
               wp_enqueue_style('ssp_backend_style', SSP_CSS_DIR . 'backend/backend.css', SSP_VERSION); 
               wp_enqueue_style( 'ssp-fontawesome', SSP_CSS_DIR. 'font-awesome/font-awesome.min.css' );  
               wp_enqueue_media();    
               wp_enqueue_script( 'ssp-backend-js', SSP_JS_DIR . 'backend.js', array('jquery'), SSP_VERSION );         
               //wp_enqueue_script( 'ssp-media-uploader-backend-js', SSP_JS_DIR . 'media-uploader.js', array('jquery'), SSP_VERSION );
           }

        }

        /**
          * Save Settings Form to database
         * */
        function ssp_save_options()
        {
           if (isset($_POST['ssp_add_nonce_save_settings'], $_POST['ssp_save_settings']) && wp_verify_nonce($_POST['ssp_add_nonce_save_settings'], 'ssp_nonce_save_settings')) {
             include( 'inc/backend/save_settings.php' );
          }
           else {
            die( 'No script kiddies please!' );
           }          
        }

        /**
          * Clear Database Settings and save 
         * */
        function ssp_restore_default_settings(){
          $nonce = $_REQUEST['_wpnonce'];
          if(isset($_GET) && wp_verify_nonce($nonce,'ssp-restore-default-settings-nonce' )){
            include( 'inc/backend/activation.php' );
            $_SESSION['ssp_message'] = __( 'Restored Default Settings Successfully.', 'smart-scroll-posts' );
            wp_redirect( admin_url() . 'admin.php?page=ssp_scroll_form');
          
          }else{
            die( 'No script kiddies please!' );
          }

        }

        /**
          * Registers assets for frontend
         * */
         function ssp_register_frontend_assets() {                 
            // Add some parameters for the JS.
           /**
              * Load the Javascript if found as a singluar post.
            */
        if (is_singular()) {
        	global $post;
              /**
             * Frontend Style
             * */
             wp_enqueue_style('ssp-frontend-css', SSP_CSS_DIR . 'frontend/frontend.css',false, SSP_VERSION);//registering animate.css
             /**
             * Frontend JS
             * */
              // echo get_template_directory_uri()/images/loader.gif
             wp_enqueue_script('ssp-frontend-js', SSP_JS_DIR . 'frontend.js', array('jquery'), true, SSP_VERSION);//registering frontend js 
             $options = get_option( SSP_SETTINGS ); 
             $ajax_image_type = (isset( $options['smart_scroll_ajax_image'] ) && $options['smart_scroll_ajax_image'] !='')?esc_attr( $options['smart_scroll_ajax_image']):'default_loader';
             $custom_img_url = (isset( $options['smart_scroll_ajax_image_url'] ) && $options['smart_scroll_ajax_image_url'] !='')?esc_url( $options['smart_scroll_ajax_image_url']):'';
             $ssp_default_loader = (isset( $options['ssp_default_loader'] ) && $options['ssp_default_loader'] !='')?intval( $options['ssp_default_loader'] ):'0';
             if($ajax_image_type == 'default_loader'){
             	if($ssp_default_loader == '' || $ssp_default_loader == '0'){
                  $url_img = SSP_IMAGE_DIR.'loader/loader.gif';
             	}else{
                  $url_img = SSP_IMAGE_DIR.'loader/loader'.$ssp_default_loader.'.gif';
             	}
                  $ajaxloader_image_path = esc_url($url_img);
             }else{
                 $ajaxloader_image_path = $custom_img_url;
             }
             
              // Variables for JS scripts
              wp_localize_script('ssp-frontend-js', 'ssp_frontend_js_params', array(
                'smartscroll_load_ajax_type'    => esc_attr($options['load_ajax_type']),
                'smartscroll_MainClass'         => esc_attr($options['appendElementClass']),
                'smartscroll_ajax_container'    => esc_attr($options['container_class']),
                'smartscroll_markup_type'       => esc_attr($options['markup_type']),
                'smartscroll_replace_url'       => intval($options['replace_url']),
                'smartscroll_ajaxurl'           => admin_url('admin-ajax.php'),
                'smartscroll_loader_type'       => $options['smart_scroll_ajax_image'],
                'smartscroll_loader_img'        => esc_url($ajaxloader_image_path),
                'smartscroll_default_loader'    => SSP_IMAGE_DIR. 'smart_scroll-ajax_loader.gif',
                'smartscroll_posts_limit'       => isset($options['post_limit'])?esc_attr($options['post_limit']):'',
                'smartscroll_category_options'  => $options['category_options'],
                'smartscroll_order_next_posts'  => $options['order_next_posts'],
                'smartscroll_post_link_target'  => $options['post_link_target'],
                'smartscroll_posts_featured_size'  => $options['posts_featured_size'],
                'smartscroll_postid'            => $post->ID,
                'smartscroll_ajax_nonce'        => wp_create_nonce('ssp-ajax-nonce'),
              ));
                


            } // END if is_singular() && get_post_type()

         }

         function add_content_footer(){
            global $post;
            $post_id = $post->ID;
            $category = get_the_category($post->ID);
            if(empty($category)){
             $category_id = '';
            }else{
              $category_idd =$category[0]->cat_ID;            
              $category_id = $category_idd;
            }
            echo '<input type="hidden" id="ssp_main_postid" value="'.$post_id.'"/>';
            echo '<input type="hidden" id="ssp_main_cateid" value="'. $category_id .'"/>';

         } 


        function get_previous_post_id( $post_id,$in_same_term ,$posttypee ) {
            // Get a global post reference since get_adjacent_post() references it
            global $post;
            // Store the existing post object for later so we don't lose it
            $oldGlobal = $post;
            // Get the post object for the specified post and place it in the global variable
            $post = get_post( $post_id );
            // Get the post object for the previous post
            if($posttypee == "newer_posts"){
               $previous_post = get_next_post($in_same_term);
            }else{
              $previous_post = get_previous_post($in_same_term);
            }
            
            // Reset our global object
            $post = $oldGlobal;
            if ( '' == $previous_post ) 
                return 0;
            return $previous_post->ID; 
        } 


      /* Default and Custom Template ajax call */
        function ssp_populate_posts(){
       if ( !empty( $_POST ) && wp_verify_nonce( $_POST['_wpnonce'], 'ssp-ajax-nonce' ) ) {
            if (!isset($_POST['ID']))
              die();

              $post_id       = sanitize_text_field($_POST['ID']);
              $markup        = sanitize_text_field($_POST['markup_type']);
              $in_same_term  = sanitize_text_field($_POST['catid']);
              $nextpoststype = sanitize_text_field($_POST['order_next_posts']);

              $post_link_target = (isset($_POST['post_link_target'])?sanitize_text_field($_POST['post_link_target']):'_self');
              $posts_featured_size = (isset($_POST['posts_featured_size'])?sanitize_text_field($_POST['posts_featured_size']):'large');

              $post_id      = $this->get_previous_post_id( $post_id, $in_same_term , $nextpoststype );
              if($post_id){
                  $args     = array(
                    'p'     =>  $post_id
                    );
              $query = new WP_Query($args);
              while ( $query->have_posts() ) : $query->the_post();
                global $post;?>

          <div class="ssp_divider" data-title="<?php the_title();?>" data-url="<?php the_permalink(); ?>" id="<?php echo get_the_ID();?>">
          </div>        
               <?php               
                $smart_post_titlee     = get_the_title();
                $smart_post_contents   = do_shortcode(get_the_content());
                $post_thumbnail_id     = get_post_thumbnail_id( get_the_ID());  
                $m_img                 = wp_get_attachment_image_src(  $post_thumbnail_id, $posts_featured_size );
                $image_path            = esc_url($m_img[0]);

               

                /* added Code  for #postID, #post_day, #post_month, #post_year, 
                #author_name, #post_class ,#category_name*/
                $postID    = get_the_ID();
                $dates     = get_the_date('F,j,Y');
                $date_arr  = explode(',', $dates);
                $SmartDay       = $date_arr[1];
                $SmartMonth     = $date_arr[0];
                $Smartyear      = $date_arr[2];
                $author_name    = get_the_author_meta('display_name');
                $author_image   = get_avatar( get_the_author_meta( 'ID' ), 49 ) ;
                $categorylists  = get_the_category_list(', ');
                $post_classes   = get_post_class();
                $postclass_separated = implode(" ", $post_classes); 
                $comment_number        = get_comments_number( $postID );
                $permalink             = esc_url(get_the_permalink(get_the_ID()));

                /* added code end */
       
                if(has_post_thumbnail())
                {
                  $post_fimage           = $image_path;
                }else{
                  $post_fimage = '';
                }
                $smartpost_permalink   = get_the_permalink(get_the_ID());
                $post_readmore_text    = __('Read More','smart-scroll-posts');
                $post_excerpt          = get_the_excerpt().'...<a href="'.$smartpost_permalink.'" target="'.$post_link_target.'">Read More >></a>';
                $options    = get_option( SSP_SETTINGS);
               
               if($markup   == "default_markup"){
                  $content         = $options['default_markup'];
                  $htmlmarkup      = stripslashes($content);
               }else{
                  $content         = $options['custom_markup'];
                  $htmlmarkup      =  stripslashes($content);
               }
               
                $orginalstr = array("#post_title", "#post_content",'#post_image', '#post_excerpt','#author_name','#author_image','#postID','#post_day','#post_month','#post_year','#category_name','#post_class','#post_comment','#post_permalink','#post_target');
                $replacestr   = array($smart_post_titlee ,$smart_post_contents , $post_fimage , $post_excerpt, $author_name,$author_image, $postID , $SmartDay, $SmartMonth,$Smartyear,$categorylists,$postclass_separated,$comment_number,$permalink,$post_link_target );
                $ajaxcontent = str_replace($orginalstr, $replacestr, $htmlmarkup);
                echo $ajaxcontent;
                 ?>
         
              <?php 
              endwhile;
            }else{
              return false;
            }

            die();

          }else{
            die( 'No script kiddies please!');
          }
        }

            function smart_ajax_page_content( $content )
        {
             return '<div class="smart_content_wrapper">'.$content.'</div>';
        }

         //prints the array in pre format
        function displayArr($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

         //returns all the registered post types only
       function get_registered_post_types() {
           $post_types = get_post_types();
           unset($post_types['page']);
           unset($post_types['attachment']);
           unset($post_types['revision']);
           unset($post_types['nav_menu_item']);
           unset($post_types['wp-types-group']);
           unset($post_types['wp-types-user-group']);
           return $post_types;
       }

       // returns all the registered taxonomies
       function get_registered_taxonomies() {
           $output = 'objects';
           $args = '';
           $taxonomies = get_taxonomies($args, $output);
           unset($taxonomies['post_tag']);
           unset($taxonomies['nav_menu']);
           unset($taxonomies['link_category']);
           unset($taxonomies['post_format']);
           return $taxonomies;
       }


     /**
     * Get size information for all currently-registered image sizes.
     *
     * @global $_wp_additional_image_sizes
     * @uses   get_intermediate_image_sizes()
     * @return array $sizes Data for all currently-registered image sizes.
     */
      public static function ssp_get_image_sizes() {
      global $_wp_additional_image_sizes;

      $sizes = array();

      foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
          $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
          $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
          $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
          $sizes[ $_size ] = array(
            'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
            'height' => $_wp_additional_image_sizes[ $_size ]['height'],
            'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
          );
        }
      }

      return $sizes;
    }



	}
   $ssp_object = new SSP_Smart_Scroll_Posts();
}

