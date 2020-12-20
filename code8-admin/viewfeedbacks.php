<?php 
require_once('auth.php');
include "header.php";
?>
	<!-- page content -->
	<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<h3>Feedbacks</h3>
		  </div>             
		</div>
		<div class="clearfix"></div>
		<div class="row">
		  <div class="clearfix"></div>
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">                  
			  <div class="x_content">
				<div class="table-responsive" style="overflow:hidden">
				  <table id="datatable" class="table table-striped jambo_table bulk_action">
					<thead>
					  <tr class="headings">                            
						<th width="100" class="column-title">Sl. No </th>
						<th width="300" class="column-title">Name </th>
						<th width="300" class="column-title">Email </th>
						<th width="300" class="column-title">Mobile </th>
						<th width="300" class="column-title">Comments</th>
						<th width="300" class="column-title">Date </th>									
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
					$banner_que = "SELECT * from code8_feedbacks where 1=1";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($banner_que);  
					$stmt1->execute();	
					$about_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
					foreach($about_res as $banner_result)
					{												
					?>
					  <tr class="even pointer">                            
						<td class=" "><?php echo $i ?></td>
						<td class=" "><?php echo $banner_result['name'] ?></td>
						<td class=" "><?php echo $banner_result['email'] ?></td> 
						<td class=" "><?php echo $banner_result['mobile'] ?></td> 
						<td class=" "><?php echo $banner_result['comments'] ?></td>	
						<td class=" "><?php echo $banner_result['date'] ?></td>
						<td style="text-align:center" class=" last">
						<a class="btn btn-danger" href="#" id="delete_<?php echo $banner_result['id'] ?>">Delete</a>
						</td>
					  </tr>
					<?php 
					$i++;
					}							
					?>                            
					</tbody>
				  </table>
				</div>
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
			url:"deletecollection.php?type=feedback",
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