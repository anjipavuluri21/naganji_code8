<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title 			= $_POST['title'];
	$titlear 		= $_POST['titlear'];
	$content 		= $_POST['content'];		
	$contentar 		= $_POST['contentar'];		
	$email		 	= $_POST['email'];
	$call		 	= $_POST['call'];		
		
	 $login_query = "UPDATE code8_helpcontent SET title='$title', content='$content', titlear='$titlear', contentar='$contentar', email='$email', callus='$call' WHERE id=1"; 
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();						
	
	if($res == 1){
		header("location:helpdeliverycontent.php?msg=success");		
	} else {		
		header("location:helpdeliverycontent.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Help Content</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_helpcontent where id=1";
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
                    <h2>Help Content</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="<?php echo $about_res['title'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>	
				     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title(Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Content:<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="content" id="content" class="form-control" style="width: 780px;"><?php echo $about_res['content'] ?></textarea>
						</div>
                     </div>				
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Content (Arabic):<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">					
							<textarea name="contentar" id="contentar" class="form-control" style="width: 780px;"><?php echo $about_res['contentar'] ?></textarea>
						</div>
                     </div>				
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="email" name="email" id="email" required="required" value="<?php echo $about_res['email'] ?>" class="form-control" style="width: 780px;">
						</div>
                      </div>													  
					  					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Call<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="call" id="call" required="required" value="<?php echo $about_res['callus'] ?>" class="form-control" style="width: 780px;">
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