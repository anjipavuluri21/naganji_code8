<div class="row">

<?php

//include database configuration file

include('connectionpdo.php');



if(isset($_POST["id"]) && !empty($_POST["id"])){

	//count all rows except already displayed

	$storecount_que = "SELECT COUNT(*) as num_rows from code8_stores where id < ".$_POST['id']." AND status=1 ORDER BY id ASC";

	$database1 = new Database();

	$dbCon1 = $database1->getConnection();

	$stmt1 = $dbCon1->prepare($storecount_que);  

	$stmt1->execute();	

	$storecount_res = $stmt1->fetch(PDO::FETCH_ASSOC);

	$allRows = $storecount_res['num_rows'];

	//Display Limit

	$showLimit = 2;

	//get rows query		

	$remstorecount_que = "SELECT * from code8_stores where id > ".$_POST['id']." AND status=1 ORDER BY id ASC LIMIT ".$showLimit;

	$database1 = new Database();

	$dbCon1 = $database1->getConnection();

	$stmt1 = $dbCon1->prepare($remstorecount_que);  

	$stmt1->execute();	

	

	//number of rows

	$rowCount = $stmt1->rowCount();

	if($rowCount > 0){ 

		$remstorecount_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);

		foreach($remstorecount_res as $store_result){	 

			$storeid = $store_result['id']; 

			?>		

			<div class="col-lg-6 col-md-6 store-box">

					<div class="product-thumb gold-color-bg">

						<div class="product-holder-img"><img src="<?php echo $store_result['image']; ?>" alt="products"></div>

						<div class="store-dtl">

							<h2><?php echo $store_result['title']; ?></h2>

							<p><?php echo $store_result['address']; ?></p>

							<p><?php echo $store_result['timings']; ?></p>

							<div class="store-btn-div"><a href="javascript:void(0);" class="button fancyIframe" data-src="<?php echo $store_result['maps']; ?>">Google Map Location</a></div>

						</div>

					</div>

				</div>   		

	<?php } ?>

	<?php if($allRows > $showLimit){ ?>    	

		<div class="col-12 load-more" id="show_more_main<?php echo $storeid; ?>">

			<a id="<?php echo $storeid; ?>" href="javascript:void(0);" class="load-more-link">Load More +</a>

		</div>

	<?php } ?>  

	<?php 

		}

    } 

?>

</div>