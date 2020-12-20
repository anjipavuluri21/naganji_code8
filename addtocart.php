<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css" />
<?php
//ob_start();
//session_start();
//include database configuration file
//include('connectionpdo.php');
//include "functions.php";

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

//Add product to Cart
//if(isset($_POST['submitaddtocart'])){	

	//user session ID
	$loginid = $_SESSION['SESS_CUSTOMER_ID']; 
	if($loginid!=""){
		include 'auth.php';
	}
	if(isset($_COOKIE['guestid'])){	
		$cookieguestid = $_COOKIE['guestid'];
	}	
	
	$pid 		= $_POST['prodid'];
	$size 		= $_POST['selsize'];
	$color 		= $_POST['colorcode'];
	$qty 		= $_POST['quantity'];
	$tax_price 	= $_POST['tax_price'];	
	$ship_price = $_POST['ship_price'];	
	$colorname 	= getColor($color);
	$sizename 	= getSize($size);	
	
	//Get Product Price	
	
	$proprice_que = "SELECT * from code8_prodprices where prodid='$pid' AND country='$countryid'";	
	
	$database1 = new Database();	
	
	$dbCon1 = $database1->getConnection();	
	
	$stmt1 = $dbCon1->prepare($proprice_que); 
	
 	$stmt1->execute();		
	
	$proprice_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	
	$prod_price = $proprice_res['price'];	
	
	if($_POST['prodid'] !=""){
			
		/*if(($totstockqty=="0")&&($qty > $totstockqty)){		
			echo '<a class="nostock"></a>';	
			echo '<script> $(document).ready(function(){ $(".nostock"); });</script>';			
		} else {	*/			
			if($loginid!=""){
				//echo "1"; die;
				$pid = $_POST['prodid'];	
				$guest_query2 = "SELECT * FROM code8_cart WHERE customerid=$loginid AND prodid='$pid' AND status=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($guest_query2);  
				$stmt1->execute();	
				$guest_res2 = $stmt1->fetch(PDO::FETCH_ASSOC);				
				$DBcustomer = $guest_res2['customerid'];
				$qtyid2 	= $guest_res2['quantity'];
				$incqty2 	= $qtyid2+$qty;
				$Dbprodid2 	= $guest_res2['prodid'];
				$cacolor 	= $guest_res2['color'];
				$csize 		= $guest_res2['size'];				
							
				if($pid==$Dbprodid2 && $color==$cacolor && $size==$csize){					
					$updatecartquery = "UPDATE code8_cart SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($updatecartquery);
					$stmt1->execute();						
						
					$updatecartprodquery = "UPDATE code8_cartproducts SET `quantity`='$incqty2' WHERE customerid='$loginid' AND prodid='$pid' AND status=1";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($updatecartprodquery);  
					$stmt1->execute();				
				} else {					
					$addcartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`price`,`tax`,`shipping`) VALUES ('','$loginid','$cookieguestid','$pid','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($addcartquery);  
					$stmt1->execute();
					$lastinsid = $dbCon1->lastInsertId();
					
					$prod_res 	= getProductData($pid);
					$prodname 	= $prod_res['prodtitle'];
					$color_name	= getColor($cacolor);	
					$size_name	= getSize($csize);
					
					$addcartquery = "INSERT INTO code8_cartproducts (`id`,`cartid`,`customerid`,`guestid`,`prodid`,`prodname`,`sizeid`,`colorid`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`product_price`,`tax`,`shipping`) VALUES ('','$lastinsid','$loginid','$cookieguestid ','$pid','$prodname','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')"; 
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($addcartquery);  
					$stmt1->execute();	
				}			
			} else if(!isset($_COOKIE['guestid'])){
				//echo "2"; die;				
				$guestquery = "INSERT INTO code8_guest (`id`,`date`) VALUES ('',NOW())";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($guestquery);  
				$stmt1->execute();
				$guestid = $dbCon1->lastInsertId();
				
				setcookie('guestid', $guestid);
				setcookie('guestid', $guestid, time()+ (86400));	
				$cookieguestid = $guestid;
				
				$inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($inscartquery);  
				$stmt1->execute();							
			} else {	
				//echo "3"; die;
				$ginscartquery = "SELECT * FROM code8_cart WHERE guestid=$cookieguestid AND prodid='$pid' AND status=1";
				$database1 = new Database();
				$dbCon1 = $database1->getConnection();
				$stmt1 = $dbCon1->prepare($ginscartquery);  
				$stmt1->execute();
				$guest_res  = $stmt1->fetch(PDO::FETCH_ASSOC);			
				$DBguestid 	= $guest_res['guestid'];
				$qtyid 		= $guest_res['quantity'];
				$cacolor 	= $guest_res['color'];
				$csize 		= $guest_res['size'];				
				$incqty 	= $qtyid+$qty;
				$Dbprodid 	= $guest_res['prodid'];
													
				if($pid==$Dbprodid && $cookieguestid==$DBguestid && $color==$cacolor && $size==$csize){					
					$cginscartquery = "UPDATE code8_cart SET `quantity`='$incqty' WHERE guestid='$cookieguestid' AND prodid='$pid' AND color=$color AND size=$size AND status=1";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($cginscartquery);  
					$stmt1->execute();											
				} else {					
					//$inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`quantity`,`currencycode`,`status`,`date`) VALUES ('','0','$cookieguestid ','$pid','$size','$color','$qty','$currencycode','1',NOW())";
					$inscartquery = "INSERT INTO code8_cart (`id`,`customerid`,`guestid`,`prodid`,`size`,`color`,`sizename`,`colorname`,`quantity`,`currencycode`,`status`,`date`,`price`,`tax`,`shipping`) VALUES ('','0','$cookieguestid','$pid','$size','$color','$sizename','$colorname','$qty','$currencycode','1',NOW(),'$prod_price','$tax_price','$ship_price')";
					$database1 = new Database();
					$dbCon1 = $database1->getConnection();
					$stmt1 = $dbCon1->prepare($inscartquery);  
					$stmt1->execute();
				}						
			}
						
		//}			
	}
	echo '<a class="addtocartcode"></a>';	
	echo '<script> $(document).ready(function(){ $(".addtocartcode").trigger("click"); });</script>';		
	
	/*echo '<script> 						$(document).ready(function(){			
		$(".addddccaartt").trigger("click", function(){
			var delay = 2000;
			setTimeout(function(){ window.location = product-detail.php; }, delay);    
			return false;
		});
	});
	</script>';*/
	
?>
<a class="on-addtocart-btn addddccaartt" href="javascript:void(0);" data-src="#addtocartpop" data-fancybox=""></a>
<div id="addtocartpop" class="popup-hidden animated-modal added-cart-model addddccaartt">
	<p class="anim1"><strong>Product added to Cart!!</strong></p>
	<p class="anim2"><a href="javascript:void(0);" onclick="$.fancybox.close();" class="button">OK</a></p>
</div>
<script>
//$(".addtocartcode").load("click", function(){	
//	//swal("Product added to Cart!!", "", "success");
//	$(".addddccaartt").trigger("click");
//	var delay = 2000; 
//    var url = 'product-detail.php?id=<?php echo $pid; ?>';
//    setTimeout(function(){ window.location = url; }, delay);
//	return false;
//});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--start fancybox-->	
<script type="text/javascript" src="fancybox-master/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="fancybox-master/fancybox.js"></script>
<!--end fancybox-->	