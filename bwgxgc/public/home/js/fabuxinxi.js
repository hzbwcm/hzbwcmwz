$(function () {
    //侧导航点击
    $('.cedaohang-li').on('click', function (e) {
        $('.cedaohang-li').removeClass('cedaohang-active');
        $(e.target).addClass('cedaohang-active');
    });
    //实现实时预览的函数
    function setImagePreview(avalue,localimag,preview,doc) {
        var docObj = document.getElementById(doc);
        //img
        var imgObjPreview = document.getElementById(preview);
        //div
        var divs = document.getElementById(localimag);
        if (docObj.files && docObj.files[0]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.maxWidth = "100%";
            imgObjPreview.style.maxHeight = "100%";
            //imgObjPreview.src = docObj.files[0].getAsDataURL();
            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        } else {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementById(localimag);
            //必须设置初始大小
            localImagId.style.maxWidth = "100%";
            localImagId.style.maxHeight = "100%";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try {
                localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)"
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            } catch (e) {
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
        return true;
    }

    //绑定更换头像实现预览的效果
    inputimg=function (pic1,localimag,preview,doc){
        // console.log(pic);
        $("input[name='"+pic1+"']").on('change', function () {
            var file = $(this).val();
            setImagePreview(file,localimag,preview,doc);
        });
    }
})