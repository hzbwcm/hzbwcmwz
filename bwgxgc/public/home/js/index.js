$(function() {
	(function() { //设置banner父元素高度     banner轮播
		var height = $('.banner-box .banner-c-box .banner-img .banner-c-img img')[0].height;
		var dian_box_w = $('.banner-box .banner-c-box .banner-img .banner-dian-box li').length * 15; //轮播点外div设置宽高
		var banner_num = $('.banner-box .banner-c-box .banner-img .banner-c-img img').length //轮播图数量
		var num = 46 + height + 'px';
		var number = 0;
		$('.banner-box .banner-c-box .banner-img .banner-dian-box').css('margin-left', '-' + dian_box_w / 2 + 'px'); //轮播图圆点居中

		//轮播

		function banner_time() {
			var num = number % banner_num
			$('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(num).css('opacity', 1);
			$('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(num).addClass(
				'banner-dd-xzxg')
			var banner_color = $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(num).attr('banner_color');
			$('.banner-box').css('background-image', "url(" + banner_color + ")");
			number++;
		}


		$('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).css('opacity', 1);
		$('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').eq(0).addClass('banner-dd-xzxg')
		$('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(0).attr(
			'banner_color') + ")");
		var t = setInterval(banner_time, 5000) //轮播图时间函数

		//轮播鼠标移入移出
		$('.banner-img img').on('mouseover', function() {
			clearInterval(t)
		})
		$('.banner-img').on('mouseout', function() {
			clearInterval(t)
			t = setInterval(banner_time, 5000) //轮播图时间函数
		})
		//鼠标点击小圆点
		$('.banner-dian-box li').on('click', function() {
			number = $(this).attr('banner_id');
			$('.banner-box .banner-c-box .banner-img .banner-c-img').css('opacity', 0).eq(number).css('opacity', 1);
			$('.banner-box .banner-c-box .banner-img .banner-dian-box .banner-dian').removeClass('banner-dd-xzxg').eq(
				number).addClass('banner-dd-xzxg')
			$('.banner-box').css('background-image', "url(" + $('.banner-box .banner-c-box .banner-img .banner-c-img').eq(
				number).attr('banner_color') + ")");
		})
	})()
	//侧导航鼠标移入移出隐藏显示效果
	$('.ce-daohang li').css('display', 'none')
	$('.ce-daohang li').eq(0).css('display', 'block')
	$('.ce-daohang').on('mouseout', function() {
		$('.ce-daohang li').css('display', 'none')
		$('.ce-daohang li').eq(0).css('display', 'block')
	})
	$('.ce-daohang').on('mouseover', function() {
		$('.ce-daohang li').css('display', 'block')
	})
	//搜索
	$('.search-button').on('click', function() {
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
	//点击播放视频
	$('.video-img-box').on('click', function(e) {
		var class_name = $(e.target).parent().attr('class');
		if (class_name == 'video-img-box') {
			class_name = $(e.target).parent().parent().attr('class');
		}
		$(this).css('display', 'none')
		$('.' + class_name + ' video')[0].play()
	})
	$('.wsyp-video video').on('click', function(e) {
		$('.wsyp-video .video-img-box').css('display', 'block');
		$(this)[0].pause()
	})
	$('.wsyp-video1 video').on('click', function(e) {
		$('.wsyp-video1 .video-img-box').css('display', 'block');
		$(this)[0].pause()
	})
	$('.wsyp-video2 video').on('click', function(e) {
		$('.wsyp-video2 .video-img-box').css('display', 'block');
		$(this)[0].pause()
	})
	//点击规格
	$('.jiagong-b-box .gg-sz').on('click', function(e) {
		$(e.target).siblings().css('background', 'none').css('color', '#989797')
		$(e.target).css('background', '#9d5fd6').css('color', '#fff')
		// var gg_text=$(e.target).text();
		// var cp_id=$(e.target).attr('gg_id');
		// $.ajax({
		//     url:'',
		//     type:post,
		//     data:{cp_id,gg_text},
		//     dataType:JSON,
		//     success:function (res) {
		//
		//     }
		//
		// })

	})
	//卫生用品优选工厂
	//优选工厂图片切换
	var info=$('.youxuan-xw-img a img');
	var oldnum,num=info.length-1,newnum=info.length-2;
	var yxt=setInterval(yxFunction,5000);
	var yxflag=true;
	function yxFunction(){
		if(newnum<0){
			newnum=info.length-1;
		}
		var yxName=$(info).eq(newnum).attr('yxName');
		var yxGm=$(info).eq(newnum).attr('yxGm');
		var yxFl=$(info).eq(newnum).attr('yxFl');
		var yxTime=$(info).eq(newnum).attr('yxTime');
		var yxDz=$(info).eq(newnum).attr('yxDz');
		var str='<div class="youxuan-xw-title">'+yxName+'</div>'+
								'<div class="xw-gongsi-zl">公司规模 : <span>'+yxGm+'</span></div>'+
								'<div class="xw-gongsi-zl">产品分类 : <span>'+yxFl+'</span></div>'+
								'<div class="xw-gongsi-zl">公司成立时间 : <span>'+yxTime+'</span></div>'+
								'<div class="xw-gongsi-zl">公司地址 : <span>'+yxDz+'</span></div>'+
								'<div class="youxuan-yyc"><img data-original="../img/eyyz.png" alt=""></div>';
								
		$('.youxuan-xw-right').html(str);
		$('.youxuan-img-title').text(yxName);
		$(info).eq(num).animate({left:"-100%"},function(){
			if(oldnum || oldnum==0){
				$(info).eq(oldnum).css({left:"100%"})
			}
		});
		$(info).eq(newnum).animate({left:0},function(){
			oldnum=num;
			num=newnum;
			newnum-=1;
			yxflag=true;
		});
	}
	//优选工厂箭头显示隐藏,鼠标移入停止切换
	$('.youxuan-xw-img').on('mouseover', function(event) {
		$(this).children('.youxuan-jt').css('display', 'block');
		clearInterval(yxt);
	}).on('mouseout', function(event) {
		$(this).children('.youxuan-jt').css('display', 'none');
		clearInterval(yxt);
		yxt=setInterval(yxFunction,5000);
	})
	//鼠标点击左右箭头
	$('.youxuan-xw-img .youxuan-left-jt').on('click',function(){
		if(num<info.length-1 && yxflag){
			yxflag=false;
			var yxName=$(info).eq(oldnum).attr('yxName');
			var yxGm=$(info).eq(oldnum).attr('yxGm');
			var yxFl=$(info).eq(oldnum).attr('yxFl');
			var yxTime=$(info).eq(oldnum).attr('yxTime');
			var yxDz=$(info).eq(oldnum).attr('yxDz');
			var str='<div class="youxuan-xw-title">'+yxName+'</div>'+
									'<div class="xw-gongsi-zl">公司规模 : <span>'+yxGm+'</span></div>'+
									'<div class="xw-gongsi-zl">产品分类 : <span>'+yxFl+'</span></div>'+
									'<div class="xw-gongsi-zl">公司成立时间 : <span>'+yxTime+'</span></div>'+
									'<div class="xw-gongsi-zl">公司地址 : <span>'+yxDz+'</span></div>'+
									'<div class="youxuan-yyc"><img data-original="../img/eyyz.png" alt=""></div>';
									
			$('.youxuan-xw-right').html(str);
			$('.youxuan-img-title').text(yxName);
			
			$(info).eq(oldnum).css({left:"-100%"})
			$(info).eq(num).animate({left:"100%"});
			$(info).eq(oldnum).animate({left:0},function(){
				newnum=num;
				num=oldnum;
				oldnum+=1;
				yxflag=true;
			});
		}
	})
	$('.youxuan-xw-img .youxuan-right-jt').on('click',function(){
		
		if(num>0 && yxflag){
			yxflag=false;
			yxFunction();
		}
	})
	// 结束
})
