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