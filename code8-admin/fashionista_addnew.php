<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{		
	$name 				= $_POST['name'];	
	$namear 			= $_POST['namear'];	
	$portfoliotitle 	= $_POST['portfoliotitle'];	
	$portfoliotitlear 	= $_POST['portfoliotitlear'];	
	$videolink 			= $_POST['videolink'];	
	$title 				= $_POST['title'];	
	$titlear 			= $_POST['titlear'];	
	$comments 			= addslashes($_POST['comments']);	
	$commentsar 		= addslashes($_POST['commentsar']);	
	$description 		= $_POST['description'];	
	$descriptionar 		= $_POST['descriptionar'];	
	$collectiontitle 	= $_POST['collectiontitle'];	
	$collectiontitlear 	= $_POST['collectiontitlear'];	
	$collectionlink 	= $_POST['collectionlink'];		
	$date 				= $_POST['date'];		
	$image				= $_FILES['image']['name'];
	$pimage				= $_FILES['prodimage']['name'];	
	$cimage				= $_FILES['collectionimage']['name'];
	$countprods			= count($_FILES['prodimage']['name']);
	
	$login_query = "INSERT INTO code8_fashionistas (`name`,`namear`,`portfoliotitle`,`portfoliotitlear`,`videolink`,`title`,`titlear`,`comments`,`commentsar`,`description`,`descriptionar`,`collectiontitle`,`collectiontitlear`,`collectionlink`,`date`) VALUES ('$name', '$namear', '$portfoliotitle', '$portfoliotitlear', '$videolink','$title', '$titlear', '$comments', '$commentsar', '$description', '$descriptionar', '$collectiontitle', '$collectiontitlear', '$collectionlink', '$date')"; 
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
	$lastinsertid = $dbCon1->lastInsertId();
		
	if($image!="")
	{			
		$name1 = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8s'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_fashionistas SET image='$blocation1' WHERE id=$lastinsertid";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res11 = $stmt1->rowCount();	
			}
		}
	} 
	
	if($cimage!="")
	{			
		$name1 = pathinfo($_FILES['collectionimage']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['collectionimage']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['collectionimage']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8f'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['collectionimage']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_fashionistas SET collectionimage='$blocation1' WHERE id=$lastinsertid";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res1 = $stmt1->rowCount();	
			}
		}
	} 
	for($p=0;$p<$countprods;$p++){				
		//Check Rename
		$name1 = pathinfo($_FILES['prodimage']['name'][$p], PATHINFO_FILENAME);
		$extension1 = strtolower(pathinfo($_FILES['prodimage']['name'][$p], PATHINFO_EXTENSION));
				
		if($name1!=""){						
			if (($extension1 == "jpg") || ($extension1 == "jpeg") || ($extension1 == "png")) {								
				$newfilename1 = 'code8f'.$p.rand(). round(microtime(true));			
				$basename1 = $newfilename1 . '.' . $extension1;
				$blocation1 = "uploads/adminfiles/" . $basename1;
				$target_file1 = "../uploads/adminfiles/" . $basename1;	
				
				if (move_uploaded_file($_FILES['prodimage']['tmp_name'][$p], $target_file1)) { 						
					$login_query = "INSERT INTO code8_fashionistaprodimages (`fashionistaid`,`prodimages`) VALUES ('$lastinsertid','$blocation1')";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($login_query);  
					$stmt1->execute();
					$res12 = $stmt1->rowCount();					
				}
			}	
		}		
	}
			
	if($res == 1 || $res1 == 1|| $res11 == 1|| $res12 == 1){
		header("location:fashionistas.php?msg=success");		
	} else {		
		header("location:fashionistas.php?msg=fail");		
	}	
}	
?>	
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Fashionista</h3>
              </div>			
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Fashionista</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="name" id="name" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="namear" id="namear" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Portfolio Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="portfoliotitle" id="portfoliotitle" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Portfolio Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="portfoliotitlear" id="portfoliotitlear" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="date" id="date" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fashionista Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" required id="image" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 930 X 925px)						  
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Video Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="videolink" id="videolink" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" class="form-control" style="width: 780px;">
						</div>
                      </div>				     	
					 	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="description" id="description" class="form-control" style="width: 780px;"></textarea>
						</div>
                     </div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="descriptionar" id="descriptionar" class="form-control" style="width: 780px;"></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fashionista Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="prodimage[]" id="prodimage" accept="image/*" multiple required class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 513 X 695px)						  
                        </div>
                      </div>
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comments<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="comments" id="comments" required="required" class="form-control" style="width: 780px;"></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comments (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="commentsar" id="commentsar" required="required" class="form-control" style="width: 780px;"></textarea>
						</div>
                      </div>				  
					 	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectiontitle" id="collectiontitle" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectiontitlear" id="collectiontitlear" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectionlink" id="collectionlink" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Collection Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="collectionimage" id="collectionimage" accept="image/*" required class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 1440 X 720px)						  
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
$(function() {	
	$("#date").datepicker({dateFormat: "dd/mm/yy"});	
});
</script>
<?php include "footer.php" ?>
<script>	
	CKEDITOR.replace('description');
	CKEDITOR.replace('descriptionar', {language:'ar'});	
</script>
