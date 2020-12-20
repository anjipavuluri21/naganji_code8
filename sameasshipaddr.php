<?php
include "connectionpdo.php";

$loginid = $_POST['id'];
$type 	 = $_REQUEST['type'];
if($type=='sameasship'){	
	
	$shipaddrquery = "SELECT * from code8_customeraddresses where custid='$loginid'";
	$database1 = new Database();
	$dbCon = $database1->getConnection();
	$stmt = $dbCon->prepare($shipaddrquery);  
	$stmt->execute();	
	$myshipaddrres = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$sarea 		= $myshipaddrres['ship_area'];
	$sstreet 	= $myshipaddrres['ship_street'];
	$sbuilding 	= $myshipaddrres['ship_building'];
	$sappartment= $myshipaddrres['ship_appartment'];
	$sblock 	= $myshipaddrres['ship_block'];
	$savenue 	= $myshipaddrres['ship_avenue'];
	$sfloor 	= $myshipaddrres['ship_floor'];	
	
	$sambill_query = "UPDATE code8_customeraddresses SET `bill_area`='$sarea',`bill_street`='$sstreet',`bill_building`='$sbuilding',`bill_appartment`='$sappartment',`bill_block`='$sblock',`bill_avenue`='$savenue',`bill_floor`='$sfloor',`sameasshipaddr`='1' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($sambill_query);  
	$stmt1->execute();
	
} else if($type=='uncheck'){		
	$unsambill_query = "UPDATE code8_customeraddresses SET `sameasshipaddr`='0' WHERE custid=$loginid";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($unsambill_query);  
	$stmt1->execute();	
}
?>