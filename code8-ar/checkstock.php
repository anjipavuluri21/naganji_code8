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

$prodid 	= $_REQUEST['id'];
$size 		= $_REQUEST['size'];
$color 		= $_REQUEST['color'];

$stoc_que = "SELECT *, sum(quantity) as availstock from code8_cartproducts where prodid='$prodid' AND sizeid='$size' AND colorid='$color' AND status=2";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($stoc_que);  
$stmt1->execute();	
$stoc_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$soldstock = $stoc_res['availstock'];

$dbstock_que = "SELECT * from code8_stocks where prodid='$prodid' AND size='$size' AND color='$color'";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($dbstock_que);  
$stmt1->execute();	
$dbstock_res = $stmt1->fetch(PDO::FETCH_ASSOC);
$dbstockqty = $dbstock_res['quantity'];
echo $totavailablestock = $dbstockqty-$soldstock;
?>