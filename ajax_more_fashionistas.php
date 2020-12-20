<div class="row">
<?php
//include database configuration file
include('connectionpdo.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	//count all rows except already displayed
	$prodcount_que = "SELECT COUNT(*) as num_rows from code8_fashionistas where id < ".$_POST['id']." AND status=1 ORDER BY id DESC";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($prodcount_que);  
	$stmt1->execute();	
	$prodcount_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	$allRows = $prodcount_res['num_rows'];
	//Display Limit
	$showLimit = 3;
	//get rows query		
	$remprodcount_que = "SELECT * from code8_fashionistas where id < ".$_POST['id']." AND status=1 ORDER BY id DESC LIMIT ".$showLimit;
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($remprodcount_que);  
	$stmt1->execute();	
	
	//number of rows
	$rowCount = $stmt1->rowCount();
	if($rowCount > 0){ 
		$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		foreach($prod_res as $prod_result){		 
			$prodid = $prod_result['id'];			
?>		
			<div class="col-lg-4 col-md-4 portfolio-box">
				<div class="portfolio-thumb">
					<div class="portfolio-holder"><a href="fashionista_page.php?id=<?php echo $prod_result['id']; ?>" class="portfolio-link"></a>
						<div class="portfolio-img"><img src="<?php echo $prod_result['image']; ?>" alt="products"></div>
						<h2><?php echo $prod_result['portfoliotitle']; ?></h2>	
					</div>
					<div class="portfolio-date-dsnr">
						<div class="date-uplaod"><?php echo $prod_result['date']; ?></div>
						<a href="fashionista_page.php?id=<?php echo $prod_result['id']; ?>" class="portfolio-maker"><?php echo $prod_result['name']; ?></a>
					</div>
				</div>
			</div>	
	<?php } ?>
	<?php if($allRows > $showLimit){ ?>    	
		<div class="col-12 load-more" id="show_more_main<?php echo $prodid; ?>">
			<a id="<?php echo $prodid; ?>" href="javascript:void(0);" class="load-more-link">Load More +</a>
		</div>
	<?php } ?>  
	<?php 
		}
    } 
?>
</div>