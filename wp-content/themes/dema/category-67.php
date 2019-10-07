<?php get_header(); ?>
    <div class="main">
        <div class="main-27">
            <div class="chunk">
                <p>Delmar news</p>

            </div>
        </div>
        <div class="main-28">
            <div class="container">
                <div class="title">
                    <p>Delmar news</p>
                    <p></p>
                </div>
                <div class="content">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="list">
                                <div class="photo">
                                    <p class="i"></p>
                                    <p class="ii"></p>
                                    <a href="?p=<?php the_ID();?>"><?php the_post_thumbnail();?></a>
                                </div>
                                <div class="text-2">
                                    <a href="?p=<?php the_ID();?>"><p><?php the_title();?></p></a>
                                    <?php the_excerpt(); ?>
                                    <div class="turn">
                                        <p class="roll2"><a href="?p=<?php the_ID();?>">VIEW MORE</a></p>
                                        <p class="roll1"><a href="?p=<?php the_ID();?>">VIEW MORE</a></p>
                                    </div>
                                </div>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <ul class="pager" style="display: none;">
                    <li class="previous">
                        <?php previous_posts_link( __( '&larr; PRE', 'dema' ) ); ?>
                    </li>
                    <li class="next">
                        <?php next_posts_link( __( 'NEXT &rarr;', 'dema' ) ); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php get_footer(); ?>