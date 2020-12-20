<?php 
ob_start();
require_once('auth.php');
include "header.php"; 

if(isset($_POST['submit']))
{			
	$condition 		= $_POST['condition'];
	$conditionar 	= $_POST['conditionar'];
	$charges 		= $_POST['charges'];
	$chargesar 		= $_POST['chargesar'];
	$field_id 		= $_POST['field_id'];
	
	$return 		= $_POST['return'];
	$returnar 	 	= $_POST['returnar'];
	
	if($return!=""){
		$ret_query = "UPDATE code8_deliveryterms SET termcondition='$return', conditionar='$returnar' WHERE id=1"; 
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt12 = $dbCon1->prepare($ret_query);  
		$stmt12->execute();
		$ret = $stmt12->rowCount();		
	}
		
	for ($i = 0; $i < count($condition); $i++) {
		$idd  = $field_id[$i];
		if($idd!="")									
		{
			$login_query = "UPDATE code8_deliveryterms SET termcondition='$condition[$i]', conditionar='$conditionar[$i]', charge='$charges[$i]', chargear='$chargesar[$i]' WHERE id=$idd"; 
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($login_query);  
			$stmt1->execute();
			$res = $stmt1->rowCount();
		} else {
			$login_query = "INSERT INTO code8_deliveryterms (id, termcondition, conditionar, charge, chargear) VALUES ('','$condition[$i]', '$conditionar[$i]', '$charges[$i]', '$chargesar[$i]')"; 
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($login_query);  
			$stmt1->execute();
			$res = $stmt1->rowCount();
		}		
	}	
	
	if($res == 1 || $ret == 1){
		header("location:deliveryreturn.php?msg=success");		
	} else {		
		header("location:deliveryreturn.php?msg=fail");		
	}	
}	
?>
<style>
.add_button { color:black; }
.remove_button { color:black; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =  {row :function(f){           
			return '<div'+x+'><div class="field_wrapper1"><div class="form-group"><label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name"></label><div class="col-md-4 col-sm-4 col-xs-12"><input type="text" name="condition[]" required="required" placeholder="Condition" value="" style="width: 480px;" class="form-control"><input type="text" name="conditionar[]" required="required" placeholder="Condition Arabic" value="" style="width: 480px;" class="form-control"></div><div class="col-md-2 col-sm-2 col-xs-12"><input type="text" name="charges[]" required="required" value="" placeholder="Charges" style="width: 280px;" class="form-control"><input type="text" name="chargesar[]" required="required" value="" placeholder="Charges Arabic" style="width: 280px;" class="form-control"><a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a></div></div></div></div1>';
        }};

    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML.row(x)); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
		//alert("div"+x);
      // $(this).parent("div"+x).remove(); //Remove field html
	   $("div"+x).remove();
	   //$(wrapper).(fieldHTML.row(x)).remove(); 
        x--; //Decrement field counter
    });
});
</script>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Delivery & Return Content</h3>
              </div>
			<?php
				$banner_que = "SELECT * from code8_deliveryterms where id=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($banner_que);  
				$stmt1->execute();	
				$about_ress = $stmt1->fetch(PDO::FETCH_ASSOC);
			?>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Delivery & Return Content</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
					
					<div class="form-group">
						<div class="field_wrapper">	
					<br>
					<div class="form-group">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name"><span class="required">Add Terms for Delivery: </span>
                        </label> 
						
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div align="left;" style="text-align:left; text-decoration:underline"><a align="right" href="javascript:void(0);" class="add_button" title="Add field">Add Terms </a></div>	
						</div>	
                    </div>	
					<?php
						$j=1;	
						$banner_que = "SELECT * from code8_deliveryterms where id!=1";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($banner_que);  
						$stmt1->execute();	
						$about_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($about_res as $about_resval)
						{						
						?><div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name"><span class="required"></span>
							</label>											
							<input type="hidden" name="field_id[]" value="<?php echo $about_resval['id'] ?>" >		
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="text" name="condition[]" required="required" placeholder="Condition" value="<?php echo $about_resval['termcondition'] ?>" style="width: 480px;" class="form-control">
								<input type="text" name="conditionar[]" required="required" placeholder="Condition Arabic" value="<?php echo $about_resval['conditionar'] ?>" style="width: 480px;" class="form-control">
							</div>
							
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" name="charges[]" required="required" placeholder="Charge" value="<?php echo $about_resval['charge'] ?>" style="width: 280px;" class="form-control">
								<input type="text" name="chargesar[]" required="required" placeholder="Charge Arabic" value="<?php echo $about_resval['chargear'] ?>" style="width: 280px;" class="form-control">
								<p><a href="#" id="delete_<?php echo $about_resval['id'] ?>" class="remove_button" title="Remove field">Remove</a></p>
							</div>						
							</div>	
					<?php $j++; }  ?>	
						</div>					
                    </div>
					<div class="form-group">
						
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Return<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="return" id="return" required="required" value="<?php echo $about_ress['termcondition'] ?>" placeholder="Return" class="form-control" style="width: 780px;">
						</div>
						<label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Return (Arabic)<span class="required">*</span>
                        </label>                        
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" name="returnar" id="returnar" required="required" value="<?php echo $about_ress['conditionar'] ?>" placeholder="Return Arabic" class="form-control" style="width: 780px;">
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
<script>
$(function(){	
	$("[id^='delete_']").click(function(){		
     	var i=$(this).attr('id');		
   	 	var arr=i.split("_");
   	 	var i=arr[1];
   	 	var r=confirm("Are you sure?");
   	 	if(r==true)
   	 	{   	 		
   	 	 $.ajax({
			type:"POST",
			data:"id="+i,
			url:"deletecollection.php?type=condition",
			success:function(data)
			{
				if(data=="done")
				{
					alert("Deleted Successfully");
					location.reload();
				}
			}
		  });
		 }
		 else
		 {
			return false;
		 }
	});
});
</script>
<?php include "footer.php" ?>
<script>
	CKEDITOR.replace('content');
	CKEDITOR.replace('contentar', {	language:'ar'});	
</script>