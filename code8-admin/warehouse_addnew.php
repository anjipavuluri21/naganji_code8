<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$title 		= ($_POST['title']);
	$titlear 	= ($_POST['titlear']);
	$countries 	= ($_POST['countries']);
	$location 	= ($_POST['location']);
	$expcon 	= implode(",",$countries);
		
	$adminmenu_query = "INSERT INTO code8_warehouses (id, title, titlear, location, countries) VALUES ('', '$title', '$titlear', '$location', '$expcon')";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($adminmenu_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
							
	if($res == 1){
		header("location:warehouses.php?msg=success");		
	} else {		
		header("location:warehouses.php?msg=fail");		
	}	
}	
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Warehouse</h3>
		  </div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12 control-label">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Add Warehouse</h2>                    
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content">
				<br />
				<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Warehouse Name<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="title" id="title" required="required" class="form-control" style="width: 780px;">
					</div>
				  </div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Warehouse Name (Arabic)<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="titlear" id="titlear" required="required" class="form-control" style="width: 780px;">
					</div>
				  </div>
				 <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Warehouse Location<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">						
						<select name="location" id="location" required class="form-control" style="width: 780px;">
							<option value="">-Select Category-</option>	
							<?php
							$j = 6;								
							$banner_que = "SELECT * from code8_countries where 1=1 ORDER BY id ASC";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($banner_que);  
							$stmt1->execute();	
							$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($menbanner_res as $banner_result)
							{
							?>
								<option value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['title'] ?></option>								
							<?php } ?>								
						</select>
					</div>
				  </div>
				  <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Countries
                          <br>
                          <small class="text-navy">Chose countries under this warehouse</small>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<?php
						$conbanner_que = "SELECT * from code8_countries where 1=1 ORDER BY id ASC";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($conbanner_que);  
						$stmt1->execute();	
						$conmenbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($conmenbanner_res as $conbanner_result)
						{
						?>	
                          <div class="checkbox">
                            <label>
                              <input name="countries[]" type="checkbox" class="flat" value="<?php echo $conbanner_result['id'] ?>"> <?php echo $conbanner_result['title']; ?> 
                            </label>
                          </div>
						<?php } ?>                                                  
                        </div>
                      </div>
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="warehouses.php" class="btn btn-primary">Cancel</a>
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
