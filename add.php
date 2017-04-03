<?php
require 'database.php';
session_start();

function validCSRF(){
    if (isset($_POST["CSRF_TOKEN"]) && isset($_SESSION["CSRF_TOKEN"]))
        if ($_POST["CSRF_TOKEN"] != null && strcmp($_POST["CSRF_TOKEN"], $_SESSION['CSRF_TOKEN'])==0){
          return true;
        }
    else {
        session_destroy();
        return false;
    }
}

if (validCSRF()){
    $flag = 0;
   
    if (strcmp($_POST["flag"],"true")==0){
      
        $flag = 1;
    }
    $message = null;
       $_SESSION['CSRF_TOKEN'] = bin2hex(openssl_random_pseudo_bytes(32));
    $title = $_POST["title"];
    if ($title != ""){
        $cstmt = $mysqli->prepare("insert into events (title, datetime,username, flag) values ( ?, ?,?,?)");
        $cstmt->bind_param("sssi", $title,$_POST["datetime"], $_SESSION['username'],$flag);
         if(!$cstmt){
             printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
    
        $cstmt->execute();
        $cstmt->close();  
    }
    else {
        $message = "Can't have empty event title!";
    }
    
    $jsonArray = array();
 
    
    //if ($mysqli->affected_rows > 0){
        $jsonArray[] = array("status" => "sucess","CSRF_TOKEN" => $_SESSION['CSRF_TOKEN'], "message" => $message);
        
    //    
    //}
    //else {
    //    $jsonArray[] = (array("status" => "could_not_add","CSRF_TOKEN" => $_SESSION['CSRF_TOKEN']));
    //}
    
     $stmt = $mysqli->prepare("select event_id, title, flag, TIME(datetime) as TIME, DAY(datetime) as DAY, MONTH(datetime) as MONTH, YEAR(datetime) as YEAR from events where username = ? order by datetime");
         $stmt->bind_param("s", $_SESSION["username"]);
        if(!$stmt){
                 printf("Query Prep Failed: %s\n", $mysqli->error);
         exit;
         }
        $stmt->execute();
        $result = $stmt->get_result();
         while($row = $result->fetch_assoc()){
             $jsonArray[] = $row;
        }
        $stmt->close();
        echo (json_encode($jsonArray));
    
    
}

else {
      echo json_encode(array("status" => "invalid_token","CSRF_TOKEN" => null));
}
?>