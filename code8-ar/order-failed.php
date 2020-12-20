<?php 
include "header.php"; 
include "auth.php";

if(isset($_GET['paymentId'])){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,'https://apikw.myfatoorah.com/Token');
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'password','username' => 'dessieguila@gmail.com','password' => 'mishari12')));
	$result = curl_exec($curl);
	$error= curl_error($curl);
	$info = curl_getinfo($curl);
	curl_close($curl);
	$json = json_decode($result, true);
	$access_token= $json['access_token'];
	$token_type= $json['token_type'];
	if(isset($_GET['paymentId']))
	{
		$id=$_GET['paymentId'];
	}
	$password= 'mishari12';
	$url = 'https://apikw.myfatoorah.com/ApiInvoices/Transaction/'.$id;
	$soap_do1 = curl_init();
	curl_setopt($soap_do1, CURLOPT_URL,$url );
	curl_setopt($soap_do1, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($soap_do1, CURLOPT_TIMEOUT, 10);
	curl_setopt($soap_do1, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($soap_do1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($soap_do1, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($soap_do1, CURLOPT_POST, false );
	curl_setopt($soap_do1, CURLOPT_POST, 0);
	curl_setopt($soap_do1, CURLOPT_HTTPGET, 1);
	curl_setopt($soap_do1, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Accept: application/json','Authorization: Bearer '.$access_token));
	$result_in = curl_exec($soap_do1);
	$err_in = curl_error($soap_do1);
	$file_contents = htmlspecialchars(curl_exec($soap_do1));
	curl_close($soap_do1);
	$getRecorById = json_decode($result_in, true);
	
	$InvoiceId			=	$getRecorById['InvoiceId'];
	$InvoiceReference	=	$getRecorById['InvoiceReference'];
	$CreatedDate		=	$getRecorById['CreatedDate'];
	$ExpireDate			=	$getRecorById['ExpireDate'];
	$InvoiceValue		=	$getRecorById['InvoiceValue'];
	$Comments			=	$getRecorById['Comments'];
	$CustomerName		=	$getRecorById['CustomerName'];
	$CustomerMobile		=	$getRecorById['CustomerMobile'];
	$CustomerEmail		=	$getRecorById['CustomerEmail'];
	$TransactionDate	=	$getRecorById['TransactionDate'];
	$PaymentGateway		=	$getRecorById['PaymentGateway'];
	$ReferenceId		=	$getRecorById['ReferenceId'];
	$TrackId			=	$getRecorById['TrackId'];
	$TransactionId		=	$getRecorById['TransactionId'];
	$PaymentId			=	$getRecorById['PaymentId'];
	$AuthorizationId	=	$getRecorById['AuthorizationId'];
	$OrderId			=	$getRecorById['OrderId'];
	$TransactionStatus	=	$getRecorById['TransactionStatus'];
	$Error				=	$getRecorById['Error'];
	$PaidCurrency		=	$getRecorById['PaidCurrency'];
	$PaidCurrencyValue	=	$getRecorById['PaidCurrencyValue'];
	$CustomerServiceCharge=	$getRecorById['CustomerServiceCharge'];
	$DueValue			=	$getRecorById['DueValue'];
	$Currency			=	$getRecorById['Currency'];
		
	$addcartquery = "INSERT INTO code8_payments (`id`,`InvoiceId`,`InvoiceReference`,`CreatedDate`,`ExpireDate`,`InvoiceValue`,`Comments`,`CustomerName`,`CustomerMobile`,`CustomerEmail`,`TransactionDate`,`PaymentGateway`,`ReferenceId`,`TrackId`,`TransactionId`,`PaymentId`,`AuthorizationId`,`OrderId`,`TransactionStatus`,`Error`,`PaidCurrency`,`PaidCurrencyValue`,`TransationValue`,`CustomerServiceCharge`,`DueValue`,`Currency`) VALUES ('','$InvoiceId','$InvoiceReference','$CreatedDate','$ExpireDate','$InvoiceValue','$Comments','$CustomerName','$CustomerMobile','$CustomerEmail','$TransactionDate','$PaymentGateway','$ReferenceId','$TrackId','$TransactionId','$PaymentId','$AuthorizationId','$OrderId','$TransactionStatus','$Error','$PaidCurrency','$PaidCurrencyValue','$TransationValue','$CustomerServiceCharge','$DueValue','$Currency')";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($addcartquery);  
	$stmt1->execute();
}
//Get OrderId from Payments
$OrderID = $Comments;

$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($myaddrquery);  
$stmt->execute();	
$myaddrres 	= $stmt->fetch(PDO::FETCH_ASSOC);
$cusdata  	= getCustomerdata($loginid);
$emailid  	= $cusdata['email'];
$fullname 	= $cusdata['fullname'];

//Generate Order ID 
$cartprod_que = "UPDATE code8_cartproducts SET status=3, paystatus=3, orderid='$OrderID', paymentdate=NOW() where status IN (1) AND customerid=$loginid";	
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($cartprod_que);  
$stmt1->execute();

$cartprod_que = "UPDATE code8_cart SET status=3, orderid='$OrderID', paymentdate=NOW() where status IN (1) AND customerid=$loginid";	
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt11 = $dbCon1->prepare($cartprod_que);  
$stmt11->execute();
$regstatus = $stmt11->rowCount();

?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Order <span>Failed</span></h1>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items address-summary">
					<h4>Address Summary</h4>
					<div class="my-cart-items-sub">
						<p><strong>Your payment has been failed.</strong></p>						
						<p><strong>Your order and details are as follows.</strong></p>
						<h3>عنوان الشحن
</h3>
						<p><?php if($myaddrres['ship_area']!=""){ echo $myaddrres['ship_area'].','; } ?> <?php if($myaddrres['ship_street']!=""){ echo $myaddrres['ship_street'].','; } ?> <?php if($myaddrres['ship_building']!=""){ echo $myaddrres['ship_building'].','; } ?> <?php if($myaddrres['ship_appartment']!=""){ echo $myaddrres['ship_appartment'].','; } ?> <?php if($myaddrres['ship_block']!=""){ echo $myaddrres['ship_block'].','; } ?> <?php if($myaddrres['ship_avenue']!=""){ echo $myaddrres['ship_avenue'].','; } ?> <?php if($myaddrres['ship_floor']!=""){ echo $myaddrres['ship_floor']; } ?>. Phone: <?php echo $cusdata['mobile'] ?></p>
						<h3>عنوان الدفع
</h3>
						<p><?php if($myaddrres['bill_area']!=""){ echo $myaddrres['bill_area'].','; } ?> <?php if($myaddrres['bill_street']!=""){ echo $myaddrres['bill_street'].','; } ?> <?php if($myaddrres['bill_building']!=""){ echo $myaddrres['bill_building'].','; } ?> <?php if($myaddrres['bill_appartment']!=""){ echo $myaddrres['bill_appartment'].','; } ?> <?php if($myaddrres['bill_block']!=""){ echo $myaddrres['bill_block'].','; } ?> <?php if($myaddrres['bill_avenue']!=""){ echo $myaddrres['bill_avenue'].','; } ?> <?php if($myaddrres['bill_floor']!=""){ echo $myaddrres['bill_floor']; } ?>.</p>
						<p>Order ID : <strong><?php echo $OrderID; ?></strong><br>
							Transaction Id : <strong>-</strong><br>
							Date : <strong><?php echo $cartprod_result['date']; ?></strong><br>
							Transaction Status : <strong>Failed</strong>
						</p>
						<div class="print-btn"><a href="javascript:void(0);" class="button no-print print-link">Print</a> <a href="listing.php" class="button">Continue Shopping</a></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items cart-summary">
					<h4>ملخص عربة التسوق
</h4>
					<div class="my-cart-items-sub">
					<?php							
					$cartprod_que = "SELECT * from code8_cartproducts where status=3 AND customerid='$loginid' AND orderid='$OrderID'";	
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
								<li><label>Price</label><div class="my-cart-ul-dtl"><strong><?php echo ($sprod_price*$cartprod_result['quantity']); ?> <?php echo $currencycode; ?></strong></div></li>
							</ul>
						</div>
						</div>
						<?php } ?>
						<ul class="summary-detail">
							<li>
								<label>Subtotal</label>
								<div class="summary-dtl"><?php echo $subtotal; ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Taxes</label>
								<div class="summary-dtl"><?php echo $tax; ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label>Delivery Chanrges</label>
								<div class="summary-dtl"><?php echo $shipping; ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label><strong>Total</strong></label>
								<div class="summary-dtl"><strong><?php echo $grandtotal; ?> <?php echo $currencycode; ?></strong></div>
							</li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>