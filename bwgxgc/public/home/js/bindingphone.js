$(function () {
    $('.huoquyanzhengma').on('click',function () {
        var telphone=$('.telphone-num').val();
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{telphone},
        //     dataType:JSON,
        //     success:function (str) {
        //
        //     }
        //
        // })
    })

    //修改密码绑定手机切换
    $('.header-xgmm').on('click',function () {
        $('.header-xgmm').addClass('header-active')
        $('.header-bdsj').removeClass('header-active');
        $('.main-content').addClass('active');
        $('.main-content1').removeClass('active');
    })
    $('.header-bdsj').on('click',function () {
        $('.header-bdsj').addClass('header-active')
        $('.header-xgmm').removeClass('header-active');
        $('.main-content1').addClass('active');
        $('.main-content').removeClass('active');
    })
})