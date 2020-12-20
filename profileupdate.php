<?php
session_start();
include "connectionpdo.php";
$loginid = $_SESSION['SESS_CUSTOMER_ID'];

if(isset($_POST['myaccount'])){	
	$fullname 	= filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);	
	$email 		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$mobile 	= filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);	
	
	$myaccup_query = "UPDATE code8_customers SET `fullname`='$fullname',`email`='$email',`mobile`='$mobile' WHERE id=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($myaccup_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();	
	if($res1 == 1){			
		echo "<script>window.location='my-account.php?msg=success'</script>";
	}			
}

if(isset($_POST['updateshipaddress'])){	
	$ship_area 		= filter_var($_POST['ship_area'], FILTER_SANITIZE_STRING);	
	$ship_street 	= filter_var($_POST['ship_street'], FILTER_SANITIZE_STRING);	
	$ship_building 	= filter_var($_POST['ship_building'], FILTER_SANITIZE_STRING);	
	$ship_appartment= filter_var($_POST['ship_appartment'], FILTER_SANITIZE_STRING);	
	$ship_block 	= filter_var($_POST['ship_block'], FILTER_SANITIZE_STRING);	
	$ship_avenue 	= filter_var($_POST['ship_avenue'], FILTER_SANITIZE_STRING);	
	$ship_floor 	= filter_var($_POST['ship_floor'], FILTER_SANITIZE_STRING);	
		
	
	$myaccup_query = "UPDATE code8_customeraddresses SET `ship_area`='$ship_area',`ship_street`='$ship_street',`ship_building`='$ship_building',`ship_appartment`='$ship_appartment',`ship_block`='$ship_block',`ship_avenue`='$ship_avenue',`ship_floor`='$ship_floor' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($myaccup_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();	
	if($res1 == 1){			
		echo "<script>window.location='address.php?msg=success'</script>";
	}			
}
if(isset($_POST['updatebilladdress'])){	
	$bill_area 		= filter_var($_POST['bill_area'], FILTER_SANITIZE_STRING);	
	$bill_street 	= filter_var($_POST['bill_street'], FILTER_SANITIZE_STRING);	
	$bill_building 	= filter_var($_POST['bill_building'], FILTER_SANITIZE_STRING);	
	$bill_appartment= filter_var($_POST['bill_appartment'], FILTER_SANITIZE_STRING);	
	$bill_block 	= filter_var($_POST['bill_block'], FILTER_SANITIZE_STRING);	
	$bill_avenue 	= filter_var($_POST['bill_avenue'], FILTER_SANITIZE_STRING);	
	$bill_floor 	= filter_var($_POST['bill_floor'], FILTER_SANITIZE_STRING);	
			
	$myaccup_query = "UPDATE code8_customeraddresses SET `bill_area`='$bill_area',`bill_street`='$bill_street',`bill_building`='$bill_building',`bill_appartment`='$bill_appartment',`bill_block`='$bill_block',`bill_avenue`='$bill_avenue',`bill_floor`='$bill_floor' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($myaccup_query);  
	$stmt1->execute();
	$res1 = $stmt1->rowCount();	
	if($res1 == 1){			
		echo "<script>window.location='address.php?msg=success'</script>";
	}			
}

?>