$.fancybox.defaults.buttons = [
  /*'slideShow',
	'thumbs',
  'download',
  'fullScreen',*/
  'close'
];

$('[data-fancybox="inline"]').fancybox({
  buttons : [	
	'close'
  ],
  thumbs : {
    autoStart : false
  },
	touch: {
    vertical: false, // Allow to drag content vertically
    momentum: false // Continue movement after releasing mouse/touch when panning
  } 
});
$('[data-fancybox="iframe"]').fancybox({
	toolbar  : true,
	smallBtn : true,
	iframe : {
		preload : true
	}
});
/*var league_title;
$(".league_popup").on('click', function() {
	league_popup = $(this).attr('data-title');
  $.fancybox.open({
    src  : 'popup-league.html',
    type : 'iframe',
    opts : {
      beforeShow : function( instance, current ) {
		  $('#register_popup').find('h2').text(league_popup);        	
      }
    }
  });
  
});*/

$(".fancyIframe").on('click', function() {	
  $.fancybox.open({
	src  : $(this).attr('data-src'),  
    type : 'iframe',
    opts : {
      beforeLoad : function() {		  
		  //$('#register_popup').find('h2').text(league_popup);        	
      }
    }
  });
  $('.fancybox-content').addClass('popupIframe');
});
$(".pageloadpopup").on('click', function() {	
  $.fancybox.open({
	src  : $(this).attr('data-src'),  
    type : 'iframe',
    opts : {
      beforeLoad : function() {		  
		  //$('#register_popup').find('h2').text(league_popup);        	
      }
    }
  });
  $('.fancybox-container').addClass('fancybox-full-width');
});
/*$('[data-fancybox="img2"]').fancybox({
  buttons : [
	'thumbs',
	'close'
  ],
  thumbs : {
    autoStart : true
  }
});*/
$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});