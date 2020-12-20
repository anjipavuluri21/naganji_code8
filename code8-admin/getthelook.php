<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title 			= $_POST['title'];
	$caption 		= $_POST['caption'];
	$titlear 		= $_POST['titlear'];	
	$captionar 		= $_POST['captionar'];		
	$shopnowlink 	= $_POST['shopnowlink'];		
	$pimage			= $_FILES['image']['name'];
	$lookimage		= $_FILES['lookimage']['name'];
	$prods			= $_POST['prods'];	
	foreach($prods as $prodscats){
		$finalcats = implode(",",$prods); 
	}
	
	if($pimage!="")
	{			
		$name1 = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code81'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_getthelook SET image='$blocation1' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	}
		
	if($lookimage!="")
	{			
		$name1 = pathinfo($_FILES['lookimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['lookimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['lookimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code82'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename11 = $newfilename .'.'. $extension1;
			$blocation11 = "uploads/adminfiles/" . $basename11;
			$target_file11 = "../uploads/adminfiles/" . $basename11;
			if (move_uploaded_file($_FILES['lookimage']['tmp_name'], $target_file11)) {	
				$login_query = "UPDATE code8_getthelook SET lookimage='$blocation11' WHERE id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res = $stmt1->rowCount();	
			}
		}
	} 
	
	$login_query = "UPDATE code8_getthelook SET title='$title', caption='$caption', titlear='$titlear', captionar='$captionar', shopnowlink='$shopnowlink', prods='$finalcats' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();							
	
	if($res == 1){
		header("location:getthelook.php?msg=success");		
	} else {		
		header("location:getthelook.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Get the Look section</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_getthelook where id=1";
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
                    <h2>Get the Look section</h2>                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subtitle:<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="caption" id="caption"  class="form-control" style="width: 780px;"><?php echo $about_res['caption'] ?></textarea>
						</div>
                     </div>				
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subtitle(Arabic):<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="captionar" id="captionar" class="form-control" style="width: 780px;"><?php echo $about_res['captionar'] ?></textarea>
						</div>
                     </div>				
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">More link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="shopnowlink" id="shopnowlink" required="required" value="<?php echo $about_res['shopnowlink'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>													  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" id="image" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 1920 X 1100px)
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
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Get the look Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="lookimage" id="lookimage" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 1060 X 1413px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['lookimage']!=""){ ?>
									<img src="../<?php echo $about_res['lookimage'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						</div>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Add products to Get the Look <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="prods[]" class="select2_multiple form-control" multiple="multiple">
                            <option>Choose option</option>
							<?php	
							$cats = explode(',',$about_res['prods']);					
							$pord_que = "SELECT * from code8_products where 1=1 AND status=1";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($pord_que);  
							$stmt1->execute();	
							$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($prod_res as $prod_result)					
							{
								$catid = $prod_result['id'];	
							?>
								<option <?php if(in_array($catid,$cats)){ echo "selected"; } ?> value="<?php echo $prod_result['id']; ?>"><?php echo $prod_result['prodtitle']; ?></option>
							<?php }	?> 
                          </select>
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
<script>
$(document).ready(function() {	
	$(".select2_multiple").select2({
	  maximumSelectionLength: 6,
	  placeholder: "Max Selection limit 6",
	  allowClear: true
	});
});
</script>
<?php include "footer.php" ?>
<script>
	CKEDITOR.replace('caption');
	CKEDITOR.replace('captionar', {	language:'ar'});	
</script>
