<?php
require 'database.php';


session_start();

//no CSRF check since non-users can request forecasts too
$_POST["location"];

$url = "http://api.apixu.com/v1/forecast.json?key=c74845061b594eea8d6231446171903&q=NY&days=10";
 //we are contacing the dataabase thru the server because we were given a secret (albeit free) api access key

$response = file_get_contents($url);


//$responsejson = json_decode($response, true);
//
//$forcast = responsejson["forecast"];
//    echo $forecast["date"];
?>