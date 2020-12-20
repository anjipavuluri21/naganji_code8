<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{	
	$title 		= ($_POST['title']);	
	$titlear 	= ($_POST['titlear']);	
	$code 		= ($_POST['code']);	
		
	$login_query = "INSERT INTO code8_seasons (id, title, titlear) VALUES ('', '$title', '$titlear')";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($login_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
		
	if($res == 1){
		header("location:seasons.php?msg=success");		
	} else {		
		header("location:seasons.php?msg=fail");		
	}	
}	
?>		
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Season</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Season</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Season Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Season Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>										 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="seasons.php" class="btn btn-primary">Cancel</a>
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
