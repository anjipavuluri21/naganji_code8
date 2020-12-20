<?php 
ob_start();
require_once('auth.php');
include "header.php";

$id = $_REQUEST['id']; 
if(isset($_POST['submit']))
{			
	$title 			= $_POST['title'];
	$address 		= $_POST['address'];
	$titlear 		= $_POST['titlear'];	
	$addressar 		= $_POST['addressar'];		
	$maps 			= $_POST['maps'];		
	$mapsar 		= $_POST['mapsar'];		
	$pimage			= $_FILES['image']['name'];
	$timings 		= $_POST['timings'];
	$timingsar 		= $_POST['timingsar'];
	
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
								
				$login_query = "UPDATE code8_stores SET `title`='$title',`titlear`='$titlear',`address`='$address',`addressar`='$addressar',`maps`='$maps',`mapsar`='$mapsar',`image`='$blocation1',`timings`='$timings',`timingsar`='$timingsar' WHERE id=$id";
				
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	} else {		
		$login_query = "UPDATE code8_stores SET `title`='$title',`titlear`='$titlear',`address`='$address',`addressar`='$addressar',`maps`='$maps',`mapsar`='$mapsar',`timings`='$timings',`timingsar`='$timingsar' WHERE id=$id";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($login_query);  
		$stmt1->execute();
		$res = $stmt1->rowCount();		
	}					
	
	if($res == 1){
		header("location:viewallstores.php?msg=success");		
	} else {		
		header("location:viewallstores.php?msg=fail");		
	}	
}		
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Store</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_stores where id=$id";
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
                    <h2>Edit Store</h2>                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address:<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="address" id="address" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['address'] ?></textarea>
						</div>
                     </div>				
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address(Arabic):<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">				
							<textarea name="addressar" id="addressar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['addressar'] ?></textarea>
						</div>
                     </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Timings<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">				
							<textarea name="timings" id="timings" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['timings'] ?></textarea>
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Timings(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">			
							<textarea name="timingsar" id="timingsar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['timingsar'] ?></textarea>
						</div>
                     </div>						 
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Map Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="maps" id="maps" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['maps'] ?></textarea>
						</div>
                      </div>													  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Map Link (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="mapsar" id="mapsar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['mapsar'] ?></textarea>
						</div>
                      </div>													  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" id="image" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 750 X 750px)
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
                          <a href="viewallstores.php" class="btn btn-primary">Cancel</a>
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
