setTimeout(function(){
	var swiperTwo = new Swiper('.productTwo-container',{
		slidesPerView:1,
		spaceBetween:0,
		navigation: {
			nextEl: '.productTwo-button-next',
			prevEl: '.productTwo-button-prev',
		},
	});
	var swipersizeTwo = new Swiper('.sizeTwo-container', {
		slidesPerView:4,
		spaceBetween:20,
		// Responsive breakpoints
		breakpoints: {
			// when window width is <= 320px
			320: {
				slidesPerView: 2,
				spaceBetween:0,
			},
			// when window width is <= 480px
			480: {
				slidesPerView:3,
				spaceBetween:0,
			},
			575: {
				slidesPerView:3,
				spaceBetween:0,
			},
			// when window width is <= 640px
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
		nextEl: '.sizeTwo-button-next',
		prevEl: '.sizeTwo-button-prev',
		},
	});
	$('.size-link-div .swiper-slide a').click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}
		else{			
			$(this).parents('.size-link-div').find('.swiper-slide a').removeClass('active');
			$(this).addClass('active');
		}
	});
	$('.minusBtn').click(function(){
		no_of_bottle = parseInt($(this).parent('.plus-minus').find('.noValue').val());		
		if(no_of_bottle > 1){
			no_of_bottle = no_of_bottle - 1;
			$(this).parent('.plus-minus').find('.noValue').val(no_of_bottle);
		}
	});
	$('.plusBtn').click(function(){
		no_of_bottle =  parseInt($(this).parent('.plus-minus').find('.noValue').val());
		no_of_bottle = no_of_bottle + 1;
		$(this).parent('.plus-minus').find('.noValue').val(no_of_bottle);
	});
	$('.wishlist-link').on('click', function(){
		$('header').removeClass('hidden');
		main_img_ht = $('.main-img').width();
		setTimeout(function(){
		$('.favourite-popup').addClass('opened');
		//$('.wishlist-link').addClass('active');		
		product_scroll();
		setTimeout(function(){
			$('.favourite-popup-sub').toggleClass('show');
		},50);		
		favourite_up_wd = $('.favourite-popup').width();
        var imgtodragWish = $('.main-img').find("img").eq(0);
        if (imgtodragWish){
            var imgclone = imgtodragWish.clone()
                .offset({
                top: imgtodragWish.offset().top,
                left: imgtodragWish.offset().left
            }).css({
                'opacity': '0',
                'position': 'absolute',
                'width': main_img_ht+'px',
                'z-index': '9999'
            }).animate({
				'opacity': '1',
            },300).appendTo($('body')).delay(300).animate({
				'width': favourite_up_wd+'px',	
                top: $('header .cart-link').offset().top + 30,
                'left':$('header .cart-link').offset().left - (favourite_up_wd + 15)
            },1000);
            imgclone.animate({
                'opacity':0
            }, function () {
                $(this).detach();
            });
        }
		closeFav();
		},200);
    });
	var top_position;
	$('.add-to-cart').on('click', function(){
		$('.shoppingcart-popup').addClass('opened');
		main_img_ht = $('.main-img').width();
		closeCart();
		top_position=$('.shoppingcart-popup').height()/3;
        var cart = $('.shoppingcart-popup');
        var imgtodrag = $('.main-img').find("img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            }).css({
                'opacity': '0',
                'position': 'absolute',
                'width': main_img_ht+'px',
                'z-index': '9999'
            }).animate({
				'opacity': '1',
            },300).appendTo($('body')).animate({
				'width': (main_img_ht/2) +'px',	
                top: $('.shoppingcart-popup').offset().top+top_position,
                'left':'80%'
            }, 1000 );
            /*setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);*/
            imgclone.animate({
                'opacity':0
            }, function () {
                $(this).detach();
            });
        }
    });
	$('.detail-product-more li .dtl-btn').click(function(){
		if($(this).hasClass('active')){
			$(this).parents('li').find('.more-detail').slideUp();
			$(this).removeClass('active');
		}
		else{			
			$(this).parents('.detail-product-more').find('li .more-detail').slideUp();
			$(this).parents('.detail-product-more').find('li .dtl-btn').removeClass('active');
			$(this).parents('li').find('.more-detail').slideDown();
			$(this).addClass('active');
		}
	});
	
	
},300);	