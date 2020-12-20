<?php include "header.php"; ?>
<?php include "auth.php"; ?>
<?php
$loginid = $_SESSION['SESS_CUSTOMER_ID'];
if(isset($_POST['submit']))
{			
	$password  = md5($_POST['password']);
	$npassword = md5($_POST['npassword']);			
	$cpassword = md5($_POST['cpassword']);
	$spassword = ($_POST['cpassword']);
		
	if($npassword==$cpassword){
		
		$myaccquery = "SELECT * from code8_customers where id='$loginid' AND status=1";
		$database1 = new Database();
		$dbCon = $database1->getConnection();
		$stmt = $dbCon->prepare($myaccquery);  
		$stmt->execute();	
		$myaccres = $stmt->fetchAll(PDO::FETCH_ASSOC);	
		foreach($myaccres as $myaccres_result)				
		{			
			$db_password = $myaccres_result['password'];					
			if($password==$db_password)
			{								
				$login_query2 = "UPDATE code8_customers SET password='$cpassword', secretcode='$spassword' where id=$loginid";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query2);  
				$stmt1->execute();
				
				echo "<script>window.location='change-password.php?status=passsuccess'</script>";
			} else {
				echo "<script>window.location='change-password.php?status=oldpassnotmatch'</script>";	
			}						
		}					
	} else {
		echo "<script>window.location='change-password.php?status=passnotmatch'</script>";			
	}	
}
if($_REQUEST[status]=='passnotmatch'){
	$status = "Confirm Password not matching!!";
} else if($_REQUEST[status]=='passsuccess'){
	$status = "Password changed successfully!!";
} else if($_REQUEST[status]=='oldpassnotmatch'){
	$status = "Old password not matching!!";
}
?>
<section class="innerpages">
	<div class="container clearfix">
		<p align="center"><span align="center" style="color:red"><?php echo $status; ?></span></p>
		<div class="row" id="ele2">
			<div class="col-lg-12 col-md-12">
				<h1 class="text-center fullwidth">Change <span>Password</span></h1>
			</div>
			<form name="change-password" method="post" autocomplete="off">
			<div class="col-lg-8 col-md-8 col-sm-7 mycart-column my-account-left">
				<div class="profile-left">
					<div class="mycart-sub">	
						<div class="checkout-sub">
							<div class="password-change">
								<div class="form-group">
									<div class="inputbox">
									<input type="password" required id="" name="password" placeholder="Old Password" class="form-control" /></div>
								</div>
								<div class="form-group">
									<div class="inputbox">
									<input type="password" required id="" name="npassword" placeholder="New Password" class="form-control" /></div>
								</div>
								<div class="form-group">
									<div class="inputbox">
									<input type="password" requireds id="" name="cpassword" placeholder="Confirm Password" class="form-control" /></div>
								</div>							
								<div class="change-div"><button class="button" name="submit" type="submit">Change Password</button></div>
							</div>
						</div>
					</div>	
				</div>
			</div>
			</form>
			<div class="col-lg-4 col-md-4 col-sm-5 mycart-column my-account-right">
				<a href="javascript:void(0);" class="profile-mobile-link"></a>
				<div class="profile-right">
					<div class="mycart-sub">
						<ul class="profile-links">
							<li><a href="my-account.php">My Profile</a></li>
							<li><a href="order-histotry.php">My Order History</a></li>
							<li><a href="address.php">My Address</a></li>
							<li><a href="wishlist.php">My Wishlist</a></li>
							<li><a href="change-password.php" class="active">Change Password</a></li>
						</ul>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<?php include "footer.php"; ?>