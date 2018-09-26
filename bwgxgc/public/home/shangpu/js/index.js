$(function () {
    //点击收藏,点击取消收藏
    $('.qytp-icon').on('click', djsc);

    function djsc() {
        //     $.ajax({//点击收藏
        //         url:'',
        //         type:post,
        //         data:{},
        //         dataType:JSON,
        //         success:function (str) {
        //             if(str){
        //                 $(this).children('.icon-xin').addClass('icon-xin1').removeClass('icon-xin');
        //             }
        //         }
        //
        //     })


        // $.ajax({//点击取消收藏
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (str) {
        //         if(str){
        //             $(this).children('.icon-xin1').addClass('icon-xin').removeClass('icon-xin1');
        //         }
        //     }
        //
        // })

    }
    //鼠标移入切换图片
    $('.cpzs-img-mousemove').on('mouseenter',qhtp);
    function qhtp() {
        var img_mouseenter=$(this).children('img').attr('src');
        $(this).css("border","1px solid #a260de").siblings().css("border","none");
        $(this).parent().siblings('.cpzs-content-img').children('img').attr('src',img_mouseenter);
    }
    //点击资质图片放大
    $('.qyzz-li1-img').on('click',function () {
        var img_src=$(this).children('img').attr('src');
        $('.qyzz-big-img').children('img').attr('src',img_src);
        var top_pianyi=$('.qyzz-big-img').innerHeight();
        var img_top=$(this).offset().top - top_pianyi/2;
        $('.qyzz-big-img').css({'top':img_top,'display':'block'})
    })
    $('.qyzz-img-off').on('click',function () {
        $('.qyzz-big-img').css('display','none')
    })
})