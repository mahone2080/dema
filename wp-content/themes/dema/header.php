<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title><?php wp_title('&hearts;', true, 'right'); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
    <?php if(get_query_var('lang')=='en'):?>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/outer/css/index.css">
    <?php else:?>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/index.css">
    <?php endif;?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/media.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/swiper.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri(); ?>/lib/font_as1kzi5oest/iconfont.css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.3.1.min.js"></script>
<!--    <script type="text/javascript" src="--><?php //echo get_template_directory_uri(); ?><!--/js/jquery.min.js"></script>-->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swiper.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>
    <!-- 数字滚动 -->
    <script type="text/javascript"
            src="<?php echo get_template_directory_uri(); ?>/js/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/gun.js"></script>
</head>

<body>
<div class="index">
    <!-- 头部 -->
    <div class="header">
        <div class="container">
            <div class="header-left">
                <div class="logo-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <div class="photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo-1.png">
                        </div>
                    </a>
                </div>
                <div class="logo-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <div class="photo">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo-2.png">
                        </div>
                    </a>
                </div>
            </div>
            <div class="header-right">
                <div class="icon">
                    <span class="iconfont icon-ego-menu"></span>
                    <span class="iconfont icon-guanbi"></span>
                </div>
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'ooo',
                    'container' => 'false',
//                    'container_class' => 'second-level',
//                    'items_wrap'      => '<ul id="%1$s" class="">%3$s</ul>',
                    'walker' => new dema_Nav_Walker,
                ));
                ?>
            </div>
            <?php //                get_sidebar();            ?>
            <div class="switch">
                <ul>
                    <li><img style="vertical-align:middle"
                             src="<?php echo get_template_directory_uri(); ?>/img/p19.jpg">
                    <?php
//                    pll_the_languages();
                                        if(get_query_var('lang')=='en'){
                                            echo "<a href='".site_url()."' title='中文'>中文</a>";
                                        }else{
                                            echo "<a href='".site_url()."?lang=en' title='English'>English</a>";
                                        }
                    ?>
                    </li>
                    <li></li>
                </ul>


            </div>
        </div>
    </div>
