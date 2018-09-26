$(function () {
//侧导航鼠标移入移出隐藏显示效果
    $('.ce-daohang li').css('display','none')
    $('.ce-daohang li').eq(0).css('display','block')
    $('.ce-daohang').on('mouseout',function () {
        $('.ce-daohang li').css('display','none')
        $('.ce-daohang li').eq(0).css('display','block')
    })
    $('.ce-daohang').on('mouseover',function () {
        $('.ce-daohang li').css('display','block')
    })
//搜索
    $('.search-button').on('click', function () {
        var search = $('.search-fram input')[0].value;
        $(location).attr('href', 'http://www.baidu.com')
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{search},
        //     dataType:JSON,
        //     success:function (str) {
        //
        //     }
        //
        // })
    })

//banner
    var img_width=$('.banner-img img').width();
    var img_num=$('.banner-img-box1 img').length;
    $('.banner-img-box').css('width',(img_width+6)*img_num+'px');
    // $('.banner-box-img').css('width',img_width*img_num*2);
    var left1=0;
    var t=setInterval(function () {
        $('.banner-img-box').css('left',left1--);
        if(left1<=-(img_width+6)){
            $('.banner-img').eq(0).appendTo('.banner-img-box');
            left1=0;
        }
    },10)
    $('.banner-img-box').on('mouseover',function () {
        clearInterval(t);
        $('.banner-img-box').on('mouseout',function () {
            clearInterval(t);
            t=setInterval(function () {
                $('.banner-img-box').css('left',left1--);
                if(left1<=-(img_width+6)){
                    $('.banner-img').eq(0).appendTo('.banner-img-box');
                    left1=0;
                }
            },10)
        })
    })

//区域点击效果
    $('.main-right-text').on('click',function (e) {
        $('.main-right-text').removeClass('main-right-text1');
        $(e.target).addClass('main-right-text1');

        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{},
        //     dataType:JSON,
        //     success:function (str) {
        //
        //     }
        //
        // })
    })
//点击首页
    $('.main-sy').on('click',function () {
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
    $('.main-syy').on('click',function () {
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
    $('.main-xyy').on('click',function () {
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
    $('.main-fenye-box ul li').on('click',function (e) {
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
    $('.main-tiaozhuan input').on('keyup',function (e) {
        if($(e.keyCode)[0]==13){
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
    $('.main-wy').on('click',function () {
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