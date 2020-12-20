<?php 
require_once('auth.php');
include "header.php"; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Product Price Management</h3>
              </div>             
            </div>
		<div class="clearfix"></div>			
			<a align="right" href="prodprice_addnew.php"><button class="btn btn-success"><i class="fa fa-plus"></i> Add Product Price</button></a>			
		<div class="clearfix"></div>
            <div class="row">
              <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">                  
                  <div class="x_content"> 
                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">                            
                            <th width="50" class="column-title">Sl. No </th>			
							<th width="300" class="column-title">Product Name</th> 
							
                            <th width="200" style="text-align:center" class="column-title no-link last"><span class="nobr">Action</span></th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
						<?php
						$i = 1;
						$banner_que = "SELECT * from code8_prodprices where 1=1 GROUP BY prodid ORDER BY id DESC";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($banner_que);  
						$stmt1->execute();	
						$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($menbanner_res as $banner_result)						
						{
						?>
                          <tr class="even pointer">                            
                            <td class=" "><?php echo $i ?></td>							
							<td class=" "><?php echo getProduct($banner_result['prodid']); ?></td>
							<td style="text-align:center" class=" last">
							<a class="btn btn-info" href="prodprice_edit.php?id=<?php echo $banner_result['prodid'] ?>">Edit</a>&nbsp; 
							<a class="btn btn-danger" href="#" id="delete_<?php echo $banner_result['prodid'] ?>"><i class="fa fa-trash"></i></a>&nbsp;
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
			url:"deletecollection.php?type=prodprice",
			success:function(data)
			{
				alert("Data deleted Successfully");
				location.reload();				
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
