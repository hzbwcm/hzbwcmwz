$(function () {

    //鼠标移入切换图片
    $('.cpzs-img-mousemove').on('mouseenter',qhtp);
    function qhtp() {
        var img_mouseenter=$(this).children('img').attr('src');
        $(this).css("border","1px solid #a260de").siblings().css("border","none");
        $(this).parent().siblings('.cpzs-content-img').children('img').attr('src',img_mouseenter);
    }
})