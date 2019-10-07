<?php
/*
 * Template Name: oar
 */
?>
<?php get_header(); ?>


<div class="main">
    <div class="main-47">
        <div class="chunk clearfix">
            <p>Ocean Freight </p>
            <p>海运代理</p>
        </div>
    </div>
    <?php show_post(293);?>>
    <div class="main-49 w">
        <div class="title">
            <p>优势航线</p>
            <p></p>
            <p>Main Trade Line </p>
        </div>
        <?php show_post(295);?>
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
            <p>优势航线</p>
            <p></p>
            <p>Main Trade Line </p>
        </div>
        <div class="photo"><img src="/wp-content/themes/dema/img/q23.jpg"></div>
    </div>
    <div class="main-50">
        <div class="w">
            <div class="title">
                <p>合作伙伴</p>
                <p></p>
                <p>partners</p>
            </div>
            <div class="content">
                <?php show_post(297);?>
            </div>
        </div>
    </div>
    <div class="main-51">
        <div class="chunk">
            <p>Air Freight</p>
            <p>空运代理</p>
        </div>
    </div>
    <div class="main-52">
        <div class="content w">
            <?php show_post(299); ?>
        </div>
    </div>
    <div class="main-53 w">
        <div class="title">
            <p>空运枢纽</p>
            <p></p>
            <p>Air Hubs </p>
        </div>
        <div class="content location">
            <?php show_post(301); ?>
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
            <p>空运枢纽</p>
            <p></p>
            <p>Air Hubs </p>
        </div>
        <div class="photo">
            <img src="/wp-content/themes/dema/img/q24.jpg">
        </div>
    </div>
    <div class="main-54">
        <div class="w">
            <div class="title">
                <p>合作伙伴</p>
                <p></p>
                <p>partners</p>
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
            <p>铁路运输</p>
        </div>
    </div>
    <div class="main-56">
        <div class="content w">
            <?php show_post(305);?>
        </div>
    </div>
    <div class="main-57 w">
        <div class="title">
            <p>主要线路</p>
            <p></p>
            <p>main railway</p>
        </div>
        <?php show_post(307);?>
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
