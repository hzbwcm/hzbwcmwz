$(function () {
    (function () {//设置banner父元素高度     banner轮播
        var height = $('.banner-box .banner-c-box .banner-img .banner-c-img img')[0].height;
        var dian_box_w = $('.banner-box .banner-c-box .banner-img .banner-dian-box li').length * 15;//轮播点设置宽高
        var banner_num = $('.banner-box .banner-c-box .banner-img .banner-c-img img').length//轮播图数量
        var num = height + 'px';
        var number = 0;
        $('.banner-box .banner-c-box .banner-img .banner-dian-box').css('margin-left', '-' + dian_box_w / 2 + 'px');//轮播图圆点居中

        //轮播

        function banner_time() {
            var num = number % banner_num
            $('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(num).css('opacity', 1);
            $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(num).addClass('banner-dd-xzxg')
            var banner_color = $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(num).attr('banner_color');
            $('.banner-box').css('background-image', "url(" + banner_color + ")");
            number++;
        }


        $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).css('opacity', 1);
        $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').eq(0).addClass('banner-dd-xzxg')
        $('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).attr('banner_color') + ")");
        var t = setInterval(banner_time, 5000)//轮播图时间函数

        //轮播鼠标移入移出
        $('.banner-img img').on('mouseover', function () {
            clearInterval(t)
        })
        $('.banner-img').on('mouseout', function () {
            clearInterval(t)
            t = setInterval(banner_time, 5000)//轮播图时间函数
        })
        //鼠标点击小圆点
        $('.banner-dian-box li').on('click', function () {
            number = $(this).attr('banner_id');
            $('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(number).css('opacity', 1);
            $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(number).addClass('banner-dd-xzxg')
            $('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(number).attr('banner_color') + ")");
        })
    })()
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
//登陆注册
    //登陆
    $('.denglu-button').on('click', function () {
        var user = $('.denglu .dl-zh input')[0].value
        var password = $('.denglu .dl-mm input')[0].value
        // $.ajax({//登陆ajax
        //     url:'',
        //     type:post,
        //     data:{user,password},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })
        console.log(user, password)
    })
//左侧导航点击
    $('.accordion-inner').on('click',function (e) {
        $('.accordion-inner').removeClass('left-click');
        $(e.target).addClass('left-click');//当前点击
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
//右侧上点击
    //属性
    $('.main-top-sx li').on('click',function (e) {
        $('.main-top-sx li').removeClass('right-click');
        $(e.target).addClass('right-click');//当前点击
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
    //区域
    $('.main-top-qy li').on('click',function (e) {
        $('.main-top-qy li').removeClass('right-click');
        $(e.target).addClass('right-click');//当前点击
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
    //期限
    $('.main-top-qx li').on('click',function (e) {
        $('.main-top-qx li').removeClass('right-click');
        $(e.target).addClass('right-click');//当前点击
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
//点击上一页
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