<?php include "header.php"; ?>
<?php include "auth.php"; ?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">My <span>Wishlist</span></h1>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-7 mycart-column my-account-left">
				<div class="profile-left">
					<div class="row">
						<?php
						$wish_que = "SELECT * from code8_wishlist where userid=$loginid";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($wish_que);  
						$stmt1->execute();	
						$wish_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($wish_res as $wish_result){	
							$wishproddata  = getProductData($wish_result['prodid']);	
							$wishprodpricedata = getProductPrice($wish_result['prodid'],$countryid);
						?>
						<div class="col-lg-4 col-md-4 col-sm-6 favourite-product my-account-fav">
							<div class="product-thumb">
								<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $wish_result['prodid'] ?>" class="pro-dt-btn"></a>
									<figure class="pro-img1"><img src="<?php echo $wishproddata['thumimage1']; ?>" alt="products"></figure>
									<figure class="pro-img2"><img src="<?php echo $wishproddata['thumimage2']; ?>" alt="products"></figure>
								</div>
								<div class="product-dtl">
									<div class="product-price-btn"><div class="product-price"><?php echo $wishprodpricedata; ?></div></div>
									<h2><?php echo $wishproddata['prodtitle']; ?></h2>
								</div>
								<a href="product-detail.php?id=<?php echo $wish_result['prodid'] ?>" title="Add to Cart" class="fav-addtocart-item"><span></span></a>
								<a id="deletewish_<?php echo $wish_result['id'] ?>" href="javascript:void(0);" title="Remove Item" class="remove-item"></a>
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
								</script>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-5 mycart-column my-account-right">
				<a href="javascript:void(0);" class="profile-mobile-link"></a>
				<div class="profile-right">
					<div class="mycart-sub">
						<ul class="profile-links">
							<li><a href="my-account.php">My Profile</a></li>
							<li><a href="order-histotry.php">My Order Histotry</a></li>
							<li><a href="address.php">My Address</a></li>
							<li><a href="wishlist.php" class="active">My Wishlist</a></li>
							<li><a href="change-password.php">Change Password</a></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>