<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

function sizes() {
	$output="";
	$banner_que = "SELECT * from code8_sizes where 1=1 ORDER BY id ASC";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($menbanner_res as $banner_result)
	{
		$output .= '<option value="'.$banner_result["id"].'">'.$banner_result["title"].'</option>';
	}		
	return $output;
}
function colors() {
	$output="";
	$banner_que = "SELECT * from code8_colors where 1=1 ORDER BY id ASC";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($menbanner_res as $banner_result)
	{
		$output .= '<option value="'.$banner_result["id"].'">'.$banner_result["title"].'</option>';
	}		
	return $output;
}


if(isset($_POST['submit']))
{			
	$product    = $_POST['product'];
	$size 		= $_POST['size'];
	$color 		= $_POST['color'];
	$countcomb	= count($_POST['size']);
	
	for($i=0;$i<=$countcomb;$i++){
		if($size[$i]!=""){
			$adminmenu_query = "INSERT INTO code8_prodcombinations (id, prodid, sizes, colors) VALUES ('', '$product', '$size[$i]', '$color[$i]')";
			$database0 = new Database();
			$dbCon0 = $database0->getConnection();
			$stmt0 = $dbCon0->prepare($adminmenu_query);  
			$stmt0->execute();	
			$res = $stmt0->rowCount();
		}		
	}		
							
	if($res == 1){
		header("location:prodcombinations.php?msg=success");		
	} else {		
		header("location:prodcombinations.php?msg=fail");		
	}	
}	
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Product Combinations</h3>
		  </div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12 control-label">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Add Product Combinations</h2>                    
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content">
				<br />
				<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name <span class="required">*</span>
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
				 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name <span class="required">*</span>
				 </label>
				   <div class="col-md-6 col-sm-12 col-xs-12">						 
					 <table class="table table-bordered" id="item_table">
						  <tr>								   
						   <th>Select Size</th>
						   <th>Select Color</th>						   
						   <th><button type="button" name="add" class="btn btn-success btn-sm addbtn"><span class="glyphicon glyphicon-plus"></span></button></th>
						  </tr>
						  <tr>							
							 <td>
							 <select name="size[]" id="size" required class="form-control" style="width: 350px;">
								<option value="">-Select Size-</option>	
								<?php											
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
							</td>
							<td>
							   <select name="color[]" id="color" required class="form-control" style="width: 350px;">
								<option value="">-Select Color-</option>	
								<?php	
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
							</td>							
							<td>
								<button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button>
							</td>
						 </tr>							
					  </table>
					</div>
				  </div>
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="prodcombinations.php" class="btn btn-primary">Cancel</a>
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
$(document).ready(function() {
	$(document).on('click', '.addbtn', function(){
	  var html = '';
	  html += '<tr>';	  
	  html += '<td><select name="size[]" required class="form-control size_available"><option value="">Select Size</option> <?php echo sizes(); ?>	  </select></td>';
	  html += '<td><select name="color[]" required class="form-control color_available"><option value="">Select Color</option>	<?php echo colors(); ?>  </select></td>';
	  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
	  $('#item_table').append(html);
	 });
	 
	 $(document).on('click', '.remove', function(){
	  $(this).closest('tr').remove();
	 });
});
</script>
<?php include "footer.php" ?>

