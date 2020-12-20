<?php include "header.php"; ?>
<?php
$id = $_REQUEST['id'];
$decrypted = my_simple_crypt( $id, 'd' );

if(isset($_POST['submit']))
{			
	$npassword = md5($_POST['npassword']);			
	$cpassword = md5($_POST['cpassword']);
	$spassword = ($_POST['cpassword']);
		
	if($npassword==$cpassword){
		
		$myaccquery = "SELECT * from code8_customers where id='$decrypted' AND status=1";
		$database1 = new Database();
		$dbCon = $database1->getConnection();
		$stmt = $dbCon->prepare($myaccquery);  
		$stmt->execute();	
		$myaccres = $stmt->fetchAll(PDO::FETCH_ASSOC);	
		foreach($myaccres as $myaccres_result)				
		{			
			$db_id = $myaccres_result['id'];					
			if($decrypted==$db_id)
			{							
				$login_query2 = "UPDATE code8_customers SET password='$cpassword', secretcode='$spassword' WHERE id='$decrypted'";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query2);  
				$stmt1->execute();
				
				//echo "<script>window.location='recoverpassword.php?status=passsuccess'</script>";
				echo '<a class="confpassmatch"></a>';	
				echo '<script> $(document).ready(function(){ $(".confpassmatch"); });</script>';
			} else {
				//echo "<script>window.location='recoverpassword.php?status=oldpassnotmatch'</script>";	
				echo '<a class="something"></a>';	
				echo '<script> $(document).ready(function(){ $(".something"); });</script>';
			}						
		}					
	} else {
		//echo "<script>window.location='recoverpassword.php?status=passnotmatch'</script>";
		echo '<a class="passnotmatch"></a>';	
		echo '<script> $(document).ready(function(){ $(".passnotmatch"); });</script>';		
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
				<h1 class="text-center fullwidth">Recover <span>Password</span></h1>
			</div>
			<div class="col-lg-3 col-md-3">	
			</div>
			<div class="col-lg-6 col-md-6">			
				<div class="profile-left">
					<div class="mycart-sub">	
						<div class="checkout-sub">
						<form name="change-password" method="post" autocomplete="off">
							<div class="password-change">		
								<div class="form-group">
									<div class="inputbox">
									<input type="password" required id="" name="npassword" placeholder="New Password" class="form-control" /></div>
								</div>
								<div class="form-group">
									<div class="inputbox">
									<input type="password" required id="" name="cpassword" placeholder="Confirm Password" class="form-control" /></div>
								</div>							
								<div class="change-div"><button class="button" name="submit" type="submit">Change Password</button></div>
							</div>
						</div>
						</form>	
					</div>	
				</div>
			</div>
			<div class="col-lg-3 col-md-3">	
			</div>			
		</div>
	</div>
</section>
<?php include "footer.php"; ?>