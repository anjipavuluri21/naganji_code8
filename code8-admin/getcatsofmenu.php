<?php 
include "connectionpdo.php";
$categoryId = $_POST['categoryId'];

echo "<option value=''>Select SubCategory</option>";

$banner_que = "SELECT * from code8_collectionsmenu where menutype=$categoryId";
$database1 = new Database();
$dbCon1 = $database1->getConnection();
$stmt1 = $dbCon1->prepare($banner_que);  
$stmt1->execute();	
$menbanner_res = $stmt1->fetchAll(PDO::FETCH_ASSOC);
foreach($menbanner_res as $men_resval)
{
	echo '<option value='.$men_resval[id].'>'.$men_resval[title].'</option>';
}
?>