<?php 
require_once('auth.php');
include "header.php"; 
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payments</h3>
              </div>             
            </div>

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
							<th width="300" class="column-title">Ordered By</th> 
							<th width="300" class="column-title">Email </th>
							<th width="300" class="column-title">Mobile </th>
							<th width="300" class="column-title">Transaction Id </th>
							<th width="300" class="column-title">Payment Id </th>
							<th width="300" class="column-title">Amount</th>
							<th width="300" class="column-title">Transaction Status</th>
							<th width="300" class="column-title">Paid Date </th>
                           <!-- <th width="200" style="text-align:center" class="column-title no-link last"><span class="nobr">Action</span></th>-->
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
						<?php
						$i = 1;
						$banner_que = "SELECT * from code8_payments where 1=1 ORDER BY id DESC";
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
							<td class=" "><?php echo $banner_result['CustomerName']; ?></td>
							<td class=" "><?php echo $banner_result['CustomerEmail'] ?></td>	
							<td class=" "><?php echo $banner_result['CustomerMobile'] ?></td>	
							<td class=" "><?php echo $banner_result['TransactionId'] ?></td>	
							<td class=" "><?php echo $banner_result['PaymentId'] ?></td>	
							<td class=" "><?php echo $banner_result['PaidCurrencyValue'] ?></td>	
							<td class=" "><?php 
							if($banner_result['TransactionStatus']==2){ 	echo "Success"; 
							} else if($banner_result['TransactionStatus']==3 || $banner_result['TransactionStatus']==1){
								echo "Failed";
							} 
							?></td>	
							<td class=" "><?php echo $banner_result['TransactionDate'] ?></td>	
							<!--<td style="text-align:center" class=" last">
							<a class="btn btn-info" href="viewportaluser.php?id=<?php echo $banner_result['id'] ?>">View</a>&nbsp; 
							<a class="btn btn-danger" href="#" id="delete_<?php echo $banner_result['id'] ?>"><i class="fa fa-trash"></i></a>&nbsp;
                            </td>-->
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
			url:"deletecollection.php?type=payment",
			success:function(data)
			{
				if(data=="done")
				{
					alert("User deleted Successfully");
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
$(function(){
	$("[id^='status_']").click(function(){
     	var i=$(this).attr('id');		
   	 	var arr=i.split("_");
   	 	var i=arr[1];
		var arr2=i.split("&");
		var j=arr2[1];
   	 	var r=confirm("Are you sure?");
   	 	if(r==true)
   	 	{   	 		
   	 	 $.ajax({
			type:"POST",
			data:"id="+i+"&"+j,
			url:"changestatus.php?type=payment",
			success:function(data)
			{
				if(data=="done")
				{
					alert("Status changed Successfully");
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
