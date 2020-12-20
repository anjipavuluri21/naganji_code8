<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$loginid = $_SESSION['SESS_MEMBER_ID'];
if(isset($_POST['submit']))
{	
	$menu 		= ($_POST['menu']);	
	$subname 	= ($_POST['subname']);
	$link 		= ($_POST['link']);
		
	$login_query = "INSERT INTO code8_adminsubmenu (id, adminmenuid, submenuname, link) VALUES ('', '$menu', '$subname', '$link')";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($login_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
	$adsmid= $dbCon0->lastInsertId();
			
	$banner_que = "SELECT * from code8_adminuser where 1=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($menbanner_res as $banner_result)
	{
		$id = $banner_result['id'];
		if($id==$loginid){			
			$product_sql = "INSERT INTO `code8_usermenulist` (`id`, `adminmenuid`, `menusubmenurel`, `adminsubmenuid`, `userid`, `status`) VALUES ('', 0, $menu, $adsmid, $id, 1)";
			$database2 = new Database();
			$dbCon2 = $database2->getConnection();
			$stmt2 = $dbCon2->prepare($product_sql);  
			$stmt2->execute();			
		} 
	}				
	
	if($res == 1){
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
                <h3>Add Admin Submenu</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Admin Submenu</h2>                    
                    <div class="clearfix"></div>
                  </div>
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
								$j = 6;								
								$banner_que = "SELECT * from code8_adminmenu where 1=1 ORDER BY id ASC";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
								?>
									<option value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['menuname'] ?></option>								
								<?php } ?>								
							</select>
						</div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Submenu Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="subname" id="subname" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Link<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="link" id="link" required="required" value="" class="form-control" style="width: 780px;">
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