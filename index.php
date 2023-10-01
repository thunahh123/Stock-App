<?php session_start(); ?><!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Author: Thu Nguyen, 000832893
        Date:  2022
        Purpose: Placeholder for later
        Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
		original work. No other person's work has been used without due acknowledgement.
    -->
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 5</title>
    <link rel="stylesheet" href="css/a5.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/stockApp.js"></script>
    <?php
    if(!isset($_SESSION['signedIn'])){
        $_SESSION['signedIn'] = false;
    }
    if($_SESSION['signedIn']===true){
        echo "<script>
        var signedIn = true;
        var signedInName = '".$_SESSION["userName"]."'</script>";
        
    }else{
        echo "<script>var signedIn = false;</script>";
    }
    ?>
</head>
<body>
    <div id="signInDiv">
        <h1>Welcome to Thu's stock app</h1>
        <form method="get" id="signInForm" action="">
            <input type="text" name="userName" id="userName" placeholder="Enter your username"> <br>
            <input type="password" name="password" id="password" placeholder="Enter password"><br>
            <button id="signInButton">Sign In</button>
        </form>
        <div>
            <p id="showRegisterForm">Click here to register new account</p>
        </div> 
            
    </div>  
    <div id="signUpDiv">
        <h1>Welcome to Thu's stock app</h1>
        <form method="get" id="signUpForm" action="">
            <input type="text" name="newUserName" id="newUserName" placeholder="Create your username"><br>
            <input type="text" name="reEnterNewUserName" id="reEnterNewUserName" placeholder="Re-enter your username"><br>
            <input type="password" name="newPw" id="newPw" placeholder="Enter your password"><br>
            <input type="password" name="reEnterNewPw" id="reEnterNewPw" placeholder="Re-enter your password"><br>
            <button id="registerButton">Register</button>
            <button id="cancelButton">Cancel</button>
        </form> 
    </div>
    <div id="target"></div>
    <div id="stockOptions">
        <form id="addStockForm" action="" method="post">
            <input type="text" name="stockName" placeholder="Name">
            <input type="number" name="stockPrice" step="0.01" placeholder="Price">
            <input type="submit" value="Add Stock">
        </form>
    </div>  
    <button id="getStocksButton">Get Stocks</button>  
    <div id="stocks">

    </div>
</body>
</html>