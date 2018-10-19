$(function () {
    (function () {//设置banner父元素高度     banner轮播
        var height = $('.banner-box .banner-c-box .banner-img .banner-c-img img')[0].height;
        var dian_box_w = $('.banner-box .banner-c-box .banner-img .banner-dian-box li').length * 15;//轮播点外div设置宽高
        var banner_num = $('.banner-box .banner-c-box .banner-img .banner-c-img img').length//轮播图数量
        var num = 46 + height + 'px';
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
// //一键找厂下拉菜单
//     $('.gongchang-ch-x').on('click', function (e) {
//         var class_name = $(e.target).parent().attr('class');
//         var dqdj_name=$(e.target).attr('dqdj');
//         if(dqdj_name=='a1'){
//             class_name=$(e.target).parent().parent().attr('class');
//         }
//         if(class_name=='cp-l-b' || class_name=='cp-p-p' || class_name=='gc-p-y'){
//             if ($("." + class_name + " .cp-xl").css('display') == 'block') {
//                 $('.gongchang-ch-x .cp-xl').css('display', 'none');
//             } else {
//                 $('.gongchang-ch-x .cp-xl').css('display', 'none');//隐藏下拉菜单
//                 $("." + class_name + " .cp-xl").css('display', 'block');//显示当前点击下拉菜单
//             }
//             if (class_name == 'yijian-x-z') {
//                 var category_name = $('.cp-l-b .cp-xl-title').text();
//                 var brand_name = $('.cp-p-p .cp-xl-title').text();
//                 var area_name = $('.gc-p-y .cp-xl-title').text();
//                 if (category_name == '产品类别') {
//
//                 } else if (brand_name == '产品品牌') {
//
//                 } else if (area_name = '工厂区域 ') {
//
//                 } else {
//                     // $.ajax({
//                     //     url:'',
//                     //     type:post,
//                     //     data:{category_name,brand_name,area_name},
//                     //     dataType:JSON,
//                     //     success:function (res) {
//                     //
//                     //     }
//                     //
//                     // })
//                 }
//
//             }
//
//         }
//     })
// // 一键找厂三级联动
//     $('.gongchang-ch-x .cp-xl-box .cp-xl ').on('click',function (e) {
//         var class_name = $(e.target).parent().parent().attr('class');
//         var str = $(e.target).text()
//         $("."+class_name+" .cp-xl-title span").text(str);
//         $('.gongchang-ch-x .cp-xl').css('display', 'none');
//
//     })


//点击播放视频
    $('.video-img-box').on('click',function (e) {
        var class_name=$(e.target).parent().attr('class');
        if(class_name=='video-img-box'){
            class_name=$(e.target).parent().parent().attr('class');
        }
        $(this).css('display','none')
        $('.'+class_name+' video')[0].play()
    })
    $('.wsyp-video video').on('click',function (e) {
        $('.wsyp-video .video-img-box').css('display','block');
        $(this)[0].pause()
    })
    $('.wsyp-video1 video').on('click',function (e) {
        $('.wsyp-video1 .video-img-box').css('display','block');
        $(this)[0].pause()
    })
    $('.wsyp-video2 video').on('click',function (e) {
        $('.wsyp-video2 .video-img-box').css('display','block');
        $(this)[0].pause()
    })
//点击规格
    $('.jiagong-b-box .gg-sz').on('click',function (e) {
        $(e.target).siblings().css('background','none').css('color','#989797')
        $(e.target).css('background','#9d5fd6').css('color','#fff')
        // var gg_text=$(e.target).text();
        // var cp_id=$(e.target).attr('gg_id');
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{cp_id,gg_text},
        //     dataType:JSON,
        //     success:function (res) {
        //
        //     }
        //
        // })

    })
//卫生用品优选验厂
    var yxyc_xb=0;
    //点击左箭头
    $('.youxuan-xw-img .youxuan-left-jt').on('click',function () {
        yxyc_xb--;
        if(yxyc_xb<0){
            yxyc_xb=0;
        }else{
            // $.ajax({
            //     url:'',
            //     type:post,
            //     data:{yxyc_xb},
            //     dataType:JSON,
            //     success:function (res) {
            //
            //     }
            //
            // })
        }
    })
    //点击右箭头
    $('.youxuan-xw-img .youxuan-right-jt').on('click',function () {
        yxyc_xb++;
        if(yxyc_xb>6){
            yxyc_xb=6;
        }else{
            // $.ajax({
            //     url:'',
            //     type:post,
            //     data:{yxyc_xb},
            //     dataType:JSON,
            //     success:function (res) {
            //
            //     }
            //
            // })
        }
    })
    //优选验厂箭头显示隐藏
    $('.youxuan-xw-img').on('mouseover',function (event) {
        $(this).children('.youxuan-jt').css('display','block')
    }).on('mouseout',function (event) {
        $(this).children('.youxuan-jt').css('display','none')
    })

// 结束
})