<?php
// Checking if the user used login button to access the next pages
if(isset($_POST["login-submit"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once 'dbc.php';
    require_once 'functions.php';

    // Checking if all fields are filled
    if(emptyInputLogin($email, $password) !== false){
        header("location:../login/login.php?error=emptyinput");   // redirecting a user to the login page
        exit(); 
    }

    // Determine whether it's a regular user or a facilitator login
    if (userIsFacilitator($conn, $email)) {
        // Log a facilitator in 
        loginFacilitator($conn, $email, $password);
    } elseif (userIsStudent($conn, $email)){
        // Log a regular user in 
        loginUser($conn, $email, $password);
    }elseif (userIsLead($conn, $email)){
        loginLead($conn, $email, $password);
    }
}
else{
    header("location:../login/login.php");  // redirecting to the login page
    exit();
}
?>
