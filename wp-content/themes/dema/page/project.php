<?php
/**
 * Template Name:project
 *
 */
get_header();
?>
<div class="main">
    <div class="main-32">
        <div class="chunk clearfix">
            <p>Project & Special <br> Cargo</p>
            <p>项目及特殊货物</p>
        </div>
    </div>
    <div class="main-33">
        <div class="w">
            <div class="title">
                <p>项目货物</p>
                <p></p>
            </div>
            <div class="content">

                <?php show_post(372)?>
            </div>
        </div>
    </div>
    <div class="main-34">
        <div class="w">
            <div class="title">
                <p>特殊货物</p>
                <p></p>
            </div>
            <div class="content">
                <?php show_post(374)?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
