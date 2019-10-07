<?php
/**
 * Template Name: p2p
 */
get_header();
?>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri(); ?>/css/video-js.css">    <!-- 视频播放 -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.js"></script>

    <div class="main">
        <!-- <div class="main-58">
        </div> -->
        <div class="main-59 w">
            <img src="/wp-content/themes/dema/img/photo-74.jpg">
        </div>
        <div class="main-60 ">
            <div class="w">
                <?php show_post(518); ?>
            </div>
        </div>
        <div class="main-61">
            <div class="container">
                <?php $video_post = get_post(521); ?>
                <video id="o" class="video-js vjs-big-play-centered" data-setup="{}" width="100%" height="auto"
                       controls>
                    <source src="<?php echo $video_post->post_content; ?>" type="video/mp4">
                    <source src="<?php echo $video_post->post_content; ?>" type="video/ogg">
                </video>
            </div>
        </div>
    </div>
<?php get_footer(); ?>