<div class="row">
<?php
session_start();
//include database configuration file
include('connectionpdo.php');
include "functions.php";
//Set Country in Session
if($_SESSION["COUNTRY"]==""){
	$_SESSION["COUNTRY"] = "1";
} else {
	$_SESSION["COUNTRY"];
}
$countryid = $_SESSION["COUNTRY"];
//Get Currency Code
$countrydet   = getCountry($countryid);
$currencycode = $countrydet['currencycode'];
	
	$colorsort 	= $_POST["colorsort"];
	$sizesort 	= $_POST["sizesort"];
	$seasonsort = $_POST["seasonsort"];
	
	$cond = "";	
	if($colorsort!="" && $colorsort!="undefined"){
		$cond .= " AND cs.color='$colorsort'";
	}
	if($sizesort!="" && $sizesort!="undefined"){
		$cond .= " AND cs.size='$sizesort'";
	}
	if($seasonsort!="" && $seasonsort!="undefined"){
		$cond .= " AND cp.season='$seasonsort'";
	}
	
	$cond .= " GROUP BY cp.id ";

	if($_POST["sortby"]=='new'){
		$cond .= "ORDER BY cp.id DESC";
	} else if($_POST["sortby"]=='asc'){
		$cond .= "ORDER BY cpp.price ASC";
	} else if($_POST["sortby"]=='desc'){
		$cond .= "ORDER BY cpp.price DESC";
	}
	
	//count all rows except already displayed
	$prodcount_que = "SELECT COUNT(*) as num_rows, cp.id as pid from code8_products cp LEFT JOIN code8_prodprices cpp ON cp.id=cpp.prodid LEFT JOIN code8_stocks cs ON cp.id=cs.prodid where cp.menuid=1 AND cp.status=1 AND cpp.country='$countryid' $cond";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($prodcount_que);  
	$stmt1->execute();	
	$prodcount_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	$allRows = $prodcount_res['num_rows'];
	//Display Limit
	$showLimit = 50;
	
	//get rows query		
	$remprodcount_que = "SELECT *, cp.id as pid from code8_products cp LEFT JOIN code8_prodprices cpp ON cp.id=cpp.prodid LEFT JOIN code8_stocks cs ON cp.id=cs.prodid where cp.menuid=1 AND cp.status=1 AND cpp.country='$countryid' $cond LIMIT ".$showLimit;
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($remprodcount_que);  
	$stmt1->execute();	
	
	//number of rows
	$rowCount = $stmt1->rowCount();
	if($rowCount > 0){ 
		$prod_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		foreach($prod_res as $prod_result){		 
			$prodid = $prod_result['pid'];
			//Get Product Price
			$proprice_que = "SELECT * from code8_prodprices where prodid='$prodid' AND country='$countryid'";
			$database1 = new Database();
			$dbCon1 = $database1->getConnection();
			$stmt1 = $dbCon1->prepare($proprice_que);  
			$stmt1->execute();	
			$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);
			$sprod_price = $proprice_res['price'];		
?>			<p>&nbsp;</p>
			<div class="col-lg-3 col-md-3 product-box">
				<div class="product-thumb">
					<div class="product-holder-img"><a href="product-detail.php?id=<?php echo $prodid; ?>" class="pro-dt-btn"></a>
						<figure class="pro-img1"><img src="<?php echo $prod_result['thumimage1']; ?>" alt="products"></figure>
						<figure class="pro-img2"><img src="<?php echo $prod_result['thumimage2']; ?>" alt="products"></figure>
					</div>
					<div class="product-dtl">
						<div class="product-price-btn"><div class="product-price"><?php echo $sprod_price; ?> <?php echo $currencycode; ?></div></div>
						<h2><?php echo $prod_result['prodtitle']; ?></h2>
					</div>
					<?php if($_SESSION["SESS_CUSTOMER_ID"]!=""){ ?>	
					<a id="moveto_<?php echo $prodid; ?>" href="javascript:void(0);" class="favrt-div" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>
					<script>
					$(function(){								
						$("[id^='moveto_']").click(function(){
						var i=$(this).attr('id');		
						var arr=i.split("_");
						var i=arr[1];	   	 		
						 $.ajax({
								type:"POST",
								data:"id="+i,
								url:"deleteprods.php?type=addtowishlist&userid=<?php echo $loginid; ?>&removeid=<?php echo $prodid; ?>",
								success:function(data)
								{				
									location.reload();				
								}
							});		
						});
					});
					</script>
					<?php } else { ?>
						<a href="javascript:void(0);" class="favrtlog-div wishlist" title="Favourite"><span><img src="images/favourite.png" alt="Favourite"></span></a>
					<?php } ?>
				</div>
		   </div> 		
	<?php } ?>
	<?php if($allRows > $showLimit){ ?>    	
		<div class="col-12 load-more" id="show_more_main<?php echo $prodid; ?>">
			<a id="<?php echo $prodid; ?>" href="javascript:void(0);" class="load-more-link">Load More +</a>
		</div>
	<?php } ?>  
	<?php 
	} else {
		echo "<div class='col-12'><p align='center'>No Products Found!</p></div>";
	}  
?>
</div>