<?php

/*

Faucet by Ratnet - Made in México - 2015

I developed this for free to help spread the word about Bytecoin but if you want to tip me, everything will be appreciated :D

Donations to Ratnet Personal Wallet for Developing:

Bytecoin: 28qwqrRWSF7Ad8GjwUgR142yvhmnsa6GGbvf8KpxzWkqU1FEhK5LBijZhXseeQvDzij7cRETY3DPJ3e7opXQc5AhURdFt9U
Bitcoin: 1MXPDKMSbCr41n2imq2BEMivtu9SJyd4ES

Donations to Ratnet's Bytecoin Faucet:
Bytecoin: 24gKv1yqZ2oZ7Ln4KWcL3q7D7CXibndxhDzLvrJxxw1x7tiaQ5euuduT9EkHzDta144vmwToddz9Khct4pqSVzuBCxgVTYP

*/

$faucetTitle = "Bitcoin-N Faucet";
$faucetSubtitle = "AQUÍ PUEDES OBTENER Bitcoin nova GRATIS ";
$logo = "images/bitcoin-nova.png";

//Faucet address for donations
$faucetAddress = "E83cmWiHS8tJthWxaA4fH5e58CDruc7AENTQ7M2ciitoP1Z8PZ1p7CYZr4XWYPtr8C8jxzcWmbxq5BeLf79emxbRF38VoTi";

//Reward time in hours
$rewardEvery = "12";
//Max reward and min reward as decimals Ex: Min = 10.0 & Max = 20.0
//$minReward = "0.01"; //Remember that the minimum for an eobot deposit is 5 BCN as reward.
//$maxReward = "0.3"; 
$minReward = "1.01"; //Remember that the minimum for an eobot deposit is 5 BCN as reward.
$maxReward = "3.3"; 
//Transaction fee is set to 0.01 BCN for every request.


//Database connection

$userDB = "";
$database = "";
$passwordDB = "";
$hostDB = "localhost";


//Recaptcha Keys. You can get yours here: https://www.google.com/recaptcha/
$keys = array(
  'site_key' => '',
  'secret_key' => ''
  );

//Addresses that can request more than one time but with a different payment ID.
$clearedAddresses = array(
	/*"Eobot" => "22694R3K1JvGf1m98pBsbaXCA3ULQz4xdQiYHgnNAdsVDqZDjiTH9CMj6QHhKD232wPeYtfypNzp5TX5L3NcGGSmJ8pWnPJ",
	"Poloniex" => "25cZNQYVAi3issDCoa6fWA2Aogd4FgPhYdpX3p8KLfhKC6sN8s6Q9WpcW4778TPwcUS5jEM25JrQvjD3XjsvXuNHSWhYUsu",
	"HitBTC" => "24zavX3Bi2PiKGWLKh4bPGTiMsn4iHf3Y6JnKCF6V1PeBpDpuwiAMZ8di7ok6B5SQT6UXUtQgusruCoXbqUZm8VJAfq2xKK"*/
	);?>