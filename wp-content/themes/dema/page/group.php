<?php
/*
 * Template Name: group
 */
?>

<?php get_header(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/video-js.css">    <!-- 视频播放 -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/video.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>

    <!-- header文字颜色 -->
    <style type="text/css">
        .header-right ul>li:nth-child(1) a {
            color: #000;
        }

        .header-right ul>li:nth-child(2) a {
            color: #08478a;
        }
    </style>

    <div class="main-11">
        <div class="chunk">
            <p>Delmar Group</p>
            <p>全球集团</p>
        </div>
    </div>

    <div class="main-12">
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

$video_post = get_post(237);

?>
    <div class="main-13">
        <div class="container">
            <video id="o" class="video-js vjs-big-play-centered" data-setup="{}" width="100%" height="auto" controls>
                <source src="<?php echo $video_post->post_content;?>" type="video/mp4">
                <source src="<?php echo $video_post->post_content;?>" type="video/ogg">
            </video>
        </div>
    </div>
    <div class="main-14">
        <div class="chunk">
            <p>Network</p>
            <p>全球网络</p>
        </div>
    </div>
<?php show_post(239);?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.panel-group').on('hide.bs.collapse show.bs.collapse', '.panel-collapse', function(e) {
                var $this = $(this)
                $this.prev().find("span").toggleClass("span_plus");
                $this.prev().find("span").toggleClass("span_minus");
            })
        });
    </script>
<?php get_footer(); ?>