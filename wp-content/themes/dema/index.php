<?php get_header(); ?>
<style type="text/css">
    .header-right ul > li:nth-child(1) a {
        color: #08478a;
    }
</style>
<div class="main">
    <div class="main">
        <?php
        echo do_shortcode('[smartslider3 slider=2]');
//        echo do_shortcode('[metaslider id="500"]');
        ?>
    </div>

    <div class="insert w">
        <div class="main-1_list">
            <?php $arr_menu_product=$_GET['lang']=='en'?[310,337,355,368,376]:[289, 328, 350, 360, 372]; foreach ($arr_menu_product as $itemid): $product = get_post($itemid); ?>
                <div class="item location wow fadeInUp" data-wow-delay="">
                    <div class="photo">
                        <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($itemid))[0]?>" >
                    </div>
                    <div class="item-top">
                        <p><?php echo $product->abstract?></p>
                        <p><a href="<?php echo $product->guid?>"><?php echo $_GET['lang']=='en'?'To learn more':'了解更多' ?></a></p>
                    </div>
                    <p><?php echo $product->post_title?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- 手机 -->
    <div class="carousel_a">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php $arr_menu_product=$_GET['lang']=='en'?[310,337,355,368,376]:[289, 328, 350, 360, 372]; foreach ($arr_menu_product as $itemid): $product = get_post($itemid); ?>
                    <div class="swiper-slide">
                        <div class="photo">
                            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($itemid))[0]?>">
                        </div>
                        <p><?php echo $product->abstract?></p>
                        <p><?php echo $product->post_title?></p>
                        <p><a href="<?php echo $product->guid?>"><?php echo $_GET['lang']=='en'?'To learn more':'了解更多' ?></a></p>
                    </div>
                <?php endforeach; ?>

            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php
//    _e(pods_field_display('theme_options', 'pods-settings-theme_option', 'dema_china'));
    if($_GET['lang']=='en'){
        show_post(482);
    }else{
        show_post(478);
    }

    ?>
    <div class="insert_a">
    </div>
    <?php
    if($_GET['lang']=='en'){
    show_post(487);
    }else{
    show_post(485);
    }
    ?>
</div>
<!-- 遮罩层 -->
<div class="shaow">
    <div class="shaow_a">
        <div class="location">
            <div class="guanbi">
                <img src="/wp-content/themes/dema/img/a6.png" alt="">
            </div>
            <a href="?p=447" title="点击查看详情信息">
                <div class="photo">
                    <img src="/wp-content/themes/dema/img/a7.jpg">
                </div>
            </a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        if ($.cookie("isClose") != 'yes') {
            var winWid = $(window).width() / 2 - $('.shaow').width() / 2;
            var winHig = $(window).height() / 2 - $('.shaow').height() / 2;
            // $(".shaow").css({ "left": winWid, "top": -winHig * 2 }); //自上而下
            // $(".shaow").fadeIn('9000');
            setTimeout(function() {
                $(".shaow").fadeIn();
            },2000);
            // $(".shaow").animate({ "left": winWid, "top": winHig }, 2000);
            $(".shaow .guanbi").click(function() {
                // $(this).parent().fadeOut(500);
                // $.cookie("isClose",'yes',{ expires:1/8640}); //测试十秒
                $.cookie("isClose", 'yes', { expires: 1 });
            });
        }
    });

    $(document).ready(function() {

        var swiper = new Swiper('.carousel_a .swiper-container', {
            autoplay: true,
            pagination: {

                el: '.swiper-pagination',
                clickable: true,

            },
        });

        var swiper = new Swiper('.main-1 .aa .swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: true,
        });
        var swiper = new Swiper('.main-1 .bb .swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: true,
        });
        // 5个图标
        var oWidth = window.screen.width;

        // 动效
        new WOW().init();

        if (oWidth < 1200) {
            $(".swiper-button-prev").css("left", "10px");
            $(".swiper-button-next").css("right", "10px");
        }

        // 数字滚动
        $('.counter').countUp();





        $(".guanbi").click(function() {
            $(".shaow").fadeOut();
        });

        if (oWidth > 1199) {

            $(".main-3_bottom a:first-child .photo").hover(function() {
                $(".main-3_bottom a:first-child .photo").css({
                    "background-position": "-17px -36px"
                })
            }, function() {
                $(".main-3_bottom a:first-child .photo").css({
                    "background-position": "-17px -147px"
                })
            });

            $(".main-3_bottom a:nth-child(2) .photo").hover(function() {
                $(".main-3_bottom a:nth-child(2) .photo").css({
                    "background-position": "-184px -36px"
                })
            }, function() {
                $(".main-3_bottom a:nth-child(2) .photo").css({
                    "background-position": "-182px -147px"
                })
            });

            $(".main-3_bottom a:nth-child(3) .photo").hover(function() {
                $(".main-3_bottom a:nth-child(3) .photo").css({
                    "background-position": "-365px -58px"
                })
            }, function() {
                $(".main-3_bottom a:nth-child(3) .photo").css({
                    "background-position": "-363px -170px"
                })
            });

            $(".main-3_bottom a:nth-child(4) .photo").hover(function() {
                $(".main-3_bottom a:nth-child(4) .photo").css({
                    "background-position": "-534px -36px"
                })
            }, function() {
                $(".main-3_bottom a:nth-child(4) .photo").css({
                    "background-position": "-532px -147px"
                })
            });
        }


    });
</script>
<?php get_footer(); ?>


