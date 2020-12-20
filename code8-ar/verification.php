<?php 
include "connection.php";
include "header.php";

$id 	   = filter_var($_REQUEST['id'], FILTER_SANITIZE_STRING);
$decrypted = my_simple_crypt($id,'d');

$checkquery = "SELECT * from code8_customers where id='$decrypted'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($checkquery);  
$stmt->execute();	
$checkres = $stmt->fetch(PDO::FETCH_ASSOC);

$checkquery = "UPDATE code8_customers SET status=1 where id='$decrypted'";
$database1 = new Database();
$dbCon = $database1->getConnection();
$stmt = $dbCon->prepare($checkquery);  
$stmt->execute();
$regstatus = $stmt->rowCount();
if($regstatus==1){
	echo "<script>alert('Account activated successfully!')</script>";
	echo "<script>window.location='index.php'</script>";
}
?>