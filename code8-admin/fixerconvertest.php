<?php
// set API Endpoint, access key, required parameters
$endpoint = 'convert';
$access_key = '00209bc6427e1330d1b1d6f280249635';

$from = 'KWD';
$to = 'GBP';
$amount = 10;

// initialize CURL:
$ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
echo $conversionResult['result'];