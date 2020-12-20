<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$address 		= $_POST['address'];
	$addressar 		= $_POST['addressar'];
	$telephone		= $_POST['telephone'];	
	$pobox			= $_POST['pobox'];		
	$email 			= $_POST['email'];		
			
	$login_query = "UPDATE code8_contactpage SET address='$address', addressar='$addressar', telephone='$telephone', pobox='$pobox', email='$email' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();						
	
	if($res == 1){
		header("location:contactpage.php?msg=success");		
	} else {		
		header("location:contactpage.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Contact Page</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_contactpage where id=1";
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
                    <h2>Contact Page</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="address" id="address" required="required" value="<?php echo $about_res['address'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="addressar" id="addressar" required="required" value="<?php echo $about_res['addressar'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Telephone:<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="telephone" id="telephone" required="required" value="<?php echo $about_res['telephone'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>				
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">P.O.Box:<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="pobox" id="pobox" required="required" value="<?php echo $about_res['pobox'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>				
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="email" id="email" required="required" value="<?php echo $about_res['email'] ?>" class="form-control" style="width: 780px;">
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
<?php include "footer.php" ?>
