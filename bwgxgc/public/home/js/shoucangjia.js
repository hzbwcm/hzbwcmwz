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
})