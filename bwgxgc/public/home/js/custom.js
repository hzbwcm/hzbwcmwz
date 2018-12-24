$(function () {
    (function () {//设置banner父元素高度     banner轮播
        var height = $('.banner-box .banner-c-box .banner-img .banner-c-img img')[0].height;
        var dian_box_w = $('.banner-box .banner-c-box .banner-img .banner-dian-box li').length * 15;//轮播点设置宽高
        var banner_num = $('.banner-box .banner-c-box .banner-img .banner-c-img img').length//轮播图数量
        var num = height + 'px';
        var number = 0;
        $('.banner-box .banner-c-box .banner-img .banner-dian-box').css('margin-left', '-' + dian_box_w / 2 + 'px');//轮播图圆点居中

        //轮播

        // function banner_time() {
        //     var num = number % banner_num
        //     $('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(num).css('opacity', 1);
        //     $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(num).addClass('banner-dd-xzxg')
        //     var banner_color = $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(num).attr('banner_color');
        //     $('.banner-box').css('background-image', "url(" + banner_color + ")");
        //     number++;
        // }


        $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).css('opacity', 1);
        $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').eq(0).addClass('banner-dd-xzxg')
        $('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).attr('banner_color') + ")");
        // var t = setInterval(banner_time, 5000)//轮播图时间函数

        // //轮播鼠标移入移出
        // $('.banner-img img').on('mouseover', function () {
        //     clearInterval(t)
        // })
        // $('.banner-img').on('mouseout', function () {
        //     clearInterval(t)
        //     t = setInterval(banner_time, 5000)//轮播图时间函数
        // })
        // //鼠标点击小圆点
        // $('.banner-dian-box li').on('click', function () {
        //     number = $(this).attr('banner_id');
        //     $('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(number).css('opacity', 1);
        //     $('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(number).addClass('banner-dd-xzxg')
        //     $('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(number).attr('banner_color') + ")");
        // })
    })()
})