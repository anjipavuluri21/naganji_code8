<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id']; 
if(isset($_POST['submit']))
{	
	$title 				= ($_POST['title']);	
	$titlear 		    = ($_POST['titlear']);	
	$showinnewarrival 	= ($_POST['showinnewarrival']);	
	$menu 				= ($_POST['menu']);	
	
	$login_query = "UPDATE code8_brands SET title='$title', titlear='$titlear', showinnewarrival='$showinnewarrival', collectionorwomen='$menu' WHERE id=$id";
	
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($login_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
		
	if($res == 1){
		header("location:brandmanagement.php?msg=success");		
	} else {		
		header("location:brandmanagement.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Brand Menu</h3>
              </div>
            </div>
			<?php
				$banner_que = "SELECT * from code8_brands where id=$id";
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
                    <h2>Edit Brand Menu</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Brand Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="<?php echo $about_res['title'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Brand Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					<div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Do you want to show Brand in New Arrival menu?
                          <br>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						  <div class="checkbox">
						    <label>
                              <input name="showinnewarrival" id="showinnewarrival" type="checkbox"  <?php if($about_res['showinnewarrival']==1){ echo "checked"; } ?> value="1"> 
							</label>
                          </div>        
                        </div>
                      </div>
					<div class="form-group hidecategory" <?php if($about_res['showinnewarrival']!=1){ ?> style="display:none" <?php } ?>>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Menu Category<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menu" id="menu" class="form-control" >
								<option value="">-Menu Category-</option>	
								<option <?php if($about_res['collectionorwomen']==1){ echo "selected"; } ?> value="1">Collections</option>
								<option <?php if($about_res['collectionorwomen']==2){ echo "selected"; } ?> value="2">Women</option>
							</select>
						</div>
                    </div>					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="brandmanagement.php" class="btn btn-primary">Cancel</a>
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
$(function(){	
	if ($('#showinnewarrival').change(function(){
		if ($(this).is(':checked')) {
			$('.hidecategory').show();
		} else {
			$('.hidecategory').hide();
		}		
	}));	
});
</script>