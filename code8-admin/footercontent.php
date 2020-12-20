<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title 			= $_POST['title'];	
	$titlear 		= $_POST['titlear'];	
	$google 		= $_POST['google'];	
	$facebook 		= $_POST['facebook'];		
	$twitter 		= $_POST['twitter'];		
	$linkedin 		= $_POST['linkedin'];		
	$instagram 		= $_POST['instagram'];		
	$address 		= $_POST['address'];		
	$addressar 		= $_POST['addressar'];		
	$contactemail 	= $_POST['contactemail'];		
	$simage			= $_FILES['storeimage']['name'];
	$fimage			= $_FILES['footerimage']['name'];
		
	if($simage!="")
	{			
		$name1 = pathinfo($_FILES['storeimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['storeimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['storeimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8s'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['storeimage']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_footercontent SET storeimage='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res11 = $stmt1->rowCount();	
			}
		}
	} 
	
	if($fimage!="")
	{			
		$name1 = pathinfo($_FILES['footerimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['footerimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['footerimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8f'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['footerimage']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_footercontent SET footerimage='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res1 = $stmt1->rowCount();	
			}
		}
	} 
	
	$login_query = "UPDATE code8_footercontent SET title='$title', titlear='$titlear',google='$google', facebook='$facebook', twitter='$twitter', instagram='$instagram', linkedin='$linkedin', address='$address', addressar='$addressar', contactemail='$contactemail' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();		
		
	if($res == 1 || $res1 == 1|| $res11 == 1){
		header("location:footercontent.php?msg=success");		
	} else {		
		header("location:footercontent.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Footer Content</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_footercontent where id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($banner_que);  
				$stmt1->execute();	
				$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
			?>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Footer Content</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="<?php echo $about_res['title'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="storeimage" id="storeimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 1920 X 800px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['storeimage']!=""){ ?>
									<img src="../<?php echo $about_res['storeimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Google+<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="google" id="google" required="required" value="<?php echo $about_res['google'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Facebook<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="facebook" id="facebook" required="required" value="<?php echo $about_res['facebook'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Twitter<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="twitter" id="twitter" required="required" value="<?php echo $about_res['twitter'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Instagram<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="instagram" id="instagram" required="required" value="<?php echo $about_res['instagram'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Linked In<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="linkedin" id="linkedin" required="required" value="<?php echo $about_res['linkedin'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="address" id="address" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['address'] ?></textarea>
						</div>
                     </div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="addressar" id="addressar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['addressar'] ?></textarea>
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Email<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="contactemail" id="contactemail" required="required" value="<?php echo $about_res['contactemail'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Footer Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="footerimage" id="footerimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 2050 X 904px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['footerimage']!=""){ ?>
									<img src="../<?php echo $about_res['footerimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>									  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
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
	CKEDITOR.replace('address');
	CKEDITOR.replace('addressar', {	language:'ar'});	
</script>