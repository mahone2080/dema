<?php
/**
 * Template Name: supply en
 */
get_header();
?>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri(); ?>/css/video-js.css">    <!-- 视频播放 -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.js"></script>

    <div class="main">
        <!-- <div class="main-62">
        </div> -->
        <div class="main-63 w">
            <img src="/wp-content/themes/dema/outer/img/photo-79.jpg">
        </div>
        <div class="main-64 ">
            <div class="w">
                <div class="list">
                    <?php show_post(533); ?>
                </div>
            </div>
        </div>
        <div class="main-65">
            <div class="container">
                <?php $video_post = get_post(530); ?>
                <video width="100%" id="o" class="video-js vjs-big-play-centered" data-setup="{}" height="auto" controls poster="/wp-content/themes/dema/img/photo-87.png">
                    <source src="<?php echo $video_post->post_content; ?>" type="video/mp4">
                    <source src="<?php echo $video_post->post_content; ?>" type="video/ogg">
                </video>
            </div>
        </div>
    </div>
<?php get_footer(); ?>