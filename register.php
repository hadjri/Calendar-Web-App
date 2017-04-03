<?php
        require 'database.php';
        session_start();
        $error = False;
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
            $responseArr[] = array("status"=>"error_username");
            
            
            $error = True;
        }
        else{
           $clean_username = $_POST['username'];
        }
        $raw_email = $_POST['email'];
        $sanitized_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pw = '';
        
        if (!strcmp($sanitized_email, $raw_email)==0 || !filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
            /*
            $json[]= array(
                'm1' => "e",
                'm2' => "e",
                );
            */
            $responseArr[] = array("status"=>"error_email");

         
             $error = True;
        }
        if (!preg_match('/^[a-zA-Z@#\*$%\^._\-0-9]+$/', $_POST['password'])){
             $responseArr[] = array("status"=>"error_password");
            $error = True;
        }
        
        else {
            $pw = $_POST['password'];
        } 
    if (!$error){
            $hashedPW = password_hash($pw,PASSWORD_BCRYPT);
            
            $precountstmt = $mysqli -> prepare ("SELECT COUNT(*) FROM users");
           if(!$precountstmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
           }
           $precountstmt->bind_result($preCount);
           $precountstmt ->execute();
           $precountstmt -> fetch();
           $precountstmt -> close();
               $stmt = $mysqli->prepare("insert into users (username, password, email, date_joined) values ( ?, ?, ?, NOW())");
        $stmt->bind_param("sss", $clean_username, $hashedPW, $sanitized_email);
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
        $stmt->execute();
        $stmt->close();
        
         $countstmt = $mysqli -> prepare ("SELECT COUNT(*) FROM users");
       if(!$countstmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
       }
       $countstmt->bind_result($afterCount);
       $countstmt ->execute();
       $countstmt -> fetch();
    
       $countstmt -> close();
       if ((int)$preCount < (int)$afterCount){       
        $responseArr[] = array("status"=>"sucess");
       }
       else{
        $responseArr[] = array("status"=>"error_register");         
        session_destroy();
       }
    }
    
    echo json_encode($responseArr);
?>