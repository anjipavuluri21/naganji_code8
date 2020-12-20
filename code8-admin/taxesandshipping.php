<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{		
	$country 	= $_POST['country'];
	$tax 		= $_POST['tax'];
	$shipping 	= $_POST['shipping'];
	$countcomb	= count($_POST['country']);
	$hiddencombi = $_POST['hiddencombi'];
	$hiddenshipping = $_POST['hiddenshipping'];
	$hiddentaxes = $_POST['hiddentaxes'];
	
	for($i=0;$i<=$countcomb;$i++){	
		if($tax[$i]!=""){
			if($hiddencombi[$i]!="" && $hiddentaxes[$i]!=""&& $hiddenshipping[$i]!=""){			
				$adminmenu_query = "UPDATE code8_taxesandshipping SET country='$country[$i]', taxes='$tax[$i]', shipping='$shipping[$i]' WHERE country=$hiddencombi[$i]";
				$database0 = new Database();
				$dbCon0 = $database0->getConnection();
				$stmt0 = $dbCon0->prepare($adminmenu_query);  
				$stmt0->execute();	
				$res = $stmt0->rowCount();
			} else {
				$adminmenu_query = "INSERT INTO code8_taxesandshipping (id, taxes, country, shipping) VALUES ('', '$tax[$i]', '$country[$i]', '$shipping[$i]')";
				$database01 = new Database();
				$dbCon0 = $database01->getConnection();
				$stmt01 = $dbCon0->prepare($adminmenu_query);  
				$stmt01->execute();	
				$res01 = $stmt01->rowCount();
			}
		}
	}
							
	if($res==1||$res01==1){
		header("location:taxesandshipping.php?msg=success");		
	} else {		
		header("location:taxesandshipping.php?msg=fail");		
	}	
}	
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Taxes & Shipping Charges</h3>
		  </div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12 control-label">
			<div class="x_panel">
			  <div class="x_title">
				<h2>Taxes & Shipping Charges</h2>                    
				<div class="clearfix"></div>
			  </div>
			  <div class="x_content">
				<br />
				<form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
				<?php													
				$numcont_que = "SELECT * from code8_countries where 1=1 ORDER BY id ASC";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($numcont_que);  
				$stmt1->execute();	
				$numcont_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($numcont_res as $numcont_result)
				{
					$contryid = $numcont_result['id'];
					$banner_queval = "SELECT * from code8_taxesandshipping where country=$contryid";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($banner_queval);  
					$stmt1->execute();	
					$about_resval = $stmt1->fetch(PDO::FETCH_ASSOC);
					$taxval = $about_resval['taxes'];
					$shipval = $about_resval['shipping'];					
				?>
				<input type="hidden" name="hiddencombi[]" value="<?php echo $about_resval['country']; ?>">
				<input type="hidden" name="hiddentaxes[]" value="<?php echo $taxval; ?>"><input type="hidden" name="hiddenshipping[]" value="<?php echo $shipval; ?>">				
				  <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Country<span class="required">*</span>
					</label>                        
					<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="hidden" name="country[]" value="<?php echo $numcont_result['id']; ?>">
					<input type="text" name="countrys[]" id="countrys" required="required" value="<?php echo $numcont_result['title']; ?>" class="form-control countrys" readonly>
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Tax<span class="required">*</span>
					</label>                        
					<div class="col-md-2 col-sm-2 col-xs-12">
						<input type="number" name="tax[]" id="tax" required="required" value="<?php echo $taxval; ?>" class="form-control" >
					</div>
					<label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Shipping Price<span class="required">*</span>
					</label>                        
					<div class="col-md-2 col-sm-2 col-xs-12">
						<input type="number" name="shipping[]" id="shipping" required="required" value="<?php echo $shipval; ?>" class="form-control" >
					</div>
				  </div>
				<?php } ?>
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="taxesandshipping.php" class="btn btn-primary">Cancel</a>
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
