<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id'];
if(isset($_POST['submit']))
{	
	$menu 		= ($_POST['menu']);	
	$subname 	= ($_POST['subname']);	
	$link 		= ($_POST['link']);	
	
	$login_query = "UPDATE code8_adminsubmenu SET adminmenuid='$menu', submenuname='$subname', link='$link' WHERE id=$id";
	$database = new Database();
	$dbCon = $database->getConnection();
	$stmt = $dbCon->prepare($login_query);  
	$stmt->execute();
	$count = $stmt->rowCount();
	
	if($count == 1){
		header("location:adminsubmenus.php?msg=success");		
	} else {		
		header("location:adminsubmenus.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Admin Submenu</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Admin Submenu</h2>                    
                    <div class="clearfix"></div>
                  </div>
				  <?php					
					$about_query = "SELECT * from code8_adminsubmenu where id=$id";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($about_query);  
					$stmt1->execute();	
					$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);					
					$selmenid = $about_res['adminmenuid'];
				  ?>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Admin Menu Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menu" id="menu" required class="form-control" >
								<option value="">-Select Category-</option>
								<?php								
								$banner_que = "SELECT * from code8_adminmenu where 1=1 ORDER BY id ASC";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
									$menid = $banner_result['id'];	
								?>
									<option <?php if($selmenid==$menid) { echo "selected"; } ?> value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['menuname'] ?></option>
								<?php } ?>								
							</select>
						</div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Submenu Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="subname" id="subname" required="required" value="<?php echo $about_res['submenuname'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link" id="link" required="required" value="<?php echo $about_res['link'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>		 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="adminsubmenus.php" class="btn btn-primary">Cancel</a>
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