<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$loginid = $_SESSION['SESS_MEMBER_ID'];
if(isset($_POST['submit']))
{			
	$title 	= $_POST['title'];	
		
	$adminmenu_query = "INSERT INTO code8_adminmenu (id, menuname) VALUES ('', '$title')";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($adminmenu_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
	$admid= $dbCon0->lastInsertId();
		
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
			$product_sql = "INSERT INTO `code8_usermenulist` (`id`, `adminmenuid`, `menusubmenurel`, `adminsubmenuid`, `userid`, `status`) VALUES ('', $admid, 0, 0, $loginid, 1)";
			$database2 = new Database();
			$dbCon2 = $database2->getConnection();
			$stmt2 = $dbCon2->prepare($product_sql);  
			$stmt2->execute();
		} 							
	}
	if($login_query == 1){
		header("location:adminmenus.php?msg=success");		
	} else {		
		header("location:adminmenus.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add New Admin Menu</h3>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Admin Menu</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" class="form-control" style="width: 780px;">
						</div>
                      </div>		  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="adminmenus.php"><button type="cancel" class="btn btn-primary">Cancel</button></a>
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
