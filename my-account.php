<?php include "header.php"; ?>
<?php include "auth.php"; ?>
<?php
	$loginid = $_SESSION['SESS_CUSTOMER_ID'];
	$myaccquery = "SELECT * from code8_customers where id='$loginid' AND status=1";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($myaccquery);  
	$stmt->execute();	
	$myaccres = $stmt->fetch(PDO::FETCH_ASSOC);	
?>
<section class="innerpages">
	<div class="container clearfix">
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">My <span>Profile</span></h1>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-7 mycart-column my-account-left">
				<div class="profile-left">
					<div class="mycart-sub">	
						<div class="checkout-sub">
							<div class="myprofile-main">
								<div class="profiledata">
									<div class="form-group">
										<label>Full Name </label><p><?php echo $myaccres[fullname]; ?></p>
									</div>
									<!--<div class="form-group">
										<label>Last Name </label><p><?php echo $myaccres[lastname]; ?></p>
									</div>-->
									<div class="form-group">
										<label>Email Address</label><p><?php echo $myaccres[email]; ?></p>
									</div>
									<div class="form-group">
										<label>Mobile</label><p><?php echo $myaccres[mobile]; ?></p>
									</div>
									<div class="change-div"><a href="javascript:void(0);" class="button change-btn">CHANGE</a></div>
								</div>	
								<form name="myaccount" method="post" action="profileupdate.php">	
								<div class="profileform">
									<div class="form-group">
										<div class="inputbox"><input type="text" id="" name="fullname" value="<?php echo $myaccres['fullname']; ?>" required placeholder="Full Name" class="form-control" /></div>
									</div>
									<!--<div class="form-group">
										<div class="inputbox"><input type="text" id="" name="" placeholder="Last Name" class="form-control" /></div>
									</div>-->
									<div class="form-group">
										<div class="inputbox"><input type="email" id="" name="email" required placeholder="Email Address" value="<?php echo $myaccres['email']; ?>" class="form-control" /></div>
									</div>
									<div class="form-group">
										<div class="inputbox"><input type="text" id="" name="mobile" value="<?php echo $myaccres['mobile']; ?>" required placeholder="Mobile" class="form-control" /></div>
									</div>
									<div class="change-div">
										<button class="button" name="myaccount" type="submit">UPDATE</button>
									<a href="javascript:void(0);" class="button closebutton">CLOSE</a></div>
								</div>
								</form>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-5 mycart-column my-account-right">
				<a href="javascript:void(0);" class="profile-mobile-link"></a>
				<div class="profile-right">
					<div class="mycart-sub">
						<ul class="profile-links">
							<li><a href="my-account.php" class="active">My Profile</a></li>
							<li><a href="order-histotry.php">My Order History</a></li>
							<li><a href="address.php">My Address</a></li>
							<li><a href="wishlist.php">My Wishlist</a></li>
							<li><a href="change-password.php">Change Password</a></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>