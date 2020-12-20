<?php							
	$footercont_que = "SELECT * from code8_footercontent where id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($footercont_que);  
	$stmt1->execute();	
	$footercont_res = $stmt1->fetch(PDO::FETCH_ASSOC);			
?>
<style>
footer {
    background: url("<?php echo $footercont_res['footerimage']; ?>") left bottom no-repeat;
        background-position-x: left;
        background-position-y: bottom;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: auto;
    background-size: 100% auto;
    padding: 50px 0px;
}
</style>

<footer class="parallaxcont">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="social-media">
					<ul class="social-links">
						<li><a href="<?php echo $footercont_res['google']; ?>"><figure><img src="images/google-plus-color.svg" alt="google plus"></figure></a></li>
						<li><a href="<?php echo $footercont_res['facebook']; ?>"><figure><img src="images/facebook-color.svg" alt="facebook"></figure></a></li>
						<li><a href="<?php echo $footercont_res['twitter']; ?>"><figure><img src="images/twitter-color.svg" alt="twitter"></figure></a></li>
						<li><a href="<?php echo $footercont_res['instagram']; ?>"><figure><img src="images/instagram-color.svg" alt="instagram"></figure></a></li>
						<li><a href="<?php echo $footercont_res['linkedin']; ?>"><figure><img src="images/linkedin-color.svg" alt="linkedin"></figure></a></li>						
					</ul>	
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="address-main">
					<?php echo $footercont_res['address']; ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="email-div">
					<p><a href="mailto:<?php echo $footercont_res['contactemail']; ?>" class="mail"><?php echo $footercont_res['contactemail']; ?></a></p>
				</div>
			</div>
			<div class="col-12 copyrights"><p><span class="years-at">© <?php echo date('Y'); ?></span> <span class="pipe"></span> <a href="javascript:void(0);" class="privacy">PRIVACY POLICY</a></p></div>
		</div>
	</div>	
</footer>
<div class="shoppingcart-popup"><a href="javascript:void(0);" class="close-cart" title="Close"></a>
	<div class="shoppingcart-popup-sub">
		<h3>My Shopping Cart</h3>
		<div class="shoppingcart-scroll mCustomScrollbar">
			<div class="row">
			<?php							
			if($loginid==""){
			   $cartprod_que = "SELECT * from code8_cart where status=1 AND guestid=$guestid";
			} else {
				$cartprod_que = "SELECT * from code8_cart where status=1 AND customerid=$loginid";
			}						
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($cartprod_que);  
			$stmt1->execute();	
			$cartprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			$subtotal = 0;
			foreach($cartprod_res as $cartprod_result){	
				$cartproddata   = getProductData($cartprod_result['prodid']);	
				$prodpricedata  = getProductPrice($cartprod_result['prodid'],$countryid);
				$prodid 		= $cartprod_result['prodid'];
				//Get Product Price
				$proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($proprice_que);  
				$stmt1->execute();	
				$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
				$sprod_price = $proprice_res['price'];
				$pricewithqty = $sprod_price*$cartprod_result['quantity'];
				$subtotal+=$pricewithqty;
				$cartid 	= $cartprod_result['id'];				
				$grandtotal = $subtotal;	
				
			?>
				<div class="col-lg-12 col-md-12 cart-product">
					<div class="product-thumb">
						<div class="product-th-left">
							<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $cartprod_result['prodid'] ?>" class="pro-dt-btn"></a>
								<figure class="pro-img1"><img src="<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
								<figure class="pro-img2"><img src="<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
							</div>
						</div>
						<div class="product-th-right">
							<div class="product-dtl">							
								<h2><?php echo $cartproddata['prodtitle']; ?></h2>
								<div class="product-price-btn"><div class="product-price"><?php echo number_format($prodpricedata,3); ?></div></div>
								<div class="size-color-name">
									<div class="size-s">Size : <?php echo getSize($cartprod_result['size']); ?></div>
									<div class="color-name">Color : <?php echo getColor($cartprod_result['color']); ?></div>
									<div class="color-name">Quantity : <?php echo ($cartprod_result['quantity']); ?></div>
								</div>
								<a href="javascript:void(0);" title="Remove Item" class="remove-item"></a>
							</div>
						</div>
						<div class="wishlist-remove">
							<div class="wishlist-remove-sub">
								<a id="moveto_<?php echo $cartprod_result['prodid'] ?>" href="javascript:void(0);" title="Move to Wishlist" class="button movetowishlist">Move to Wishlist</a>
								<a id="delete_<?php echo $cartprod_result['id'] ?>" href="javascript:void(0);" title="Remove Item" class="button delete-item">Remove Item</a>
							</div>
							<script>
							$(function(){						
								$("[id^='moveto_']").click(function(){
								var i=$(this).attr('id');		
								var arr=i.split("_");
								var i=arr[1];	   	 		
								 $.ajax({
										type:"POST",
										data:"id="+i,
										url:"deleteprods.php?type=addtowishlist&userid=<?php echo $loginid; ?>&removeid=<?php echo $cartprod_result['id']; ?>",
										success:function(data)
										{				
											location.reload();				
										}
									});		
								});
							});
							</script>							
						</div>
					</div>
				</div>
				<?php } ?>				
			</div>
		</div>
		<div class="row cart-order">
			<div class="col-lg-12 col-md-12">
				<div class="total-table">Total : <?php echo number_format($subtotal,3); ?> <?php echo $currencycode; ?></div>
			</div>
			<?php if($subtotal!=0){ ?>
				<div class="col-lg-6 col-md-6"><a href="my-cart.php" class="button">See My Cart</a></div>
				<?php if($loginid!=""){ ?>
					<?php if($_SESSION["SESS_CUSTOMER_TYPE"]==1){ ?>
						<div class="col-lg-6 col-md-6"><a href="checkout-review.php" class="button">Place Order</a></div>
					<?php } else { ?>
						<div class="col-lg-6 col-md-6"><a href="order-review.php" class="button">Place Order</a></div>
					<?php } ?>
					
				<?php } else { ?>
					<div class="col-lg-6 col-md-6"><a href="my-cart.php" class="button">Place Order</a></div>
				<?php } ?>
			<?php } else { ?>
				<div class="col-lg-6 col-md-6"><a href="#" data-src="#emptycart" data-fancybox=""  class="button emptycart">See My Cart</a></div>
				<div class="col-lg-6 col-md-6"><a href="#" data-src="#emptycart" data-fancybox="" class="button emptycart">Place Order</a></div>
			<?php } ?>
		</div>
	</div>
</div>
<div id="loginModal" class="popup-hidden animated-modal">
	<form name="signin" method="post" action="" autocomplete="off">	
		<h2 class="anim1">Sign In</h2>
		<div class="form-group anim2">
			<input type="text" name="email" class="form-control" placeholder="Mobile / Email" value="" />
		</div>
		<div class="form-group anim3">
			<input type="password" name="password" class="form-control" placeholder="Password" value="" />
		</div>
		<div class="form-group anim5">
			<button type="submit" name="login" class="button">Sign In</button>
			<a href="javascript:void(0);" class="forgot-link">Forgot Password</a>
		</div>
		</form>
		<form name="forgot" method="post" action="" autocomplete="off">
		<div class="forgot-main">
			<div class="form-group">
				<div class="forgot-div">
					<input type="text" required class="form-control" placeholder="Enter mobile or email" name="email" value=""/>
					<button type="submit" name="forgot" class="button">Reset Password</button>
				</div>
			</div>
		</div>
		</form>
	<p class="forgot-reg anim6">Don't have an account ? <a href="javascript:void(0);" onclick="$.fancybox.close();" data-fancybox data-src="#signupModal" data-animation-duration="700">Register</a></p>	
</div>

<div id="signupModal" class="popup-hidden animated-modal">
	<form name="register" action="" method="post" autocomplete="off">	    
		<h2 class="anim1">Sign Up</h2>
		<div class="form-group anim2">
			<input type="text" name="fullname" required class="form-control" placeholder="Full Name..." value=""/>
		</div>
		<div class="form-group anim3">
			<div class="double">
				<input type="text" name="mobile" required class="form-control" placeholder="Mobile Number..." value=""/>
			</div>
			<div class="double">
				<input type="email" name="email" required class="form-control" placeholder="Email Address..." value=""/>
			</div>
		</div><div class="form-group anim4">
			<div class="double">
				<input type="password" name="password" required  class="form-control" placeholder="Password" value=""/>
			</div>
			<div class="double">
				<input type="password" name="cpassword" required  class="form-control" placeholder="Confirm password" value=""/>
			</div>
		</div>
		<div class="form-group anim5 signup-btn">
			<button type="submit" name="register" class="button">Sign Up</button> 
			<p class="forgot-reg">Already member? <a href="javascript:void(0);" onclick="$.fancybox.close();" data-fancybox data-src="#loginModal" data-animation-duration="700">Login</a></p>
		</div>
	</form>
</div>
<div id="storeModal" class="popup-hidden animated-modal">
	<h2 class="anim1">Our Stores</h2>
	<div class="form-group anim2">
		<div class="inpubox" id="states" onchange="populateCities()"><select id="StatesList" class="form-control"> </select></div>
	</div>
	<div class="form-group anim3">
		<div class="inpubox" id="Cities"><select id="CitiesList" class="form-control"> </select></div>
	</div>
	<div class="anim4 signup-btn"><a href="find-our-store.php" class="button">Find Store</a></div>
</div>	
<div id="sizeModal" class="popup-hidden size-guide animated-modal">
	<p class="anim1">SIZE GUIDE</p>
	<h4 class="anim2">COATS, OUTWEAR<br>MEASUREMENTS</h4>
	 <table class="size-guide-table anim3">
<tbody><tr>
<th>FR</th>
<th>US</th>
<th>UK</th>
<th>IT</th>
<th>UNIVERSEL</th>
</tr>
<tr>
<td>34</td>
<td>2</td>
<td>6</td>
<td>38</td>
<td>XXS</td>
</tr>
<tr>
<td>36</td>
<td>4</td>
<td>8</td>
<td>40</td>
<td>XS</td>
</tr>
<tr>
<td>38</td>
<td>6</td>
<td>10</td>
<td>42</td>
<td>S</td>
</tr>
<tr>
<td>40</td>
<td>8</td>
<td>12</td>
<td>44</td>
<td>M</td>
</tr>
<tr>
<td>42</td>
<td>10</td>
<td>14</td>
<td>46</td>
<td>L</td>
</tr>
<tr>
<td>44</td>
<td>12</td>
<td>16</td>
<td>48</td>
<td>XL</td>
</tr>
<tr>
<td>46</td>
<td>14</td>
<td>18</td>
<td>50</td>
<td>XXL</td>
</tr>
</tbody></table>
</div>
<div id="loginShare" class="popup-hidden animated-modal">
	<h2 class="anim1">Share</h2>
	<ul class="share-ul">
		<li class="anim2"><a href="javascript:void(0);"><img src="images/icon-facebook.svg" alt="facebook"></a></li>
		<li class="anim3"><a href="javascript:void(0);"><img src="images/icon-twitter.svg" alt="twitter"></a></li>
		<li class="anim4"><a href="javascript:void(0);"><img src="images/icon-instagram.svg" alt="instagram"></a></li>
		<li class="anim5"><a href="javascript:void(0);"><img src="images/mail-envelope.svg" alt="email"></a></li>
	</ul>
</div>
<script>
$("#wishlistlog").on( "click", function(){	
	$('#wishlistlogpop').trigger('click');	
});

/*$("#emptycart").on( "click", function(){
	$('#emptycarts').trigger('click');	
});*/

</script>
<div id="addedCartModel" class="popup-hidden animated-modal added-cart-model">
	<p class="anim1"><strong>Product added into the Cart !!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>
<div id="wishlistlogpop" class="popup-hidden animated-modal added-cart-model">
	<p class="anim1"><strong>Please login to add products to Wishlist!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<div id="emptycart" class="popup-hidden animated-modal added-cart-model">
	<p class="anim1"><strong>Cart is empty!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<div id="notloggedinpop" class="popup-hidden animated-modal added-cart-model notloggedinpop">
	<p class="anim1"><strong>Cart has been updated successfully. Please Login/Register to continue shopping!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<script>
$(function(){
	$("[id^='deletewish_']").click(function(){
	var i=$(this).attr('id');		
	var arr=i.split("_");
	var i=arr[1];	   	 		
	 $.ajax({
			type:"POST",
			data:"id="+i,
			url:"deleteprods.php?type=delwishprod",
			success:function(data)
			{				
				location.reload();				
			}
		});		
	});	
});
$(function(){
	$("[id^='delete_']").click(function(){
	var i=$(this).attr('id');		
	var arr=i.split("_");
	var i=arr[1];	   	 		
	 $.ajax({
			type:"POST",
			data:"id="+i,
			url:"deleteprods.php?type=delcartprod",
			success:function(data)
			{				
				location.reload();				
			}
		});		
	});	
});
</script>
<script>
$(function(){								
	$("[id^='movetowish_']").click(function(){
	var i=$(this).attr('id');		
	var arr=i.split("_");
	var i=arr[1];	   	 		
	 $.ajax({
			type:"POST",
			data:"id="+i,
			url:"deleteprods.php?type=movetowish&userid=<?php echo $loginid; ?>",
			success:function(data)
			{						
				location.reload();	
			}
		});		
	});
});
</script>	
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<!--<script type="text/javascript" src="js/jpreloader.js"></script>
<script type="text/javascript" src="js/loader.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>-->	
<script type="text/javascript" src="js/webslidemenu.js"></script>
<!--start fancybox-->	
<script type="text/javascript" src="fancybox-master/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="fancybox-master/fancybox.js"></script>
<!--end fancybox-->	
<!--start swiper-->
<script type="text/javascript" src="swiper/swiper.min.js"></script>
<script type="text/javascript" src="swiper/swiper.functions.js"></script>
<!--end swiper-->
<!--start scrollbar-->
<script type="text/javascript" src="scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!--end scrollbar-->
<!--<script  src="js/script.js"></script>-->
<script src="js/parallaxscroll.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {  
	$('.banner-main').parallax("50%", 0.6);
	$('.section02').parallax("50%", 0.6);
	$('.section04').parallax("50%", 0.6);
	$('footer').parallax("50%", 0.6);
});	
</script>
<script>
//Refresh Captcha
function refreshCaptcha(){
    var img = document.images['captcha_image'];
    img.src = img.src.substring(
 0,img.src.lastIndexOf("?")
 )+"?rand="+Math.random()*1000;
}
function refreshCaptchaSignin(){
    var img = document.images['captcha_image_signin'];
    img.src = img.src.substring(
 0,img.src.lastIndexOf("?")
 )+"?randsign="+Math.random()*1000;
}
</script>
<script>
/*$(window).load(function() {
	"use strict";		
	<?php if($_REQUEST[status]=='wrongcaptcha'){ ?>		
		$('.signin-link').trigger('click');
	<?php } else if($_REQUEST[status]=='confpassnotmatch'){ ?>	
		$('.signin-link').trigger('click');
	<?php } else if($_REQUEST[status]=='somethingwrong'){ ?>	
		$('.signin-link').trigger('click');
	<?php } else if($_REQUEST[status]=='registered'){ ?>	
		$('.signin-link').trigger('click');
	<?php } ?>
});*/
</script>
<script>
//$('.swal-button swal-button--confirm').addClass('button').removeClass('swal-button swal-button--confirm');

var el = $('.swal-button-container');
el.addClass('button');
el.removeClass('swal-button-container');
</script>
<script type="text/javascript" src="js/sweetalerts.js"></script>
<script type="text/javascript" src="js/nested.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.17/dist/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>