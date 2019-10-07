<?php
/*
 * Template Name: join us
 */
?>
<?php get_header(); ?>
<div class="main-22">
    <div class="chunk">
        <p>Join us</p>
        <p>加入我们</p>
    </div>
</div>
<div class="main-23 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
    <div class="container">
        <div class="title">
            <p>We're waiting for you</p>
            <p></p>
            <p>你是千里马,我们就是伯乐!你有才华,我们就有舞台！<br>
                我们期待你用智慧为德玛的强大注入力量，与德玛共同成长。<br>来吧，千里马，我们等着你！</p>
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
                    <p>简历投递邮箱：</p>
                    <p><?php if (have_posts()): while (have_posts()) : the_post(); the_content();endwhile;endif;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-26">
    <div class="container">
        <div class="title">
            <p>我们的福利</p>
            <p></p>
        </div>
        <div class="content">
            <?php show_post(275);?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
