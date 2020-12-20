var swiper = new Swiper('.product-container', {
	slidesPerView:1,
	spaceBetween:0,
	navigation: {
		nextEl: '.product-button-next',
		prevEl: '.product-button-prev',
	},
});
var swipersize = new Swiper('.size-container', {
		slidesPerView:8,
		spaceBetween:0,	
		centeredSlides:true,
		// Responsive breakpoints
		breakpoints: {
			// when window width is <= 320px
			320: {
				slidesPerView:3,
				spaceBetween:0,
			},
			// when window width is <= 480px
			480: {
				slidesPerView:3,
				spaceBetween:0,
			},
			575: {
				slidesPerView:4,
				spaceBetween:0,
			},
			// when window width is <= 640px
			768: {
				slidesPerView:6,
				spaceBetween:0,
			},
			1023: {
				slidesPerView:8,
				spaceBetween:0,
			}
		},
		navigation: {
		nextEl: '.size-button-next',
		prevEl: '.size-button-prev',
		},on: {
			init: function () {
				
			},
		  }
});
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