$(function () {
    // 点击搜索
    $('.sousuo-button').on('click',sousuo);
    function sousuo() {
        var sousuo_input_val=$('.sousuo-box input').val();
        // $.ajax({
        //     url:'',
        //     type:post,
        //     data:{sousuo_input_val},
        //     dataType:JSON,
        //     success:function (str) {
        //
        //     }
        //
        // })
    }
    //批量管理
    $('.piliangguanli1').on('click',function () {//开始批量操作
        $('.piliangcaozuo').removeClass('piliangcaozuo');
        $(this).addClass('piliangcaozuo');
        $('.scj-cz-box').removeClass('scj-cz-active');
        $('.scj-cz-xz').css('display','block');
        $('.scj-cz-jrgc').css('display','none');
        $('.scj-cz-sc').css('display','none');
    })
    $('.piliangguanli2').on('click',function () {//取消批量操作
        $('.piliangcaozuo').removeClass('piliangcaozuo');
        $('.quanxuan-box').addClass('piliangcaozuo');
        $('.shanchu-box').addClass('piliangcaozuo');
        $(this).addClass('piliangcaozuo');
        $('.scj-cz-box').addClass('scj-cz-active');
        $('.scj-cz-xz').css('display','none');
        $('.scj-cz-jrgc').css('display','block');
        $('.scj-cz-sc').css('display','block');
    })

    //点击删除一条收藏
    $('.scj-cz-sc').on('click',djsc);
    function djsc() {
        var gs_name=$(this).attr('gsmc');//公司名称
        var flag=confirm('是否将'+gs_name+'从收藏夹中移除');
        var ygz_id=$(this).attr('id');//当前要删除的数据的ID
        if(flag){
            // $.ajax({
            //     url:'',
            //     type:post,
            //     data:{ygz_id},
            //     dataType:JSON,
            //     success:function (str) {
            //
            //     }
            //
            // })
        }
    }


    //分页

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