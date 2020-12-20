<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id']; 
$loginid = $_SESSION['SESS_MEMBER_ID'];
if(isset($_POST['submit']))
{			
	$title 	= $_POST['title'];	
		
	$adminmenu_query = "UPDATE code8_deliverystatus SET title='$title' WHERE id=$id";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($adminmenu_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
	
	if($res == 1){
		header("location:shippingstatus.php?msg=success");		
	} else {		
		header("location:shippingstatus.php?msg=fail");		
	}	
}	
?>
<?php
	$banner_que = "SELECT * from code8_deliverystatus where id=$id";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);					
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Ship Status</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Ship Status</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" class="form-control" style="width: 780px;" value="<?php echo $about_res['title']; ?>">
						</div>
                      </div>		  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="shippingstatus.php" class="btn btn-primary">Cancel</a>
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
