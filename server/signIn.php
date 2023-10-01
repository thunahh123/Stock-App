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

 $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
 $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
 if($userName!==null && $password!==null && $password!=="" && $userName!=="" && strlen($userName)<=60 && strlen($password)<=60){
    $command = "SELECT * FROM  users WHERE user_name = ?";
    $params = array($userName);
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute($params);
    if($success){
        if($stmt->rowCount()===1){
            $user=$stmt->fetch();
            if(password_verify($password,$user['password'])){
                echo "success";
                $_SESSION["signedIn"]=true;
                $_SESSION["userName"]=$userName;
            }else{
                echo "wrong pw";
            }
            
        }else{
            echo "no userName";
        }
    }else{
        echo "cant connect to db";
    }
 }else{
    echo "bad input: ".$userName."".$password;
 }
?>