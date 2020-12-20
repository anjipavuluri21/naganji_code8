document.addEventListener("touchstart", function() {},false);  
$(function() {
	$('#wsnavtoggle').click(function () {
		$('.wsmenucontainer').toggleClass('wsoffcanvasopener');
	});
	$('.overlapblackbg').click(function () {
	  $('.wsmenucontainer').removeClass('wsoffcanvasopener');
	});

	//$('.wsmenu-list> li').has('.wsmenu-submenu').prepend('<span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
	$('.wsmenu-list > li').has('.megamenu').prepend('<span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
	
	if($('.wsmenu-list> li').has('.wsmenu-submenu')){
		$('.wsmenu-submenu').prev('.main-link').append('<span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
	}
	$('.wsmenu-click').click(function(){
		if($(this).hasClass('ws-activearrow')){
		   	$(this).removeClass('ws-activearrow')
		}
		else{
			$('.wsmenu-click').removeClass('ws-activearrow');
			$(this).addClass('ws-activearrow')
		}
		/*$(this).toggleClass('ws-activearrow')
		.parent().parent().siblings().children().removeClass('ws-activearrow');*/
		$(".wsmenu-submenu, .megamenu").not($(this).parent().siblings('.wsmenu-submenu, .megamenu')).slideUp('slow');
		$(this).parent().siblings('.wsmenu-submenu').slideToggle('slow');
		$(this).parent().siblings('.megamenu').slideToggle('slow');	
	});
	
	$('.wsmenu-list > li > ul > li').has('.wsmenu-submenu-sub').prepend('<span class="wsmenu-click02"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');
	$('.wsmenu-list > li > ul > li > ul > li').has('.wsmenu-submenu-sub-sub').prepend('<span class="wsmenu-click02"><i class="wsmenu-arrow fa fa-angle-down"></i></span>');

	$('.wsmenu-click02').click(function(){
		$(this).children('.wsmenu-arrow').toggleClass('wsmenu-rotate');
		$(this).siblings('.wsmenu-submenu-sub').slideToggle('slow');
		$(this).siblings('.wsmenu-submenu-sub-sub').slideToggle('slow');
	
	});

});