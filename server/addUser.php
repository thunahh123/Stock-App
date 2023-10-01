<?php
session_start();
/**
 * Author: Thu Nguyen, 000832893
 * Date:  2022
 * Purpose: Placeholder for later
 * Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
 *  original work. No other person's work has been used without due acknowledgement.
 */
    require "connect.php";

    $userName = filter_input(INPUT_POST, "newUserName", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "newPw", FILTER_SANITIZE_SPECIAL_CHARS);
    if($userName!==null && $password!==null && $password!=="" && $userName!=="" && strlen($userName)<=60 && strlen($password)<=60){
        // check if username available in db
        $command = "SELECT * FROM  users WHERE user_name = ?";
        $param = array($userName);
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute($param);
        if($success){
            if($stmt->rowCount()>0){
                echo "name taken";
            }else{
                $command = "INSERT into users (user_name,password) VALUES (?, ?)"; 
                $stmt = $dbh->prepare($command);
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $params = array($userName, $hash);
                $success = $stmt->execute($params);
                if($success){
                    echo "success $userName $hash";
                    $_SESSION["signedIn"]=true;
                    $_SESSION["userName"]=$userName;
                }else{
                    echo "fail";
                }
            }
        }
        
    }else{
        echo "bad : new".$userName." ".$password;
    }


?>