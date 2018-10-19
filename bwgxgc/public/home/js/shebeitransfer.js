$(function () {
    //点击设备名称
    $('.main-sbmc').on('click', function () {
        $('.main-sbmc').removeClass('sbmc-name-active');
        $(this).addClass('sbmc-name-active');

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
    //点击显示隐藏排序
    $('.main-sbpxfs-css').on('click',function () {
        if($(this).children('.sbpxfs-none').length == 0){
            $('.sbpxfs-display').addClass('sbpxfs-none');
            $('.main-sbpxfs-css').removeClass('sbpxfs-color');
        }else{
            $('.main-sbpxfs-css').removeClass('sbpxfs-color');
            $('.sbpxfs-display').addClass('sbpxfs-none');
            $(this).children('.sbpxfs-display').removeClass('sbpxfs-none');
            $(this).addClass('sbpxfs-color');
        }

    })
    //点击排序
    $('.sbpxfs-span').on('click', function () {
        var content_text=$(this).text();
        console.log(content_text)
        $('.sbpxfs-span').removeClass('sbpxfs-span-active');
        $(this).addClass('sbpxfs-span-active').parent().parent().children('span').text(content_text);
        console.log($(this).addClass('sbpxfs-span-active').parent().parent())
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