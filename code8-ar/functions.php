<?php
function getCountry($uid){		
	$country_que = "SELECT * from code8_countries where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res;
}
function getCountryName($uid){
	$country_que = "SELECT * from code8_countries where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getCategory($uid){
	if($uid==1){
		$country_res['title'] = "Collection";
	} else if($uid==2) {
		$country_res['title'] = "Women";
	}
	return $country_res['title'];
}
function getCollectionMenu($uid){
	$country_que = "SELECT * from code8_collectionsmenu where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getCollectionsSubmenu($uid){
	$country_que = "SELECT * from code8_collectionssubmenu where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getWomenMenu($uid){
	$country_que = "SELECT * from code8_womenmenu where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getProduct($uid){
	$country_que = "SELECT * from code8_products where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['prodtitle'];
}
function getWarehouse($uid){
	$country_que = "SELECT * from code8_warehouses where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getSize($uid){
	$country_que = "SELECT * from code8_sizes where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getColor($uid){
	$country_que = "SELECT * from code8_colors where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getColorData($uid){
	$country_que = "SELECT * from code8_colors where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res;
}
function getBrand($uid){
	$country_que = "SELECT * from code8_brands where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getProductData($uid){
	$country_que = "SELECT * from code8_products where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res;
}
function getProductPrice($uid,$country){
	$country_que = "SELECT * from code8_prodprices where prodid='$uid' AND country=$country";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);
	
	$countryc_que = "SELECT * from code8_countries where id=$country";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($countryc_que);  
	$stmt1->execute();	
	$countryc_res = $stmt1->fetch(PDO::FETCH_ASSOC);		
	return $country_res['price'].' '.$countryc_res['currencycode'];
}
function getCustomerdata($uid){		
	$country_que = "SELECT * from code8_customers where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res;
}
function getCustomerShipaddress($uid){		
	$country_que = "SELECT * from code8_customeraddresses where custid='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$myaddrres = $stmt1->fetch(PDO::FETCH_ASSOC);	
	$ship_address = "";
	if($myaddrres['address1']!=""){ $ship_address .= $myaddrres['address1'].', '; } 
	if($myaddrres['address2']!=""){ $ship_address .= $myaddrres['address2'].', '; } 
	if($myaddrres['towncity']!=""){ $ship_address .= $myaddrres['towncity'].', '; } 
	if($myaddrres['statecounty']!=""){ $ship_address .= $myaddrres['statecounty'].', '; } 
	if($myaddrres['country']!=""){ $ship_address .= getShipCountryName($myaddrres['country']).', '; } 
	if($myaddrres['postalzip']!=""){ $ship_address .= $myaddrres['postalzip'].'.'; }	
	//$ship_address .= $ship_address;	
	return $ship_address;
}
function getCustomerBilladdress($uid){		
	$country_que = "SELECT * from code8_customeraddresses where custid='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$myaddrres = $stmt1->fetch(PDO::FETCH_ASSOC);	
	$ship_address = "";
	if($myaddrres['baddress1']!=""){ $ship_address .= $myaddrres['baddress1'].', '; } 
	if($myaddrres['baddress2']!=""){ $ship_address .= $myaddrres['baddress2'].', '; } 
	if($myaddrres['btowncity']!=""){ $ship_address .= $myaddrres['btowncity'].', '; } 
	if($myaddrres['bstatecounty']!=""){ $ship_address .= $myaddrres['bstatecounty'].', '; } 
	if($myaddrres['bcountry']!=""){ $ship_address .= getShipCountryName($myaddrres['bcountry']).', '; } 
	if($myaddrres['bpostalzip']!=""){ $ship_address .= $myaddrres['bpostalzip'].'.'; }	
	//$ship_address .= $ship_address;	
	return $ship_address;
}
function my_simple_crypt($string, $action ) {
    // you may change these values to your own
    $secret_key = 'hfhdfhf';
    $secret_iv = 'hdfhfghdfghhfdhfghfdgh';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    } 
    return $output;
}

function getOrderStatus($uid){		
	$country_que = "SELECT * from code8_deliverystatus where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['title'];
}
function getShipCountry($uid){		
	$country_que = "SELECT * from code8_ship_countries where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['sortname'];
}
function getShipCountryName($uid){		
	$country_que = "SELECT * from code8_ship_countries where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['name'];
}

function getShipState($uid){		
	$country_que = "SELECT * from code8_ship_states where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['name'];
}

function getShipCity($uid){		
	$country_que = "SELECT * from code8_ship_cities where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['name'];
}

function getCountryCode($uid){		
	$country_que = "SELECT * from code8_countries where id='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$country_res = $stmt1->fetch(PDO::FETCH_ASSOC);	
	return $country_res['country'];
}

function getGuestShipaddress($uid){		
	$country_que = "SELECT * from code8_customeraddresses where custid='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$myaddrres = $stmt1->fetch(PDO::FETCH_ASSOC);	
	$ship_address = "";
	if($myaddrres['address1']!=""){ $ship_address .= $myaddrres['address1'].', '; } 
	if($myaddrres['address2']!=""){ $ship_address .= $myaddrres['address2'].', '; } 
	if($myaddrres['towncity']!=""){ $ship_address .= $myaddrres['towncity'].', '; } 
	if($myaddrres['statecounty']!=""){ $ship_address .= $myaddrres['statecounty'].', '; } 
	if($myaddrres['country']!=""){ $ship_address .= getShipCountryName($myaddrres['country']).', '; } 
	if($myaddrres['postalzip']!=""){ $ship_address .= $myaddrres['postalzip'].'.'; }	
	//$ship_address .= $ship_address;	
	return $ship_address;
}

function getGuestBilladdress($uid){		
	$country_que = "SELECT * from code8_customeraddresses where custid='$uid'";
	$database1 = new Database();
	$dbCon1 = $database1->getConnection();
	$stmt1 = $dbCon1->prepare($country_que);  
	$stmt1->execute();	
	$myaddrres = $stmt1->fetch(PDO::FETCH_ASSOC);	
	$ship_address = "";
	if($myaddrres['baddress1']!=""){ $ship_address .= $myaddrres['baddress1'].', '; } 
	if($myaddrres['baddress2']!=""){ $ship_address .= $myaddrres['baddress2'].', '; } 
	if($myaddrres['btowncity']!=""){ $ship_address .= $myaddrres['btowncity'].', '; } 
	if($myaddrres['bstatecounty']!=""){ $ship_address .= $myaddrres['bstatecounty'].', '; } 
	if($myaddrres['bcountry']!=""){ $ship_address .= getShipCountryName($myaddrres['bcountry']).', '; } 
	if($myaddrres['bpostalzip']!=""){ $ship_address .= $myaddrres['bpostalzip'].'.'; }	
	//$ship_address .= $ship_address;	
	return $ship_address;
}

?>