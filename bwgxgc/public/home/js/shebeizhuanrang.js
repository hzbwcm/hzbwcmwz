$(function () {
    $('.main-lxsj').on('click',function () {
        var tel=$(this).attr('tel');
        alert('商家联系电话：'+tel);
    })

    //去边框
    var num=$('.main-content').length;
    if($('.main-content-sblczx').length == 0){
        if(num/2){
            $('.main-content').eq(num-2).css('border-bottom','none');
        }
    }

})