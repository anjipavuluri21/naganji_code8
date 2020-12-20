$(".regsuccess").on("click", function(){	
	swal("Registered successfully!!", "", "success");
	var delay = 3000; 
    var url = 'index.php';
    setTimeout(function(){ window.location = url; }, delay);
	return false;
});

//$(".somethingwrong").load("click", function(){	
//	swal("Something went wrong!!", "", "warning");
//	var delay = 3000; 
//    var url = 'index.php';
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});

//$(".confpassnotmatch").load("click", function(){
//	swal("Confirm password not matching!!", "", "warning");
//	var delay = 3000; 
//    var url = 'index.php';
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});

$(".wrongcaptcha").load("click", function(){
	swal("Wrong Captcha!!", "", "warning");
	var delay = 3000; 
    var url = 'index.php';
    setTimeout(function(){ window.location = url; }, delay);
	return false;
});

$(".wrongcaptchasignin").load("click", function(){	
	swal("Wrong Captcha!!", "", "warning");	
	var delay = 3000; 
    var url = 'index.php';
	setTimeout(function(){ window.location = url; }, delay);
	return false;
});

$(".invalidpassword").on("click", function(){	
	swal("Invalid password!!", "", "warning");
//        	$(".invalidpassword").trigger("click");

	var delay = 3000; 
    var url = 'index.php';
    setTimeout(function(){ window.location = url; }, delay);
	return false;
});

//$(".invalidcredentials").on("click", function(){
//	//swal("Invalid Credentials!!", "", "warning");
//	$(".invalidcredentials").trigger("click");
//	var delay = 3000; 
//    var url = 'index.php';
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});

$(".addtocart").load("click", function(){
//	swal("تمت إضافة المنتج إلى عربة التسوق
!!", "", "success");
         $(".addddccaartt").trigger("click");
        var delay = 3000; 	
    setTimeout(function(){ window.location = window.location.href; }, delay);
	return true;
});

$(".nostock").load("click", function(){	
	swal("Stock not available!!", "", "error");
	var delay = 3000;
	setTimeout(function(){ window.location = window.location.href; }, delay);    
	return false;
});

$(".wishlist").click("click", function(){
	swal("Please login to add products to Wishlist!!", "", "error");
	var delay = 3000; 
	return false;
});

/*$("#wishlistlog").on( "click", function(){
	setTimeout(function() {
		$('#wishlist').trigger('click');
	}, 3000);
});*/

/*$('#wishlist').trigger('click');
		setTimeout(function() {
			$('.loginPopupLink').trigger('click');
		}, 3000);*/

$(".addtowishlist").load("click", function(){
	swal("Product added to Wishlist!!", "", "success");
	var delay = 3000;    
	return false;
});

/*$(".notloggedin").on("click", function(){	
	swal("Cart has been updated successfully. Please Login/Register to continue shopping!", "", "warning");
	var delay = 3000;    
	return false;
});*/

/*$(".emptycart").click("click", function(){	
	swal("Cart is empty!!", "", "error");
	var delay = 3000;    
	return false;
});*/

//$(".emailnotmatch").load("click", function(){
//	swal("Email or Mobile number not matching with the records!!", "", "success");
//	var delay = 3000; 
//    var url = 'index.php'
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});

$(".senttoregemail").on("click", function(){	
	swal("Email sent to registered email address!!", "", "success");
	var delay = 3000; 
    var url = 'index.php'
    setTimeout(function(){ window.location = url; }, delay);
	return false;
});

//$(".confpassmatch").load("click", function(){
//	swal("Password changed successfully!!", "", "warning");
//	var delay = 3000; 
//    var url = 'index.php';
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});

$(".something").load("click", function(){
	swal("Something went wrong!!", "", "warning");
	var delay = 3000;     
    setTimeout(function(){ window.location = window.location.href; }, delay);
	return false;
});

//$(".passnotmatch").load("click", function(){
//	swal("Confirm Password not matching!!", "", "warning");
//	var delay = 3000;     
//    setTimeout(function(){ window.location = window.location.href; }, delay);
//	return false;
//});
