<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id'];
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
			
	$login_query = "UPDATE code8_fashionistas SET  `name`='$name',`namear`='$namear',`videolink`='$videolink',`title`='$title',`titlear`='$titlear',`comments`='$comments',`commentsar`='$commentsar',`description`='$description',`descriptionar`='$descriptionar',`collectiontitle`='$collectiontitle',`collectiontitlear`='$collectiontitlear',`collectionlink`='$collectionlink',`portfoliotitle`='$portfoliotitle',`portfoliotitlear`='$portfoliotitlear',`date`='$date' WHERE id=$id";
	
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
				$login_query = "UPDATE code8_fashionistas SET image='$blocation1' WHERE id=$id";
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
				$login_query = "UPDATE code8_fashionistas SET collectionimage='$blocation1' WHERE id=$id";
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
					$login_query = "INSERT INTO code8_fashionistaprodimages (`fashionistaid`,`prodimages`) VALUES ('$id','$blocation1')";
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
<style>
.img-wrap {
    position: relative;
    display: inline-block;
    border: 1px red solid;
    font-size: 0;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Fashionista</h3>
              </div>			
            </div>
			<?php
				$banner_que = "SELECT * from code8_fashionistas where id=$id";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($banner_que);  
				$stmt1->execute();	
				$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
			?>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Fashionista</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="name" id="name" required="required" value="<?php echo $about_res['name'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="namear" id="namear" required="required" value="<?php echo $about_res['namear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Portfolio Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="portfoliotitle" id="portfoliotitle" required="required" value="<?php echo $about_res['portfoliotitle'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Portfolio Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="portfoliotitlear" id="portfoliotitlear" required="required" value="<?php echo $about_res['portfoliotitlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="date" id="date" required="required" value="<?php echo $about_res['date'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>					 
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fashionista Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" id="image" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 930 X 925px)
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Video Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="videolink" id="videolink" required="required" value="<?php echo $about_res['videolink'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="description" id="description" class="form-control" style="width: 780px;"><?php echo $about_res['description'] ?></textarea>
						</div>
                     </div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="descriptionar" id="descriptionar" class="form-control" style="width: 780px;"><?php echo $about_res['descriptionar'] ?></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fashionista Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="prodimage[]" id="prodimage" accept="image/*" multiple class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 513 X 695px)
							<br><br>
							<?php							
								$prod_que = "SELECT * from code8_fashionistaprodimages where fashionistaid=$id";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($prod_que);  
								$stmt1->execute();	
								$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($prod_res as  $prod_resval){
							?>													
							<div class="img-wrap">
								<span class="close">&times;</span>
								<img src="../<?php echo $prod_resval['prodimages'] ?>" width="150px" height="150px" data-id="<?php echo $prod_resval['id'] ?>">
							</div>
						<?php } ?>
                        </div>
                      </div>
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comments<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="comments" id="comments" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['comments'] ?></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comments (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="commentsar" id="commentsar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['commentsar'] ?></textarea>
						</div>
                      </div>				  
					 	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectiontitle" id="collectiontitle" required="required" class="form-control" value="<?php echo $about_res['collectiontitle'] ?>" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Title (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectiontitlear" id="collectiontitlear" value="<?php echo $about_res['collectiontitlear'] ?>" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="collectionlink" id="collectionlink" value="<?php echo $about_res['collectionlink'] ?>" required="required" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 									  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Collection Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="collectionimage" id="collectionimage" accept="image/*" class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 1440 X 720px)
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
<script>
$('.img-wrap .close').on('click', function() {		
	var id = $(this).closest('.img-wrap').find('img').data('id');  	
	var r=confirm("Are you sure?");
	if(r==true)
	{   	 		
	 $.ajax({
		type:"POST",
		data:"id="+id,
		url:"deletecollection.php?type=prodimage",
		success:function(data)
		{
			if(data=="done")
			{
				alert("Image Deleted Successfully");
				location.reload();
			}
		}
	  });
	 }
	 else
	 {
		return false;
	 }
}); 

</script>