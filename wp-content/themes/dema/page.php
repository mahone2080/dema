<?php get_header(); ?>
<?php if ( have_posts() ): ?>
    <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?><?php
