<?php 
require_once('auth.php');
include "header.php"; 
?>
<style>
.greenew {
    color: #906D36;
}
</style>
	<!-- page content -->
	<div class="right_col" role="main">
	<!-- top tiles -->
	<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_products where status=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	?>
	  <span class="count_top"><i class="fa fa-bullhorn"></i> No of Products</span>
	  <div class="count greenew"><?php echo $about_res['prodcount']; ?></div>              
	</div>           
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_products where status=0";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	?>
	  <span class="count_top"><i class="fa fa-archive"></i> Inactive</span>
	  <div class="count greenew"><?php echo $about_res['prodcount']; ?></div>              
	</div>
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_cartproducts where status=2 GROUP BY orderid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	$ressuc = $stmt1->rowCount();
	?>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-folder"></i> No of Orders</span>
	  <div class="count greenew"><?php echo $ressuc; ?></div>              
	</div>
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_customers where status=1";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	?>
	 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-user"></i> Registered Users</span>
	  <div class="count greenew"><?php echo $about_res['prodcount']; ?></div>              
	</div>
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_customers where status=0";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-user"></i> Inactive users</span>
	  <div class="count greenew"><?php echo $about_res['prodcount']; ?></div>              
	</div>
	<?php 
	$banner_que = "SELECT count(*) as prodcount from code8_cartproducts where status=3 GROUP BY orderid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$about_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	$faillres = $stmt1->rowCount();
	?>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-user"></i> Failed Orders</span>
	  <div class="count greenew"><?php echo $faillres; ?></div>          
	</div>
	<?php
	$fromtime 	= date('d/m/Y').'';	
	$totime 	= date('d/m/Y').'';
	$today_que = "SELECT SUM(replace(PaidCurrencyValue, ',', '')) as todaycount from code8_payments where TransactionStatus=2 AND TransactionDate BETWEEN '$fromtime' AND '$totime'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($today_que);  
	$stmt1->execute();
	$todayres = $stmt1->fetch(PDO::FETCH_ASSOC);
	if($todayres['todaycount']==""){
		$todayrev = "0";
	} else {
		$todayrev = $todayres['todaycount'];
	}	
	?>
	<div class="tile_count">
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-money"></i> Today's Revenue</span>
	  <div class="count greenew"><?php  echo number_format($todayrev,3); ?> KWD</div>
	</div>
	<?php
	$fromtime 	= date('01/m/Y').'';	
	$totime 	= date('31/m/Y').'';
	$tilltoday_que = "SELECT SUM(replace(PaidCurrencyValue, ',', '')) as todaycount from code8_payments where TransactionStatus=2 AND TransactionDate BETWEEN '$fromtime' AND '$totime'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($tilltoday_que);  
	$stmt1->execute();
	$monthres = $stmt1->fetch(PDO::FETCH_ASSOC);
	if($monthres['todaycount']==""){
		$monthrev = "0";
	} else {
		$monthrev = $monthres['todaycount'];
	}	
	?>
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-money"></i> Present Month Revenue</span>
	  <div class="count greenew"><?php echo number_format($monthrev,3); ?> KWD</div>
	</div>
	
	<?php 
	$tilltoday_que = "SELECT SUM(replace(PaidCurrencyValue, ',', '')) as todaycount from code8_payments where TransactionStatus=2";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($tilltoday_que);  
	$stmt1->execute();
	$tilltodayres = $stmt1->fetch(PDO::FETCH_ASSOC);
	if($tilltodayres['todaycount']==""){
		$tillmonthrev = "0";
	} else {
		$tillmonthrev = $tilltodayres['todaycount'];
	}
	?>
	<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-money"></i> Revenue Till Date</span>
	  <div class="count greenew"><?php echo number_format($tillmonthrev,3); ?> KWD</div>
	</div>
	
	</div>	
	</div>	
	<!-- /top tiles -->         
	<br/>
	<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
	  <div class="x_panel tile fixed_height_350 ">
		<div class="x_title">
		  <h2>Orders Statistics</h2>                  
		  <div class="clearfix"></div>
		</div>
		<div class="x_content">
		  <table class="" style="width:100%">
			<tr>
			  <th style="width:37%;">                   
			  </th>
			  <th>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
				  <p class=""></p>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
				  <p class=""></p>
				</div>
			  </th>
			</tr>
			<tr>
			  <td>
				<canvas id="canvas1" height="220" width="210" style="margin: 15px 10px 10px 0"></canvas>
			  </td>
			  <td>
				<table class="tile_info">                       
				  <tr>
					<td>
					  <p><i class="fa fa-square purple"></i>Successful Orders </p>
					</td>
					<td><?php echo $ressuc; ?></td>
				  </tr>
				  <tr>
					<td>
					  <p><i class="fa fa-square blue"></i>Failed Orders </p>
					</td>
					<td><?php echo $faillres; ?></td>
				  </tr>                              
				</table>
			  </td>
			</tr>
		  </table>
		</div>
	  </div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel fixed_height_350">
		<div class="x_title">
		  <h2>Quick Links</h2>                  
		  <div class="clearfix"></div>
		</div>
		  <div class="x_content" >
				<div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a style="color: #337ab7;font-weight:bold" href="homepagecontent.php">Home page management</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a style="color: #337ab7;font-weight:bold" href="product_addnew.php">Add new Product</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a style="color: #337ab7;font-weight:bold" href="pricemanagement.php">Product Price Management
					  </a> </li>
                      <li><i class="fa fa-paste"></i><a style="color: #337ab7;font-weight:bold" href="orders.php">Orders
					  </a>
                      </li>
                      <li><i class="fa fa-newspaper-o"></i><a style="color: #337ab7;font-weight:bold" href="editmenutitles.php">Menu Titles</a> </li>
                      <li><i class="fa fa-line-chart"></i><a style="color: #337ab7;font-weight:bold" href="collectionsmenu.php">Menu Management</a>
                      </li>
                      <li><i class="fa fa-list"></i><a style="color: #337ab7;font-weight:bold" href="collectionssubmenu.php">Sub Menu Management</a>
                      </li>
					  <li><i class="fa fa-database"></i><a style="color: #337ab7;font-weight:bold" href="stocks.php">Stocks
					  </a>
                    </ul>                   
                  </div>
				<div class="clearfix"></div>
			</div>			
		  </div>
		</div>	 
	</div>
	<br />
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="dashboard_graph x_panel">
	  <div class="row x_title">
		<div class="col-md-6">
		  <h3>Registration Activities <small>Customers</small></h3>
		</div>
		<div class="col-md-6">
		  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
			<i cla ss="glyphicon glyphicon-calendar fa fa-calendar"></i>
			<span>0 <?php echo date('M'); ?>, <?php echo date('Y'); ?> - 31 <?php echo date('M'); ?>, <?php echo date('Y'); ?></span> 
		  </div>
		</div>
	  </div>
	  <div class="x_content">
		<div class="demo-container" style="height:250px">
		  <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
		</div>
	  </div>
	</div>
	</div>
	</div>
	<br/>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {

				var data = google.visualization.arrayToDataTable([
				  ['Task', 'Hours per Day'],
				  <?php
					$i = 1;
					$banner_que = "SELECT *, sum(quantity) as totqty from code8_stocks where 1=1 GROUP BY prodid ORDER BY id DESC";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($banner_que);  
					$stmt1->execute();	
					$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
					foreach($menbanner_res as $banner_result)	
					{ ?>
						['<?php echo getProduct($banner_result['prodid']); ?>',     <?php echo $banner_result['totqty'] ?>],
					<?php } ?>				  
				]);

				var options = {
				  title: ''
				};

				var chart = new google.visualization.PieChart(document.getElementById('piechart'));

				chart.draw(data, options);
			  }
			</script>
		</div>				 
	</div>
	<br/>			
	<!--<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph x_panel">
			  <div class="row x_title">
				<div class="x_title">
				  <h3>Stock Activities</h3>                  
				  <div class="clearfix"></div>
				</div>				  
				<div class="col-md-12 col-sm-12">
				<div id="piechart" style="width: 100%; height: 500px;"></div>
		</div>							  
	  </div></div></div>
	</div>-->         
	</div>        
	<!-- /page content -->

<?php include "footer.php" ?>
