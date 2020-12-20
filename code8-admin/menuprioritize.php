<?php 
include "connectionpdo.php";

$orderid = $_POST['order'];
$menuid  = $_POST['menuid'];
$res 	 = array_combine($orderid, $menuid);

foreach ($res as $key => $value) {  	
	$banner_que = "UPDATE code8_adminmenu SET corder=$key WHERE id=$value";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
}
header("location: adminmenus.php");
?>