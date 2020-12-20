<?php 
ob_start();
include "header.php"; 

$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($myaddrquery);  
$stmt->execute();	
$myaddrres = $stmt->fetch(PDO::FETCH_ASSOC);

//Customer info
$custinfo = getCustomerdata($loginid);

if(isset($_POST['updateshipaddress'])){	
	$fullname 	= filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);	
	$mobile 	= filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);	
	$email 		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);	
	$address1 	= filter_var($_POST['address1'], FILTER_SANITIZE_STRING);	
	$address1 	= filter_var($_POST['address1'], FILTER_SANITIZE_STRING);	
	$address2 	= filter_var($_POST['address2'], FILTER_SANITIZE_STRING);	
	$towncity 	= filter_var($_POST['towncity'], FILTER_SANITIZE_STRING);	
	$statecounty= filter_var($_POST['statecounty'], FILTER_SANITIZE_STRING);	
	$country 	= filter_var($_POST['country'], FILTER_SANITIZE_STRING);	
	$postalzip 	= filter_var($_POST['postalzip'], FILTER_SANITIZE_STRING);
		
	if($loginid==""){
		//Register the Guest	
		//1-guest;2-registereduser
		$regquery = "INSERT INTO code8_customers (fullname, email, mobile, status, registereddate, customertype) VALUES ('$fullname','$email','$mobile',1,NOW(),1)";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($regquery);  
		$stmt1->execute();	
		$last_id = $dbCon1->lastInsertId();
		$regstatus = $stmt1->rowCount();
		
		//Insert Address
		$regquery = "INSERT INTO code8_customeraddresses (custid) VALUES ('$last_id')";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($regquery);  
		$stmt1->execute();				
		$regstatus = $stmt1->rowCount();
	
		if($regstatus==1){
			$_SESSION["SESS_CUSTOMER_ID"]	= $last_id;
			$_SESSION["SESS_CUSTOMER_TYPE"]	= 1;		
		
			$myaccup_query = "UPDATE code8_customeraddresses SET `address1`='$address1',`address2`='$address2',`towncity`='$towncity',`statecounty`='$statecounty',`country`='$country',`postalzip`='$postalzip' WHERE custid=$last_id";					
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($myaccup_query);  
			$stmt1->execute();
			$res1 = $stmt1->rowCount();		
						
			$updquery = "UPDATE code8_cart SET guestid='0', customerid = REPLACE(customerid, '0', '$last_id') WHERE guestid='$guestid' AND status=1";
			
			$database1 = new Database();
			$dbCon = $database1->getConnection();
			$stmt = $dbCon->prepare($updquery);  
			$stmt->execute();
			
			$cartprod_que = "SELECT * from code8_cart WHERE status=1 AND customerid='$last_id'";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($cartprod_que);  
			$stmt1->execute();	
			$cartcount = $stmt1->rowCount();
			$cartprod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);							
			foreach($cartprod_res as $result){	
				$id 		  = $result['id'];
				$customerid   = $result['customerid'];
				$prodid 	  = $result['prodid'];
				$quantity 	  = $result['quantity'];
				$price 		  = $result['price'];
				$tax_price 	  = $result['tax'];	
				$ship_price   = $result['shipping'];	
				$colorname    = $result['colorname'];
				$sizename 	  = $result['sizename'];
				$currencycode = $result['currencycode'];
				$sizeid 	  = $result['size'];
				$colorid 	  = $result['color'];
									
				$prod_res 	= getProductData($prodid);			
				$prodname 	= addslashes($prod_res['prodtitle']);
																
				$query3 = "SELECT * from code8_cartproducts WHERE status=1 AND customerid='$customerid' AND prodid='$prodid'";			
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($query3);  
				$stmt1->execute();	
				$count3 = $stmt1->rowCount();
				
				if($count3==0){					
					$query34 = "INSERT INTO code8_cartproducts(`invoice`, `orderid`, `cartid`,`customerid`,`prodid`,`prodname`, `product_price`, `quantity`, `status`, `remarks`, `date`, `paystatus`,`billaddress`,`shipaddress`,`tax`,`shipping`,`currencycode`,`colorname`,`sizename`,`colorid`,`sizeid`) VALUES ('','','$id','$customerid','$prodid','$prodname','$price','$quantity','1','',NOW(),'','','','$tax_price','$ship_price','$currencycode','$colorname','$sizename','$colorid','$sizeid')";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($query34);  
					$stmt1->execute();				
				} else {				
					$query34 = "UPDATE code8_cartproducts SET `quantity`='$quantity' WHERE status=1 AND customerid='$customerid' AND prodid='$prodid'";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($query34);  
					$stmt1->execute();
				}
			}	
		}	
		if($res1 == 1){			
			echo "<script>window.location='checkout-review.php'</script>";
		}	
	} else {
		$myaccup_query = "UPDATE code8_customeraddresses SET `address1`='$address1',`address2`='$address2',`towncity`='$towncity',`statecounty`='$statecounty',`country`='$country',`postalzip`='$postalzip' WHERE custid=$last_id";				
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($myaccup_query);  
		$stmt1->execute();
		$res1 = $stmt1->rowCount();
		if($res1 == 1){			
			echo "<script>window.location='checkout-review.php'</script>";
		}		
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
		echo "<script>window.location='checkout-review.php'</script>";
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
									<label>Full Name</label><p><?php echo $custinfo['fullname']; ?></p>
								</div>
								<div class="form-group">
									<label>Email</label><p><?php echo $custinfo['email']; ?></p>
								</div>
								<div class="form-group">
									<label>Mobile</label><p><?php echo $custinfo['mobile']; ?></p>
								</div>
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
									<div class="inputbox"><input type="text" required placeholder="Full Name" name="fullname" id="fullname" value="<?php echo $myaddrres['fullname']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" required placeholder="Mobile" name="mobile" id="mobile" value="<?php echo $myaddrres['mobile']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="email" required placeholder="Email" name="email" id="email" value="<?php echo $myaddrres['email']; ?>" class="form-control"></div>
								</div>
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
							$gov_que = "SELECT * from code8_countries";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$countval= $gov_result['id'];
							?>
							<option  <?php if($contryval==$countval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['title']; ?></option>
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
							$gov_que = "SELECT * from code8_countries";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($gov_que);
							$stmt1->execute();	
							$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($gov_res as $gov_result){
								$countval= $gov_result['id'];
							?>
							<option  <?php if($stateval==$countval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['title']; ?></option>
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
								$gov_que = "SELECT * from code8_countries";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection(); 
								$stmt1 = $dbCon1->prepare($gov_que);
								$stmt1->execute();	
								$gov_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($gov_res as $gov_result){
									$bcountval= $gov_result['id'];
								?>
								<option  <?php if($bcontryval==$bcountval) { echo "selected"; } ?> value="<?php echo $gov_result['id']; ?>"><?php echo $gov_result['title']; ?></option>
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
							
					if($loginid!=""){
						$cartprod_que = "SELECT * from code8_cartproducts where status=1 AND customerid='$loginid'";
					} else {
						$cartprod_que = "SELECT * from code8_cart where status=1 AND (guestid='$guestid')";
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
						$cartid 	= $cartprod_result['id'];
						$tax 		= $cartprod_result['tax'];
						$shipping 	= $cartprod_result['shipping'];
						$grandtotal = $subtotal+$tax+$shipping;
						
						if($loginid!=""){
							$sizeid  = $cartprod_result['sizeid'];
							$colorid = $cartprod_result['colorid'];
						} else {
							$sizeid  = $cartprod_result['size'];
							$colorid = $cartprod_result['color'];
						}
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
										<div class="product-price-btn"><div class="product-price"><?php echo number_format(($sprod_price*$cartprod_result['quantity']),3); ?> <?php echo $currencycode; ?></div></div>
										<div class="size-color-name">
											<div class="size-s">Size : <?php echo getSize($sizeid); ?></div>
											<div class="color-name">Color : <?php echo getColor($colorid); ?></div>
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
                                                                <div class="summary-dtl"><span id="product_cost"><?php echo number_format($subtotal,3); ?> </span><span class="currency"><?php echo $currencycode; ?></span></div>
							</li>
							<li>
								<label>Taxes</label>
								<input type="hidden" name="taxes" id="taxes" value="<?php echo $tax; ?>">
                                                                <div class="summary-dtl"> &nbsp;<span class="tax"><?php echo number_format($tax,3); ?> </span>&nbsp;<span class="currency"><?php echo $currencycode; ?></span></div>
							</li>
							<li>
								<label>Delivery Charges</label>
								<input type="hidden" name="delivery" id="delivery" value="<?php echo $shipping; ?>">
                                                                <div class="summary-dtl shipping"><span id="delcharge"><?php echo $shipping.' '; ?> </span> &nbsp;<span class="currency"><?php echo $currencycode; ?></span></div>
							</li>
							<li>
								<label><strong>Total</strong></label>
                                                                <div class="summary-dtl"><strong id="grandtotal"><?php echo number_format($grandtotal,3); ?></strong><strong>&nbsp;<span class="currency"> <?php echo $currencycode; ?></span></strong></div>
							</li>							
						</ul>
                                            
						<div class="pay-through">
							<p>Pay through</p>
							<ul class="unstyled">
								<li class="black">
                                                                    <input class="styled-checkbox" id="p_net"  name="payment" type="radio" value="knet" checked> 
									<label for="p_net"><span><img src="images/knet.jpg" alt="kent" ></span></label>
								</li>
<!--								<li class="white">
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
								</li>-->
                                                                <!-- <?php 	
                                            if($_SESSION['COUNTRY']==1 && $_SESSION['COD_FLAG']==1){ 
                                               ?>
                                                <li class="gold">
                                                    <input class="styled-checkbox" id="p_cod" name="payment1" type="radio" value="cod" checked>
									<label for="p_cod"><span><img src="images/paypal.jpg" alt="cod"></span></label>
								</li>
                                           <?php  }
                                            ?> -->
                                                                
							</ul>
						</div>
						
					</div>	<?php if($subtotal!=0){ ?>
							<div class="order-div">
							<!--<a href="k-net.php" class="button fullwidth" onclick="return validateAddr()">Pay Now</a>-->
								<form name="" method="post" action="k-net_checkout.php">
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

<a class="on-addtocart-btn shippingaddress" href="javascript:void(0);" data-src="#shippingaddress" data-fancybox=""></a>
<div id="shippingaddress" class="popup-hidden animated-modal added-cart-model shippingaddress">
	<p class="anim1"><strong>Please fill shipping address!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<a class="on-addtocart-btn billingaddress" href="javascript:void(0);" data-src="#billingaddress" data-fancybox=""></a>
<div id="billingaddress" class="popup-hidden animated-modal added-cart-model billingaddress">
	<p class="anim1"><strong>Please fill Billing address!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<a class="on-addtocart-btn invaliddestiny" href="javascript:void(0);" data-src="#invaliddestiny" data-fancybox=""></a>
<div id="invaliddestiny" class="popup-hidden animated-modal added-cart-model invaliddestiny">
	<p class="anim1"><strong>Invalid Destination!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<script>
function validateAddr(){
			
	var address1 		= $('#address1').val();
	var address2		= $('#address2').val();
	var country		= $('#country').val();
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
		
	if(address1=="" && address2=="" && country=="" && statecounty=="" && towncity=="" && postalzip==""){	
		$(".shippingaddress").trigger("click");
		return false;
	} else if(baddress1=="" && baddress2=="" && bcountry=="" && bstatecounty=="" && btowncity=="" && bpostalzip==""){
		$(".billingaddress").trigger("click");
		return false;
	} /*else if(shippingpirce=="0"){		
		$(".invaliddestiny").trigger("click");
		return false;
	}	*/	
}

<?php if($loginid!=""){ ?>
$("#p_address").click(function() {
	var checkval = $('#p_address').val();
	var i=<?php echo $loginid; ?>;
	if(i!=""){	
		if(checkval==1) {					
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
	}	
});
<?php } ?>

$(document).ready(function(){
	//$("#country").change(function() {
	$(document).on('change','#country',function(){	
		var country = $('#country').val();
		$.ajax({
			type:"POST",
			data:"country="+country,
			url:"get_country_data.php",
			success:function(data)
                        {		
                       var res= JSON.parse(data)    ;
                       var product_cost=$("#product_cost").text();
				$(".currency").html(res[0]['currencycode']);
				$(".tax").html(res[0]['taxes']);				
				$("#delcharge").html(res[0]['shipping']);
                                
				$("#grandtotal").html("");
				$("#grandtotal").html(parseInt(product_cost)+parseInt(res[0]['taxes'])+parseInt(res[0]['shipping']));
                                
                                
			}
		});	
                
	});

	//$("#statecounty").change(function() {
	$(document).on('change','#statecounty',function(){	
		var state = $('#statecounty').val();
		$.ajax({
			type:"POST",
			data:"state="+state,
			url:"getcities.php",
			success:function(data)
			{				
				$("#towncity").html(data);		
			}
		});	
	});

	//$("#bcountry").change(function() {
	/*$(document).on('change','#bcountry',function(){
		var country = $('#bcountry').val();
		$.ajax({
			type:"POST",
			data:"country="+country,
			url:"getstates.php",
			success:function(data)
			{				
				$("#bstatecounty").html(data);		
			}
		});	
	});*/

	//$("#bstatecounty").change(function() {
	/*$(document).on('change','#bstatecounty',function(){
		var state = $('#bstatecounty').val();
		$.ajax({
			type:"POST",
			data:"state="+state,
			url:"getcities.php",
			success:function(data)
			{				
				$("#btowncity").html(data);		
			}
		});	
	});*/
});

//$(document).ready(function(){
//	var warestate 	= $('#warestate').val();
//	var warecity 	= $('#warecity').val();
//	var warezip 	= $('#warezip').val();
//	var warecountry = $('#warecountry').val();
//	var shipstate 	= $('#shipstate').val();
//	var shipcity 	= $('#shipcity').val();
//	var shipzip 	= $('#shipzip').val();
//	var shipcountry = $('#shipcountry').val();
//	
//	if(shipcountry!="KW"){
//		$.ajax({
//			type:"POST",
//			data:"warestate="+warestate+"&warecity="+warecity+"&warezip="+warezip+"&warecountry="+warecountry+"&shipstate="+shipstate+"&shipcity="+shipcity+"&shipzip="+shipzip+"&shipcountry="+shipcountry,
//			url:"dhl_runprice_quote.php",
//			success:function(data)
//			{				
//				alert(data);//delivery
//				if(data=='Invalid Destination'){
//					$('#delivery').text('0');
//					$('#delivery').val('0');
//					$('#delcharge').text('0');
//				} else {
//					$('#delivery').text(data);
//					$('#delcharge').text(data);
//				}						
//			}
//		});	
//	}
//});
</script>
<?php include "footer.php"; ?>
