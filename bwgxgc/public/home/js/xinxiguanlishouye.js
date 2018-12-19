$(function () {
    //侧导航点击
    $('.cedaohang-li').on('click', function (e) {
        $('.cedaohang-li').removeClass('cedaohang-active');
        $(e.target).addClass('cedaohang-active');
    });
})