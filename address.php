<?php include "header.php"; ?>
<?php include "auth.php"; ?>
<?php
	$loginid = $_SESSION['SESS_CUSTOMER_ID'];
	$myaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($myaddrquery);  
	$stmt->execute();	
	$myaddrres = $stmt->fetch(PDO::FETCH_ASSOC);	
?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">My <span>Address</span></h1>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-7 mycart-column my-account-left">
				<div class="profile-left">
					<div class="my-cart-items-sub address-review">
						<div class="checkout-sub address-sub-div">
							<h3>Shipping Address</h3>
							<form name="" method="post" action="profileupdate.php">
							<div class="myprofile-main">
							<div class="profiledata">
								<div class="form-group">
									<label>Area </label><p><?php echo $myaddrres['ship_area']; ?> </p>
								</div>
								<div class="form-group">
									<label>Street </label><p><?php echo $myaddrres['ship_street']; ?></p>
								</div>
								<div class="form-group">
									<label>Building No</label><p><?php echo $myaddrres['ship_building']; ?></p>
								</div>
								<div class="form-group">
									<label>Apartment No</label><p><?php echo $myaddrres['ship_appartment']; ?></p>
								</div>
								<div class="form-group">
									<label>Block</label><p><?php echo $myaddrres['ship_block']; ?></p>
								</div>
								<div class="form-group">
									<label>Avenue</label><p><?php echo $myaddrres['ship_avenue']; ?></p>
								</div>
								<div class="form-group">
									<label>Floor No</label><p><?php echo $myaddrres['ship_floor']; ?></p>
								</div>						
								<div class="change-div"><a href="javascript:void(0);" class="button change-btn">Change</a></div>
							</div>					
							<div class="profileform">
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Area" name="ship_area" value="<?php echo $myaddrres['ship_area']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Street" name="ship_street" value="<?php echo $myaddrres['ship_street']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Building No" name="ship_building" value="<?php echo $myaddrres['ship_building']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Apartment No" name="ship_appartment" value="<?php echo $myaddrres['ship_appartment']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Block" name="ship_block" value="<?php echo $myaddrres['ship_block']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Avenue / Judda" name="ship_avenue" value="<?php echo $myaddrres['ship_avenue']; ?>" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" placeholder="Floor No" name="ship_floor" value="<?php echo $myaddrres['ship_floor']; ?>" class="form-control"></div>
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
							<form name="" method="post" action="profileupdate.php">
							<div class="myprofile-main">
							<div class="profiledata">
								<div class="form-group">
									<label>Area </label><p><?php echo $myaddrres['bill_area']; ?> </p>
								</div>
								<div class="form-group">
									<label>Street </label><p><?php echo $myaddrres['bill_street']; ?></p>
								</div>
								<div class="form-group">
									<label>Building No</label><p><?php echo $myaddrres['bill_building']; ?></p>
								</div>
								<div class="form-group">
									<label>Apartment No</label><p><?php echo $myaddrres['bill_appartment']; ?></p>
								</div>
								<div class="form-group">
									<label>Block</label><p><?php echo $myaddrres['bill_block']; ?></p>
								</div>
								<div class="form-group">
									<label>Avenue</label><p><?php echo $myaddrres['bill_avenue']; ?></p>
								</div>
								<div class="form-group">
									<label>Floor No</label><p><?php echo $myaddrres['bill_floor']; ?></p>
								</div>
								<?php if($myaddrres['sameasshipaddr']==0){ ?>	
									<div class="change-div"><a href="javascript:void(0);" class="button change-btn">Change</a></div>
								<?php } ?>	
							</div>					
							<div class="profileform">
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_area" value="<?php echo $myaddrres['bill_area']; ?>" placeholder="Area" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_street" value="<?php echo $myaddrres['bill_street']; ?>" placeholder="Street" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_building" value="<?php echo $myaddrres['bill_building']; ?>" placeholder="Building No" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_appartment" value="<?php echo $myaddrres['bill_appartment']; ?>" placeholder="Apartment No" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_block" value="<?php echo $myaddrres['bill_block']; ?>" placeholder="Block" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_avenue" value="<?php echo $myaddrres['bill_avenue']; ?>" placeholder="Avenue / Judda" class="form-control"></div>
								</div>
								<div class="form-group">
									<div class="inputbox"><input type="text" name="bill_floor" value="<?php echo $myaddrres['bill_floor']; ?>" placeholder="Floor No" class="form-control"></div>
								</div>
								<div class="change-div"><button class="button" type="submit" name="updatebilladdress">UPDATE</button> <a href="javascript:void(0);" class="button closebutton">CLOSE</a></div>
							</div>
							</div>
							</form>	
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-5 mycart-column my-account-right">
				<a href="javascript:void(0);" class="profile-mobile-link"></a>
				<div class="profile-right">
					<div class="mycart-sub">
						<ul class="profile-links">
							<li><a href="my-account.php">My Profile</a></li>
							<li><a href="order-histotry.php">My Order History</a></li>
							<li><a href="address.php" class="active">My Address</a></li>
							<li><a href="wishlist.php">My Wishlist</a></li>
							<li><a href="change-password.php">Change Password</a></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$("#p_address").click(function() {
	var checkval = $('#p_address').val();		
	if(checkval==1) {	
		var i=<?php echo $loginid; ?>;		
		$.ajax({
			type:"POST",
			data:"id="+i,
			url:"sameasshipaddr.php?type=sameasship",
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
			url:"sameasshipaddr.php?type=uncheck",
			success:function(data)
			{				
				location.reload();				
			}
		});	
	}	 
});
</script>
<?php include "footer.php"; ?>