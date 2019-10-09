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
                <div class="more turn">
                    <p class="roll2">
                        <?php next_posts_link(__('VIEW MORE')); ?>
                    </p>
                    <p class="roll1"><a href="javascript:void(0)">VIEW MORE</a></p>
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
        //wordpress点击加载更多
        jQuery(document).ready(function($) {
            //点击下一页的链接(即那个a标签)
            $('.more .roll2 a').click(function() {
                $this = $(this);
                // $('.roll1').remove()
                // $this.addClass('loading').text("正在努力加载"); //给a标签加载一个loading的class属性，可以用来添加一些加载效果
                var href = $this.attr("href"); //获取下一页的链接地址
                if (href != undefined) { //如果地址存在
                    $.ajax({ //发起ajax请求
                        url: href, //请求的地址就是下一页的链接
                        type: "get", //请求类型是get
                        error: function(request) {
                            //如果发生错误怎么处理
                        },
                        success: function(data) { //请求成功

                            $this.removeClass('loading').text("VIEW MORE"); //移除loading属性
                            console.log(data)

                            var $res = $(data).find(".list"); //从数据中挑出文章数据，请根据实际情况更改
                            $('.content').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
                            var newhref = $(data).find(".next a").attr("href"); //找出新的下一页链接
                            if (newhref != undefined) {
                                $(".more .roll2 a").attr("href", newhref);
                            } else {
                                $(".more .roll1").text('NO MORE')
                                $(".more .roll2").text('NO MORE'); //如果没有下一页了，隐藏
                            }
                        }
                    });
                }
                return false;
            });
        });
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