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
	
	$address1 	= $myshipaddrres['address1'];
	$address2 	= $myshipaddrres['address2'];
	$towncity 	= $myshipaddrres['towncity'];
	$statecounty= $myshipaddrres['statecounty'];
	$country 	= $myshipaddrres['country'];
	$postalzip 	= $myshipaddrres['postalzip'];
	
	
	$sambill_query = "UPDATE code8_customeraddresses SET `baddress1`='$address1',`baddress2`='$address2',`btowncity`='$towncity',`bstatecounty`='$statecounty',`bcountry`='$country',`bpostalzip`='$postalzip',`sameasshipaddr`='1' WHERE custid=$loginid";
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