/*wow = new WOW(
  {
	animateClass: 'animated',
	offset:       100,
	callback:     function(box) {
	  console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
	}
  }
);
wow.init();*/ 
var conatact;
$(document).ready(function(){
	"use strict";	
	 $('.main-menu-slider li').on('click', function () {		 
		 conatact = $(this).find('.heading h2 span:first-child').text();
        var cart = $('.cart-main');
        var imgtodrag = $(this).find(".thumbnail").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left + $('.thumbnail').width()/4
            }).addClass('seperate')
                .css({
                'opacity': '0',
				'top': '50%',
				'position': 'fixed',					
				'width':$('.thumbnail').width()/3,
				'height':$('.thumbnail').height()/2,
				'margin-top': -($('.thumbnail').height()/4),
				'margin-left': ($('.thumbnail').width()/10),
				//'height': '150px',
				'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': 0,
				'left': 0,
				'margin-top':0,
				'margin-left':0,
				'width': '100%',
				'opacity': '1',
				'height': '100%'
            }).append('<a href="javascript:void(0);" class="close-btn"></a>');
			setWidthPopup();
            setTimeout(function () {
                set_innerpages();
            },1000);
			setTimeout(function () {
                $('.close-btn').click(function(){
					console.log('hi');
					$('.seperate').addClass('hidecontents');
					setTimeout(function () {
						$('.seperate').remove();
					},700);
				});
            },1000);
            /*setTimeout(function () {
                cart.effect("shake", {					
                    times: 2
                }, 200);
            }, 1500);*/

            imgclone.animate({				
                //'width':'100%'
            }, function () {
                //$(this).detach();
            });
        }
    });
	
	
});

var win_width;
var win_height;
var slider_item;
var slider_item_width;
var slider_width;
var item_width;
var margin_left;
var margin_left_final=0;
var heading_after;
var scroll_ht;
var innerpages_ht;
function addRemoveStyle(){
	"use strict";
	win_width = $(window).width();	
	win_height = $(window).height();	
	//$('.main-menu-slider,.main-menu-slider li,.thumbnail').css({'height':win_height});
	//slider_item = $('.main-menu-slider li').length;
	if(win_width > 1000){
		slider_item_width = win_width / 4;
	}
	else{
		if(win_width > 640){
			if(win_width > win_height){
			   slider_item_width = win_width / 4;
			}
			else{
				slider_item_width = win_width / 3;
			}
		}
		else{
			if(win_width > win_height){
			   slider_item_width = win_width / 3;
			}
			else{
				slider_item_width = win_width / 2;
			}
		}
	}
	
	slider_width = slider_item_width * slider_item;
	//$('.main-menu-slider li,.main-menu-slider li .thumbnail').css({'width':slider_item_width});
	$('.main-menu-slider').css({'width':slider_width});
	$('.item-cont').css({'height':win_height});
	setTimeout(function(){	
	item_width = $('.item-holder').width();
	
	if(item_width > slider_item_width){
	   	margin_left = item_width - slider_item_width;
		margin_left_final = margin_left / 2;
		$('.item-holder').css({'margin-left':-margin_left_final});
	}
	},1000);

}
function set_innerpages(){
	"use strict";
	heading_after = $('.seperate .title-div .heading::after').height();
	scroll_ht = win_height - (heading_after + 200);
	innerpages_ht = $('.seperate .innerpages').height();
	if(innerpages_ht > scroll_ht){
		$('.seperate .innerpages').css({'height':scroll_ht +'px'});
	}
	else{
		$('.seperate .innerpages').css({'height':'auto'});
	}
	setTimeout(function () {
		$(".seperate .innerpages").mCustomScrollbar({
			axis:"y" 
		});
		
	},500);
	if(conatact ==="Reach"){
   	}
}
var seperate_img_width;
var seperate_thumnail_div_width;
function setWidthPopup(){
	"use strict";
	seperate_img_width = $('.seperate .item-holder').width();
	
	if(margin_left_final < 0){
		margin_left_final = margin_left_final + 0;
		console.log('if :'+margin_left_final);
	 }
	console.log('out :'+margin_left_final);
	seperate_thumnail_div_width = win_width - (seperate_img_width + margin_left_final);	
	$('.seperate .thumnail-div').css({'width':seperate_thumnail_div_width});
}
$(window).load(function() {
	"use strict";	
	addRemoveStyle();
	//bowling_thumb();
});
$(window).resize(function() {
	"use strict";	
	addRemoveStyle();
	set_innerpages();
	setWidthPopup();
	//bowling_thumb();
});
