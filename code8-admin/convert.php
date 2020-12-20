<?php
function calculateCurrency($from,$to,$amount){
    $url = "https://www.google.com/search?q=".$from.$to;
    $request = curl_init();
    $timeOut = 0;
    curl_setopt ($request, CURLOPT_URL, $url);
    curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36");
    curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut);
    $response = curl_exec($request);
    curl_close($request);
 
    preg_match('~<span [^>]* id="knowledge-currency__tgt-amount"[^>]*>(.*?)</span>~si', $response, $finalData);
    return floatval((floatval(preg_replace("/[^-0-9\.]/","", $finalData[1]))/100) * $amount);
}

echo calculateCurrency('USD','INR',1);