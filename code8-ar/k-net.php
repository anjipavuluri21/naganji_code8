<?php 
include "header.php"; 
include "auth.php";

$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($myaddrquery);  
$stmt->execute();	
$myaddrres = $stmt->fetch(PDO::FETCH_ASSOC);
$cusdata = getCustomerdata($loginid);
?>
<!--<section class="innerpages">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Pay <span>Now</span></h1>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items">
					<h4>knet</h4>
					<div class="my-cart-items-sub address-review gold-color-bg">
						<a hr ef="order-confirmation.php" class="k-net-div"><img src="images/knet.png" alt="k net"></a>
						
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mycart-column">
				<div class="my-cart-items">
					<h4>ملخص عربة التسوق
</h4>
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
						
						$json_cartdate['ProductId'] = "";
						$json_cartdate['ProductName'] = $cartproddata['prodtitle'];
						$json_cartdate['Quantity'] = $cartprod_result['quantity'];
						$json_cartdate['UnitPrice'] = number_format($sprod_price,3);
							
						$newdatarray[] = $json_cartdate;	
					?>
						<div class="product-thumb">
							<div class="product-th-left">
								<div class="product-holder-img">
									<figure class="pro-img1"><img src="<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
									<figure class="pro-img2"><img src="<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
								</div>
							</div>
							<div class="product-th-right">
								<div class="product-dtl">							
									<h2><?php echo $cartproddata['prodtitle']; ?></h2>
									<div class="product-price-btn"><div class="product-price"><?php echo ($sprod_price*$cartprod_result['quantity']); ?> <?php echo $currencycode; ?></div></div>
									<div class="size-color-name">
										<div class="size-s">Size : <?php echo getSize($cartprod_result['sizeid']); ?></div>
										<div class="color-name">Color : <?php echo getColor($cartprod_result['colorid']); ?></div>
										<div class="qty-num">Quantity : <?php echo ($cartprod_result['quantity']); ?></div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php 						
						$json_tax['ProductId'] = "";
						$json_tax['ProductName'] = "Tax";
						$json_tax['Quantity'] = "";
						$json_tax['UnitPrice'] = $tax;
						//shipping
						$json_ship['ProductId'] = "";
						$json_ship['ProductName'] = "Shipping";
						$json_ship['Quantity'] = "";
						$json_ship['UnitPrice'] = $shipping;
						?>
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
								<label>رسوم التوصيل
</label>
								<div class="summary-dtl"><?php echo $shipping; ?> <?php echo $currencycode; ?></div>
							</li>
							<li>
								<label><strong>Total</strong></label>
								<div class="summary-dtl"><strong><?php echo number_format($grandtotal,3); ?> <?php echo $currencycode; ?></strong></div>
							</li>							
						</ul>
						<div class="shipping-billing">
							<h3>عنوان الشحن
</h3>
							<p><?php echo getCustomerShipaddress($loginid);  ?> Phone: <?php echo $cusdata['mobile'] ?></p>
							<h3>عنوان الدفع
</h3>
							<p><?php echo getCustomerBilladdress($loginid);  ?>
							
							<?php $jsondata = json_encode($newdatarray);				
							$jsondata = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($newdatarray), ENT_NOQUOTES))
							?>
							</p>							
						</div>
					</div>
				</div><p align="center"><button type="button" id="paymentRedirect"  class="btn btn-success">Click here to Pay</button></p>
			</div>
		</div>
	</div>
</section>-->

<?php
if(isset($_POST['SubmitButton'])){
	//check if form was submitted
	if(empty($_POST['username']) || empty($_POST['password']))
	{
		echo "You did not fill out the required fields.";
		die();  // Note this
	} else {
		
		//Generate Order ID 
		$idag = time();
		$a = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
		$OrderID = 'Code8'.$loginid.$idag;
		$orderid = $OrderID;

		$cartprod_que = "UPDATE code8_cartproducts SET orderid='$OrderID' where status IN (1) AND customerid=$loginid";	
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($cartprod_que);  
		$stmt1->execute();

		$cartprod_que = "UPDATE code8_cart SET orderid='$OrderID' where status IN (1) AND customerid=$loginid";	
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt11 = $dbCon1->prepare($cartprod_que);  
		$stmt11->execute();
		$regstatus = $stmt11->rowCount();
		
		$username=$_POST['username'];
		$password=$_POST['password'];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,'https://apikw.myfatoorah.com/Token');
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'password','username' => $username,'password' =>$password)));
		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		$json = json_decode($result, true);
		
		if(isset($json['access_token']) && !empty($json['access_token'])){
			$access_token= $json['access_token'];
		} else {
			$access_token='';
		}
		if(isset($json['token_type']) && !empty($json['token_type'])){
			$token_type= $json['token_type'];
		} else {
			$token_type='';
		}
		if(isset($json['access_token']) && !empty($json['access_token']))
		{
			$cust_name 		= $cusdata['fullname'];
			$cust_mobile 	= $cusdata['mobile'];
			$cust_email 	= $cusdata['email'];
			$cust_block 	= $myaddrres['ship_block'];
			$cust_street 	= $myaddrres['ship_street'];
			$cust_building 	= $myaddrres['ship_building'];
			
			
			//echo "Token Generated Successfully.<br>";			
			$t= time();
			$name = $cust_name;
			$post_string = '{
				"Comments": "'.$orderid.'",
				"InvoiceValue": "'.$grandtotal.'",
				"CustomerName": "'.$name.'",
				"CustomerBlock": "'.$cust_block.'",
				"CustomerStreet": "'.$cust_street.'",
				"CustomerHouseBuildingNo": "'.$cust_building.'",
				"CustomerCivilId": "",
				"CustomerAddress": "Payment Address",
				"CustomerReference": "'.$t.'",
				"DisplayCurrencyIsoAlpha": "'.$currencycode.'",
				"CountryCodeId": "+965",
				"CustomerMobile": "'.$cust_mobile.'",
				"CustomerEmail": "'.$cust_email.'",
				"DisplayCurrencyId": 3,
				"SendInvoiceOption": 1,
				"InvoiceItemsCreate": [
				  '.$jsondata.' ,				
				  {
					"ProductId": null,
					"ProductName": "Tax",
					"Quantity": 1,
					"UnitPrice": "'.$tax.'"
				  },{
					"ProductId": null,
					"ProductName": "Shipping",
					"Quantity": 1,
					"UnitPrice": "'.$shipping.'"
				  },
				],
			   "CallBackUrl":  "'.$urlpath.'order-confirmation.php",
				"Language": 2,
				 "ExpireDate": "2022-12-31T13:30:17.812Z",
			"ApiCustomFileds": "'.$orderid.'",
			"ErrorUrl": "'.$urlpath.'order-confirmation.php"
			  }';
			  
			$soap_do     = curl_init();
			curl_setopt($soap_do, CURLOPT_URL, "https://apikw.myfatoorah.com/ApiInvoices/CreateInvoiceIso");
			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST, true);
			curl_setopt($soap_do, CURLOPT_POSTFIELDS, $post_string);
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Content-Length: ' . strlen($post_string),  'Accept: application/json','Authorization: Bearer '.$access_token));
			$result1 = curl_exec($soap_do);
			// echo "<pre>";print_r($result1);die;
			$err    = curl_error($soap_do);
			$json1= json_decode($result1,true);
			$RedirectUrl= $json1['RedirectUrl'];
			$ref_Ex=explode('/',$RedirectUrl);
			$referenceId =  $ref_Ex[4];
			curl_close($soap_do);
			// echo '<br><button type="button" id="paymentRedirect"  class="btn btn-success">Click here to Payment Link</button>';
			/*echo'<script type="text/javascript">
			$("#paymentRedirect").click(function(e) {
			window.location="'.$RedirectUrl.'";
			});
			</script>';*/
			echo'<script type="text/javascript">			
				window.location="'.$RedirectUrl.'";			
			</script>';
		} else {			
			print_r("Error: ".$json['error']."<br>Description: ".$json['error_description']);
		}

    }
}

?>
<?php include "footer.php"; ?>