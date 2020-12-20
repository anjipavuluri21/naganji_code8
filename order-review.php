<?php 
ob_start();
include "header.php"; 
include "auth.php";

$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($myaddrquery);  
$stmt->execute();	
$myaddrres = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['updateshipaddress'])){	
	$address1 	= filter_var($_POST['address1'], FILTER_SANITIZE_STRING);	
	$address2 	= filter_var($_POST['address2'], FILTER_SANITIZE_STRING);	
	$towncity 	= filter_var($_POST['towncity'], FILTER_SANITIZE_STRING);	
	$statecounty= filter_var($_POST['statecounty'], FILTER_SANITIZE_STRING);	
	$country 	= filter_var($_POST['country'], FILTER_SANITIZE_STRING);	
	$postalzip 	= filter_var($_POST['postalzip'], FILTER_SANITIZE_STRING);		
	
	$myaccup_query = "UPDATE code8_customeraddresses SET `address1`='$address1',`address2`='$address2',`towncity`='$towncity',`statecounty`='$statecounty',`country`='$country',`postalzip`='$postalzip' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($myaccup_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();	
	if($res1 == 1){			
		echo "<script>window.location='order-review.php'</script>";
	}			
}
if(isset($_POST['updatebilladdress'])){	
	$baddress1 	= filter_var($_POST['baddress1'], FILTER_SANITIZE_STRING);	
	$baddress2 	= filter_var($_POST['baddress2'], FILTER_SANITIZE_STRING);	
	$btowncity 	= filter_var($_POST['btowncity'], FILTER_SANITIZE_STRING);	
	$bstatecounty= filter_var($_POST['bstatecounty'], FILTER_SANITIZE_STRING);	
	$bcountry 	= filter_var($_POST['bcountry'], FILTER_SANITIZE_STRING);	
	$bpostalzip 	= filter_var($_POST['bpostalzip'], FILTER_SANITIZE_STRING);
			
	$myaccup_query = "UPDATE code8_customeraddresses SET `baddress1`='$baddress1',`baddress2`='$baddress2',`btowncity`='$btowncity',`bstatecounty`='$bstatecounty',`bcountry`='$bcountry',`bpostalzip`='$bpostalzip' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($myaccup_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();	
	if($res1 == 1){			
		echo "<script>window.location='order-review.php'</script>";
	}			
}
//Warehouse Address
$warequery = "SELECT * from code8_warehouses where location='$countryid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($warequery);  
$stmt->execute();	
$warehouseaddr = $stmt->fetch(PDO::FETCH_ASSOC);
$warestate   = $warehouseaddr['state'];
$warecity	 = $warehouseaddr['city'];
$warezip	 = $warehouseaddr['zip'];
$warecountry = getCountryCode($countryid);

?>
<input type="hidden" id="warestate" value="<?php echo $warestate; ?>">
<input type="hidden" id="warecity" value="<?php echo $warecity; ?>">
<input type="hidden" id="warezip" value="<?php echo $warezip; ?>">
<input type="hidden" id="warecountry" value="<?php echo $warecountry; ?>">

<section class="innerpages">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Order <span>Review</span></h1>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items">
					<h4>Address</h4>
					<div class="my-cart-items-sub address-review gold-color-bg">
						<div class="checkout-sub address-sub-div">
							<h3>Shipping Address</h3>
							<form name="" method="post" action="">
							<div class="myprofile-main">
							<div class="profiledata">			
								<div class="form-group">
									<label>Address 1</label><p><?php echo $myaddrres['address1']; ?></p>
								</div>
								<div class="form-group">
									<label>العنوان 2</label><p><?php echo $myaddrres['address2']; ?></p>
								</div>
								<input type="hidden" id="shipcity" value="<?php echo getShipCity($myaddrres['towncity']); ?>">					
								<input type="hidden" id="shipstate" value="<?php echo getShipState($myaddrres['statecounty']); ?>">
								<input type="hidden" id="shipcountry" value="<?php echo getShipCountry($myaddrres['country']); ?>">					
								<input type="hidden" id="shipzip" value="<?php echo $myaddrres['postalzip']; ?>">
								
								<div class="form-group">
									<label>City</label><p><?php echo ($myaddrres['towncity']); ?></p>
								</div>
								<div class="form-group">
									<label>State</label><p><?php echo ($myaddrres['statecounty']); ?></p>
								</div>
								<div class="form-group">
									<label>Country</label><p><?php echo getShipCountry($myaddrres['country']); ?></p>
								</div>
								<div class="form-group">
									<label>ZIP</label><p><?php echo $myaddrres['postalzip']; ?></p>
								</div>							
								<div class="change-div"><a href="javascript:void(0);" class="button change-btn">Change</a></div>
							</div>					
							<div class="profileform">			
								<div class="form-group">
									<div class="inputbox"><input type="text" required placeholder="House number and street name" name="address1" id="address1" value="<?php echo $myaddrres['address1']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" required placeholder="Appartment, suite, unit etc.(optional)" name="address2" id="address2" value="<?php echo $myaddrres['address2']; ?>" class="form-control"></div>
								</div>
						<div class="form-group">
							<div class="inputbox"><input type="text" required placeholder="City" name="towncity" id="towncity" value="<?php echo $myaddrres['towncity']; ?>" class="form-control"></div>
						</div>
						<div class="form-group">
							<div class="inputbox"><input type="text" required placeholder="State" name="statecounty" id="statecounty" value="<?php echo $myaddrres['statecounty']; ?>" class="form-control"></div>
						</div>
						
						<div class="form-group">
							<div class="inputbox">
							<select class="form-control" id="country" name="country" required>
							<option value="" >Select Country</option>
							<?php
							$contryval =  $myaddrres['country']; 	
							$gov_que = "SELECT * from code8_ship_countries";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$countval= $gov_result['id'];
							?>
							<option  <?php if($contryval==$countval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
							<?php } ?>				
						</select>
						</div>
					</div>
					<!--<div class="form-group">
						  <div class="inputbox">
							<select class="form-control" id="statecounty" name="statecounty" required>
							<option value="" >Select State</option>
							<?php
							$stateval =  $myaddrres['statecounty']; 	
							$gov_que = "SELECT * from code8_ship_states";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$countval= $gov_result['id'];
							?>
							<option  <?php if($stateval==$countval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
							<?php } ?>				
						</select></div>
						</div>
						<div class="form-group">
							<div class="inputbox">
							<select class="form-control" id="towncity" name="towncity" required>
							<option value="" >Select City</option>
							<?php
							$cityval =  $myaddrres['towncity']; 	
							$gov_que = "SELECT * from code8_ship_cities";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$countval= $gov_result['id'];
							?>
							<option  <?php if($cityval==$countval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
							<?php } ?>				
						</select>
									</div>
								</div>-->
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="ZIP code" name="postalzip" id="postalzip" value="<?php echo $myaddrres['postalzip']; ?>" class="form-control"></div>
								</div>
								<div class="change-div"><button class="button" name="updateshipaddress" type="submit">UPDATE</button> <a href="javascript:void(0);" class="button closebutton">CLOSE</a></div>
							</div>
							</div>
							</form>							
						</div>
						<div class="checkout-sub address-sub-div">
							<h3>Billing Address<div class="same-as"><ul class="unstyled">
								<li>
									<input class="styled-checkbox" id="p_address" name="" <?php if($myaddrres['sameasshipaddr']==1){ echo "checked value='0'"; } else { echo "value='1'"; } ?> type="checkbox" >
									<label for="p_address"><span>Same As Shipping Address</span></label>
								</li>
							</ul></div></h3>
							<form name="" method="post" action="">
							<div class="myprofile-main">
							<div class="profiledata">
								<div class="form-group">
									<label>Address 1</label><p><?php echo $myaddrres['baddress1']; ?></p>
								</div>
								<div class="form-group">
									<label>العنوان 2</label><p><?php echo $myaddrres['baddress2']; ?></p>
								</div>
								<div class="form-group">
									<label>City</label><p><?php echo ($myaddrres['btowncity']); ?></p>
								</div>
								<div class="form-group">
									<label>State</label><p><?php echo ($myaddrres['bstatecounty']); ?></p>
								</div>
								<div class="form-group">
									<label>Country</label><p><?php echo getShipCountry($myaddrres['bcountry']); ?></p>
								</div>
								<div class="form-group">
									<label>ZIP</label><p><?php echo $myaddrres['bpostalzip']; ?></p>
								</div>	
								<div class="change-div"><a href="javascript:void(0);" class="button change-btn">Change</a></div>
							</div>					
							<div class="profileform">
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="House number and street name" name="baddress1" id="baddress1" value="<?php echo $myaddrres['baddress1']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Appartment, suite, unit etc.(optional)" name="baddress2" id="baddress2" value="<?php echo $myaddrres['baddress2']; ?>" class="form-control"></div>
								</div>	
					    <div class="form-group">
							<div class="inputbox"><input type="text" required placeholder="City" name="btowncity" id="btowncity" value="<?php echo $myaddrres['btowncity']; ?>" class="form-control"></div>
						</div>
						<div class="form-group">
							<div class="inputbox"><input type="text" required placeholder="State" name="bstatecounty" id="bstatecounty" value="<?php echo $myaddrres['bstatecounty']; ?>" class="form-control"></div>
						</div>
								<div class="form-group">
							  <div class="inputbox">
							<select class="form-control" id="bcountry" name="bcountry" required>
								<option value="" >Select Country</option>
								<?php
								$bcontryval =  $myaddrres['bcountry']; 	
								$gov_que = "SELECT * from code8_ship_countries";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($gov_que);
								$stmt1->execute();	
								$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($gov_res as $gov_result){
									$bcountval= $gov_result['id'];
								?>
								<option  <?php if($bcontryval==$bcountval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
								<?php } ?>				
							</select>
							</div>
						</div>
						<!--<div class="form-group">
							<div class="inputbox">
						<select class="form-control" id="bstatecounty" name="bstatecounty" required>
							<option value="" >Select State</option>
							<?php
							$bstateval =  $myaddrres['bstatecounty']; 	
							$gov_que = "SELECT * from code8_ship_states";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$bcountval= $gov_result['id'];
							?>
							<option  <?php if($bstateval==$bcountval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
							<?php } ?>				
						</select>
									</div>
								</div>
								<div class="form-group">
									<div class="inputbox">
							<select class="form-control" id="btowncity" name="btowncity" required>
							<option value="" >Select City</option>
							<?php
							$bcityval =  $myaddrres['btowncity']; 	
							$gov_que = "SELECT * from code8_ship_cities";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$bcountval= $gov_result['id'];
							?>
							<option  <?php if($bcityval==$bcountval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['name']; ?></option>
							<?php } ?>				
						</select>
									</div>
								</div>-->
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="ZIP code" name="bpostalzip" id="bpostalzip" value="<?php echo $myaddrres['bpostalzip']; ?>" class="form-control"></div>
								</div>
								<div class="change-div"><button class="button" type="submit" name="updatebilladdress">UPDATE</button> <a href="javascript:void(0);" class="button closebutton">CLOSE</a></div>
							</div>
							</div>	
							</form>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items">
					<h4>Cart Summary</h4>
					<div class="my-cart-items-sub order-review gold-color-bg">
					<?php							
					$cartprod_que = "SELECT * from code8_cartproducts where status=1 AND customerid=$loginid";	
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
						$cartid 	= $cartprod_result['id'];
						$tax 		= $cartprod_result['tax'];
						$shipping 	= $cartprod_result['shipping'];
						$grandtotal = $subtotal+$tax+$shipping;	
					?>
						<div class="product-thumb">
							<div class="product-thumb-sub">
								<div class="product-th-left">
									<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $cartprod_result['prodid'] ?>" class="pro-dt-btn"></a>
										<figure class="pro-img1"><img src="<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
										<figure class="pro-img2"><img src="<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
									</div>
								</div>
								<div class="product-th-right">
									<div class="product-dtl">	
										<h2><?php echo $cartproddata['prodtitle']; ?></h2>
										<div class="product-price-btn"><div class="product-price"><?php echo number_format($sprod_price*$cartprod_result['quantity'],3); ?> <?php echo $currencycode; ?></div></div>
										<div class="size-color-name">
											<div class="size-s">Size : <?php echo getSize($cartprod_result['sizeid']); ?></div>
											<div class="color-name">Color : <?php echo getColor($cartprod_result['colorid']); ?></div>
											<div class="qty-num">Quantity : <?php echo ($cartprod_result['quantity']); ?></div>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<?php } ?>
						<?php $totalval  = ($subtotal+$tax_price+$ship_price); ?>
						<ul class="summary-detail">
							<li>
								<label>Subtotal</label>
								<div class="summary-dtl"><?php echo number_format($subtotal,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Taxes</label>
								<input type="hidden" name="taxes" id="taxes" value="<?php echo $tax; ?>">
								<div class="summary-dtl"><?php echo number_format($tax,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Delivery Charges</label>
								<input type="hidden" name="delivery" id="delivery" value="<?php echo $shipping; ?>">
								<div class="summary-dtl"><span id="delcharge"><?php echo number_format($shipping.' ',3); ?> </span> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label><strong>Total</strong></label>
								<div class="summary-dtl"><strong><?php echo number_format($grandtotal,3); ?> <?php echo $currencycode; ?></strong></div>
							</li>							
						</ul>
						<div class="pay-through">
							<p>Pay through</p>
							<ul class="unstyled">
								 <li class="black">
									<input class="styled-checkbox" id="p_net" checked name="payment" type="radio" value="knet">
									<label for="p_net"><span><img src="images/knet.jpg" alt="kent"></span></label>
								</li>
								<!-- <li class="white">
									<input class="styled-checkbox" id="p_visa" name="payment" type="radio" value="visa card">
									<label for="p_visa"><span><img src="images/visa.jpg" alt="visa"></span></label>
								</li>
								<li class="gold">
									<input class="styled-checkbox" id="p_master"  name="payment" type="radio" value="master card">
									<label for="p_master"><span><img src="images/mastercard.jpg" alt="mastercard"></span></label>
								</li>
								<li class="gold">
									<input class="styled-checkbox" id="p_amrican" name="payment" type="radio" value="american card">
									<label for="p_amrican"><span><img src="images/americancard.jpg" alt="american"></span></label>
								</li>
								<li class="gold">
									<input class="styled-checkbox" id="p_paypal" name="payment" type="radio" value="paypal">
									<label for="p_paypal"><span><img src="images/paypal.jpg" alt="american"></span></label>
								</li>  -->
								<?php 	
                                            if($_SESSION['COUNTRY']==1 && $_SESSION['COD_FLAG']==1){ 
                                               ?>
                                                <li class="gold">
                                                    <input class="styled-checkbox" id="p_cod" name="payment1" type="radio" value="cod" checked>
									<label for="p_cod"><span><img src="images/paypal.jpg" alt="cod"></span></label>
								</li>
                                           <?php  }
                                            ?>
							</ul>
						</div></div>
						<?php if($subtotal!=0){ ?>
							<div class="order-div">
							<!--<a href="k-net.php" class="button fullwidth" onclick="return validateAddr()">Pay Now</a>-->
								<form name="" method="post" action="k-net.php">
								  <input class="form-control" id="username" name="username" value="dessieguila@gmail.com" placeholder="username" type="text" required style="display:none"/>			 
								  <input class="form-control" id="password" name="password" placeholder="password" type="passsword" value="mishari12" required style="display:none"/>				 
								   <button class="button fullwidth" name="SubmitButton" onclick="return validateAddr()" type="submit">
								  Pay Now
								   </button>
								</form>							
							</div>
						<?php } else { ?>
							<div class="order-div"><a href="#" class="button fullwidth emptycart">Pay Now</a></div>
						<?php } ?>
						
				</div>
			</div>
		</div>
	</div>
</section>
<script>
function validateAddr(){
	var address1 		= $('#address1').val();
	var address2		= $('#address2').val();
	var country			= $('#country').val();
	var statecounty		= $('#statecounty').val();
	var towncity		= $('#towncity').val();
	var postalzip		= $('#postalzip').val();
	
	var baddress1		= $('#baddress1').val();	
	var baddress2		= $('#baddress2').val();
	var bcountry		= $('#bcountry').val();
	var bstatecounty	= $('#bstatecounty').val();
	var btowncity		= $('#btowncity').val();
	var bpostalzip		= $('#bpostalzip').val();
	var shippingpirce	= $('#delivery').val();	
	//alert(shippingpirce);
	
	if(address1=="" && address2=="" && country=="" && statecounty=="" && towncity=="" && postalzip==""){
		swal("Please fill shipping address!", "", "warning");
		return false;
	} else if(baddress1=="" && baddress2=="" && bcountry=="" && bstatecounty=="" && btowncity=="" && bpostalzip==""){
		swal("Please fill Billing address!", "", "warning");
		return false;
	} /*else if(shippingpirce=="0"){
		swal("Invalid Destination!", "", "warning");
		return false;
	}	*/	
}

$("#p_address").click(function() {
	var checkval = $('#p_address').val();		
	if(checkval==1) {	
		var i=<?php echo $loginid; ?>;		
		$.ajax({
			type:"POST",
			data:"id="+i,
			url:"sameasshipaddrguest.php?type=sameasship",
			success:function(data)
			{				
				location.reload();				
			}
		});	
	} else {
		var i=<?php echo $loginid; ?>;		
		$.ajax({
			type:"POST",
			data:"id="+i,
			url:"sameasshipaddrguest.php?type=uncheck",
			success:function(data)
			{				
				location.reload();				
			}
		});	
	}	 
});
</script>
<?php include "footer.php"; ?>
