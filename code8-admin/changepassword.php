<?php 
ob_start();
require_once('auth.php');
include "header.php"; 
$loginid = $_SESSION["SESS_MEMBER_ID"];
if(isset($_POST['submit']))
{			
	$password  = md5($_POST['password']);			
	$npassword = md5($_POST['npassword']);			
	$cpassword = md5($_POST['cpassword']);
	
	if($npassword==$cpassword){		
		$login_query = "SELECT * from code8_adminuser where id=$loginid";
		$database = new Database();
		$dbCon = $database->getConnection();
		$stmt = $dbCon->prepare($login_query);  
		$stmt->execute();
		$menbanner_res2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($menbanner_res2 as $login_res) {								
			$db_password = $login_res['password'];					
			if($password==$db_password)
			{				
				$login_query2 = "UPDATE code8_adminuser SET password='$cpassword' where id=$loginid";
				$database = new Database();
				$dbCon = $database->getConnection();
				$stmt = $dbCon->prepare($login_query2);  
				$stmt->execute();
				
				echo "<script>alert('Password changed successfully!!')</script>";
			} else {
				echo "<script>alert('Old password do not match!!')</script>";
			}						
		}					
	} else {		
		echo "<script>alert('Confirm password do not match!!')</script>";			
	}
}
if(isset($_POST['profilpic']))
{			
	$pimage1 = $_FILES['image1']['name'];			
	if($pimage1!="")
	{			
		$name1 = pathinfo($_FILES['image1']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);		
		$ext = strtolower(pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION));
		$newfilename = 'bargain1'. round(microtime(true));				
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {			
			$basename1 = $newfilename . '.' . $extension1;
			$blocation1 = "uploads/userprofiles/" . $basename1;
			$target_file1 = "../uploads/userprofiles/" . $basename1;			
			if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1)) {					
				$login_query = "UPDATE code8_adminuser SET profilepic='$blocation1' WHERE id=$loginid";
				$database = new Database();
				$dbCon = $database->getConnection();
				$stmt = $dbCon->prepare($login_query);  
				$stmt->execute();
			}
		}
	}
}

$login_query = "SELECT * from code8_adminuser where id=$loginid";
$database = new Database();
$dbCon = $database->getConnection();
$stmt = $dbCon->prepare($login_query);  
$stmt->execute();
$login_res = $stmt->fetch(PDO::FETCH_ASSOC);	
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3>Profile Settings</h3>
	  </div>			
	</div>
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Change Profile Picture</h2>                    
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
			<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Images<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="file" name="image1" id="image1" accept="image/*" class="form-control" style="padding: 0px; border-width: 0px;">				  
				  <div class="control-group">					
						<div class="controls">
							<div align="left"><br/>
							<?php if($login_res['profilepic']!=""){ ?>
								<img src="../<?php echo $login_res['profilepic'] ?>" width="250px" height="150px"/>
							<?php } ?>										
							</div>	
						</div>
					</div>
				</div>
			</div>	  
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <a href="landingpage.php" class="btn btn-primary">Cancel</a>
				  <button type="submit" name="profilpic" class="btn btn-success">Submit</button>
				</div>
			</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>	
<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Change Password</h2>                    
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
			<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Old Password<span class="required">*</span>
				</label>                        
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="password" name="password" id="password" required="required" class="form-control" style="width: 780px;">
				</div>
			</div>		  
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password<span class="required">*</span>
				</label>                        
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="password" name="npassword" id="npassword" required="required" class="form-control" style="width: 780px;">
				</div>
			</div>		  
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm Password<span class="required">*</span>
				</label>                        
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="password" name="cpassword" id="cpassword" required="required" class="form-control" style="width: 780px;">
				</div>
			</div>		  
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <a href="landingpage.php" class="btn btn-primary">Cancel</a>
				  <button type="submit" name="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>	
  </div>
</div>
<!-- /page content -->

<?php include "footer.php" ?>
<script>
	CKEDITOR.replace('content');	
</script>