<?php include "header.php"; ?>
<?php
//Get Tax & Shipping Price
$tax_que = "SELECT * from code8_taxesandshipping where country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($tax_que);  
$stmt1->execute();	
$tax_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$tax_price = $tax_res['taxes'];
$ship_price = $tax_res['shipping'];
?>
<?php
if(isset($_POST['placeorder'])){	
		
	$cartprods 		= $_POST['cartprods'];	
	$cartprodprices = $_POST['cartprodprices'];	
	$quantity 		= $_POST['quantity'];	
	$taxes 		 	= $tax_price;
	$delivery 		= $ship_price;
	
	$cartprodscount	= count($_POST['cartprods']);
	for($i=0;$i<$cartprodscount;$i++){
		$cartprods[$i];
		
		$getcartprod_que = "SELECT * from code8_cart where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid=$cartprods[$i]";	
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($getcartprod_que);  
		$stmt1->execute();	
		$getcartcount = $stmt1->rowCount();
		
		if($getcartcount>0){
			$updatecart_que = "UPDATE code8_cart SET quantity='$quantity[$i]', price='$cartprodprices[$i]', tax='$taxes', shipping='$delivery', currencycode='$currencycode' where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid='$cartprods[$i]'";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($updatecart_que);  
			$stmt1->execute();
			$getupcart = $stmt1->rowCount();
			
			//Update cart Products
			if($loginid!=""){		
				$updatecart_que = "UPDATE code8_cartproducts SET quantity='$quantity[$i]', product_price='$cartprodprices[$i]', tax='$taxes', shipping='$delivery', currencycode='$currencycode' where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid='$cartprods[$i]'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($updatecart_que);  
				$stmt1->execute();
			}
		}		
	}	
	if($_SESSION["SESS_CUSTOMER_ID"]!=""){		
		echo "<script>window.location='order-review.php'</script>";	
	} else {				
		echo '<a class="notloggedinpop"></a>';	
		echo '<script> $(document).ready(function(){ $(".notloggedinpop"); });</script>';
		echo '<a class="on-addtocart-btn notloggedinpop" href="javascript:void(0);" data-src="#notloggedinpop" data-fancybox=""></a>';	
	}	
}
if(isset($_POST['guestcheckout'])){	
		
	$cartprods 		= $_POST['cartprods'];	
	$cartprodprices = $_POST['cartprodprices'];	
	$quantity 		= $_POST['quantity'];
	$taxes 		 	= $tax_price;
	$delivery 		= $ship_price;
	
	$cartprodscount	= count($_POST['cartprods']);
	for($i=0;$i<$cartprodscount;$i++){
		$cartprods[$i];
		
		$getcartprod_que = "SELECT * from code8_cart where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid=$cartprods[$i]";	
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($getcartprod_que);  
		$stmt1->execute();	
		$getcartcount = $stmt1->rowCount();
		
		if($getcartcount>0){
			$updatecart_que = "UPDATE code8_cart SET quantity='$quantity[$i]', price='$cartprodprices[$i]', tax='$taxes', shipping='$delivery', currencycode='$currencycode' where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid='$cartprods[$i]'";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($updatecart_que);  
			$stmt1->execute();
			$getupcart = $stmt1->rowCount();
			
			//Update cart Products
			//if($loginid!=""){		
				$updatecart_que = "UPDATE code8_cartproducts SET quantity='$quantity[$i]', product_price='$cartprodprices[$i]', tax='$taxes', shipping='$delivery', currencycode='$currencycode' where status=1 AND (guestid='$guestid' OR customerid='$loginid') AND prodid='$cartprods[$i]'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($updatecart_que);  
				$stmt1->execute();
			//}
		}		
	}				
	echo "<script>window.location='checkout-review.php'</script>";	 
}
?>
<section class="innerpages">
<form name="mycart" method="post" action="">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">My <span>Cart</span></h1>
			</div>
			
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items gold-color-bg">
					<h4>Products</h4>
					<div class="my-cart-items-sub">
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
					$cartcount = $stmt1->rowCount();
					$cartprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
					$subtotal = 0;
					
					foreach($cartprod_res as $cartprod_result){	
						$cartproddata  = getProductData($cartprod_result['prodid']);	
						$prodpricedata = getProductPrice($cartprod_result['prodid'],$countryid);
						$prodid = $cartprod_result['prodid'];
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
						$cartid = $cartprod_result['id'];						
					?>
						<div class="product-thumb">
							<div class="product-thumb-sub">
								<div class="product-th-left">
								<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $cartprod_result['prodid'] ?>" class="pro-dt-btn"></a>
									<figure class="pro-img1"><img src="../<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
									<figure class="pro-img2"><img src="../<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
								</div>
							</div>
								<div class="product-th-right">
									<input type="hidden" name="cartprods[]" value="<?php echo $cartproddata['id']; ?>">
									<input type="hidden" name="cartprodprices[]" value="<?php echo $sprod_price; ?>">
									<h2><a href="product-detail.php?id=<?php echo $cartproddata['id']; ?>"><?php echo $cartproddata['prodtitle']; ?></a></h2>
									<ul class="my-cart-ul">
										<li><label>Size</label>
											<div class="my-cart-ul-dtl">
												<strong><?php echo getSize($cartprod_result['size']); ?></strong>
											</div>
										</li>
										<li><label>Color</label><div class="my-cart-ul-dtl"><strong><?php echo getColor($cartprod_result['color']); ?></strong></div></li>
										<li><label>Quantity</label><div class="my-cart-ul-dtl">
											<div class="quantity-control-div plus-minus">
												<a href="javascript:void(0);" class="minus-btn minusBtncart<?php echo $cartid; ?>">-</a>
												<div class="quantity-control"><input type="text" name="quantity[]" class="form-control noValue" value="<?php echo ($cartprod_result['quantity']); ?>"></div>
												<a href="javascript:void(0);" class="plus-btn plusBtncart<?php echo $cartid; ?>">+</a>
												<input type="hidden" name="prodprice" id="prodprice<?php echo $cartid; ?>" value="<?php echo $sprod_price; ?>">
												<script>
												var prodcount = <?php echo $cartcount; ?>;		
												$('.plusBtncart<?php echo $cartid; ?>').click(function(){	
													no_of_bottle =  parseInt($(this).parent('.plus-minus').find('.noValue').val());
													no_of_bottle = no_of_bottle + 1;
																					
													$(this).parent('.plus-minus').find('.noValue').val(no_of_bottle);
													
													var valsize<?php echo $cartid; ?>  = (no_of_bottle*($('#prodprice<?php echo $cartid; ?>').val())).toFixed(3);
													
													var prodval<?php echo $cartid; ?> = $('#prodprice<?php echo $cartid; ?>').val();
													
													var updatetot = $('#changedprice<?php echo $cartid; ?>').text(valsize<?php echo $cartid; ?>);							
													
													$('#hidenchangedprice<?php echo $cartid; ?>').val(valsize<?php echo $cartid; ?>);
													
													$(".cartprice").each(function() {	
														calculateSum();	
													});				
												});	
																																		$('.minusBtncart<?php echo $cartid; ?>').click(function(){	
													no_of_bottle = parseInt($(this).parent('.plus-minus').find('.noValue').val());
													
													if(no_of_bottle > 1){
														no_of_bottle = no_of_bottle - 1;
																						
														$(this).parent('.plus-minus').find('.noValue').val(no_of_bottle);
														
														var valsize<?php echo $cartid; ?>  = no_of_bottle*($('#prodprice<?php echo $cartid; ?>').val());
														
														var prodval<?php echo $cartid; ?> = $('#prodprice<?php echo $cartid; ?>').val();
														
														var updatetot = $('#changedprice<?php echo $cartid; ?>').text(valsize<?php echo $cartid; ?>);							
														
														$('#hidenchangedprice<?php echo $cartid; ?>').val(valsize<?php echo $cartid; ?>);
														
														$(".cartprice").each(function() {	
															calculateSum();	
														});
													}								
												});				
												</script>
												
											</div></div>
										</li>
										<input type="hidden" name="cartprice" value="<?php echo ($sprod_price*$cartprod_result['quantity']); ?>" class="cartprice" id="hidenchangedprice<?php echo $cartid; ?>">	
										<li><label>Price</label><div class="my-cart-ul-dtl"><strong><span id="changedprice<?php echo $cartid; ?>"><?php echo number_format(($sprod_price*$cartprod_result['quantity']),3); ?></span> <?php echo $currencycode; ?></strong></div></li>
										<li><div class="wish-remove-item">
										<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>
												<a id="moveto_<?php echo $cartprod_result['prodid'] ?>" href="javascript:void(0);" title="Move to Wishlist" data-name="wishlist" class="movetowishlist">Move to Wishlist</a>
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
												<?php } else { ?>	
													<a href="javascript:void(0);" title="Move to Wishlist" class="wishlist">Move to Wishlist</a>
												<?php } ?>				
												<a id="delete_<?php echo $cartprod_result['id'] ?>" href="javascript:void(0);" title="Remove Item" class="delete-item">Remove Item</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>						
					</div>
				</div>
			</div>
			
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items gold-color-bg">
					<h4>Summary</h4>
					<div class="my-cart-items-sub">
						<ul class="summary-detail">
							<li>								
								<label>Subtotal</label>
								<div class="summary-dtl"><span id="changedsubtotal"><?php echo number_format($subtotal,3); ?> </span> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Taxes</label>
								<input type="hidden" name="taxes" id="taxes" value="<?php echo $tax_price; ?>">
								<div class="summary-dtl"><?php echo number_format($tax_price,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>رسوم التوصيل
</label>
								<input type="hidden" name="delivery" id="delivery" value="<?php echo $ship_price; ?>">
								<div class="summary-dtl"><?php echo number_format($ship_price,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<?php $totalval  = ($subtotal+$tax_price+$ship_price); ?>
							<li>
								<label><strong>Total</strong></label>
								<div class="summary-dtl"><strong><span class="updatedtotal"><?php echo number_format($totalval,3); ?></span> <?php echo $currencycode; ?></strong></div>
							</li>
						</ul>
					</div>	
				</div>
				<div class="row order-div">
					<div class="col-lg-6 col-md-6"><a href="listing.php" class="button fullwidth">Continue Shopping</a></div>
					<?php if($subtotal!=0){ ?>
						<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>
							<div class="col-lg-6 col-md-6">		
							<input type="submit" value="Place Order" name="placeorder" class="button fullwidth"/>
							</div>
						<?php } else { ?>
							<div class="col-lg-6 col-md-6">							
								<input type="submit" value="Place Order" name="placeorder" class="button fullwidth"/>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="col-lg-6 col-md-6"><a href="#" class="button fullwidth emptycart">تنفيذ الطلب</a></div>
					<?php } ?>
					<?php if(($loginid=="" && $_SESSION[SESS_CUSTOMER_TYPE]=="1")){ ?>
						<div style="margin-top:15px" class="col-lg-12 col-md-6"><input type="submit" value="Guest Checkout" name="guestcheckout" class="button fullwidth"/></div>
					<?php } else if($loginid!="" && $_SESSION[SESS_CUSTOMER_TYPE]!="2") { ?>
						<div style="margin-top:15px" class="col-lg-12 col-md-6"><input type="submit" value="Guest Checkout" name="guestcheckout" class="button fullwidth"/></div>
					<?php } else if($loginid=="") { ?>
						<div style="margin-top:15px" class="col-lg-12 col-md-6"><input type="submit" value="Guest Checkout" name="guestcheckout" class="button fullwidth"/></div>
					<?php } ?>
				</div>
			</div>			
		</div>
	</div>
	</form>
</section>
<script>
$(".notloggedinpop").load("click", function(){	
	$(".notloggedinpop").trigger("click");
	/*var delay = 2000; 
    var url = 'my.php';
    setTimeout(function(){ window.location = url; }, delay);*/
	return false;
});
</script>
<script>			
function calculateSum() {					
	var total = 0;
	$('.cartprice').each(function(){
		if($(this).val() !==''){
			total +=parseInt($(this).val());
		}						
	});
	var taxes 		= parseInt($('#taxes').val());
	var delivery 	= parseInt($('#delivery').val());
	var grandtotal 	= total+taxes+delivery;	
	//alert(grandtotal)
	$("#changedsubtotal").text(total.toFixed(3));
	$(".updatedtotal").text(grandtotal.toFixed(3));
}
</script>
<script>
$('.plusBtncart').click(function(){	
	no_of_bottle =  parseInt($(this).parent('.plus-minus').find('.noValue').val());
	no_of_bottle = no_of_bottle + 1;
	alert(no_of_bottle);
	
	$(this).parent('.plus-minus').find('.noValue').val(no_of_bottle);
});
</script>
<?php include "footer.php"; ?>