<?php
    //Facilitator functionality
    if(isset($_POST["creating-lead"])){
        
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConfrim = $_POST["confirm_password"];
  
        require_once 'dbc.php';
        require_once 'functions.php';
   
  
          //  Error handling
  
           // Validating the username
        if(invalidFirstname($fname) !== false){
             header("location:../staff/add_lead.php?error=invalid_firstname");
             exit(); 
        }
        
        if(invalidLastname($lname) !== false){
          header("location:../staff/add_lead.php?error=invalid_lastname");
          exit(); 
        }
  
        if(isValidEmail($email) !== false){
           header("location:../staff/add_lead.php?error=invalid_emailaddress");
           exit(); 
        }
           // Handling empty input fields
        if(emptyInputSignup($fname, $lname, $email, $password, $passwordConfrim) !== false){
             header("location:../staff/add_lead.php?error=emptyinput");
             exit(); 
        }
  
           // Handling passwords match
        if(passwordMatch($password, $passwordConfrim) !== false){
           header("location:../staff/add_lead.php?error=passwordsdontmatch");
           exit(); 
        }
  
  
           // Handling taken usernames
        if(existingLead($conn, $email)!== false){
           header("location:../staff/add_lead.php?error=userExists");
           exit(); 
        }
           // Creating a new user
           createLead($conn, $fname,  $lname,  $email, $password);
          
     }else {
        header("location:../staff/add_lead.php");   // redirecting to the create page
        exit();
     }
?>