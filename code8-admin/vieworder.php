<?php 
require_once('auth.php');
include "header.php";
$id = $_REQUEST['id'];

if(isset($_POST['submit']))
{		
	$orderstatus = $_POST['orderstatus'];		
	$login_query = "UPDATE code8_cartproducts SET orderstatus='$orderstatus' WHERE orderid='$id'"; 
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($login_query);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
}
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Order Details</h3>
              </div>             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Order Details </h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<?php						
						$banner_que = "SELECT * from code8_cartproducts where status IN (2,3) AND orderid='$id'";
						$database1 = new Database();
						$dbCon1 = $database1->getConnection();
						$stmt1 = $dbCon1->prepare($banner_que);  
						$stmt1->execute();	
						$menbanner_res = $stmt1->fetch(PDO::FETCH_ASSOC);
						$customerdata = getCustomerdata($menbanner_res['customerid']);
						$customertype = $customerdata['customertype'];						
					?>
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
							  <i class="fa fa-globe"></i> Order ID: <?php echo $id ?>
							  <small class="pull-right">Order Date: <?php echo $menbanner_res['date']; ?></small>
						  </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          <h2><b>House Address:</b></h2>
                          <address>
							  <strong><?php echo $customerdata['fullname']; ?></strong>
							  <br>
							  <?php  
							  if($customertype==2){  echo getCustomerShipaddress($menbanner_res['customerid']); 
							  } else { echo getGuestShipaddress($menbanner_res['customerid']); }  ?>
							  <br>Phone: <?php echo $customerdata['mobile'] ?>
							  <br>Email: <?php echo $customerdata['email'] ?>
						  </address>
                        </div>
						<div class="col-sm-4 invoice-col">
                         <h2><b>Building Address:</b></h2>
                          <address>
							  <?php 
							  if($customertype==2){  echo getCustomerBilladdress($menbanner_res['customerid']); 
							  } else { echo getGuestBilladdress($menbanner_res['customerid']); }							  
							  ?>
							  <br>Phone: <?php echo $customerdata['mobile'] ?>
							  <br>Email: <?php echo $customerdata['email'] ?>
						  </address>
                        </div>                             
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>                               
                                <th>Product Name</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Qty</th>
                                <th>Price</th>        
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php
							$totamt =0;							
							$prod_que = "SELECT * from code8_cartproducts where status IN (2,3) AND orderid='$id'";
							$database1 = new Database();
							$dbCon1 = $database1->getConnection();
							$stmt1 = $dbCon1->prepare($prod_que);  
							$stmt1->execute();	
							$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							foreach($prod_res as $prod_result)	
							{									
								$prodid = getProductData($prod_result['prodid']);
								$amt = $prod_result['quantity']*$prod_result['product_price'];	
								$totamt+=$amt;
								$grandtotal = $totamt+$menbanner_res['tax']+$menbanner_res['shipping'];	
							?>
                              <tr>                               
                                <td><?php echo $prodid['prodtitle']; ?></td>
								<td><?php echo getCategory($prodid['catid']); ?></td>
								<td><?php echo getCollectionsSubmenu($prodid['subcat']); ?></td>
								<td><?php echo $prod_result['quantity']; ?></td>
                                <td><?php echo $prod_result['product_price']; ?> <?php echo $prod_result['currencycode']; ?></td> 
                                <td><?php echo number_format($amt,3); ?> <?php echo $prod_result['currencycode']; ?></td>
                              </tr>
                            <?php } ?>  
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->  
					  <div class="row">
						<div class="col-xs-8">
						  <form method="post">	
							  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Update Order Status<span class="required">*</span>
								</label>                        
								<div class="col-md-3 col-sm-3 col-xs-12">
									<select name="orderstatus" id="orderstatus" required class="form-control" >
										<option value="">-Select Status-</option>
										<?php				
										$order_que = "SELECT * from code8_deliverystatus where 1=1";
										$database1 = new Database();
										$dbCon1 = $database1->getConnection();
										$stmt1 = $dbCon1->prepare($order_que);  
										$stmt1->execute();	
										$ordersta_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
										foreach($ordersta_res as $ordersta_result)	
										{	
										?>
										<option <?php if($menbanner_res['orderstatus']==$ordersta_result['id']){ echo "selected"; } ?> value="<?php echo $ordersta_result['id']; ?>"><?php echo $ordersta_result['title']; ?></option>
										<?php } ?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<div class="clearfix">&nbsp;</div>
								</div>
							  </div>
							  
							  <div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" name="submit" class="btn btn-success">Submit</button>
								</div>
							  </div>
							</form>					  
						</div>
						<div class="col-xs-4">
						<table class="table">
                              <tbody>                        
                                <tr>
                                  <th>Tax:</th>
                                  <td><?php echo number_format($menbanner_res['tax'],3);?> <?php echo $prod_result['currencycode']; ?></td>
                                </tr> 
								<tr>
                                  <th>Shipping:</th>
                                  <td><?php echo number_format($menbanner_res['shipping'],3);?> <?php echo $prod_result['currencycode']; ?></td>
                                </tr>
								<tr>
                                  <th>Grand Total:</th>
                                  <td><?php echo number_format($grandtotal,3);?> <?php echo $prod_result['currencycode']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          <!--<p class="lead">Total Amount</p>-->
                         </div>
                        <!-- /.col -->
						
                      </div>
                      <!-- this row will not appear when printing
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div> -->					 
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include "footer.php" ?>
