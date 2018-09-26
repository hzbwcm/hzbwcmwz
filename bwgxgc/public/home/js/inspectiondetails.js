$(function () {
    //点击切换
    $('.main-bottom-shengchanchanpin').on('click',function () {
        $(this).addClass('main-active');
        $('.main-gongsijianjie-box').addClass('main-img-active');
        $('.main-bottom-gongsijianjie').removeClass('main-active');
        $('.main-gongsitupian-img-box').removeClass('main-img-active');
    })
    $('.main-bottom-gongsijianjie').on('click',function () {
        $(this).addClass('main-active');//公司简介选中状态
        $('.main-gongsitupian-img-box').addClass('main-img-active');//公司简介显示
        $('.main-bottom-shengchanchanpin').removeClass('main-active');//生产产品清除选中状态
        $('.main-gongsijianjie-box').removeClass('main-img-active');//生产产品图隐藏

    })
})