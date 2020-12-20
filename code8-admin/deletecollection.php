<?php
include 'connectionpdo.php';

$id = $_POST['id'];
$type = $_REQUEST['type'];

if($type == 'contactus'){		
	$banner_que = "DELETE FROM code8_feedbacks WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();	
} else if($type == 'warehouse'){	
	$banner_que = "DELETE FROM code8_warehouses WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'store'){	
	$banner_que = "DELETE FROM code8_stores WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'feedback'){	
	$banner_que = "DELETE FROM code8_feedbacks WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'fashionista'){	
	$banner_que = "DELETE FROM code8_fashionistas WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'prodimage'){	
	$banner_que = "DELETE FROM code8_fashionistaprodimages WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'collectmenu'){	
	$banner_que = "DELETE FROM code8_collectionsmenu WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'collectsubmenu'){	
	$banner_que = "DELETE FROM code8_collectionssubmenu WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'womenmenu'){	
	$banner_que = "DELETE FROM code8_womenmenu WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'womensubmenu'){	
	$banner_que = "DELETE FROM code8_womensubmenu WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'brand'){	
	$banner_que = "DELETE FROM code8_brands WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'color'){	
	$banner_que = "DELETE FROM code8_colors WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'season'){	
	$banner_que = "DELETE FROM code8_seasons WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'condition'){	
	$banner_que = "DELETE FROM code8_deliveryterms WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'product'){	
	$banner_que = "DELETE FROM code8_products WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'productimage'){	
	$banner_que = "DELETE FROM code8_prodimages WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'customer'){	
	$banner_que = "DELETE FROM code8_customers WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'stock'){	
	$banner_que = "DELETE FROM code8_stocks WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'prodcombi'){	
	$banner_que = "DELETE FROM code8_prodcombinations WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'prodprice'){	
	$banner_que = "DELETE FROM code8_prodprices WHERE prodid='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'order'){	
	$banner_que = "DELETE FROM code8_cartproducts WHERE orderid='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
} else if($type == 'shipstatus'){	
	$banner_que = "DELETE FROM code8_deliverystatus WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();
	$res = $stmt1->rowCount();	
}

if($res==1){
	echo "done";	
}
?>