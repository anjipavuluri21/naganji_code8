<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{		
	$content 	= $_POST['content'];		
	$contentar 	= $_POST['contentar'];		
				
	$login_query = "UPDATE code8_privacypolicy SET content='$content', contentar='$contentar' WHERE id=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();		
		
	if($res == 1){
		header("location:privacypolicycontent.php?msg=success");		
	} else {		
		header("location:privacypolicycontent.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Privacy Policy Content</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_privacypolicy where id=1";
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
                    <h2>Privacy Policy Content</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Content<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">				
							<textarea name="content" id="content" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['content'] ?></textarea>
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Content(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="contentar" id="contentar" required="required" class="form-control" style="width: 780px;"><?php echo $about_res['contentar'] ?></textarea>
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
<script>
	CKEDITOR.replace('content');
	CKEDITOR.replace('contentar', {	language:'ar'});	
</script>