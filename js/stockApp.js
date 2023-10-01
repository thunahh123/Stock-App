/**
    Author: Thu Nguyen, 000832893
    Date:  2022
    Purpose: Placeholder for later
    Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
    original work. No other person's work has been used without due acknowledgement.
 */
var signedInName;
let success = (res)=>{
    if(res=="name taken"){
        $("#target").html("<p>User name already existed</p>");
        $("#signUpDiv input").css("border","solid 3px red");
    }else{
        $(location).attr("href","index.php");
    }
    
};

let showSignedIn = ()=>{
    $("#signInDiv").hide();
    $("#signUpDiv").hide();
    $("#stockOptions").show();
    $("#getStocksButton").show();
    $("#target").append("<p>Welcome "+signedInName+" to Thu's Stock App</p>");
    $("#target").append("<button id='signOutButton'>Sign Out</button>");
    //$("#stocks").append("<input>")
    $("#signOutButton").click((e)=>{
        fetch("server/signOut.php",{credentials:"include"})
        .then(response=>response.text())
        .then((response)=>{
            if(response=="success"){
                $("#stocks").empty();
                $("#target").empty();
                $("#stocks").hide();
                $("#signInDiv").show();
                $("#stockOptions").hide();
                $("#getStocksButton").hide();

            }
        })
    });
};

let successSignIn =((res)=>{
    if(res=="success"){
        $("#signInDiv").hide();
        showSignedIn();
    }else{
        $("#target").html("<p>Can not sign up, try again</p>");
        $("#signInDiv input").css("border","solid 3px red");
    }
    
});


let successAddStock = ((res)=>{
    if(res=="success"){
        $("#addStockForm [name='stockName']").val("");
        $("#addStockForm [name='stockPrice']").val("");
    }
    
});

let successGetSTock = ((res)=>{
    $("#stocks").empty();
    res.forEach(element => {
        $("#stocks").append("<div class='stock'><p>"+element['name']+"</p><p>"+element['price']+"</p></div>")
    });
});


$(document).ready(function(){
    $("#signUpDiv").hide();
    $("#stockOptions").hide();
    $("#getStocksButton").hide();

    $("#showRegisterForm").click(function(){
        $("#signUpDiv").show();
        $("#signInDiv").hide();
        $("#target").empty();
    });

    $("#cancelButton").click((e)=>{
        e.preventDefault();
        $("#signInDiv").show();
        $("#signUpDiv").hide();
        $("#target").empty();
        
    });

    $("#registerButton").click((e)=>{
        e.preventDefault();
        let newUserName = $("#signUpForm [name='newUserName']").val();
        let reEnterNewUserName = $("#signUpForm [name='reEnterNewUserName']").val();
        let newPw = $("#signUpForm [name='newPw']").val();
        let reEnterNewPw = $("#signUpForm [name='reEnterNewPw']").val();
        if(newUserName.length <= 0 || newUserName.length>60 || reEnterNewUserName!==newUserName || newPw.length <=0 || newPw.length >60 || reEnterNewPw!==newPw){
            $("#signUpDiv input").css("border","solid 3px red");
            $("#target").html("bad input");
        }else{
            let url = "server/addUser.php";
            let params = "newUserName=" + newUserName + "&newPw=" + newPw;
            fetch(url,{ method: 'POST',credentials: "include",headers:{"Content-Type": "application/x-www-form-urlencoded"}, body: params})
            .then(response=>response.text())
            .then((response)=>{
                signedInName = newUserName;
                success(response);
            });
        }
    });

    $("#signInButton").click((e)=>{
        e.preventDefault();
        let userName = $("#signInForm [name='userName']").val();
        let password = $("#signInForm [name='password']").val();
        if(userName.length<=0 || userName.length>60 || password.length <=0 || password.length>60){
        }else{
            let url = "server/signIn.php";
            let params = "userName=" +userName + "&password=" + password;
            fetch(url,{ method: 'POST',credentials: "include",headers:{"Content-Type": "application/x-www-form-urlencoded"}, body: params})
            .then(response=>response.text())
            .then((response)=>{
                signedInName = signedInName;
                successSignIn(response);
            });
        }
    });

    $("#addStockForm [type='submit']").click((e)=>{
        e.preventDefault();
        let stockName = $("#addStockForm [name='stockName']").val();
        let stockPrice = $("#addStockForm [name='stockPrice']").val();
        if(stockName.length<=0 || stockName.length>60 || stockPrice >99999999.99 || stockPrice<=0){
            //console.log("bad input")
        }else{
            let url = "server/addStock.php";
            let params = "stockName=" + stockName + "&stockPrice=" + stockPrice;

            fetch(url,{ method: 'POST',credentials: "include",headers:{"Content-Type": "application/x-www-form-urlencoded"}, body: params})
            .then(response=>response.text())
            .then(successAddStock);
        }

    });

    $("#getStocksButton").click((e)=>{
        fetch("server/getList.php",{credentials:"include"})
        .then(response=>response.json())
        .then(successGetSTock);
    });

    if(signedIn){
        showSignedIn();
    }
});