<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

$id = $_REQUEST['id']; 
if(isset($_POST['submit']))
{	
	$title 		= ($_POST['title']);	
	$titlear 	= ($_POST['titlear']);	
	$code 		= ($_POST['code']);	
	
	$login_query = "UPDATE code8_colors SET title='$title', titlear='$titlear', code='$code' WHERE id=$id";
	
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($login_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
		
	if($res == 1){
		header("location:colors.php?msg=success");		
	} else {		
		header("location:colors.php?msg=fail");		
	}	
}	
?>
<link href="vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Color</h3>
              </div>
            </div>
			<?php
				$banner_que = "SELECT * from code8_colors where id=$id";
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
                    <h2>Edit Color</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Color Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="<?php echo $about_res['title'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Color Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="<?php echo $about_res['titlear'] ?>" class="form-control" style="width: 780px;">
						</div>
                     </div>	
			<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Color Code</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 ">
                                    <div class="input-group">
                                     <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" id="hexcolor"></input>

                                    <input type="color" id="colorpicker" name="code" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" > 
                                    </div>
                                </div>
                            </div>			
                        
                        
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="colors.php" class="btn btn-primary">Cancel</a>
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
<script src="vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script>
$('#colorpicker').on('change', function () {
        $('#hexcolor').val(this.value);
    });
    $('#hexcolor').on('change', function () {
        $('#colorpicker').val(this.value);
    });
    $('#colorpicker').on('change', function () {
        $('#hexcolor').val(this.value);
    });
    $('#hexcolor').on('change', function () {
        $('#colorpicker').val(this.value);
    });
</script>