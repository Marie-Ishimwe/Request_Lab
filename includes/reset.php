<?php
    // Start a session (if not already started)
    session_start();

    if (!isset($_SESSION["userId"])) {
        // Redirect to the login page or display an error message
        header("Location: ../login/login.php");
        exit();
    }
    else{
        if(isset($_POST["reset-submit"])){
            $userId = $_SESSION["userId"];
            $password = $_POST["password"];
            $passwordConfrim = $_POST["confirm_password"];
    
            require_once 'dbc.php';
            require_once 'functions.php';
    
            // Checking if all fields are filled
            if(emptyInputPassword($password, $passwordConfrim) !== false){
                header("location:../student/pwd_reset.php?error=emptyinput");
                exit(); 
            }
    
            // Handling passwords match
            if(passwordMatch($password, $passwordConfrim) !== false){
                header("location:../student/pwd_reset.php?error=passwordsdontmatch");
                exit(); 
            }
            if(isStudentLoggedIn($conn, $userId) === true) {
                updateStudentPassword($conn, $userId, $password);
            }
            elseif(isFacilitatorLoggedIn($conn, $userId) === true){
                updateFacilitatorPassword($conn, $userId, $password);
            }
    
        }

    }
?>