$(function () {
    $('.main-lxsj').on('click',function () {
        var tel=$(this).attr('tel');
        alert('商家联系电话：'+tel);
    })

    //
    var num=$('.main-content').length;
    if(num/2==0){
        $('.main-content').eq(num-2).css('border-bottom','none');
    }


})