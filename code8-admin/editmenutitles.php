<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title1 	= $_POST['title1'];
	$title1ar 	= $_POST['title1ar'];
	$title2 	= $_POST['title2'];	
	$title2ar 	= $_POST['title2ar'];		
	$title3 	= $_POST['title3'];		
	$title3ar 	= $_POST['title3ar'];		
	$title4 	= $_POST['title4'];		
	$title4ar 	= $_POST['title4ar'];		
	$title5 	= $_POST['title5'];		
	$title5ar 	= $_POST['title5ar'];		
	$title6 	= $_POST['title6'];		
	$title6ar 	= $_POST['title6ar'];		
	$title7 	= $_POST['title7'];		
	$title7ar 	= $_POST['title7ar'];

	$dimage			= $_FILES['desiggnerwearimage']['name'];	
	$cimage			= $_FILES['collectionimage']['name'];	
	$wimage			= $_FILES['womenimage']['name'];	
	
	if($cimage!="")
	{			
		$name1 = pathinfo($_FILES['collectionimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['collectionimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['collectionimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code81'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['collectionimage']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_menutitles SET collectionimage='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	}
	if($dimage!="")
	{			
		$name1 = pathinfo($_FILES['desiggnerwearimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['desiggnerwearimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['desiggnerwearimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code82'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename12 = $newfilename .'.'. $extension1;
			$blocation12 = "uploads/adminfiles/" . $basename12;
			$target_file12 = "../uploads/adminfiles/" . $basename12;
			if (move_uploaded_file($_FILES['desiggnerwearimage']['tmp_name'], $target_file12)) {	
				$login_query = "UPDATE code8_menutitles SET desiggnerwearimage='$blocation12' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	}
	if($wimage!="")
	{			
		$name1 = pathinfo($_FILES['womenimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['womenimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['womenimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code83'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename13 = $newfilename .'.'. $extension1;
			$blocation13 = "uploads/adminfiles/" . $basename13;
			$target_file13 = "../uploads/adminfiles/" . $basename13;
			if (move_uploaded_file($_FILES['womenimage']['tmp_name'], $target_file13)) {	
				$login_query = "UPDATE code8_menutitles SET womenimage='$blocation13' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	}
			
	$login_query = "UPDATE code8_menutitles SET title1='$title1', title1ar='$title1ar',title2='$title2', title2ar='$title2ar',title3='$title3', title3ar='$title3ar',title4='$title4', title4ar='$title4ar',title5='$title5', title5ar='$title5ar',title6='$title6', title6ar='$title6ar',title7='$title7', title7ar='$title7ar' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();					
	
	if($res == 1||$res1 == 1){
		header("location:editmenutitles.php?msg=success");		
	} else {		
		header("location:editmenutitles.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Menu Titles</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_menutitles where id=1";
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
                    <h2>Menu Titles</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 1<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title1" id="title1" required="required" value="<?php echo $about_res['title1'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 1(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title1ar" id="title1ar" required="required" value="<?php echo $about_res['title1ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 2<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title2" id="title2" required="required" value="<?php echo $about_res['title2'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 2(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title2ar" id="title2ar" required="required" value="<?php echo $about_res['title2ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 3<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title3" id="title3" required="required" value="<?php echo $about_res['title3'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 1(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title3ar" id="title3ar" required="required" value="<?php echo $about_res['title3ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 4<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title4" id="title4" required="required" value="<?php echo $about_res['title4'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 4(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title4ar" id="title4ar" required="required" value="<?php echo $about_res['title4ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 5<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title5" id="title5" required="required" value="<?php echo $about_res['title5'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 5(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title5ar" id="title5ar" required="required" value="<?php echo $about_res['title5ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 6<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title6" id="title6" required="required" value="<?php echo $about_res['title6'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 6(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title6ar" id="title6ar" required="required" value="<?php echo $about_res['title6ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
												  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 7<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title7" id="title7" required="required" value="<?php echo $about_res['title7'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title 7(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title7ar" id="title7ar" required="required" value="<?php echo $about_res['title7ar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
							
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Collection Menu Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="collectionimage" id="collectionimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 300 X 450px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['collectionimage']!=""){ ?>
									<img src="../<?php echo $about_res['collectionimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Designer wear Menu Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="desiggnerwearimage" id="desiggnerwearimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 300 X 450px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['desiggnerwearimage']!=""){ ?>
									<img src="../<?php echo $about_res['desiggnerwearimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Women Menu Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="womenimage" id="womenimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 300 X 450px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['womenimage']!=""){ ?>
									<img src="../<?php echo $about_res['womenimage'] ?>" width="250px" height="150px"/>
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
	CKEDITOR.replace('description');	
</script>