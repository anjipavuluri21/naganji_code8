<?php 
require_once('auth.php');
include "header.php"; 
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3>Admin Menus</h3>
	  </div>             
	</div>
	<div class="clearfix"></div>
	<div class="row"> 
	  <div class="clearfix"></div>
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">                  
		  <div class="x_content"> 
		   <form name="fawsec" method="post" action="menuprioritize.php">
			<div class="table-responsive">
			  <table class="table table-striped jambo_table bulk_action">
				<thead>
				  <tr class="headings">                            
					<th width="100" class="column-title">Sl. No </th>
					<th width="300" class="column-title">Admin Menu Name</th>
					<th width="100" class="column-title">Priority </th>	 
					<th width="200" style="text-align:center" class="column-title no-link last"><span class="nobr">Action</span>
					</th>
					<th class="bulk-actions" colspan="7">
					  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
					</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$i = 1;				
				$banner_que = "SELECT * from code8_adminmenu where 1=1 ORDER BY id DESC";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($banner_que);  
				$stmt1->execute();	
				$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach($menbanner_res as $banner_result)
				{					
				?>
				  <tr class="even pointer">                            
					<td class=""><?php echo $i ?></td>
					<td class=""><?php echo $banner_result['menuname'] ?></td>
					<td class="">
						<input type="text" name="order[]" id="order" value="<?php echo $banner_result['corder'] ?>" class="form-control" style="width: 180px;">
						<input type="hidden" name="menuid[]" id="menuid" value="<?php echo $banner_result['id'] ?>" class="form-control" style="width: 180px;">
					</td>					
					<td style="text-align:center" class=" last">
						<a class="btn btn-info" href="adminmenu_edit.php?id=<?php echo $banner_result['id'] ?>">Edit</a>&nbsp;
					</td>
				  </tr>
				<?php 
				$i++;
				}	
				?>						                
				</tbody>
			  </table>
			  <p align="center"><button type="submit" name="submit" class="btn btn-success">Submit Priority</button></p>
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
			url:"deletecollection.php?type=adminmenu",
			success:function(data)
			{
				if(data=="done")
				{
					alert("Admin Menu deleted Successfully");
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
