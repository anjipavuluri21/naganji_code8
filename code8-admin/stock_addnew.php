<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$product    = ($_POST['product']);
	$warehouse 	= ($_POST['warehouse']);
	$size 		= ($_POST['size']);
	$color 		= ($_POST['color']);
	$quantity 	= ($_POST['quantity']);
	
		
	$adminmenu_query = "INSERT INTO code8_stocks (id, prodid, warehouseid, size, color, quantity, date) VALUES ('', '$product', '$warehouse', '$size', '$color', '$quantity',NOW())";
	$database0 = new Database();
	$dbCon0 = $database0->getConnection();
	$stmt0 = $dbCon0->prepare($adminmenu_query);  
	$stmt0->execute();	
	$res = $stmt0->rowCount();
							
	if($res == 1){
		header("location:stocks.php?msg=success");		
	} else {		
		header("location:stocks.php?msg=fail");		
	}	
}	
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Stock</h3>
		  </div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12 control-label">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Add Stock</h2>                    
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content">
				<br />
				<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select name="product" id="product" required class="form-control" style="width: 780px;">
							<option value="">-Select Product-</option>	
							<?php
							$j = 6;								
							$banner_que = "SELECT * from code8_products where 1=1 ORDER BY id ASC";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($banner_que);  
							$stmt1->execute();	
							$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($menbanner_res as $banner_result)
							{
							?>
								<option value="<?php echo $banner_result['id'] ?>"><?php echo $banner_result['prodtitle'] ?></option>								
							<?php } ?>								
						</select>
					</div>
				  </div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Warehouse<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select name="warehouse" id="warehouse" required class="form-control" style="width: 780px;">
							<option value="">-Select Warehouse-</option>	
							<?php
							$j = 6;								
							$banner_que = "SELECT * from code8_warehouses where 1=1 ORDER BY id ASC";
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Size<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">						
						<select name="size" id="size" required class="form-control" style="width: 780px;">
							<option value="">-Select Size-</option>	
							<?php
							$j = 6;								
							$banner_que = "SELECT * from code8_sizes where 1=1 ORDER BY id ASC";
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Color<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">						
						<select name="color" id="color" required class="form-control" style="width: 780px;">
							<option value="">-Select Color-</option>	
							<?php
							$j = 6;								
							$banner_que = "SELECT * from code8_colors where 1=1 ORDER BY id ASC";
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="number" name="quantity" id="quantity" required="required" value="" class="form-control" style="width: 780px;">
						</div>
                      </div>
				  
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="stocks.php" class="btn btn-primary">Cancel</a>
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
