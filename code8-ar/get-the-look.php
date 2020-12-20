<?php include "header.php"; ?>
<?php							
$getlook_que = "SELECT * from code8_getthelook where id=1";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($getlook_que);  
$stmt1->execute();	
$getlook_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
$lookprods 	 = $getlook_res['prods'];

$countryid = $_SESSION["COUNTRY"];
//Get Currency Code
$countrydet   = getCountry($countryid);
$currencycode = $countrydet['currencycode'];

//Get Tax & Shipping Price
$tax_que = "SELECT * from code8_taxesandshipping where country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($tax_que);  
$stmt1->execute();	
$tax_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$tax_price = $tax_res['taxes'];
$ship_price = $tax_res['shipping'];	
	
//Add product to Cart
if(isset($_POST['submit'])){
	
	//user session ID
	$loginid = $_SESSION['SESS_CUSTOMER_ID']; 
	if($loginid!=""){
		include 'auth.php';
	}
	if(isset($_COOKIE['guestid'])){	
		$cookieguestid = $_COOKIE['guestid'];
	}	
	
	$size 		= $_POST['selsize'];
	$color 		= $_POST['color'];
	$qty 		= $_POST['quantity'];
	$tax_price 	= $_POST['tax_price'];	
	$ship_price = $_POST['ship_price'];	
	$colorname 	= getColor($color);
	$sizename 	= getSize($size);
	$prod_id 	= $_POST['prod_id'];
	$pid 		= $prod_id;
	
	//Get Product Price
	$proprice_que = "SELECT * from code8_prodprices where prodid='$pid' AND country='$countryid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($proprice_que);  
	$stmt1->execute();	
	$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	$prod_price = $proprice_res['price'];
	
	if($prod_id !=""){							
		if($loginid!=""){
			//echo "1"; die;				
			$guest_query2 = "SELECT * FROM code8_cart WHERE customerid=$loginid AND prodid='$pid' AND status=1";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($guest_query2);  
			$stmt1->execute();	
			$guest_res2 = $stmt1->fetch(PDO::FETCH_ASSOC);				
			$DBcustomer = $guest_res2['customerid'];
			$qtyid2 	= $guest_res2['quantity'];
			$incqty2 	= $qtyid2+$qty;
			$Dbprodid2 	= $guest_res2['prodid'];
			$cacolor 	= $guest_res2['color'];
			$csize 		= $guest_res2['size'];				
						
			if($pid==$Dbprodid2 && $color==$cacolor && $size==$csize){					
				$updatecartquery = "UPDATE code8_cart SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($updatecartquery);
				$stmt1->execute();						
					
				$updatecartprodquery = "UPDATE code8_cartproducts SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($updatecartprodquery);  
				$stmt1->execute();				
			} else {					
				$addcartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`price`,`tax`,`shipping`) VALUES ('','$loginid','$cookieguestid','$pid','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($addcartquery);  
				$stmt1->execute();
				$lastinsid = $dbCon1->lastInsertId();
				
				$prod_res 	= getProductData($pid);
				$prodname 	= $prod_res['prodtitle'];
				$color_name	= getColor($cacolor);	
				$size_name	= getSize($csize);
				
				$addcartquery = "INSERT INTO code8_cartproducts (`id`,`cartid`,`customerid`,`guestid`,`prodid`,`prodname`,`sizeid`,`colorid`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`product_price`,`tax`,`shipping`) VALUES ('','$lastinsid','$loginid','$cookieguestid ','$pid','$prodname','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')"; 
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($addcartquery);  
				$stmt1->execute();	
			}			
		} else if(!isset($_COOKIE['guestid'])){
			//echo "2"; die;				
			$guestquery = "INSERT INTO code8_guest (`id`,`date`) VALUES ('',NOW())";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($guestquery);  
			$stmt1->execute();
			$guestid = $dbCon1->lastInsertId();
			
			setcookie('guestid', $guestid);
			setcookie('guestid', $guestid, time()+ (86400));	
			$cookieguestid = $guestid;
			
			$inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($inscartquery);  
			$stmt1->execute();							
		} else {	
			//echo "3"; die;
			$ginscartquery = "SELECT * FROM code8_cart WHERE guestid=$cookieguestid AND prodid='$pid' AND status=1";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($ginscartquery);  
			$stmt1->execute();
			$guest_res  = $stmt1->fetch(PDO::FETCH_ASSOC);			
			$DBguestid 	= $guest_res['guestid'];
			$qtyid 		= $guest_res['quantity'];
			$cacolor 	= $guest_res['color'];
			$csize 		= $guest_res['size'];				
			$incqty 	= $qtyid+$qty;
			$Dbprodid 	= $guest_res['prodid'];
												
			if($pid==$Dbprodid && $cookieguestid==$DBguestid && $color==$cacolor && $size==$csize){					
				$cginscartquery = "UPDATE code8_cart SET `quantity`='$incqty' WHERE guestid='$cookieguestid' AND prodid='$pid' AND color=$color AND size=$size AND status=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($cginscartquery);  
				$stmt1->execute();													
			} else {					
				$inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($inscartquery);  
				$stmt1->execute();
			}						
		}
		echo '<a class="addtocart"></a>';	
		echo '<script> $(document).ready(function(){ $(".addtocart"); });</script>';		
	}	
}
?>
<section class="innerpages getthelook-main">
	<div class="container clearfix">
		<div class="row">
			<div class="col-lg-5 col-md-5 noha-left-column">
				<div class="product-thumb">
					<div class="get-look-main-img">
						<figure class="pro-img1"><img src="../<?php echo $getlook_res['lookimage']; ?>" alt="Noha Nabil"></figure>
					</div>
					<!--<a href="javascript:void(0);" class="favrt-div" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>-->
					<a href="javascript:void(0);" class="share-link" title="Share This Product" data-fancybox="" data-src="#loginShare" data-animation-duration="700"><span><img src="images/share.png" alt="share"></span></a>
				</div>	
			</div>
			<div class="col-7 col-md-7 getthelook-slider">
				<div class="carousel-main">
					<h3>اختر لونا من فضلك</h3>
					<div class="getthelook-container swiper-container">
						<div class="swiper-wrapper">
						<?php							
						$prod_que = "SELECT * from code8_products where id IN ($lookprods)";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($prod_que);  
						$stmt1->execute();	
						$rowCount = $stmt1->rowCount();		
						$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						if($rowCount>0){
						foreach($prod_res as $prod_result){	
							$prodid = 	$prod_result['id'];
							//Get Product Price
							$proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($proprice_que);  
							$stmt1->execute();	
							$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
							$sprod_price = $proprice_res['price'];
						?>	
							<div class="swiper-slide product-box">
								<div class="product-thumb">
									<div class="product-holder-img"><a href="javascript:void(0);" class="pro-dt-btn product-dtl-btn active" data-url="getlookprods.php?id=<?php echo $prodid; ?>"></a>
										<figure class="pro-img1"><img src="../<?php echo $prod_result['thumimage1']; ?>" alt="products"></figure>
									</div>
									<div class="product-dtl">
										<div class="product-price-btn"><div class="product-price"><?php echo $sprod_price; ?> <?php echo $currencycode; ?></div></div>
										<h2><?php echo $prod_result['prodtitle']; ?></h2>
									</div>
									<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>	
									<a id="moveto_<?php echo $prod_result['id'] ?>" href="javascript:void(0);" class="favrt-div" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>
									<script>
									$(function(){								
										$("[id^='moveto_']").click(function(){
										var i=$(this).attr('id');		
										var arr=i.split("_");
										var i=arr[1];	   	 		
										 $.ajax({
												type:"POST",
												data:"id="+i,
												url:"deleteprods.php?type=addtowishlist&userid=<?php echo $loginid; ?>&removeid=<?php echo $prod_result['id']; ?>",
												success:function(data)
												{				
													location.reload();				
												}
											});		
										});
									});
									</script>
									<?php } else { ?>
										<a href="javascript:void(0);" class="favrtlog-div wishlist" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>
									<?php } ?>									
								</div>
							</div>
						<?php } }  ?>	
						</div>
					</div>
					<div class="getthelook-button-next swiper-button-next"></div>
					<div class="getthelook-button-prev swiper-button-prev"></div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 products-gallery" id="productsGallery">
				<div class="portfolio-slider">
					<div class="contents-load"></div>
					<div class="loader-div"><div class="css-spinner clickable"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><div class="name">Loading...</div></div></div>
				</div>		
				
			</div>	
		</div>
	</div>
</section>
<?php include "footer.php"; ?>