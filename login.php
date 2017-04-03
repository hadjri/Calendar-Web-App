<?php
require 'database.php';

$stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM users WHERE username=?");
$stmt->bind_param('s', $_POST["username"]);
$stmt->execute();
 
// Bind the results
$stmt->bind_result($cnt, $username, $pwd_hash);
$stmt->fetch();

$pwd_guess = ($_POST['password']);
// Compare the submitted password to the actual password hash
// In PHP < 5.5, use the insecure: if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){
if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    ini_set("session.cookie_httponly", 1);
    session_start();
	$_SESSION['username'] = $username;
    $_SESSION['CSRF_TOKEN'] = bin2hex(openssl_random_pseudo_bytes(32));
    $responseArr = array("status"=>"sucess","CSRF_TOKEN" => $_SESSION['CSRF_TOKEN']);
    echo json_encode($responseArr);

	// Redirect to your target page
} else{
    $responseArr = array("status"=>"fail","CSRF_TOKEN" => null);
    echo json_encode($responseArr);
}

?>