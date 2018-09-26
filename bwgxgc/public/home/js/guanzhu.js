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
    //全选
    $('#quanxuan-input').on('click',function () {
        if($(this).prop('checked')){
            $('.yga-cz-input').prop('checked',true);
        }else{
            $('.yga-cz-input').prop('checked',false);
        }
    })
    //点击删除一条关注
    $('.ygz-cz-sc').on('click',djsc);
    function djsc() {
        var gs_name=$(this).attr('gsmc');//公司名称
        var flag=confirm('是否取消'+gs_name+'的关注');
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