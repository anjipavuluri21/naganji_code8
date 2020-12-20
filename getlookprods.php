<?php 
session_start();
include "connectionpdo.php";
include "functions.php"; 
//Set Country in Session
if($_SESSION["COUNTRY"]==""){
	$_SESSION["COUNTRY"] = "1";
} else {
	$_SESSION["COUNTRY"];
}
$countryid = $_SESSION["COUNTRY"];
//Get Currency Code
$countrydet   = getCountry($countryid);
$currencycode = $countrydet['currencycode'];
$prodid = $_REQUEST['id'];

//Get Tax & Shipping Price
$tax_que = "SELECT * from code8_taxesandshipping where country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($tax_que);  
$stmt1->execute();	
$tax_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$tax_price = $tax_res['taxes'];
$ship_price = $tax_res['shipping'];

$prodet_que = "SELECT * from code8_products where id=$prodid AND status=1";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($prodet_que);  
$stmt1->execute();	
$prodet_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$subcat = $prodet_res['subcat'];
//Get Product Price
$proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($proprice_que);  
$stmt1->execute();	
$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$prod_price = $proprice_res['price'];
 
//Get Customer Details	
$cust_query = "SELECT * FROM code8_customers WHERE id='$loginid' AND status=1";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($cust_query);  
$stmt1->execute();	
$cust_res = $stmt1->fetch(PDO::FETCH_ASSOC);

//Get Stock Details	
$fullstockquery = "SELECT sum(quantity) as totstock FROM code8_stocks WHERE prodid='$prodid'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($fullstockquery);  
$stmt1->execute();	
$fullstocks = $stmt1->fetch(PDO::FETCH_ASSOC);
$fullstocks['totstock'];
if($fullstocks['totstock']==""){
	$totstockqty = 0;
} else {
	$totstockqty = $fullstocks['totstock'];
}

//Get Available Stock Details	
$availstockquery = "SELECT sum(quantity) as totsum FROM code8_cartproducts WHERE prodid='$prodid' AND status='2'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($availstockquery);  
$stmt1->execute();	
$fullstockres = $stmt1->fetch(PDO::FETCH_ASSOC);
$totqty = $fullstockres['totsum'];

?>
<div class="row">
	<div class="col-lg-6 col-md-6">
		<div class="product-gallery">
			<div class="carousel-main">
				<div class="main-img"><img src="get-the-look/BW50FY50DK452-02-01.jpg" alt="Product"/></div>
				<div class="productTwo-container swiper-container">
					<div class="swiper-wrapper">
					<?php							
					$prodimg_que = "SELECT * from code8_prodimages where prodid=$prodid";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($prodimg_que);  
					$stmt1->execute();	
					$prodimg_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
					foreach($prodimg_res as $proding_res){
					?>
						<div class="swiper-slide">
							<div class="product-img" data-fancybox="getthelook" data-src="<?php echo $proding_res['image']; ?>"><img src="<?php echo $proding_res['image']; ?>" alt="Product"/></div>
						</div>
					<?php }	?>
					</div>
				</div>
				<div class="productTwo-button-next swiper-button-next"></div>
				<div class="productTwo-button-prev swiper-button-prev"></div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-6 col-md-6">
	<form name="addtocart" method="post" action="">
	<input type="hidden" name="tax_price" value="<?php echo $tax_price; ?>">
	<input type="hidden" name="ship_price" value="<?php echo $ship_price; ?>">
	<input type="hidden" name="prod_id" value="<?php echo $_REQUEST['id']; ?>">
		<div class="product-detail">
			<div class="product-detail-sub">
				<h2><?php echo $prodet_res['prodtitle']; ?></h2>
				<?php if($totstockqty==0){ ?>
					<p style="color:red"><strong><img src="images/close.png" height="25px" width="25px" alt="Outofstock" style="margin-top: -5px;"> Out of Stock!</strong></p>
				<?php } ?>
				<div class="carousel-main">
					<p>SIZE</p>
					<div class="carousel-sub">
						<div class="sizeTwo-container swiper-container size-link-div">
						<input type="hidden" name="selsize" id="selsize">
							<div class="swiper-wrapper">
							<?php							
							$size_que = "SELECT * from code8_prodcombinations where prodid=$prodid GROUP BY sizes";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($size_que);  
							$stmt1->execute();	
							$size_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($size_res as $size_result){
							?>
								<div class="swiper-slide">
									<a name="size" id="<?php echo $size_result['sizes']; ?>" href="javascript:void(0);" class="size-link"><?php echo getSize($size_result['sizes']); ?></a>
								</div>
							<?php }	?>
							</div>
						</div>
						<div class="sizeTwo-button-next swiper-button-next"></div>
						<div class="sizeTwo-button-prev swiper-button-prev"></div>
					</div>
					<div class="size-guide-div"><a href="#sizeModal" data-fancybox class="size-guide-link">Link to size guide</a></div>
				</div>
				<div class="carousel-main">
					<p>Color</p>
					<div class="carousel-sub color-select">
						<ul class="unstyled color-radios">
						<?php							
						$color_que = "SELECT * from code8_prodcombinations where prodid=$prodid GROUP BY colors";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($color_que);  
						$stmt1->execute();	
						$color_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($color_res as $color_result){
							$color_data = getColorData($color_result['colors']);
							if($color_data['title']=='White'){ ?>
							<style>
								.color-radios li.white .styled-checkbox + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
								.color-radios li.white .styled-checkbox:hover + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
								.color-radios li.white .styled-checkbox:focus + label:before{box-shadow:0 0 0 1px #fff;}
								.color-radios li.white .styled-checkbox:checked + label:before{background:#fff;box-shadow:0 0 0 1px #ccc;}
								.color-radios li.white .styled-checkbox:checked + label:after{color:#000;box-shadow:0 0 0 1px #fff;}
							</style>
						<?php } else { ?>
							<style>
							.color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
							.color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:hover + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
							.color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:focus + label:before{box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
							.color-radios li.<?php echo $color_data['title']; ?> .styled-checkbox:checked + label:before{background:<?php echo $color_data['code']; ?>;box-shadow:0 0 0 1px <?php echo $color_data['code']; ?>;}
							</style>
						<?php } ?>
							<li class="<?php echo getColor($color_result['colors']); ?>">
								<input class="styled-checkbox" id="<?php echo getColor($color_result['colors']); ?>" name="color" type="radio" value="<?php echo ($color_result['colors']); ?>">
								<label for="<?php echo getColor($color_result['colors']); ?>"><span><?php echo getColor($color_result['colors']); ?></span></label>
							</li>
						<?php }	?>	
						</ul>
					</div>
				</div>
				<div class="carousel-main">
					<p>Quantity</p>
					<div class="carousel-sub quantity-select">
						<div class="my-cart-ul-dtl">
							<div class="quantity-control-div plus-minus">
								<a href="javascript:void(0);" class="minus-btn minusBtn">-</a>
								<div class="quantity-control"><input type="text" class="form-control noValue" name="quantity" value="1"></div>
								<a href="javascript:void(0);" class="plus-btn plusBtn">+</a>
							</div></div>
					</div>
				</div>
				<div class="pricekd-favourite">
					<span class="pricekd"><?php echo $prod_price; ?> <?php echo $currencycode; ?></span>
					<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>						
						<a id="movetowish_<?php echo $prodid; ?>" href="javascript:void(0);" class="wishlist-link" title="Favourite">WISHLIST <img src="images/12D9CE31.png" alt="Favourite"></a>
					<?php } else { ?>
						<a href="javascript:void(0);" class="wishlist" title="Favourite">WISHLIST <img src="images/12D9CE31.png" alt="Favourite"></a>
					<?php } ?>
				</div>
				<div class="addtocart-detail">
					<div class="addtocart-div">
						<input <?php if($totstockqty==0){ ?> disabled <?php } ?> class="button"  value="Add to Cart"  type="submit" name="submit" onclick="return checkValidation();">
					</div>
					<ul class="detail-product-more">
					<li>
						<a href="javascript:void(0);" class="dtl-btn">More details <span></span></a>
						<div class="more-detail">
							<?php echo $prodet_res['description']; ?>
							<div class="product-sub-dtl">
								<p>Product code: <?php echo $prodet_res['prodcode']; ?></p>
								<p>Composition: <?php echo $prodet_res['composition']; ?>.</p>
							</div>
							<div class="sub-title">SIZE & FIT</div>
							<div class="product-sub-dtl">
								<?php echo $prodet_res['sizeandfit']; ?>
							</div>
							<div class="sub-title">OTHER</div>
							<div class="product-sub-dtl">
								<?php echo $prodet_res['other']; ?>
							</div>
						</div>
					</li>
					<?php
					$help_que = "SELECT * from code8_helpcontent where id=1";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($help_que);  
					$stmt1->execute();	
					$help_res = $stmt1->fetch(PDO::FETCH_ASSOC);
					?>
					<li>
						<a href="javascript:void(0);" class="dtl-btn"><?php echo $help_res['title']; ?><span></span></a>
						<div class="more-detail">
							<?php echo $help_res['content']; ?>
							<div class="contact-links">
								<div class="contact-lt"><a href="tel:<?php echo $help_res['callus']; ?>"><img src="images/icon-phone.svg" alt="phone"/> <span>Email</span></a></div>
								<div class="contact-rt"><a href="mailto:<?php echo $help_res['email']; ?>"><img src="images/icon-email.svg" alt="email"/> <span>Call</span></a></div>
							</div>
						</div>
					</li>
					<li>
						<a href="javascript:void(0);" class="dtl-btn">Delivery & Returns<span></span></a>
						<div class="more-detail">
						<table cellpadding="0" cellspacing="0" border="0" class="size-guide-table">
							<?php							
							$del_que = "SELECT * from code8_deliveryterms where id!=1 ORDER BY id DESC";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($del_que);  
							$stmt1->execute();	
							$del_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($del_res as $del_result){				
							?>
							<tr>
								<td><?php echo $del_result['termcondition']; ?></td>
								<td><?php echo $del_result['charge']; ?></td>
							</tr>
							<?php } ?>
						</table>
						<?php							
							$del_que1 = "SELECT * from code8_deliveryterms where id=1";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($del_que1);  
							$stmt1->execute();	
							$del_res1 = $stmt1->fetch(PDO::FETCH_ASSOC);
						?>
							<p><?php echo $del_res1['termcondition']; ?></p>
						</div>
					</li>
					<li>
						<a href="#storeModal" data-fancybox data-animation-duration="700" class="find-in-store-btn">Find In Store<span></span></a>
					</li>
				</ul>
				</div>	
			</div>
		</div>
		</form>
	</div>	
</div>

<a class="on-addtocart-btn selsizepop" href="javascript:void(0);" data-src="#selsizepop" data-fancybox=""></a>
<div id="selsizepop" class="popup-hidden animated-modal added-cart-model selsizepop">
	<p class="anim1"><strong>Please select Size!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<a class="on-addtocart-btn selcolorpop" href="javascript:void(0);" data-src="#selcolorpop" data-fancybox=""></a>
<div id="selcolorpop" class="popup-hidden animated-modal added-cart-model selcolorpop">
	<p class="anim1"><strong>الرجاء اختيار اللون
!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>

<script type="text/javascript" src="js/get.the.look.js"></script>
<!--<script type="text/javascript" src="js/sweetalerts.js"></script>-->
<script>
$(function(){
  $('.size-link').click(function(){    
	var selsize	= $(this).attr('id');
	$('#selsize').val(selsize);	
  });
});
function checkValidation(){
	var valsize  = $('#selsize').val();
	var colorcode =$("input[name=color]:checked").length;	
	if(valsize==""){		
		$(".selsizepop").trigger("click");
		return false;
	} else if(colorcode==0) {		  
		$(".selcolorpop").trigger("click");		
		return false;				
	}	
}
</script>