<?php include "header.php"; ?>
<?php include "auth.php"; ?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">طلب <span>التاريخ</span></h1>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-7 mycart-column my-account-left">
				<div class="profile-left">
					<div class="mycart-sub ord-hstr-div">
					<?php							
					$orderprod_que = "SELECT * from code8_cartproducts where status IN (2,3) AND customerid=$loginid  GROUP BY orderid ORDER BY paymentdate DESC";	
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($orderprod_que);  
					$stmt1->execute();	
					$cartcount = $stmt1->rowCount();
					$order_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
					$subtotal = 0;
					$i=1;
					if($cartcount>=1){
					foreach($order_res as $order_result){	
						$orderid = $order_result['orderid'];
						 
						$paym_que = "SELECT * from code8_payments where Comments='$orderid'";	
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($paym_que);  
						$stmt1->execute();	
						$cartcount = $stmt1->rowCount();
						$paym_res = $stmt1->fetch(PDO::FETCH_ASSOC);
					?>
						<div class="order-histotry">
							<a href="javascript:void(0);" class="order-tab <?php if($i==1){ ?>active<?php } ?>"><span class="order-crumb"><?php echo $i; ?>. Order No: <?php echo $orderid; ?></span><span class="order-date"><?php echo date('d-m-Y H:i',strtotime($order_result['paymentdate'])); ?></span><span class="order-date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Order Status: <?php echo getOrderStatus($order_result['orderstatus']); ?></span></a>
							<div class="order-histotry-sub">
							<?php
							$cartprod_que = "SELECT * from code8_cartproducts where status IN (2,3) AND customerid='$loginid' AND orderid='$orderid'";	
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
							$sprod_price = $cartprod_result['product_price'];
							$pricewithqty = $sprod_price*$cartprod_result['quantity'];
							$subtotal+=$pricewithqty;
							$cartid 	= $cartprod_result['id'];
							$tax 		= $cartprod_result['tax'];
							$shipping 	= $cartprod_result['shipping'];
							$grandtotal = $subtotal+$tax+$shipping;	
							?>
								<div class="product-thumb">
									<div class="product-th-left">
										<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $prodid; ?>" class="pro-dt-btn"></a>
											<figure class="pro-img1"><img src="<?php echo $cartproddata['thumimage1']; ?>" alt="products"></figure>
											<figure class="pro-img2"><img src="<?php echo $cartproddata['thumimage2']; ?>" alt="products"></figure>
										</div>
									</div>
									<div class="product-th-right">
										<div class="product-dtl">							
											<h2><?php echo $cartprod_result['prodname']; ?></h2>
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
								<div class="order-div">
									<ul class="order-listing">
										<li><label>Order ID</label><div class="order-dtl"><?php echo $orderid; ?></div></li>
										<li><label>Transaction Id</label><div class="order-dtl"><?php echo $paym_res['TransactionId']; ?></div></li>
										<li><label>Date</label><div class="order-dtl"><?php echo date('d-m-Y H:i',strtotime($order_result['paymentdate'])); ?></div></li>
										<li><label>Payment Status</label><div class="order-dtl"><?php 
										if($order_result['paystatus']==2){
											echo "Success";
										} else if($order_result['paystatus']==3){
											echo "Failed";
										}
										?></div></li>
										<li><label>Order Status</label><div class="order-dtl"><?php echo getOrderStatus($order_result['orderstatus']); ?></div></li>
										<li><label>Total</label><div class="order-dtl"><?php echo $grandtotal; ?> <?php echo $currencycode; ?></div></li>
										<!--<li><label>Paid through</label><div class="order-dtl">KNET</div></li>-->
									</ul>
								</div>
							</div>	
						</div>						
					<?php $i++; } } else { ?>
						<p align="center">لا توجد أوامر!</p>
					<?php } ?>
					</div>	
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-5 mycart-column my-account-right">
				<a href="javascript:void(0);" class="profile-mobile-link"></a>
				<div class="profile-right">
					<div class="mycart-sub">
						<ul class="profile-links">
							<li><a href="my-account.php" class="active">لي الملف الشخصي</a></li>
							<li><a href="order-histotry.php">محفوظات طلبي</a></li>
							<li><a href="address.php">عنواني</a></li>
							<li><a href="wishlist.php">قائمة امنياتي</a></li>
							<li><a href="change-password.php">تغيير كلمة المرور</a></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>