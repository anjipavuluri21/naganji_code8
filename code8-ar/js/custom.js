var prev = 0;
var $window = $(window);
var nav = $('header');
var chatid =1;
var $this;  
var ht,amount;
var data_id=1;
var cartFavEvt;
$window.on('scroll', function(){
	var scrollTop = $window.scrollTop();
	nav.toggleClass('hidden', scrollTop > prev);
	prev = scrollTop;
	ht = Math.max(225 - 0.2*window.scrollY, 0);
	$(".code8-h-title").css({"top": -ht});
});
var removeEvt;
var removeFavEvt;
var remove_item;
$(document).ready(function(){
	"use strict";
	addRemoveStyle();
	//wow.init();
	/*$('.cart-link,.side-navi-link,.cloase-cart-btn').click(function(){
		$('.side-cart-main').toggleClass('opened');
	});
	$('.favourite-anchor,.liked-link').click(function(){
		$('.liked-main').toggleClass('opened');
	});*/
	$('.forgot-link').click(function(){
		$('.forgot-main').slideToggle();
	});
	$('.favourite-link').click(function(){
		$(this).toggleClass('active');
		$('.favourite-popup').toggleClass('opened');
		product_scroll();
		setTimeout(function(){
			$('.favourite-popup-sub').toggleClass('show');
		},50); 
	});
	$('.close-cart').click(function(){
		$('.shoppingcart-popup').removeClass('opened');
	});
	$('.cart-link').click(function(){
		$('.shoppingcart-popup').addClass('opened');
	});	
	$('.size-sub a').click(function(){
		$(this).parents('.product-thumb').find('.size-sub a').removeClass('active');
		$(this).addClass('active');
	});
	$('.sorting li a').click(function(){
		$('.sorting li a').removeClass('active');
		$('.sorting-main').find('#ids'+data_id).slideUp();
		data_id = $(this).attr('data-id');
		$('.sorting-main').find('#ids'+data_id).slideDown();
		$(this).addClass('active');
	});
	
	$('.sorting-ul li a').click(function(){
		$(this).parents('.sorting-div').find('.sorting-ul li a').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.sorting-div').find('.no-filter').text($(this).text());
	});
	$('.clearall').click(function(){		
		$('.sorting-div').find('.no-filter').text('NO FILTERS SELECTED');
		$('.sorting-ul li a').removeClass('active');
	});
	$('.search-link').click(function(){
		$(this).addClass('active');
		$('.search-main').toggleClass('opened');
	});
	$('.close-search').click(function(){		
		$('.search-main').removeClass('opened');
		$('.search-link').removeClass('active');
	});
	$('.cart-product .remove-item,.order-review .remove-item').click(function(){		
		//$('.shoppingcart-popup .product-thumb .remove-item').removeClass('active');
		//$('.shoppingcart-popup .wishlist-remove').removeClass('opened');
		if($(this).hasClass('active')){
			$(remove_item).removeClass('active');
			$(remove_item).parents('.product-thumb').find('.wishlist-remove').removeClass('opened');
		}
		else{
			$(remove_item).removeClass('active');
			$(remove_item).parents('.product-thumb').find('.wishlist-remove').removeClass('opened');
			remove_item = $(this);
			$(remove_item).addClass('active');
			$(remove_item).parents('.product-thumb').find('.wishlist-remove').addClass('opened');
		}	
	});
	$('.wishlist-remove-sub .delete-item,.wishlist-remove-sub .movetowishlist').click(function(){
		removeEvt = $(this);
		$(this).parents('.cart-product').addClass('shrink');
		setTimeout(function(){
			$(removeEvt).parents('.cart-product.shrink').remove();
		},500)
	});
	$('.favourite-product .remove-item').click(function(){
		removeFavEvt = $(this);
		$(removeFavEvt).parents('.favourite-product').addClass('shrink');
		setTimeout(function(){
			$(removeFavEvt).parents('.favourite-product.shrink').remove();
		},300)
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
	var no_of_bottle;
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
	$('.change-btn').click(function () {
        $(this).parents('.myprofile-main').find('.profiledata').slideUp();
        $(this).parents('.myprofile-main').find('.profileform').slideDown();
    });
    $('.closebutton').click(function () {
        $(this).parents('.myprofile-main').find('.profiledata').slideDown();
        $(this).parents('.myprofile-main').find('.profileform').slideUp();
    });
	$("#p_address").click(function() { 
		if ($("input[type=checkbox]").is(":checked")) { 
			$(this).parents('.address-sub-div').addClass('disabled-div');
			$(this).parents('.address-sub-div').find('.change-div').slideUp();
		} else { 
			$(this).parents('.address-sub-div').removeClass('disabled-div');
			$(this).parents('.address-sub-div').find('.change-div').slideDown();
		} 
	}); 
	$("#ele2").find('.print-link').on('click', function () {       
        //Print ele2 with default options
        $.print("#ele2");
    });
	$('.order-tab').click(function(){		
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).next('.order-histotry-sub').slideUp();
		}
		else{
			$('.order-tab').removeClass('active');
			$('.ord-hstr-div').find('.order-histotry-sub').slideUp();
			$(this).addClass('active');
			$(this).next('.order-histotry-sub').slideDown();
		}
	});
	/*$('.favrt-div').click(function(){
		removeEvt = $(this);
		$(this).parents('.cart-product').addClass('shrink');
		setTimeout(function(){
			$(removeEvt).parents('.cart-product.shrink').remove();
		},500)
	});*/	
	var favourite_up_wd;
	var fav_evt;
	var data_name;
	$('.favrt-div,.wish-remove-item .movetowishlist').on('click', function(){
		$('header').removeClass('hidden');
		fav_evt = $(this);
		setTimeout(function(){
		$('.favourite-popup').addClass('opened');
		$('.favourite-link').addClass('active');		
		product_scroll();
		setTimeout(function(){
			$('.favourite-popup-sub').toggleClass('show');
		},50);		
		favourite_up_wd = $('.favourite-popup').width();
        var imgtodragFav = $(fav_evt).parents('.product-thumb').find(".pro-img1 img").eq(0);
        if (imgtodragFav){
            var imgclone = imgtodragFav.clone()
                .offset({
                top: imgtodragFav.offset().top,
                left: imgtodragFav.offset().left
            }).css({
                'opacity': '0',
                'position': 'absolute',
                'width': $(fav_evt).parents('.product-thumb').find(".pro-img1").width(),
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
		data_name = $(fav_evt).attr('data-name');
		if($(fav_evt).attr('data-name') == "wishlist"){
			favCloseRemove();
		}
		else{}
		closeFav();
		},200);
    });
	function favCloseRemove(){
		$(fav_evt).parents('.product-thumb').addClass('shrinking');
		setTimeout(function(){
			$(fav_evt).parents('.product-thumb').slideUp();
			setTimeout(function(){
				$(fav_evt).parents('.product-thumb').detach();
				/*setTimeout(function(){
					$( ".my-cart-items-sub:empty").text( "Was empty!" );
				},1000);*/
			},300);
		},2000);
	}
	$('.wish-remove-item .delete-item').on('click', function(){
		fav_evt = $(this);
		$(fav_evt).parents('.product-thumb').addClass('removing');
		$(fav_evt).parents('.product-thumb').slideUp();
		setTimeout(function(){
			$(fav_evt).parents('.product-thumb').detach();
		},500);	
	});
	/*var favourite_up_wdTwo;
	var fav_evtTwo;
	$('.wish-remove-item .movetowishlist').on('click', function(){
		$('header').removeClass('hidden');
		fav_evtTwo = $(this);
		setTimeout(function(){
		$('.favourite-popup').addClass('opened');
		$('.favourite-link').addClass('active');		
		product_scroll();
		setTimeout(function(){
			$('.favourite-popup-sub').toggleClass('show');
		},50);		
		favourite_up_wdTwo = $('.favourite-popup').width();
        var imgtodragFav = $(fav_evtTwo).parents('.product-thumb').find(".pro-img1 img").eq(0);
        if (imgtodragFav){
            var imgclone = imgtodragFav.clone()
                .offset({
                top: imgtodragFav.offset().top,
                left: imgtodragFav.offset().left
            }).css({
                'opacity': '0',
                'position': 'absolute',
                'width': product_holder_img+'px',
                'z-index': '9999'
            }).animate({
				'opacity': '1',
            },300).appendTo($('body')).delay(300).animate({
				'width': favourite_up_wdTwo+'px',	
                top: $('header .cart-link').offset().top + 30,
                'left':$('header .cart-link').offset().left - (favourite_up_wdTwo + 15)
            },1000);
            imgclone.animate({
                'opacity':0
            }, function () {
                $(this).detach();
            });
        }
		closeFav();
		},200);
    });*/
	
	var main_img_ht;
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
	var fav_img_ht;
	var top_position_cart;
	
	$('.fav-addtocart-item').on('click', function(){
		cartFavEvt = $(this);
		$('.shoppingcart-popup').addClass('opened');
		fav_img_ht = $(this).parents('.product-thumb').find('.pro-img1').width();
		closeCart();
		top_position_cart=$('.shoppingcart-popup').height()/3;
        var imgtodragCart = $(this).parents('.product-thumb').find("img").eq(0);
        if (imgtodragCart) {
            var imgclone = imgtodragCart.clone()
                .offset({
                top: imgtodragCart.offset().top,
                left: imgtodragCart.offset().left
            }).css({
                'opacity': '0',
                'position': 'absolute',
                'width': fav_img_ht+'px',
                'z-index': '9999'
            }).animate({
				'opacity': '1',
            },300).appendTo($('body')).animate({
				'width': fav_img_ht +'px',	
                top: $('.shoppingcart-popup').offset().top+top_position_cart,
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
			cartFavRemove();
        }
    });
});

function cartFavRemove(){
	setTimeout(function(){
		$(cartFavEvt).parents('.favourite-product').addClass('shrinking');
		//$(cartFavEvt).parents('.my-account-fav').addClass('shrinking');
	},1300)	
	setTimeout(function(){
		$(cartFavEvt).parents('.favourite-product.shrinking').remove();
	},2000)
}

var myVarFav; 
function closeFav(){
	clearTimeout(myVarFav);
	myVarFav = setTimeout(function(){
		$('.favourite-popup-sub').removeClass('show');
		$('.favourite-popup').removeClass('opened');
		$('.favourite-link').removeClass('active');
	},2000);
}

var myVar; 
function closeCart(){
	clearTimeout(myVar);
	myVar = setTimeout(function(){ 
		$('.shoppingcart-popup').removeClass('opened');
	},2000);
}

$(document).mouseup(function(e)
{
	"use strict";
	var forgot1 = $('.forgot-main');
	var forgot2 = $('.forgot-link');
	if (!forgot1.is(e.target) && forgot1.has(e.target).length === 0) 
	{
		if (!forgot2.is(e.target) && forgot2.has(e.target).length === 0) 
		{
			$('.forgot-main').slideUp();
			
		}
	}
	var fav1 = $('.favourite-popup');
	var fav2 = $('.favourite-link');
	if (!fav1.is(e.target) && fav1.has(e.target).length === 0) 
	{
		if (!fav2.is(e.target) && fav2.has(e.target).length === 0) 
		{
			$('.favourite-popup').removeClass('opened');
			$('.favourite-link').removeClass('active');
			$('.favourite-popup-sub').removeClass('show');
		}		
	}
	var cart1 = $('.shoppingcart-popup');
	if (!cart1.is(e.target) && cart1.has(e.target).length === 0) 
	{
		$('.shoppingcart-popup').removeClass('opened');
	}
	var sort1 = $('.sorting-main');
	var sort2 = $('.sorting li a');
	if (!sort1.is(e.target) && sort1.has(e.target).length === 0) 
	{
		if (!sort2.is(e.target) && sort2.has(e.target).length === 0) 
		{
			$('.sorting-div').slideUp();
			$('.sorting li a').removeClass('active');
		}		
	}
	var search1 = $('.search-main');
	var search2 = $('.search-link');
	if (!search1.is(e.target) && search1.has(e.target).length === 0) 
	{
		if (!search2.is(e.target) && search2.has(e.target).length === 0) 
		{			
			$('.search-main').removeClass('opened');
			$('.search-link').removeClass('active');
		}
	}
	var favItem1 = $('.shoppingcart-popup .product-thumb');
	if (!favItem1.is(e.target) && favItem1.has(e.target).length === 0) 
	{
		$('.shoppingcart-popup .product-thumb .remove-item').removeClass('active');
		$('.shoppingcart-popup .wishlist-remove').removeClass('opened');
	}
	//$('.shoppingcart-popup .product-thumb .remove-item').removeClass('active');
		//$('.shoppingcart-popup .wishlist-remove').removeClass('opened');
});

var win_width;
var win_height;
var btn_fav_h;
var fav_title_h;
var liked_scroll_h;
var box_main_w;
var round_main;
var product_holder_img;
var total_pro_ht;
var product_holder_img_fav;
var total_pro_ht_two;
var shoppingcart_title_ht;
var shoppingcart_cart_order_ht;
var shoppingcart_final_ht;
var shoppingcart_scroll_ht;
var cart_product_img;
var cart_product_ttl;
var designer_product_ttl;
var designer_product_img;
var portfolio_img;
var portfolio_ttl;
var my_account_fav_img;
var my_account_fav_img_ttl;
var get_look_main_img_ht;
var get_look_main_img_ttl;
function addRemoveStyle(){
	"use strict";
	win_width = $(window).width();
	win_height = $(window).height();
	box_main_w = $('.box').width();
	$('.box-main').find('.box').each(function(){
		$(this).css({'height':box_main_w});
	});
	round_main = $('.round-main').innerWidth();
	$('.round-main').css({'height':round_main});
	$('.box rect,.box svg').css({'height':(round_main-17)});
	$('.box rect,.box svg').css({'width':(round_main-17)});
	
	
	product_holder_img_fav = $('.product-div li .product-holder-img').width();
	total_pro_ht = product_holder_img_fav*1.33;
	$('.product-div li .product-holder-img').css({'height':total_pro_ht});
	$('.favourite-scroll').css({'height':total_pro_ht});
	
	product_holder_img = $('.product-box .product-holder-img').width();
	total_pro_ht_two = product_holder_img*1.33;
	$('.product-box .product-holder-img').css({'height':total_pro_ht_two});
	
	shoppingcart_title_ht = $('.shoppingcart-popup-sub h3').innerHeight();
	shoppingcart_cart_order_ht = $('.cart-order').innerHeight();
	shoppingcart_final_ht = (shoppingcart_title_ht + shoppingcart_cart_order_ht);
	shoppingcart_scroll_ht = win_height - shoppingcart_final_ht ;
	$('.shoppingcart-scroll').css({'height':shoppingcart_scroll_ht});
	
	cart_product_img = $('.cart-product .product-holder-img').width();
	cart_product_ttl = cart_product_img*1.33;
	$('.cart-product .product-holder-img').css({'height':cart_product_ttl});
	
	designer_product_img = $('.designer-box .designer-img').width();
	designer_product_ttl = designer_product_img*1.33;
	$('.designer-box .designer-img').css({'height':designer_product_ttl});
	
	portfolio_img = $('.portfolio-box .portfolio-img').width();
	portfolio_ttl = portfolio_img*1.33;
	$('.portfolio-box .portfolio-img').css({'height':portfolio_ttl});
	
	my_account_fav_img = $('.my-account-fav .product-holder-img').width();
	my_account_fav_img_ttl = my_account_fav_img*1.33;
	$('.my-account-fav .product-holder-img').css({'height':my_account_fav_img_ttl});
	
	get_look_main_img_ht = $('.get-look-main-img').width();
	get_look_main_img_ttl = get_look_main_img_ht*1.33;
	$('.get-look-main-img').css({'height':get_look_main_img_ttl});
	
	
}

function product_scroll(){
	product_holder_img_fav = $('.product-div li .product-holder-img').width();
	total_pro_ht = product_holder_img_fav*1.33;
	$('.product-div li .product-holder-img').css({'height':total_pro_ht});
	$('.favourite-scroll').css({'height':total_pro_ht});
}

var page_url;
$(document).ready(function(){
	"use strict";
	$('.product-dtl-btn').on('click',function(){
		$(this).parents('.swiper-wrapper').find('.swiper-slide .product-dtl-btn').removeClass('active');
		page_url=$(this).attr('data-url');
		$(this).addClass('active');
		setTimeout(function(){
			myCallback();
		},500);
		loadContents(page_url);
	});
	
	if(!$('.getthelook-container .swiper-slide .product-dtl-btn:first-child').attr('data-url')==''){
		var load_data_url = $('.getthelook-container .swiper-slide .product-dtl-btn:first-child').attr('data-url');
		loadContents(load_data_url);   
	}
	else{}
	//var load_data_url = $('.getthelook-container .swiper-slide .product-dtl-btn:first-child').attr('data-url');
	
});
$.fn.imagesLoaded=function(){
	"use strict";
    var $imgs=this.find('img[src!=""]');
    if(!$imgs.length){return $.Deferred().resolve().promise();}
    var dfds=[];  
    $imgs.each(function(){
        var dfd=$.Deferred();
        dfds.push(dfd);
        var img=new Image();
        img.onload=function(){dfd.resolve();};
        img.onerror=function(){dfd.resolve();};
        img.src=this.src;
    });
    return $.when.apply($,dfds);
};

function loadContents(page_url){
	"use strict";	
	$('.portfolio-slider').find('.contents-load').slideUp();
	$('.portfolio-slider').find('.loader-div').slideDown();
	$.ajax({
    cache:false,
    url:"get-the-look/"+page_url+"",
    success: function(data){
		setTimeout(function(){
        $('.portfolio-slider').find('.contents-load').html(data).imagesLoaded().done(function(){			
			$('.portfolio-slider').find('.loader-div').slideUp();
			$('.portfolio-slider').find('.contents-load').slideDown();			 
			
			//addRemoveNutrition();
		}).fail(function(){
			$('.portfolio-slider').find('.contents-load').html("<p>Ups!, please try again.</p>");
			$('.portfolio-slider').find('.loader-div').slideUp();
			$('.portfolio-slider').find('.contents-load').slideDown();
		});
		},1000);
    }
});
}
function myCallback(){	 
	$('html,body').animate({scrollTop: ($("#productsGallery").offset().top)},1000);
}
$(window).load(function() {
	"use strict";	
	addRemoveStyle();
});
$(window).resize(function() {
	"use strict";	
	addRemoveStyle();
});
