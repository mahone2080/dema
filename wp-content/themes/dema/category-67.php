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

    <div class="return #return" id="return" style="display: block;">
        <img src="/wp-content/themes/dema/img/icon-21.png">
    </div>

    <script type="text/javascript">
        //右侧悬浮框
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop();
            if (scrollTop > 300) {
                $(".return").addClass("#return").fadeIn()
            } else {
                $(".return").removeClass("#return").fadeOut()
            }
        });
        // 返回顶部动画
        var rEturn = document.getElementById("return");
        rEturn.onclick = function() {
            var scrollToTop = window.setInterval(function() {
                var pos = window.pageYOffset;
                if (pos > 0) {
                    window.scrollTo(0, pos - 60);
                } else {
                    window.clearInterval(scrollToTop);
                }
            }, 16);
        }

        new WOW().init();
    </script>
<?php get_footer(); ?>