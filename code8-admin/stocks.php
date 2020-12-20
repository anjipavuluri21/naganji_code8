<?php 
require_once('auth.php');
include "header.php"; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Stocks</h3>
              </div>             
            </div>
		<div class="clearfix"></div>			
			<a align="right" href="stock_addnew.php"><button class="btn btn-success"><i class="fa fa-plus"></i> Add Stock</button></a>			
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
                            <th width="100" class="column-title">Sl. No </th>			
							<th width="300" class="column-title">Product Name</th> 
							<th width="300" class="column-title">Warehouse Name</th>
							<th width="150" class="column-title">Size </th>
							<th width="200" class="column-title">Color </th>
                            <th width="150" class="column-title">Quantity </th>
							<th width="150" class="column-title">Quantity Sold</th>
                            <th width="200" style="text-align:center" class="column-title no-link last"><span class="nobr">Action</span></th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
						<?php
						$i = 1;
						$banner_que = "SELECT * from code8_stocks where 1=1 ORDER BY id DESC";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($banner_que);  
						$stmt1->execute();	
						$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
						foreach($menbanner_res as $banner_result)
						{
							$prid = $banner_result['prodid'];
							$size = $banner_result['size'];
							$color= $banner_result['color'];
							
							$stoc_que = "SELECT *, sum(quantity) as availstock from code8_cartproducts where prodid=$prid AND sizeid=$size AND colorid=$color AND status=2";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($stoc_que);  
							$stmt1->execute();	
							$stoc_res = $stmt1->fetch(PDO::FETCH_ASSOC);
							$availstock = $stoc_res['availstock'];
							if($stoc_res['availstock']==""){
								$availstock = 0;
							} else {
								$availstock = $availstock;
							}
						?>
                          <tr class="even pointer">                     
                            <td class=" "><?php echo $i ?></td>
							<td class=" "><?php echo getProduct($banner_result['prodid']); ?></td>
							<td class=" "><?php echo getWarehouse($banner_result['warehouseid']); ?></td>	
							<td class=" "><?php echo getSize($banner_result['size']); ?></td>	
							<td class=" "><?php echo getColor($banner_result['color']); ?></td>	
							<td class=" "><?php echo $banner_result['quantity'] ?></td>
							<td class=" "><?php echo $availstock ?></td>	
							<td style="text-align:center" class=" last">
							<a class="btn btn-info" href="stock_edit.php?id=<?php echo $banner_result['id'] ?>">Edit</a>&nbsp; 
							<a class="btn btn-danger" href="#" id="delete_<?php echo $banner_result['id'] ?>"><i class="fa fa-trash"></i></a>&nbsp;
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
			url:"deletecollection.php?type=stock",
			success:function(data)
			{
				if(data=="done")
				{
					alert("Data deleted Successfully");
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
