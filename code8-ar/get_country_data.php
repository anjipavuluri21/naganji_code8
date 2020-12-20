<?php
session_start();
include "connectionpdo.php"; 
$contryval = $_POST['country'];
//$contryval = 1;
$query="SELECT title,currencycode,taxes,shipping from code8_countries left join code8_taxesandshipping on code8_taxesandshipping.country=code8_countries.id where code8_countries.id=$contryval ";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($query);  
$stmt1->execute();	
$country_data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
//print_r($country_data);
echo json_encode($country_data);
exit;
?>