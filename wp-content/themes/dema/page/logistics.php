<?php
/**
 * Template Name: logistics
 */
get_header();

?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/video-js.css">    <!-- 视频播放 -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.js"></script>
<div class="main">
    <div class="main">
        <div class="main-35">
            <div class="chunk clearfix">
                <p>Integrated Logistics <br> Solutions</p>
                <p>整合物流方案</p>
            </div>
        </div>
        <div class="main-36">
            <div class="w">
                <?php show_post(360); ?>
            </div>
        </div>
        <div class="main-37 w">
            <?php
            $video_post = get_post(362);
            ?>
            <video id="o" class="video-js vjs-big-play-centered" data-setup="{}" width="100%" height="auto" controls>
                <source src="<?php echo $video_post->post_content;?>" type="video/mp4">
                <source src="<?php echo $video_post->post_content;?>" type="video/ogg">
            </video>
        </div>
        <div class="main-38">
            <div class="w">
                <div class="title">
                    <p>PO管理平台</p>
                    <p></p>
                </div>
                <div class="content">
                   <?php show_post(364);?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
