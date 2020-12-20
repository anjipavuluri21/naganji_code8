<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title1 	= $_POST['title1'];	
	$titlear1 	= $_POST['titlear1'];		
	$link1 		= $_POST['link1'];		
	$link2 		= $_POST['link2'];		
	$link3 		= $_POST['link3'];		
	$image1		= $_FILES['image1']['name'];
	$image2		= $_FILES['image2']['name'];
	$image3		= $_FILES['image3']['name'];
		
	if($image1!="")
	{			
		$name1 = pathinfo($_FILES['image1']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code81'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_trendingsection SET image1='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res1 = $stmt1->rowCount();	
			}
		}
	} 
	
	if($image2!="")
	{			
		$name1 = pathinfo($_FILES['image2']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code82'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image2']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_trendingsection SET image2='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res2 = $stmt1->rowCount();	
			}
		}
	} 
	
	if($image3!="")
	{			
		$name1 = pathinfo($_FILES['image3']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image3']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image3']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code82'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image3']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_trendingsection SET image3='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res3 = $stmt1->rowCount();	
			}
		}
	} 
	
	$login_query = "UPDATE code8_trendingsection SET title='$title1', titlear='$titlear1', link1='$link1', link2='$link2', link3='$link3' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res4 = $stmt1->rowCount();		
		
	if($res1 == 1 || $res2 == 1 || $res3 == 1 || $res4 == 1){
		header("location:trending.php?msg=success");		
	} else {		
		header("location:trending.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Trending Section</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_trendingsection where id=1";
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
                    <h2>Trending Section</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title1" id="title1" required="required" value="<?php echo $about_res['title'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear1" id="titlear1" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block Link 2<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link2" id="link2" required="required" value="<?php echo $about_res['link2'] ?>" class="form-control" style="width: 780px;">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image1 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image1" id="image1" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 400 X 400px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['image1']!=""){ ?>
									<img src="../<?php echo $about_res['image1'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Image 2 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image2" id="image2" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 400 X 400px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['image2']!=""){ ?>
									<img src="../<?php echo $about_res['image2'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Image 3 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image3" id="image3" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 400 X 400px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['image3']!=""){ ?>
									<img src="../<?php echo $about_res['image3'] ?>" width="250px" height="150px"/>
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
