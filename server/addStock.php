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

    $stockName = filter_input(INPUT_POST, "stockName", FILTER_SANITIZE_SPECIAL_CHARS);
    $stockPrice = filter_input(INPUT_POST, "stockPrice", FILTER_VALIDATE_FLOAT);
    if($stockName!==null && $stockPrice!==null && $stockName!=="" && $stockPrice!==false && strlen($stockName)<60 && $stockPrice >0 && $stockPrice<= 99999999.99){
        $command = "REPLACE into stock_updates (stock_name,current_price) VALUES (?, ?)"; 
        $stmt = $dbh->prepare($command);
        
        $params = array($stockName,$stockPrice);
        $success = $stmt->execute($params);
        if($success){
            echo "success";
            
        }else{
            echo "fail";
        }
    }else{
        echo "bad input";
    }



?>
