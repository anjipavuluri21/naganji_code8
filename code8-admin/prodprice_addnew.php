<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$product    = $_POST['product'];
	$country 	= $_POST['country'];
	$price 		= $_POST['price'];
	$countcomb	= count($_POST['country']);
	
	for($i=0;$i<=$countcomb;$i++){	
		if($price[$i]!=""){	
			$adminmenu_query = "INSERT INTO code8_prodprices (id, prodid, country, price) VALUES ('', '$product', '$country[$i]', '$price[$i]')";
			$database0 = new Database();
			$dbCon0 = $database0->getConnection();
			$stmt0 = $dbCon0->prepare($adminmenu_query);  
			$stmt0->execute();	
			$res = $stmt0->rowCount();
		}
	}
							
	if($res == 1){
		header("location:pricemanagement.php?msg=success");		
	} else {		
		header("location:pricemanagement.php?msg=fail");		
	}	
}	
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Add Product Price</h3>
		  </div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12 control-label">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Add Product Price</h2>                    
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content">
				<br />
				<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Name<span class="required">*</span>
					</label>                        
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select name="product" id="product" required class="form-control" style="width: 645px;">
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Enter Kuwait Price<span class="required">*</span>
					</label>                        
					<div class="col-md-5 col-sm-9 col-xs-12">
						<input type="text" name="kuwaitprice" id="kuwaitprice" required="required" class="form-control">
					</div>
					<div class="col-md-1 col-sm-9 col-xs-12">
						<a href="#" class="btn btn-primary getprice">Get Prices</a>
					</div>				
				 </div> 
				 <!-- Image loader -->
				<div id="loader" align="center" style="display:none">
				<p>
				  <img src='../images/bx_loader.gif' width='32px' height='32px'>
				</p>
				</div>
				<!-- Image loader --> 
				<?php									
				$numcont_que = "SELECT * from code8_countries where 1=1 ORDER BY id ASC";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($numcont_que);  
				$stmt1->execute();	
				$numcont_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($numcont_res as $numcont_result)
				{
					$contcode[] = $numcont_result['currencycode'];	
					$implodecountries = implode(',',$contcode);
				?>					  	
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Country<span class="required">*</span>
					</label>                        
					<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="hidden" name="country[]" value="<?php echo $numcont_result['id']; ?>">
					<input type="hidden" name="currencycode[]" id="currencycode<?php echo $numcont_result['id']; ?>" value="<?php echo $numcont_result['currencycode']; ?>">
					<input type="text" name="countrys[]" id="countrys" required="required" value="<?php echo $numcont_result['title']; ?>" class="form-control countrys" readonly>
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Price<span class="required">*</span>
					</label>                        
					<div class="col-md-2 col-sm-2 col-xs-12">
						<input type="text" name="price[]" id="<?php echo $numcont_result['currencycode']; ?>" required="required" value="" class="form-control" >
					</div>
				  </div>
				<?php } ?>
				<input type="hidden" name="countrieslist[]" id="countrieslist" value="<?php echo $implodecountries; ?>">
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="pricemanagement.php" class="btn btn-primary">Cancel</a>
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
$(".getprice").click(function () {
	var price = $("#kuwaitprice").val();
	var countrycode = $("#countrieslist").val();
	
	$.ajax({
		type: "POST",
		url: "fixerconvert.php",
		data: "price="+price+"&countrycode="+countrycode,	
		dataType: "json",
		beforeSend: function(){
		
			$("#loader").show();
	    },
		success: function (response) {
			
			<?php 
			$numcont_que = "SELECT * from code8_countries where 1=1 ORDER BY id ASC";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($numcont_que);  
			$stmt1->execute();	
			$numcont_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			foreach($numcont_res as $numcont_result)
			{
				$currcode = $numcont_result['currencycode'];
			?>	
			$('#<?php echo $currcode; ?>').val(response.<?php echo $numcont_result['currencycode']; ?>);
			<?php } ?>
		},
			complete:function(data){
			
			$("#loader").hide();
	   }
		
	});
});
</script>

<?php include "footer.php" ?>
