<?php
/**
 * Connect page
 * Author: Thu Nguyen, 000832893
 * Date:  2022
 * Purpose: Placeholder for later
 * Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
 * original work. No other person's work has been used without due acknowledgement. 
 * 
 */
    try { 
        $dbh = new PDO("mysql:host=localhost;dbname=sa00832893", 
            "root", ""); 
    } catch (Exception $e) { 
        die("ERROR: Couldn't connect. {$e->getMessage()}"); 
    } 
?>