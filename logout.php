<?php
session_start();
//echo $_POST["CSRF_TOKEN"], "|||", $_SESSION['CSRF_TOKEN'];
if (strcmp($_POST["CSRF_TOKEN"], $_SESSION['CSRF_TOKEN'])==0){
    session_destroy();
    $responseArr = array("status"=>"sucess","CSRF_TOKEN" => null);
    echo json_encode($responseArr);
}
else {
    $responseArr = array("status"=>"failure","CSRF_TOKEN" => null);
    echo json_encode($responseArr);
}
?>