$(function () {
    (function () {//设置banner父元素高度     banner轮播
        var height = $('.banner-box .banner-c-box .banner-img .banner-c-img img')[0].height;
        var dian_box_w = $('.banner-box .banner-c-box .banner-img .banner-dian-box li').length * 15;//轮播点设置宽高
        var banner_num = $('.banner-box .banner-c-box .banner-img .banner-c-img img').length//轮播图数量
        var num = height + 'px';
        var number = 0;
        // $('.banner-box .banner-c-box').css('height', height + 'px');
        // $('.banner-box .banner-c-box .banner-img').css('height', height + 'px');
        // $('.banner-box').css('height', num);
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

//楼层跳转
    var flag=true;
    var key=true;
    $('.gudingdaohang-box ul li').on('click',function (e) {
        if(key){
            key=false;
            var num=$(e.target).index();//当前点击的第n个li
            var hdnum=$('.main-jggc-box')[num].offsetTop;
            $('html,body').animate({scrollTop:hdnum-200},function () {
                key=true;
            });
        }
    })
    $('.guding-foot').on('click',function () {
        if(key){
            key=false;
            $('html,body').animate({scrollTop:0},function () {
                $('.gudingdaohang-box').animate({height:0},function () {
                    key=true;
                })
            })
        }
    })
    $(window).on('scroll',function () {
        var height=$(window).scrollTop();
        var ce_heights=$('.guding-title').height()+$('.gudingdaohang-box ul').height()+$('.guding-foot').height();
        if(height>=800){
            if(flag){
                flag=false;
                $('.gudingdaohang-box').animate({height:ce_heights+'px'},function () {
                    flag=true;
                })
            }
        }else{
            if(flag){
                flag=false;
                $('.gudingdaohang-box').animate({height:0},function () {
                    flag=true;
                })
            }
        }
        $('.main-jggc-box').each(function (index,val) {
            if( $('.main-jggc-box')[index].offsetTop-200<=$(window).scrollTop()){
                $('.gudingdaohang-box ul li').removeAttr('id','acttive')
                $('.gudingdaohang-box ul li').eq(index).attr('id','active')
            }

        })
    })

    //点击收藏,点击取消收藏
    $('.jggc-icon').on('click',djsc);
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
})