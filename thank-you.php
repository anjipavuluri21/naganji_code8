<?php 
include "header.php"; 
include "auth.php";

$OrderID = $_REQUEST['oid'];
$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($myaddrquery);  
$stmt->execute();	
$myaddrres 	= $stmt->fetch(PDO::FETCH_ASSOC);
$cusdata  	= getCustomerdata($loginid);
$emailid  	= $cusdata['email'];
$fullname 	= $cusdata['fullname'];
$customertype = $cusdata['customertype'];

$cartprod_que = "SELECT * from code8_cartproducts where orderid='$OrderID'";	
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($cartprod_que);  
$stmt1->execute();	
$cartcount = $stmt1->rowCount();
$getcart_res = $stmt1->fetch(PDO::FETCH_ASSOC);

$paym_que = "SELECT * from code8_payments where Comments='$OrderID'";	
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($paym_que);  
$stmt1->execute();	
$cartcount = $stmt1->rowCount();
$paym_res = $stmt1->fetch(PDO::FETCH_ASSOC);

?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Order <span>Confirmation</span></h1>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items address-summary">
					<h4>Address Summary</h4>
					<div class="my-cart-items-sub">
						<p><strong>
						<?php 
							if($getcart_res['status']==2){
								echo "Your payment has been successful.";
							} else if($getcart_res['status']==3){
								echo "Your payment has been failed.";
							}
							?>
						</strong></p>
						<p>Please check your email(<?php echo $cusdata['email'] ?>) for reciept. Thank you for shopping at the Code8.</p>
						<p><strong>Your order and shipping details are as follows.</strong></p>
						<h3>Shipping Address</h3>
						<p>
						<?php if($customertype==2){ ?>
							<?php echo getCustomerShipaddress($loginid);  ?> Phone: <?php echo $cusdata['mobile'] ?>
						<?php } else { ?>
							<?php echo getGuestShipaddress($loginid);  ?> Phone: <?php echo $cusdata['mobile'] ?>
						<?php } ?>
						</p>
						<h3>Billing Address</h3>
						<?php if($customertype==2){ ?>
							<p><?php echo getCustomerBilladdress($loginid);  ?></p>
						<?php } else { ?>
							<p><?php echo getGuestBilladdress($loginid) ; ?></p>
						<?php } ?>
						<p>Order ID : <strong><?php echo $OrderID; ?></strong><br>
							Transaction Id : <strong><?php echo $paym_res['TransactionId']; ?></strong><br>
							Date : <strong><?php echo $getcart_res['paymentdate']; ?></strong><br>
							Transaction Status : <strong>
							<?php 
							if($getcart_res['status']==2){
								echo "Success";
							} else if($getcart_res['status']==3){
								echo "Failed";
							}
							?></strong>
						</p>
						<!--<div class="print-btn"><a href="javascript:void(0);" class="button no-print print-link">Print</a> <a href="listing.php" class="button">Continue Shopping</a></div>-->
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items cart-summary">
					<h4>Cart Summary</h4>
					<div class="my-cart-items-sub">
					<?php							
					$cartprod_que = "SELECT * from code8_cartproducts where status IN (2,3) AND customerid='$loginid' AND orderid='$OrderID'";	
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
							<div class="product-th-left">
							<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $cartprod_result['prodid'] ?>" class="pro-dt-btn"></a>
								<figure class="pro-img1"><img src="<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
								<figure class="pro-img2"><img src="<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
							</div>
						</div>
							<div class="product-th-right">
							<h2><a href="product-detail.php?id=<?php echo $cartprod_result['prodid'] ?>"><?php echo $cartproddata['prodtitle']; ?></a></h2>
							<ul class="my-cart-ul">
								<li><label>Size</label>
									<div class="my-cart-ul-dtl">
										<strong><?php echo getSize($cartprod_result['sizeid']); ?></strong>
									</div>
								</li>
								<li><label>Color</label><div class="my-cart-ul-dtl"><strong><?php echo getColor($cartprod_result['colorid']); ?></strong></div></li>
								<li><label>Quantity</label><div class="my-cart-ul-dtl"><strong><?php echo ($cartprod_result['quantity']); ?></strong></div></li>
								<li><label>Price</label><div class="my-cart-ul-dtl"><strong><?php echo number_format($sprod_price*$cartprod_result['quantity'],3); ?> <?php echo $currencycode; ?></strong></div></li>
							</ul>
						</div>
						</div>
						<?php } ?>
						<ul class="summary-detail">
							<li>
								<label>Subtotal</label>
								<div class="summary-dtl"><?php echo number_format($subtotal,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Taxes</label>
								<div class="summary-dtl"><?php echo number_format($tax,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Delivery Charges</label>
								<div class="summary-dtl"><?php echo number_format($shipping,3); ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label><strong>Total</strong></label>
								<div class="summary-dtl"><strong><?php echo number_format($grandtotal,3); ?> <?php echo $currencycode; ?></strong></div>
							</li>
							<!--<li>
								<label>Paid through</label>
								<div class="summary-dtl">KNET</div>
							</li>-->
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php
if($customertype==1){
	unset($_SESSION[SESS_CUSTOMER_ID]);
	unset($_SESSION[SESS_CUSTOMER_TYPE]);
}
?>
<?php include "footer.php"; ?>