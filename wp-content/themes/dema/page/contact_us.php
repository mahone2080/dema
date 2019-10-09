<?php
/*
 * Template Name: contact us
 */
?>
<?php get_header(); ?>
<style>
    .forminator-custom-form {
        display: block !important;
    }
    .forminator-label{
        display: none;
    }
    .forminator-row{

    }
    .forminator-col{
        outline: 0;
        padding: 7px 0 7px 15px;
        font-size: 15px;
        width: 100%;
        border: 1px solid #eee;
    }
    div.forminator-row:nth-child(2){
        display: flex;
        justify-content: space-around;
    }
    .forminator-button-submit{
        margin: 0 0 0 23px;
        width: 190px;
        padding: 7px 0;
        background: #4c86b6;
        color: #fff;
        outline: 0;
        border: 0;
        cursor: pointer;
    }
    .main-21 input{
        width: 88%;
    }
</style>
<div class="main-16">
    <div class="chunk">
        <p>Contact us</p>
        <p>联系我们</p>
    </div>
</div>
<div class="main-17">
    <div class="container">
        <div class="title">
            <p>位置分布</p>
            <p></p>
            <p>Locations </p>
        </div>
    </div>
</div>
<?php
//echo do_shortcode("[tribulant_slideshow gallery_id=2]");
?>
<div class="main-18">
    <!-- <div class="w"> -->
    <div class="photo wow fadeInLeft location" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
        <!-- <img src="img/photo-99.png"> -->
        <div class="w location">
            <div class="p p1 wow bounceInDown" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: bounceInDown;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p2 wow bounceInDown" data-wow-delay="1.3s" style="visibility: visible; animation-delay: 1.3s; animation-name: bounceInDown;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p3 wow bounceInDown" data-wow-delay="1.5s" style="visibility: visible; animation-delay: 1.5s; animation-name: bounceInDown;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p4 wow bounceInDown" data-wow-delay="1.7s" style="visibility: visible; animation-delay: 1.7s; animation-name: bounceInDown;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p5 wow bounceInRight" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: bounceInRight;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p6 wow bounceInRight" data-wow-delay="1.3s" style="visibility: visible; animation-delay: 1.3s; animation-name: bounceInRight;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p7 wow bounceInRight" data-wow-delay="1.5s" style="visibility: visible; animation-delay: 1.5s; animation-name: bounceInRight;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p8 wow bounceInUp" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: bounceInUp;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p9 wow bounceInUp" data-wow-delay="1.3s" style="visibility: visible; animation-delay: 1.3s; animation-name: bounceInUp;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
            <div class="p p10 wow bounceInUp" data-wow-delay="1.5s" style="visibility: visible; animation-delay: 1.5s; animation-name: bounceInUp;">
                <img src="<?php echo get_template_directory_uri(); ?>/img/photo-98.png">
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>
<?php show_post(257);?>
<div class="main-21">
    <div class="container">
        <?php show_post(556);?>
    </div>
</div>
<script type="text/javascript">
    new WOW().init();
    $(".main-21 input").focus(function() {
        $(this).css({
            "box-shadow": "0 0 10px 3px rgba(0,0,0,0.2)",
            "transition": "all 0.5s"
        });
    });
    $(".main-21 input").blur(function() {
        $(this).css({
            "box-shadow": "0 0 0 0 rgba(0,0,0,0.0)",
            "transition": "all 0.5s"
        });
    });

</script>
<?php get_footer(); ?>
