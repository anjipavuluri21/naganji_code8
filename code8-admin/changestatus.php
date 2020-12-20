<?php
include 'connectionpdo.php';

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
$status = $_POST['status'];

if($id!='' && $type=='country'){	
	$banner_que = "UPDATE code8_countries SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='warehouse'){	
	$banner_que = "UPDATE code8_warehouses SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='store'){	
	$banner_que = "UPDATE code8_stores SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='fashionista'){	
	$banner_que = "UPDATE code8_fashionistas SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='collectmenu'){	
	$banner_que = "UPDATE code8_collectionsmenu SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='collectsubmenu'){	
	$banner_que = "UPDATE code8_collectionssubmenu SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='womenmenu'){	
	$banner_que = "UPDATE code8_womenmenu SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='womensubmenu'){	
	$banner_que = "UPDATE code8_womensubmenu SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='brand'){	
	$banner_que = "UPDATE code8_brands SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='size'){	
	$banner_que = "UPDATE code8_sizes SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='color'){	
	$banner_que = "UPDATE code8_colors SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='season'){	
	$banner_que = "UPDATE code8_seasons SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='product'){	
	$banner_que = "UPDATE code8_products SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
} else if($id!='' && $type=='customer'){	
	$banner_que = "UPDATE code8_customers SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  else if($id!='' && $type=='shipstatus'){	
	$banner_que = "UPDATE code8_deliverystatus SET status=$status WHERE id='".$id."'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($banner_que);  
	$stmt1->execute();	
	$res = $stmt1->rowCount();
}  

if($res){
	echo "done";	
}
?>