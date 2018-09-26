$(function () {
    //点击类目
    $('.class_fenlei1 .main-fenlei-content span').on('click', function () {
        $(this).siblings().removeClass('fenlei-click-css');
        $(this).addClass('fenlei-click-css');
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        // })
    })
    //点击地区
    $('.class_fenlei2 .main-fenlei-content span').on('click', function () {
        $(this).siblings().removeClass('fenlei-click-css');
        $(this).addClass('fenlei-click-css');
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        // })
    })
    //点击更多
    $('#main-gengduo').on('click', function () {
        var str = $(this).attr('class');
        if (str == 'main-fenlei-gengduo') {
            $(this).addClass('main-fenlei-gengduo-avtive').removeClass('main-fenlei-gengduo').text('收起');
            $('.main-fenlei-content').addClass('main-fenlei-content-active').removeClass('main-fenlei-content');
        } else if (str == 'main-fenlei-gengduo-avtive') {
            console.log(1)
            $(this).addClass('main-fenlei-gengduo').removeClass('main-fenlei-gengduo-avtive').text('更多');
            $('.main-fenlei-content-active').addClass('main-fenlei-content').removeClass('main-fenlei-content-active');
        }
    })

    //点击规格
    $('.content-title-gg').on('click', function () {
        $('.content-title-gg').removeClass('content-title-gg-active');
        $(this).addClass('content-title-gg-active');
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        // })
    })

    //点击收藏,点击取消收藏
    $('.jggc-icon').on('click', djsc);

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

    //分页

    //点击首页
    $('.main-sy').on('click', function () {
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
    })
//点击上一页
    $('.main-syy').on('click', function () {
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
    })
//点击下一页
    $('.main-xyy').on('click', function () {
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
    })
//点击页码
    $('.main-fenye-box ul li').on('click', function (e) {
        $('.main-fenye-box ul li').removeClass('right-bottom-click')
        $(e.target).addClass('right-bottom-click');
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
    })
//跳转
    $('.main-tiaozhuan input').on('keyup', function (e) {
        if ($(e.keyCode)[0] == 13) {
            // $.ajax({
            //     url:'',
            //     type:post,
            //     data:{},
            //     dataType:JSON,
            //     success:function (res) {
            //
            //     }
            //
            // })
        }
    })
//点击尾页
    $('.main-wy').on('click', function () {
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
    })
})