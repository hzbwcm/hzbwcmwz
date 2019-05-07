$(function () {
  // 价格行情轮播
  (function () {
    let banner = $(".BannerImage0")
    let num = 1;
    let bannerTime = function () {
      if (num >= banner.length) {
        num = 0;
      }
      $(".BannerTitle").animate({ "opacity": 0 }, 300).eq(num).animate({ "opacity": 1 }, 300);
      $(".BannerContent").animate({ "opacity": 0 }, 300).eq(num).animate({ "opacity": 1 }, 300);
      $(".BannerImage0").animate({ "opacity": 0 }, 300, function () { $(".BannerImage0").css({ "display": "none" }).eq(num).css({ "display": "block" }) }).eq(num).animate({ "opacity": 1 }, 300, function () { num++ });
      $(".BannerRoundBox .BannerRound").removeClass("BannerRoundActive").eq(num).addClass("BannerRoundActive")
    }
    let t = setInterval(bannerTime, 5000)
    // 鼠标移入停止轮播
    $(".BannerBox").on('mouseover', function () {
      clearInterval(t)
    })
    $(".BannerBox").on('mouseout', function () {
      clearInterval(t)
      t = setInterval(bannerTime, 5000) //轮播图时间函数
    })
    //鼠标点击切换banner
    $(".BannerRoundBox .BannerRound").on("click", function () {
      num = $(this).index();
      bannerTime();
    })
  })()

})