function createSwiper() {
	//$('.size-carousel').css({'display':'block'});
	var startSlide;
	var size_flag=0;
	var size_wdth=$('.size-container .swiper-slide').width();
	var numberOfitem=$('.size-container .swiper-slide').length;
	console.log('slide: '+numberOfitem);
	var swipersize = $('.size-container')[0].swiper;
	if (typeof swipersize !== 'undefined') 
		swipersize.destroy(true, true); //if swiper exists, destroy it so we can create a new one 

	var ww = $(window).width();
	if (ww > 1024) {
		if(numberOfitem==1){
			startSlide=0;
			//console.log('1 size : '+numberOfitem);
		}
		else if(numberOfitem==2){
			startSlide=0;
			size_flag=1;
			//console.log('2 size : '+numberOfitem);
		}
		else if(numberOfitem==3){
			startSlide=1;
			//console.log('3 size : '+numberOfitem);
		}
		else if(numberOfitem==4){
			startSlide=1;
			size_flag=1;
			//console.log('4 size : '+numberOfitem);
		}
		else if(numberOfitem==5){
			startSlide=2;
			//console.log('5 size : '+numberOfitem);
		}
		else{
			startSlide=2;
			size_flag=1;
			//console.log('6 size : '+product_size);
		}
		swipersize = new Swiper('.size-container', {
			slidesPerView:6,
			centeredSlides:true,
			spaceBetween:10,
			initialSlide:startSlide,
			navigation: {
				nextEl: '.size-button-next',
				prevEl: '.size-button-prev',
			},on: {
			init: function () {
				if(numberOfitem>=6){
					$('.size-button-prev,.size-button-next').show();
				}
				else{
					$('.size-button-prev,.size-button-next').hide();
				}
				size_wdth=$('.size-container .swiper-slide').width();
				//$('.size-content-div').css({'height':size_wdth});
				if(size_flag==1){					
					$('.size-container').css({'margin-left':-((size_wdth/2)+3)});
					size_flag=2;
				}
				else{
					$('.size-container').css({'margin-left':0});
				}				
			},
			}
		});
	}
	else if(ww > 781 && ww < 1025) {
		if(numberOfitem==1){
			startSlide=0;
			console.log('1 size : '+numberOfitem);
		}
		else if(numberOfitem==2){
			startSlide=0;
			size_flag=1;
			console.log('2 size : '+numberOfitem);
		}
		else if(numberOfitem==3){
			startSlide=1;
			console.log('3 size : '+numberOfitem);
		}
		else if(numberOfitem==4){
			startSlide=1;
			size_flag=1;
			console.log('4 size : '+numberOfitem);
		}
		else{
			startSlide=2;			
			console.log('5 size : '+product_size);
		}
		swipersize = new Swiper('.size-container', {
			slidesPerView:5,
			centeredSlides:true,
			spaceBetween:10,
			initialSlide:startSlide,
			navigation: {
				nextEl: '.size-button-next',
				prevEl: '.size-button-prev',
			},on: {
			init: function () {
				if(numberOfitem>=5){
					$('.size-button-prev,.size-button-next').show();
				}
				else{
					$('.size-button-prev,.size-button-next').hide();
				}
				size_wdth=$('.size-container .swiper-slide').width();
				//$('.size-content-div').css({'height':size_wdth});
				if(size_flag==1){					
					$('.size-container').css({'margin-left':-((size_wdth/2)+3)});
					size_flag=2;	
				}
				else{
					$('.size-container').css({'margin-left':0});
				}
			},
			}
		});
	}
	else {
		if(numberOfitem==1){
			startSlide=0;
			console.log('1 size : '+numberOfitem);
		}
		else if(numberOfitem==2){
			startSlide=0;
			size_flag=1;
			console.log('2 size : '+numberOfitem);
		}
		else{
			startSlide=2;			
			console.log('6 size : '+product_size);
		}
		swipersize = new Swiper('.size-container', {
			slidesPerView:3,
			centeredSlides:true,
			spaceBetween:10,
			initialSlide:startSlide,
			navigation: {
				nextEl: '.size-button-next',
				prevEl: '.size-button-prev',
			},on: {
			init: function () {
				if(numberOfitem>=3){
					$('.size-button-prev,.size-button-next').show();
				}
				else{
					$('.size-button-prev,.size-button-next').hide();
				}
				size_wdth=$('.size-container .swiper-slide').width();
				//$('.size-content-div').css({'height':size_wdth});
				if(size_flag==1){					
					$('.size-container').css({'margin-left':-((size_wdth/2)+3)});
					size_flag=2;	
				}
				else{
					$('.size-container').css({'margin-left':0});
				}
			},
			}
		});
	}
}
$(document).ready(function(){

});
$(window).resize(function () {
	sizeSliderOpen();
});

var swiperproduct = new Swiper('.product-container', {
	slidesPerView:1,
	initialSlide:0,
	spaceBetween:0,
	navigation:{
		nextEl:'.product-button-next',
		prevEl:'.product-button-prev',
	},on: {
	init: function () {
		/*setTimeout(function(){
			onLoadAndSlideChnagedPlay();
		},1000)	*/
		},
	}
});
var vidPathActive,vidActive,vidPathPrev,vidPrev,vidPathNext,vidNext;
swiperproduct.on('slideChange', function () {
	setTimeout(function(){
		vidActive=$('.product-container .swiper-slide-active');
		if($('.product-container .swiper-slide-active').find('.product-img').hasClass('video-div')){
			vidPathActive=$('.product-container .swiper-slide-active video').attr('id');
			vidActive = document.getElementById(vidPathActive);
			vidActive.play();
		}
		if($('.product-container .swiper-slide-next').find('.product-img').hasClass('video-div')){
			vidPathNext=$('.product-container .swiper-slide-next video').attr('id');
			vidNext = document.getElementById(vidPathNext);
			vidNext.pause();
		}
		if($('.product-container .swiper-slide-prev').find('.product-img').hasClass('video-div')){
			vidPathPrev=$('.product-container .swiper-slide-prev video').attr('id');
			vidPrev = document.getElementById(vidPathPrev);
			vidPrev.pause();
		}
	},100)
 });
/*function onLoadAndSlideChnagedPlay(){
	if($('.product-container .swiper-slide-active').find('.product-img').hasClass('video-div')){
		vidPathActive=$('.product-container .swiper-slide-active video').attr('id');
		vidActive = document.getElementById(vidPathActive);
		vidActive.play();
	}
}*/
//var swipersize = new Swiper('.size-container', {
//		slidesPerView:8,
//		spaceBetween:0,	
//		centeredSlides:true,
//		// Responsive breakpoints
//		breakpoints: {
//			// when window width is <= 320px
//			320: {
//				slidesPerView:3,
//				spaceBetween:0,
//			},
//			// when window width is <= 480px
//			480: {
//				slidesPerView:3,
//				spaceBetween:0,
//			},
//			575: {
//				slidesPerView:4,
//				spaceBetween:0,
//			},
//			// when window width is <= 640px
//			768: {
//				slidesPerView:6,
//				spaceBetween:0,
//			},
//			1023: {
//				slidesPerView:8,
//				spaceBetween:0,
//			}
//		},
//		navigation: {
//		nextEl: '.size-button-next',
//		prevEl: '.size-button-prev',
//		},on: {
//			init: function () {
//				console.log('hi')
//			},
//		  }
//});
var swiperrelative = new Swiper('.relative-container', {
		slidesPerView:4,
		spaceBetween:0,
		// Responsive breakpoints
		breakpoints: {
			// when window width is <= 480px
			480: {
				slidesPerView:1,
				spaceBetween:0,
			},
			// when window width is <= 575
			575: {
				slidesPerView:2,
				spaceBetween:0,
			},
			// when window width is <= 768
			768: {
				slidesPerView:3,
				spaceBetween:0,
			},
			1023: {
				slidesPerView:4,
				spaceBetween:0,
			}
		},
		navigation: {
		nextEl: '.relative-button-next',
		prevEl: '.relative-button-prev',
		},
});
var swiperdesigner = new Swiper('.designer-container', {
		slidesPerView:3,
		spaceBetween:0,
		// Responsive breakpoints
		breakpoints: {
			// when window width is <= 480px
			480: {
				slidesPerView:1,
				spaceBetween:0,
			},
			// when window width is <= 575
			575: {
				slidesPerView:2,
				spaceBetween:0,
			},
			// when window width is <= 768
			768: {
				slidesPerView:3,
				spaceBetween:0,
			},
			1023: {
				slidesPerView:3,
				spaceBetween:0,
			}
		},
		navigation: {
		nextEl: '.designer-button-next',
		prevEl: '.designer-button-prev',
		},
});
var swiperGetthelook = new Swiper('.getthelook-container', {
		slidesPerView:2,
		spaceBetween:0,
		// Responsive breakpoints
		breakpoints: {
			// when window width is <= 480px
			480: {
				slidesPerView:1,
				spaceBetween:0,
			},
			// when window width is <= 575
			575: {
				slidesPerView:2,
				spaceBetween:0,
			},
			// when window width is <= 768
			768: {
				slidesPerView:2,
				spaceBetween:0,
			},
			1023: {
				slidesPerView:2,
				spaceBetween:0,
			}
		},
		navigation: {
		nextEl: '.getthelook-button-next',
		prevEl: '.getthelook-button-prev',
		},
});