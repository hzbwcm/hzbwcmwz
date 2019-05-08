$(function () {
  var flag = true;
  var mainTop = $(window).scrollTop();
  if (mainTop >= 1300 && flag) {
    flag = false;
    $(".FHDB").animate({ "width": "80px", "height": "80px" }, 300, function () { flag = true })
  } else if (mainTop <= 500 && flag) {
    flag = false;
    $(".FHDB").animate({ "width": 0, "height": 0 }, 300, function () { flag = true })
  }
  $(window).scroll(function () {
    mainTop = $(window).scrollTop();
    console.log(mainTop)
    if (mainTop >= 800 && flag) {
      flag = false;
      $(".FHDB").animate({ "width": "80px", "height": "80px" }, 300, function () { flag = true })
    } else if (mainTop <= 400 && flag) {
      flag = false;
      $(".FHDB").animate({ "width": 0, "height": 0 }, 300, function () { flag = true })
    }
  });
})