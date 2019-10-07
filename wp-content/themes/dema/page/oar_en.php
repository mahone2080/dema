<?php
/*
 * Template Name: oar en
 */
?>
<?php get_header(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/outer/css/index.css">

    <div class="main">
        <div class="main-47">
            <div class="chunk clearfix">
                <p>Ocean Freight </p>

            </div>
        </div>
        <?php show_post(312);?>>
        <div class="main-49 w">
            <div class="title">
                <p>Main Trade Line </p>
                <p></p>
            </div>
            <?php show_post(314);?>

        </div>
        <style type="text/css">
            .yy {
                width: 100%;
                margin: 0 auto;
                text-align: center;
                padding: 20px 0 0 0 ;
            }

            .yy img {
                max-width: 100%;
            }

            .yy_a {
                width: 100%;
                margin: 0 auto;
                text-align: center;
                padding: 20px 0 0 0;
            }

            .yy_a img {
                max-width: 100%;
            }
        </style>
        <div class="yy">
            <div class="title">
                <p>Main Trade Line </p>
                <p></p>

            </div>
            <div class="photo"><img src="/wp-content/themes/dema/img/q23.jpg"></div>
        </div>
        <div class="main-50">
            <div class="w">
                <div class="title">
                    <p>Ocean Partners</p>
                    <p></p>

                </div>
                <div class="content">
                    <?php show_post(297);?>
                </div>
            </div>
        </div>
        <div class="main-51">
            <div class="chunk">
                <p>Air Freight</p>

            </div>
        </div>
        <div class="main-52">
            <div class="content w">
                <?php show_post(316); ?>
            </div>
        </div>
        <div class="main-53 w">
            <div class="title">
                <p>Air Hubs </p>
                <p></p>
            </div>
            <div class="content location">
                <?php show_post(318); ?>
            </div>
        </div>
        <style type="text/css">
            .yy_a .title p:nth-child(1) {
                font-size: 22px;
            }
            .yy .title p:nth-child(1) {
                font-size: 22px;
            }
        </style>
        <div class="yy_a">
            <div class="title">
                <p>Air Hubs </p>
                <p></p>

            </div>
            <div class="photo">
                <img src="/wp-content/themes/dema/outer/img/q24.jpg">
            </div>
        </div>
        <div class="main-54">
            <div class="w">
                <div class="title">
                    <p>Air Partners</p>
                    <p></p>
                </div>
                <div class="content">
                    <?php show_post(303)?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-55">
        <div class="chunk">
            <p>Railway Service</p>
        </div>
    </div>
    <div class="main-56">
        <div class="content w">
            <?php show_post(320);?>
        </div>
    </div>
    <div class="main-57 w">
        <?php show_post(322);?>
    </div>
    </div>

    <script type="text/javascript">
        $('.main-49 .top li').mouseover(function() {
            var Top = $('.main-49 .top li').index(this);
            $(this).addClass('on').siblings().removeClass('on');

            $('.main-49 .bottom li').eq(Top).show().siblings().hide();

            $(".main-49 .top li img ").eq($(this).index()).addClass("active_a").parent("li").siblings().children().removeClass('active_a');

            $(".main-49 .top li  ").eq($(this).index()).addClass("active_b").siblings().removeClass('active_b');
        });

        $('.main-53 .topa li').mouseover(function() {
            var Top = $('.main-53 .topa li').index(this);

            $(this).addClass('on').siblings().removeClass('on');

            $('.main-53 .bottoma li').eq(Top).show().siblings().hide();

            $(".main-53 .topa li  ").eq($(this).index()).addClass("active_c").siblings().removeClass('active_c');

            $(".main-53 .topa li img ").eq($(this).index()).addClass("active_a").parent("li").siblings().children().removeClass('active_a');
        });




        new WOW().init();
    </script>

<?php get_footer(); ?>