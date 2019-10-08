<?php get_header(); ?>
    <script type="text/javascript">

        function loadnews(page) {
            console.log(page)
            $.get('?cat=9&paged=' + page, function (data) {
                console.log(data)
            })
        }

    </script>
    <div class="main">
        <div class="main-27">
            <div class="chunk">
                <p>News</p>
                <p>新闻资讯</p>
            </div>
        </div>
        <div class="main-28">
            <div class="container">
                <div class="title">
                    <p>德玛新闻</p>
                    <p></p>
                </div>
                <div class="content">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="list">
                                <div class="photo">
                                    <p class="i"></p>
                                    <p class="ii"></p>
                                    <a href="?p=<?php the_ID(); ?>"><?php the_post_thumbnail(); ?></a>
                                </div>
                                <div class="text-2">
                                    <a href="?p=<?php the_ID(); ?>"><p><?php the_title(); ?></p></a>
                                    <?php the_excerpt(); ?>
                                    <div class="turn">
                                        <p class="roll2"><a href="?p=<?php the_ID(); ?>">了解更多</a></p>
                                        <p class="roll1"><a href="?p=<?php the_ID(); ?>">了解更多</a></p>
                                    </div>
                                </div>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
                <?php
                //                var_dump(do_action('custom_infinite_scroll_js'));
                //                $cat = get_query_var('cat');
                //                $category = get_category ($cat);
                //                echo do_shortcode('[ajax_load_more seo="true" category="'.$category->slug.'"]');
                //                do_shortcode('[ajax_load_more id="6440008217" post_type="post" category__and="9" offset="10" pause="true" scroll_container=".content" progress_bar="true" progress_bar_color="ed7070" button_label="加载更多"]');
                //                $aa = do_shortcode('[ajax_load_more id="4825783008" post_type="post" posts_per_page="4" category="%e6%96%b0%e9%97%bb%e8%b5%84%e8%ae%af"]');
                //                $bb = do_shortcode('[ajax_load_more id="4825783008" css_classes=".list"]');
                //                var_dump($bb);
                ?>
                <!--                <div class="more turn">-->
                <!--                    <p class="roll2"><a href="javascript:loadnews(2)">查看更多</a></p>-->
                <!--                    <p class="roll1"><a href="javascript:loadnews(2)">查看更多</a></p>-->
                <!--                </div>-->
                <ul class="pager" style="display: block;">
                    <li class="previous" rel="previous">
                        <?php previous_posts_link(__('&larr; 上一页', 'dema')); ?>
                    </li>
                    <li class="next" rel="next">
                        <?php next_posts_link(__('下一页 &rarr;', 'dema')); ?>
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