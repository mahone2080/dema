$(document).ready(function() {
    // 获取屏幕宽度
    // var oWidth = window.screen.width; //
    var oWidth = document.body.clientWidth
    console.log(oWidth)


    //头部置顶
    $(window).scroll(function() {
        //标题栏添加删除顶格
        var scrollTop = $(this).scrollTop();
        // 设定标题顶格的距离为800
        if (scrollTop > 100) {
            $(".header").addClass("proCenTabOn").fadeIn()
        } else {
            $(".header").removeClass("proCenTabOn")
        }
    });



    // 导航打开
    $(".icon-ego-menu").click(function() {
        $(".icon-ego-menu").hide();
        $(".icon-guanbi").show();
        $(".header-right .ooo").slideDown();
        $(".new img").css("display", "block")
    });

    // 导航关闭
    $(".icon-guanbi").click(function() {
        $(".icon-ego-menu").show();
        $(".icon-guanbi").hide();
        $(".header-right .ooo").slideUp();
    });


    $(".new img").click(function() {
        $(this).parent().siblings('.second-level').slideToggle().parent().siblings().slideToggle()
    })

    // $("#menu-mainmenu > li > a > img").click(function() {
    //     $(this).siblings('.second-level').slideToggle()
    // })
});