// JavaScript Document
$(window).ready(function(){
	///Site loader
	$('body').jpreLoader({
		splashID: "#jSplash",
		loaderVPos: '50%',
		autoClose: false,
		closeBtnText: "Let's Begin!",
		splashFunction: function() {  
		}
	}, function() {	//callback function
		$('header,footer,section,.banner-main,.FAWSEC').animate({'opacity':1});
		//startScroll();
	});
})