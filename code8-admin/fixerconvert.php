<?php

$price = $_POST['price'];


$countrycode = $_POST['countrycode'];

$explodecount = explode(',',$countrycode);

$dataresponse = array();

foreach($explodecount as $keys => $countrycodeval){		
	
	
	$endpoint = 'convert';		

	$access_key = '00209bc6427e1330d1b1d6f280249635';	
	$from = 'KWD';
	$to = $countrycodeval;
	$amount = $price;
	
	if($to!='KWD'){
		$ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$json = curl_exec($ch);
		curl_close($ch);
		
		$conversionResult = json_decode($json, true);
		
		$dataresponse["$countrycodeval"] = number_format($conversionResult['result'],2);
	} else {
		$dataresponse["$countrycodeval"] = $price;
	}	
	
}

$jsondata = json_encode($dataresponse);

echo $jsondata;