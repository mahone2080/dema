<?php
/*
 * Template Name: join us en
 */
?>
<?php get_header(); ?>

<div class="main-22">
    <div class="chunk">
        <p>Join us</p>
        <!-- <p>加入我们</p> -->
    </div>
</div>
<div class="main-23 wow fadeIn" data-wow-delay="0.3s">
    <div class="container">
        <div class="title">
            <p>We're waiting for you</p>
            <p></p>
            <p>Jobs and careers in delmar. delmar offers exciting career opportunity  for your passion and dreams! Shoot the message to us, we are here for you.
            </p>
        </div>
    </div>
</div>
<div class="main-24">
</div>
<div class="main-25">
    <div class="container">
        <div class="content">
            <div class="left">
                <p>E-Mail</p>
            </div>
            <div class="right">
                <p></p>
                <div class="item">
                    <p>Resume mailing address:</p>
                    <p><?php if (have_posts()): while (have_posts()) : the_post(); the_content();endwhile;endif;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-26">
    <div class="container">
        <div class="title">
            <p>BE WITH US</p>
            <p></p>
        </div>
        <div class="content">
            <?php show_post(283);?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
