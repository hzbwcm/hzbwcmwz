$(function () {
    //视屏点击

    $('.spzs-video ').on('click', bofang);

    function bofang() {
        var video_flag = $(this).is('.stop-video');
        if (!video_flag) {
            $('.spzs-video').each(function (index, val) {
                $(val).removeClass('stop-video');
                val.pause();
            });
            $(this)[0].play();
            $(this).addClass('stop-video');
        } else {
            $(this)[0].pause();
            $(this).removeClass('stop-video');
        }
    }

    $('.spzs-video ').on('play', video_play);

    function video_play() {
        $('.spzs-video').each(function (index, val) {
            $(val).removeClass('stop-video');
        });
        $(this).addClass('stop-video');
    }

    $('.spzs-video ').on('pause', video_pause1);

    function video_pause1() {
        $(this).removeClass('stop-video');
    }
})