<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{	
	$menutype 	= ($_POST['menutype']);	
	$menuid 	= ($_POST['menuid']);	
	$title 		= ($_POST['title']);	
	$titlear 	= ($_POST['titlear']);	
		
	$login_query = "INSERT INTO code8_collectionssubmenu (id, menuid, title, titlear, menutype) VALUES ('', '$menuid', '$title', '$titlear', '$menutype')";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($login_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
		
	if($res == 1){
		header("location:collectionssubmenu.php?msg=success");		
	} else {		
		header("location:collectionssubmenu.php?msg=fail");		
	}	
}	
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Collection SubMenu</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Collection SubMenu</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Menu Category<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menutype" id="menutype" required class="form-control" >
								<option value="">-Menu Category-</option>	
								<option value="1">Collections</option>
								<option value="2">Women</option>
							</select>
						</div>
                    </div> 
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Collection Menu<span class="required">*</span>
                        </label>                        
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="menuid" id="menuid" required class="form-control" >
								<option value="">-Select Menu-</option>	
								<?php		
								/*$banner_que = "SELECT * from code8_collectionsmenu where 1=1 ORDER BY id ASC";
								$database1 = new Database();
								$dbCon1 = $database1->getConnection();
								$stmt1 = $dbCon1->prepare($banner_que);  
								$stmt1->execute();	
								$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
								foreach($menbanner_res as $banner_result)
								{
								?>
									<option value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['title'] ?></option>								
								<?php }*/ ?>								
							</select>
						</div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">SubMenu Name<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="title" id="title" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">SubMenu Name (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="titlear" id="titlear" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                     </div>		 
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="collectionssubmenu.php" class="btn btn-primary">Cancel</a>
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
<script>
$(document).ready(function(){
    $('#menutype').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        $.ajax({
            url: "getcatsofmenu.php",
            type: "POST",
            data: "categoryId="+categoryId,
            success: function (response) {
               // console.log(response);
                $("#menuid").html(response);
            },
        });
    }); 
});
</script>
<?php include "footer.php" ?>
