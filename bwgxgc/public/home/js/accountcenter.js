$(function () {
    var flage=true;
    $('.content-title-ul li').on('click',function (e) {
        var index=$('.content-title-ul li').index(this);
        var left1=50*(index);
        if(flage){
            flage=false;
            $('.content-title-ul li .weixuanzhong').removeClass('yixuanzhong');
            if($(e.target).get(0).tagName=='I'){
                $(e.target).addClass('yixuanzhong');
            }else if($(e.target).get(0).tagName=='DIV'){
                $(e.target).parents().children('.weixuanzhong').addClass('yixuanzhong');
            }else if($(e.target).get(0).tagName=='SPAN'){
                $(e.target).parents().children('.weixuanzhong').addClass('yixuanzhong');
            }else if($(e.target).get(0).tagName=='A'){
                $(e.target).children('.weixuanzhong').addClass('yixuanzhong');
            }else if($(e.target).get(0).tagName=='LI'){
                $(e.target).children('a').children('.weixuanzhong').addClass('yixuanzhong');
            }
            $('.dingwei').animate({left:left1+'%'},function () {
                flage=true;
            });
        }
    })
})