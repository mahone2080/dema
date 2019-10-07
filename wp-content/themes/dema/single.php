<?php get_header(); ?>


<div class="main nine">
    <div class="main-27">
        <div class="chunk">
            <p>News</p>
            <p>新闻资讯</p>
        </div>
    </div>
    <div class="main-29">
        <div class="container">
            <?php if (have_posts()): ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="title">
                        <p><?php the_title(); ?></p>
                        <p>德玛中国 <?php the_date(); ?></p>
                    </div>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

