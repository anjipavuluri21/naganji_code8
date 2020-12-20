<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title1 	= $_POST['title1'];
	$title2 	= $_POST['title2'];
	$title3 	= $_POST['title3'];	
	$titlear1 	= $_POST['titlear1'];	
	$titlear2 	= $_POST['titlear2'];	
	$titlear3 	= $_POST['titlear3'];		
	$link1 		= $_POST['link1'];		
	$link2 		= $_POST['link2'];		
	$link3 		= $_POST['link3'];		
	$pimage		= $_FILES['image']['name'];
	$bimage		= $_FILES['bannerimage']['name'];
		
	if($pimage!="")
	{			
		$name1 = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_homepagebody2 SET image='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res11 = $stmt1->rowCount();	
			}
		}
	} 
	
	if($bimage!="")
	{			
		$name1 = pathinfo($_FILES['bannerimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['bannerimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['bannerimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8b'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['bannerimage']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_homepagebody2 SET bannerimage='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res1 = $stmt1->rowCount();	
			}
		}
	} 
	
	$login_query = "UPDATE code8_homepagebody2 SET title1='$title1',title2='$title2',title3='$title3', titlear1='$titlear1', titlear2='$titlear2', titlear3='$titlear3', link1='$link1', link2='$link2', link3='$link3' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();		
		
	if($res == 1 || $res1 == 1|| $res11 == 1){
		header("location:homepagebody2.php?msg=success");		
	} else {		
		header("location:homepagebody2.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Homepage Body Section 2</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_homepagebody2 where id=1";
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
                    <h2>Homepage Body Section 2</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 1<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title1" id="title1" required="required" value="<?php echo $about_res['title1'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 1(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear1" id="titlear1" required="required" value="<?php echo $about_res['titlear1'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Link 1<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link1" id="link1" required="required" value="<?php echo $about_res['link1'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 2<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title2" id="title2" required="required" value="<?php echo $about_res['title2'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 2(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear2" id="titlear2" required="required" value="<?php echo $about_res['titlear2'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Link 2<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link2" id="link2" required="required" value="<?php echo $about_res['link2'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 3<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title3" id="title3" required="required" value="<?php echo $about_res['title3'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Title 3(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear3" id="titlear3" required="required" value="<?php echo $about_res['titlear3'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Link 3<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link3" id="link3" required="required" value="<?php echo $about_res['link3'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="bannerimage" id="bannerimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 2050 X 1333px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['bannerimage']!=""){ ?>
									<img src="../<?php echo $about_res['bannerimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" id="image" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 300 X 300px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['image']!=""){ ?>
									<img src="../<?php echo $about_res['image'] ?>" width="250px" height="150px"/>
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
