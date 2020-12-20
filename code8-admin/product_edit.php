<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id']; 
if(isset($_POST['submit']))
{	
	$menu 				= $_POST['menu'];	
	$menucat 			= $_POST['menucat'];	
	$submenu 			= $_POST['submenu'];	
	$brand 				= $_POST['brand'];	
	$name 				= addslashes($_POST['name']);	
	$namear 			= addslashes($_POST['namear']);	
	$prodcode 			= $_POST['prodcode'];
	$description 		= addslashes($_POST['description']);	
	$descriptionar 		= addslashes($_POST['descriptionar']);	
	$comp 				= $_POST['comp'];	
	$compar 			= $_POST['compar'];		
	$sizeandfit 		= addslashes($_POST['sizeandfit']);	
	$sizeandfitar 		= addslashes($_POST['sizeandfitar']);	
	$other 				= addslashes($_POST['other']);	
	$otherar 			= addslashes($_POST['otherar']);
	$sale 				= isset($_POST['sale'])?$_POST['sale']:'';	
	
	$thumbimg1			= $_FILES['thumbimg1']['name'];
//        print_r($_FILES['thumbimg1']);exit;
	$pimage				= $_FILES['prodimage']['name'];	
	$thumbimg2			= $_FILES['thumbimg2']['name'];
	$countprods			= count($_FILES['prodimage']['name']);
	$season 			= ($_POST['season']);
	$expseason 			= implode(",",$season);
		
	$login_query = "UPDATE code8_products SET `menuid`='$menu',`catid`='$menucat',`subcat`='$submenu',`brand`='$brand',`prodtitle`='$name',`prodtitlear`='$namear',`prodcode`='$prodcode',`description`='$description',`descriptionar`='$descriptionar',`composition`='$comp',`compositionar`='$compar',`sizeandfit`='$sizeandfit',`sizeandfitar`='$sizeandfitar',`other`='$other',`otherar`='$otherar',`sale`='$sale',`season`='$expseason' WHERE id=$id";

	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
	$lastinsertid = $dbCon1->lastInsertId();
		
	if($thumbimg1!="")
	{			
		$name1 = pathinfo($_FILES['thumbimg1']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['thumbimg1']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['thumbimg1']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8s'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['thumbimg1']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_products SET thumimage1='$blocation1' WHERE id=$id";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($login_query);  
				$stmt1->execute();
				$res11 = $stmt1->rowCount();	
			}
		}
	} 
		
	if($_POST['thumbimg1'][0] != "")
	{			
		foreach ($_POST['thumbimg1'] as $key => $productimages) {
			if($key != count($_POST['thumbimg1'])-1) {
				$img_location .= $productimages.",";
			}
			else {
				$img_location .= $productimages;
			}
		}
	}	
	if($img_location != "") {
		$img = $img_location;
	} else {
		$img = "";
	}
		
	if($img_location!="")
	{		
		$login_query = "UPDATE code8_products SET thumimage1='$img' WHERE id=$id";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($login_query);  
		$stmt1->execute();
		$res11 = $stmt1->rowCount();		
	} 
	
	if($thumbimg2!="")
	{			
		$name1 = pathinfo($_FILES['thumbimg2']['name'], PATHINFO_FILENAME);
		$extension1 = pathinfo($_FILES['thumbimg2']['name'], PATHINFO_EXTENSION);
		$ext = strtolower(pathinfo($_FILES['thumbimg2']['name'], PATHINFO_EXTENSION));
		$newfilename = 'code8f'. round(microtime(true));
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png") || ($ext == "mp4")) {
			$basename1 = $newfilename .'.'. $extension1;
			$blocation1 = "uploads/adminfiles/" . $basename1;
			$target_file1 = "../uploads/adminfiles/" . $basename1;
			if (move_uploaded_file($_FILES['thumbimg2']['tmp_name'], $target_file1)) {	
				$login_query = "UPDATE code8_products SET thumimage2='$blocation1' WHERE id=$id";
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
			if (($extension1 == "jpg") || ($extension1 == "jpeg") || ($extension1 == "png")|| ($extension1 == "mp4")) {								
				$newfilename1 = 'code8f'.$p.rand(). round(microtime(true));			
				$basename1 = $newfilename1 . '.' . $extension1;
				$blocation1 = "uploads/adminfiles/" . $basename1;
				$target_file1 = "../uploads/adminfiles/" . $basename1;	
				
				if (move_uploaded_file($_FILES['prodimage']['tmp_name'][$p], $target_file1)) { 						
					$login_query = "INSERT INTO code8_prodimages (`prodid`,`image`) VALUES ('$id','$blocation1')";
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
		header("location:products.php?msg=success");		
	} else {		
		header("location:products.php?msg=fail");		
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

<link rel="stylesheet" href="styles/prism.css">
<link rel="stylesheet" href="styles/chosen.css">
<link rel="stylesheet" href="cropper/cropper.min.css">
<link rel="stylesheet" href="dropzone/basic.css">
<link rel="stylesheet" href="dropzone/dropzone.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="main.css">

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Product</h3>
              </div>			
            </div>
			<?php
				$banner_que = "SELECT * from code8_products where id=$id";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($banner_que);  
				$stmt1->execute();	
				$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
				$catid = $about_res['catid'];
			?>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Product</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" name="adv_form" id="adv_form" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Menu Category<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menu" id="menu" required class="form-control" >
								<option value="">-Menu Category-</option>	
								<option <?php if($about_res['menuid']==1){ echo "selected"; } ?> value="1">Collections</option>
								<option <?php if($about_res['menuid']==2){ echo "selected"; } ?> value="2">Women</option>
							</select>
						</div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Category<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menucat" id="menucat" required class="form-control" >
								<option value="">-Select Category-</option>	
								<?php												
								$banner_que = "SELECT * from code8_collectionsmenu where 1=1 ORDER BY id ASC";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
								?>
									<option <?php if($about_res['catid']==$banner_result['id']){ echo "selected"; } ?> value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['title'] ?></option>								
								<?php } ?>								
							</select>
						</div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product SubCategory<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="submenu" id="submenu" required class="form-control" >
								<option value="">-Select SubCategory-</option><?php				
								$banner_que = "SELECT * from code8_collectionssubmenu where menuid=$catid";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
								?>
									<option <?php if($about_res['subcat']==$banner_result['id']){ echo "selected"; } ?> value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['title'] ?></option>								
								<?php } ?>			
							</select>
						</div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Brand<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="brand" id="brand" required class="form-control" >
								<option value="">-Select Brand-</option>	
								<?php												
								$banner_que = "SELECT * from code8_brands where 1=1 ORDER BY id ASC";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
								?>
									<option <?php if($about_res['brand']==$banner_result['id']){ echo "selected"; } ?> value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['title'] ?></option>								
								<?php } ?>								
							</select>
						</div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="name" id="name" required="required" value="<?php echo $about_res['prodtitle'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="namear" id="namear" required="required" value="<?php echo $about_res['prodtitlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <!--<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Thumbnail Image 1<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
						  <div action="#" class="dropzone" id="my-dropzone-container">
								<div class="fallback">
									<input name="file" type="file">
								</div>
							</div>
						 <div class="control-group">			
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['thumimage1']!=""){ ?>
									<img src="../<?php echo $about_res['thumimage1'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						 </div>						  
                        </div>
                      </div>-->
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Thumbnail Image 1<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="thumbimg1" id="thumbimg1" accept="image/*"  class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 466 X 621px)
						 <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['thumimage1']!=""){ ?>
									<img src="../<?php echo $about_res['thumimage1'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						 </div>						  
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Thumbnail Image 2<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="thumbimg2" id="thumbimg2" accept="image/*" class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 466 X 621px)
						  <div class="control-group">					
							<div class="controls">
								<div align="left"><br/>
								<?php if($about_res['thumimage2']!=""){ ?>
									<img src="../<?php echo $about_res['thumimage2'] ?>" width="250px" height="150px"/>
								<?php } ?>		
								</div>	
							</div>
						 </div>							  
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Code<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="prodcode" id="prodcode" required="required" value="<?php echo $about_res['prodcode'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Composition<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="comp" id="comp" required="required" value="<?php echo $about_res['composition'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Composition (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="compar" id="compar" required="required" value="<?php echo $about_res['compositionar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>				     	
					 	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Description<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="description" id="description" class="form-control" style="width: 780px;"><?php echo $about_res['description'] ?></textarea>
						</div>
                     </div>	
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Description (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="descriptionar" id="descriptionar" class="form-control" style="width: 780px;"><?php echo $about_res['descriptionar'] ?></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Images <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="prodimage[]" id="prodimage" accept="image/*,video/*" multiple class="form-control" style="padding: 0px; border-width: 0px;">
						  <br>(Resolution: 600 X 600px)
							<br><br>
							<?php							
								$prod_que = "SELECT * from code8_prodimages where prodid=$id";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($prod_que);  
								$stmt1->execute();	
								$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($prod_res as  $prod_resval){
									$extension1 = strtolower(pathinfo($prod_resval['image'], PATHINFO_EXTENSION));
							?>								
							<div class="img-wrap">
								<span class="close">&times;</span>
								<?php if($extension1!='mp4'){ ?>
								<img src="../<?php echo $prod_resval['image'] ?>" width="150px" height="150px" data-id="<?php echo $prod_resval['id'] ?>">
								<?php } else { ?>
								 	<video width="220" height="140" data-id="<?php echo $prod_resval['id'] ?>" id="myVideo<?php echo $prod_resval['id']; ?>" controls>
									  <source src="../<?php echo $prod_resval['image']; ?>" type="video/mp4">
									  <source src="../<?php echo $prod_resval['image']; ?>" type="video/ogg">
									  Your browser does not support the video tag.
									</video>
								<?php }	?>
							</div>
						<?php } ?>						  
                        </div>
                      </div>
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">sizeandfit<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="sizeandfit" id="sizeandfit" class="form-control" style="width: 780px;"><?php echo $about_res['sizeandfit'] ?></textarea>
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">sizeandfit (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="sizeandfitar" id="sizeandfitar" class="form-control" style="width: 780px;"><?php echo $about_res['sizeandfitar'] ?></textarea>
						</div>
                      </div>				  
					 	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Other Content<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="other" id="other" class="form-control" style="width: 780px;"><?php echo $about_res['other'] ?></textarea>
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Other Content (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="otherar" id="otherar" class="form-control" style="width: 780px;"><?php echo $about_res['otherar'] ?></textarea>
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Seasons
                          <br>
                          <small class="text-navy">Choose season </small>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<?php
						$dbseason = $about_res['season'];	
						$implodesea  = explode(',',$dbseason); 
						$conbanner_que = "SELECT * from code8_seasons where status=1 ORDER BY id ASC";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($conbanner_que);  
						$stmt1->execute();	
						$conmenbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($conmenbanner_res as $conbanner_result)
						{
						?>	
                          <div class="checkbox">
                            <label>
                              <input name="season[]" type="checkbox" class="flat" value="<?php echo $conbanner_result['id'] ?>" <?php if(in_array($conbanner_result['id'], $implodesea)){ echo "checked"; } ?>> <?php echo $conbanner_result['title']; ?> 
                            </label>
                          </div>
						<?php } ?>                               
                        </div>
                      </div>
					 <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Do you want to show Product in Sale?
                          <br>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						  <div class="checkbox">
						    <label>
                              <input name="sale" id="sale" type="checkbox" class="flat" value="1" <?php if($about_res['sale']==1){ echo "checked"; } ?>> 
							</label>
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
<script>
$(document).ready(function(){
    $('#menu').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        $.ajax({
            url: "catajax.php",
            type: "POST",
            data: "categoryId="+categoryId,
            success: function (response) {               
                $("#menucat").html(response);
            },
        });
    }); 
});
$(document).ready(function(){
    $('#menucat').on("change",function () {
        var categoryId = $('#menucat').find('option:selected').val();		
        var menuType = $('#menu').find('option:selected').val();		
        $.ajax({
            url: "subcatajax.php",
            type: "POST",
            data: "menuType="+menuType+"&categoryId="+categoryId,
            success: function (response) {
               // console.log(response);
                $("#submenu").html(response);
            },
        });
    }); 
});
</script>		
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="cropper/cropper.min.js"></script>
<script src="dropzone/dropzone.js"></script>
<!--<script src="dropzone/dropzone2.js"></script>-->
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/prism.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript"></script>
<script>
$(document).ready(function() {		 
	$('.removeimg').on('click', function () {
		var nam = $(this).attr('id');
		$.ajax({
				type:"POST",
				url:"removeProductimg.php",
				data:"product_id="+nam,
				success:function(data)
				{
					$("#prodimg").html(data);
				}
		});
	});
});

Dropzone.autoDiscover = false;
$(document).ready(function() {         
	// transform cropper dataURI output to a Blob which Dropzone accepts
	var dataURItoBlob = function (dataURI) {
	var byteString = atob(dataURI.split(',')[1]);
	var ab = new ArrayBuffer(byteString.length);
	var ia = new Uint8Array(ab);
	for (var i = 0; i < byteString.length; i++) {
		ia[i] = byteString.charCodeAt(i);
	}
		return new Blob([ab], {type: 'image/jpeg'});
	};
	
   //  Dropzone.autoDiscover = false;
	var fileList = new Array;
	var i =0;
	var myDropzone = new Dropzone("#my-dropzone-container", {
		addRemoveLinks: true,
		acceptedFiles: "image/jpeg,image/png",
		maxFilesize: 1,
		url: "upload.php",
		init: function() {

			// Hack: Add the dropzone class to the element
			$(this.element).addClass("dropzone");
			this.on("success", function(file, serverFileName) {
				 
				fileList[i] = {"serverFileName" : file, "fileName" : file.name,"fileId" : i };
				 console.log(serverFileName);
				 
				 serverFileName= serverFileName.trim();
				  appendFilesIntoForm(serverFileName,i);
				i++;						
			});
			this.on("removedfile", function(file) {
				 
			console.log(file);
			console.log(file.name);
				 
			var rmvFile = "";
			var rmvFileId = "";
			 $("input[name='thumbimg1[]']").each(function() {
					//values.push($(this).val());
					 //alert($(this).val());
					if(file.name==$(this).val()){
						// alert('remove');
						  $(this).remove();
					}
				});			   
			});
			},		
		}
	);
	
	myDropzone.on('addedfile', function (file) {	   
		if (file.cropped) {
			return;
		}	
		var $img = $('<img>');	
		if (file.width < 800) {
			// validate width to prevent too small files to be uploaded
			return;
		}
		// cache filename to re-assign it to cropped file
		var cachedFilename = file.name;
		// remove not cropped file from dropzone (we will replace it later)
		myDropzone.removeFile(file);
	
		// dynamically create modals to allow multiple files processing
		// modal window template
		var modalTemplate =
			'<div class="modal fade" tabindex="-1" role="dialog">' +
				'<div class="modal-dialog " role="document"   >' + /*modal-lg*/
					'<div class="modal-content">' +
					'<div class="modal-header">' +
						'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
						'<h4 class="modal-title">Crop</h4>' +
					'</div>' +
					'<div class="modal-body">' +
						'<div class="image-container"></div>' +
					'</div>' +
					'<div class="modal-footer">' +
						'<button type="button" class="btn btn-warning rotate-left"><span class="fa fa-rotate-left"></span></button>' +
						'<button type="button" class="btn btn-warning rotate-right"><span class="fa fa-rotate-right"></span></button>' +
						'<button type="button" class="btn btn-warning scale-x" data-value="-1"><span class="fa fa-arrows-h"></span></button>' +
						'<button type="button" class="btn btn-warning scale-y" data-value="-1"><span class="fa fa-arrows-v"></span></button>' +
	
						'<button type="button" class="btn btn-warning reset"><span class="fa fa-refresh"></span></button>' +
	
						'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
						'<button type="button" class="btn btn-primary crop-upload">Crop & upload</button>' +
					'</div>' +
					'</div>' +
				'</div>' +
			'</div>';
	
		var $cropperModal = $(modalTemplate);
	
		// initialize FileReader which reads uploaded file
		var reader = new FileReader();
		reader.onloadend = function () {
			// add uploaded and read image to modal
			$cropperModal.find('.image-container').html($img);
			$img.attr('src', reader.result);
		};
		// read uploaded file (triggers code above)
		reader.readAsDataURL(file);
	
		var cropper = {};
		$cropperModal
			.modal('show')
			.on("shown.bs.modal", function () {
				cropper = new Cropper($img.get(0), { 
				viewMode: 1,           
				checkOrientation:false,
				cropBoxResizable: true, 
				aspectRatio:2/2,
				strict:true,
				background:false,
				guides:false,
				//autoCropArea:0.6,
				autoCropArea: 0.8,
				rotatable:false,
				getCroppedCanvas:{fillcolor: "#FFFFFF"},			
				//using these just to stop box collapsing on itself
				minCropBoxWidth:50,
				minCropBoxHeight:50,				
				});
			})
			.on('click', '.crop-upload', function () {
				// get cropped image data
				var blob = cropper.getCroppedCanvas({ width: 400, height: 400 }).toDataURL('image/jpeg',0.9);
				// transform it to Blob object
				var newFile = dataURItoBlob(blob);
				// set 'cropped to true' (so that we don't get to that listener again)
				newFile.cropped = true;
				// assign original filename
				newFile.name = cachedFilename;
	
				// add cropped file to dropzone
				myDropzone.addFile(newFile);
				// upload cropped file with dropzone
				myDropzone.processQueue();
				$cropperModal.modal('hide');
			})
			.on('click', '.rotate-right', function () {
				cropper.rotate(90);
			})
			.on('click', '.rotate-left', function () {
				cropper.rotate(-90);
			})
			.on('click', '.reset', function () {
				cropper.reset();
			})
			.on('click', '.scale-x', function () {
				var $this = $(this);
				cropper.scaleX($this.data('value'));
				$this.data('value', -$this.data('value'));
			})
			.on('click', '.scale-y', function () {
				var $this = $(this);
				cropper.scaleY($this.data('value'));
				$this.data('value', -$this.data('value'));
			})
	});
	
	});
function appendFilesIntoForm(serverFileName,i) {
	serverFileName= serverFileName.trim();
	// console.log(serverFileName);
	$('#adv_form').append('<input type="hidden"  class="'+i+'imginsid" name="thumbimg1[]"  value="'+serverFileName+'">');
}	
		
function appendRemoveIdIntoForm(serverID) {
	serverID= serverID.trim();
	$('#adv_form').append('<input type="hidden"    name="removeRelIDarr[]"  value="'+serverID+'">');
}

</script>

        <!-- /page content -->
<?php include "footer.php" ?>
<script>	
	CKEDITOR.replace('description');
	CKEDITOR.replace('descriptionar', {language:'ar'});	
	CKEDITOR.replace('sizeandfit');
	CKEDITOR.replace('sizeandfitar', {language:'ar'});	
	CKEDITOR.replace('other');
	CKEDITOR.replace('otherar', {language:'ar'});	
</script>
<script>
$LEFT_COL=$(".left_col");
$LEFT_COL.css("min-height",$(".right_col").height()+$(".left_col").height()+500);

$('.img-wrap .close').on('click', function() {		
	var id = $(this).closest('.img-wrap').find('img').data('id');
	
	var vid = $(this).closest('.img-wrap').find('video').data('id');
			
	//alert(id);alert(vid);
	
	
	if(vid!=""){
		var r=confirm("Are you sure?");
		if(r==true)
		{   	 		
		 $.ajax({
			type:"POST",
			data:"id="+vid,
			url:"deletecollection.php?type=productimage",
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
	} else if(id!=""){
		var r=confirm("Are you sure?");
		if(r==true)
		{   	 		
		 $.ajax({
			type:"POST",
			data:"id="+id,
			url:"deletecollection.php?type=productimage",
			success:function(data)
			{
				if(data=="done")
				{
					alert("Image/Video Deleted Successfully");
					location.reload();
				}
			}
		  });
		 }
		 else
		 {
			return false;
		 }
	}
}); 
</script>