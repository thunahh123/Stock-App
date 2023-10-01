<?php
/*Author: Thu Nguyen, 000832893
* Date:  2022
* Purpose: Placeholder for later
* Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
*  original work. No other person's work has been used without due acknowledgement.
*/

require "stockRecord.php";
require "connect.php";

$stockRecordArray = array();
$command = "SELECT * FROM stock_updates ORDER BY update_date_time DESC LIMIT 10";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute();
    if($success){
        while($row = $stmt->fetch()) {   
            $nextStock = new StockRecord($row["stock_id"],$row["stock_name"],$row["current_price"]);
            array_push($stockRecordArray,$nextStock);
        }

    echo json_encode($stockRecordArray);       
        
    }else{
        echo "fail";
    }

?>