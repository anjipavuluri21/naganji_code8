<?php
session_start();
include "connectionpdo.php"; 
$_SESSION["COD_FLAG"] =1;
$contryval = $_POST['contryval'];
$query="SELECT title,cod_flag from code8_countries where id=$contryval";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($query);  
$stmt1->execute();	
$country_data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$_SESSION["COUNTRY"] = $contryval;
$_SESSION["COD_FLAG"] = $country_data[0]['cod_flag'];
echo $country_data[0]['title'];

?>