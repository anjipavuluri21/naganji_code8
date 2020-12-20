<?php
include 'connectionpdo.php';

$id = $_POST['id'];
$type = $_REQUEST['type'];

if($type == 'delcartprod'){		
	$banner_que = "DELETE FROM code8_cart WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	//delete from 
	$banner_que = "DELETE FROM code8_cartproducts WHERE cartid='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();	
} else if($type == 'addtowishlist'){
	$userid 	= $_REQUEST['userid'];
	$removeid 	= $_REQUEST['removeid'];
	//Get Prod Count
	$wish_que = "SELECT * from code8_wishlist where userid=$userid AND prodid=$id";
	$database1 = new Database();
	$dbCon2 = $database1->getConnection();
	$stmt2 = $dbCon2->prepare($wish_que);  
	$stmt2->execute();	
	$wishcount = $stmt2->rowCount();
	if($wishcount>0){

	} else {
		//DELETE from Cart
		$banner_que = "DELETE FROM code8_cart WHERE id='".$removeid."'";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($banner_que);  
		$stmt1->execute();	
		//Add to Wishlist
		$banner_que = "INSERT INTO code8_wishlist (id, prodid, userid, date) VALUES ('','$id','$userid',NOW())";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($banner_que);  
		$stmt1->execute();	
		$res = $stmt1->rowCount();
	}	
} else if($type == 'delwishprod'){
	$banner_que = "DELETE FROM code8_wishlist WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($type == 'movetowish'){
	$userid 	= $_REQUEST['userid'];
	//Get Prod Count
	$wish_que = "SELECT * from code8_wishlist where userid=$userid AND prodid=$id";
	$database1 = new Database();
	$dbCon2 = $database1->getConnection();
	$stmt2 = $dbCon2->prepare($wish_que);  
	$stmt2->execute();	
	$wishcount = $stmt2->rowCount();
	if($wishcount>0){

	} else {
		$banner_que = "INSERT INTO code8_wishlist (id, prodid, userid, date) VALUES ('','$id','$userid',NOW())";
		$database1 = new Database();
		$dbCon1 = $database1->getConnection();
		$stmt1 = $dbCon1->prepare($banner_que);  
		$stmt1->execute();	
		$res = $stmt1->rowCount();
	}	
} 

if($res==1){
	echo "done";	
}
?>