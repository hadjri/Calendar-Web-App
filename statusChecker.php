<?php
session_start();
if ($_POST["CSRF_TOKEN"] != null && strcmp($_POST["CSRF_TOKEN"], $_SESSION['CSRF_TOKEN'])==0){
    $responseArr = array("status"=>"loggedin","CSRF_TOKEN" => null);
    echo json_encode($responseArr);
}
else {
    $responseArr = array("status"=>"loggedout","CSRF_TOKEN" => null);
    echo json_encode($responseArr);
    session_destroy();
}
?>