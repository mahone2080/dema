<?php
/*
 * Template Name: about us
 */
?>
<?php get_header(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/video-js.css">    <!-- 视频播放 -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>

    <script type="text/javascript">
        new WOW().init();
    </script>

    <div class="main-4">
        <div class="chunk">
            <p>ABOUT US</p>
            <p>关于我们</p>
        </div>
    </div>

    <div class="main-5">
        <div class="container">
            <?php if (have_posts()): ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="title">
                        <p><?php the_title(); ?></p>
                        <p></p>
                    </div>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

<?php
//$page_video = get_pages(181);
//echo apply_filters('the_content',$page_video->content);
//get_page_children(181)
//get_post(181);
//get_post($id);
//show_post(181);
$video_post = get_post(181);

?>
    <div class="main-6">
        <div class="container" style="position:relative">
            <!--  -->
            <video id="o" class="video-js vjs-big-play-centered" data-setup="{}" width="100%" height="auto" controls>
                <source src="<?php echo $video_post->post_content;?>" type="video/mp4">
                <source src="<?php echo $video_post->post_content;?>" type="video/ogg">
            </video>
        </div>
    </div>
    <div class="main-7">
        <div class="chunk">
            <p>Start from 2007</p>
            <p>始于2007</p>
        </div>
        <div class="clear">
        </div>
    </div>
<?php show_post(193);?>
    <div class="main-9">
        <div class="chunk">
            <p> Corporate Culture</p>
            <p>企业文化</p>
        </div>
    </div>
<?php show_post(195);?>


<?php get_footer(); ?>