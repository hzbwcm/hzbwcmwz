$(function () {
    // //注册
    // var flag = true;
    // //登陆注册提示（点击隐藏）
    // $('.denglu-zhuce-tishi').on('click', function () {
    //     $('.denglu-zhuce-tishi').css('display', 'none')
    // })
    // //账号input失去焦点事件
    // $('.zhuce .zhuce-zh-box input').blur(function () {//判断是否含有汉字
    //     var str = $(this)[0].value;
    //     if (/[\u4E00-\u9FA5]/g.test(str)) {
    //         $('.denglu-zhuce-tishi').text('请勿使用汉字注册账号(点击隐藏)').css('display', 'block');
    //         flag = false;
    //     } else {
    //         flag = true;
    //     }
    // })
    // //密码input失去焦点事件
    // $('.zhuce .zhuce-mm-box input').blur(function () {
    //     var str = $(this)[0].value;
    //     if (str.length < 6 || str.length > 20) {
    //         $('.denglu-zhuce-tishi').text('请设置6-20位字符的密码(点击隐藏)').css('display', 'block');
    //         var t=setTimeout(function () {
    //             $('.denglu-zhuce-tishi').css('display', 'none');
    //             clearTimeout(t)
    //         },5000)
    //         flag = false;
    //     } else {
    //         flag = true;
    //     }
    // })
    // //确认密码
    // $('.zhuce .zhuce-mm-box1 input').blur(function () {
    //     var str = $('.zhuce .zhuce-mm-box input')[0].value;//第一次输入的密码
    //     var str1 = $('.zhuce .zhuce-mm-box1 input')[0].value;//第二次输入的密码
    //     if (str != str1) {
    //         $('.denglu-zhuce-tishi').text('两次密码输入不一致(点击隐藏)').css('display', 'block');
    //         var t=setTimeout(function () {
    //             $('.denglu-zhuce-tishi').css('display', 'none');
    //             clearTimeout(t)
    //         },5000)
    //         flag = false;
    //     } else {
    //         flag = true;
    //     }
    // })
    // //获取验证码
    // $('.zhuce-sjyz-box .zhuce-hqyzm').on('click',function () {
    //     var str = $('.zhuce-sjyz-box input')[0].value
    //     if(str.length != 11){
    //         $('.denglu-zhuce-tishi').text('请输入11位手机号(点击隐藏)').css('display', 'block');
    //         var t=setTimeout(function () {
    //             $('.denglu-zhuce-tishi').css('display', 'none');
    //             clearTimeout(t)
    //         },5000)
    //         flag = false;
    //     }else{
    //         // $.ajax({//获取验证码ajax
    //         //     url:'',
    //         //     type:post,
    //         //     data:{str},
    //         //     dataType:JSON,
    //         //     success:function (res) {
    //         //
    //         //     }
    //         //
    //         // })
    //         flag=true;
    //     }
    // })
    // //输入验证码
    // $('.zhuce-sryzm input').blur(function () {
    //     var str=$(this)[0].value;
    //     if(str==''){
    //         $('.denglu-zhuce-tishi').text('请输入验证码(点击隐藏)').css('display', 'block');
    //     }
    // })
    // //点击注册
    // $('.zhuce .zhuce-button').on('click',function () {
    //     var key = $('.zhuce .yhxy-box input').is(':checked')
    //     if(!key){
    //         $('.denglu-zhuce-tishi').text('请阅读《用户协议》(点击隐藏)').css('display', 'block');
    //     }else if(!flag){
    //         $('.denglu-zhuce-tishi').text('请将信息补充完整(点击隐藏)').css('display', 'block');
    //     }else{
    //         //先判断验证码是否正确
    //
    //
    //         //发送注册ajax
    //         var user= $('.zhuce .zhuce-zh-box input')[0].value;
    //         var password= $('.zhuce .zhuce-mm-box1 input')[0].value;
    //         // $.ajax({
    //         //     url:'',
    //         //     type:post,
    //         //     data:{user,password},
    //         //     dataType:JSON,
    //         //     success:function (res) {
    //         //
    //         //     }
    //         //
    //         // })
    //     }
    // })
    //点击切换个人企业
    $('.zhuce-title').on('click',function (e) {
        $('.zhuce-title a span').removeClass('a-span');
        $(e.target).addClass('a-span');
        if($(e.target)[0].tagName=='A'){
            $(e.target).children('span').addClass('a-span');
        }
    })
})