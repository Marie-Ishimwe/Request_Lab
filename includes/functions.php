<?php
    // A function to check if a given first name 
    // is valid (contains only letters and spaces)
    function invalidFirstname($fname) {
        if (!preg_match("/^[a-zA-Z\s]*$/", $fname)) {
            $result = true; // Invalid first name format
        } else {
            $result = false; // Valid first name format
        }
        return $result;
    }

    // A function to check if a given last name is valid 
    // (contains only letters, numbers, and underscores)
    function invalidLastname($lname) {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $lname)) {
            $result = true; // Invalid last name format
        } else {
            $result = false; // Valid last name format
        }
        return $result;
    }

    // A function to check if a given email is in a valid format
    function isValidEmail($email) {
        if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
            $result = true; // Invalid email format
        } else {
            $result = false; // Valid email format
        }
        return $result;
    }

    // A function to check if any of the input fields are empty during signup
    function emptyInputSignup($fname, $lname, $email, $password, $passwordConfirm) {
        if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($passwordConfirm)) {
            $result = true; // Empty input fields
        } else {
            $result = false; // All fields filled
        }
        return $result;
    }

    // A function to check if the provided passwords match
    function passwordMatch($password, $passwordConfirm) {
        if ($password !== $passwordConfirm) {
            $result = true; // Passwords do not match
        } else {
            $result = false; // Passwords match
        }
        return $result;
    }

    // A function to check if a user with the given email already exists in the student table
    function existingUsername($conn, $email) {
        $sql = "SELECT * FROM student WHERE email = ?;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/signup.php?error=stmtfailed");
            exit();
        } 
 
        mysqli_stmt_bind_param($stmt, "s",$email);
        mysqli_stmt_execute($stmt);
 
        $resultData = mysqli_stmt_get_result($stmt);
 
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
 
        }
        else{
            $result = false;
            return $result;
        }
 
        mysqli_stmt_close($stmt);
    }
 
    // A function to create a new student in the database
    function createStudent($conn, $fname,  $lname,  $email, $password){
        $sql = "INSERT INTO student(fname, lname, email, pwd) VALUES (?, ?, ?,?);";
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/signup.php?error=stmtfailed");
            exit();
        }
 
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
 
        mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashedpassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../staff/lead.php?error=none");
        exit();
    }

    // A function to check if a user with the given email already exists in the facilitator table
    function existingFacilitator($conn, $email){
        $sql = "SELECT * FROM facilitator WHERE email = ?;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/add_facilitator.php.php?error=stmtfailed");
            exit();
        } 
 
        mysqli_stmt_bind_param($stmt, "s",$email);
        mysqli_stmt_execute($stmt);
 
        $resultData = mysqli_stmt_get_result($stmt);
 
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
 
        }
        else{
            $result = false;
            return $result;
        }
 
        mysqli_stmt_close($stmt);
    }


    // A function to check if a user with the given email already exists in the facilitator table
    function existingLead($conn, $email){
        $sql = "SELECT * FROM cs_lead WHERE email = ?;"; // ? is the placeholder
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/add_lead.php?error=stmtfailed");
            exit();
        } 
 
        mysqli_stmt_bind_param($stmt, "s",$email);
        mysqli_stmt_execute($stmt);
 
        $resultData = mysqli_stmt_get_result($stmt);
 
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
 
        }
        else{
            $result = false;
            return $result;
        }
 
        mysqli_stmt_close($stmt);
    }
    


    // A function to create a new facilitator in the database
    function createFacilitator($conn, $fname,  $lname,  $email, $password){
        $sql = "INSERT INTO facilitator(fname, lname, email, pwd) VALUES (?, ?, ?,?);";
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/add_facilitator.php?error=stmtfailed");
            exit();
        }
 
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
 
        mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashedpassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../staff/lead.php?error=none");
        exit();
    }

    // A function to create a new facilitator in the database
    function createLead($conn, $fname,  $lname,  $email, $password){
        $sql = "INSERT INTO cs_lead(fname, lname, email, pwd) VALUES (?, ?, ?,?);";
        $stmt = mysqli_stmt_init($conn);           // Initializing a new prepared statement
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../staff/add_lead.php?error=stmtfailed");
            exit();
        }
 
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
 
        mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashedpassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../staff/lead.php?error=none");
        exit();
    }

    // A function to check if any of the input fields are empty during login
    function emptyInputLogin($email, $password){
        // $result;
        if(empty($email) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }

    // A function to check if any of the input fields are empty during password reset
    function emptyInputPassword($password, $passwordConfrim){
        // $result;
        if(empty($passwordConfrim) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
 
        return $result;
    }

    // A function to log in a student user
    function loginUser($conn, $email, $password){
        $usernameExists = existingUsername($conn, $email);
 
        if ($usernameExists === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
 
        $pwdHashed = $usernameExists["pwd"];
 
        $checkpwd = password_verify($password, $pwdHashed);
 
        if($checkpwd === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
        else if ($checkpwd === true){
            session_start();
            $_SESSION["userId"] =  $usernameExists["student_id"];
            $_SESSION["username"] =  $usernameExists["lname"];
            header("location:../student/st_dashboard.php");
            exit();
 
        }
 
    }


    // A function to log in a facilitator user
    function loginFacilitator($conn, $email, $password){
        $facilitatorExists = existingFacilitator($conn, $email);
 
        if ($facilitatorExists === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
 
        $pwdHashed = $facilitatorExists["pwd"];
 
        $checkpwd = password_verify($password, $pwdHashed);
 
        if($checkpwd === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
        else if ($checkpwd === true){
            session_start();
            $_SESSION["userId"] =  $facilitatorExists["facilitator_id"];
            $_SESSION["username"] =  $facilitatorExists["lname"];
            header("location:../staff/facilitator.php");
            exit();

        }

    }

    function loginLead($conn, $email, $password){
        $leadExists = existingLead($conn, $email);
 
        if ($leadExists === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
 
        $pwdHashed = $leadExists["pwd"];
 
        $checkpwd = password_verify($password, $pwdHashed);
 
        if($checkpwd === false){
            header("location:../login/login.php?error=incorrectlogin");
            exit();
        }
        else if ($checkpwd === true){
            session_start();
            $_SESSION["userId"] =  $leadExists["lead_id"];
            $_SESSION["username"] =  $leadExists["lname"];
            header("location:../staff/lead.php");
            exit();

        }

    }


    // A function to check if a user with the given email is a facilitator
    function userIsFacilitator($conn, $email) {
        $sql = "SELECT * FROM facilitator WHERE email = ?;"; // Change 'facilitator' to your facilitator table name
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return true; // User is a facilitator
        } else {
            return false; // User is not a facilitator
        }

        mysqli_stmt_close($stmt);
    }

    // A function to check if a user with the given email is a student
    function userIsStudent($conn, $email) {
        $sql = "SELECT * FROM student WHERE email = ?;"; // Change 'facilitator' to your facilitator table name
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return true; // User is a facilitator
        } else {
            return false; // User is not a facilitator
        }

        mysqli_stmt_close($stmt);
    }

    // A function to check if a user with the given email is a student
    function userIsLead($conn, $email) {
        $sql = "SELECT * FROM cs_lead WHERE email = ?;"; // Change 'facilitator' to your facilitator table name
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return true; // User is a facilitator
        } else {
            return false; // User is not a facilitator
        }

        mysqli_stmt_close($stmt);
    }

    // A function to check if a user with the given student_id is a student and logged in
    function isStudentLoggedIn($conn, $student_id) {
    
            // Query the database to retrieve the user's role
            $student_details = mysqli_query($conn, "SELECT * FROM student WHERE student_id = $student_id;");
            
            if (mysqli_num_rows($student_details) == 1) {
                return $result = true; // User is a student
            } else {
                return $result = false; // User is not a student
            }
            return $result;
    }

    // A function to check if a user with the given user_id is a facilitator and logged in
    function isFacilitatorLoggedIn($conn, $user_id) {
    
        // Query the database to retrieve the user's role
        $details = mysqli_query($conn, "SELECT * FROM facilitator WHERE facilitator_id = $user_id;");
        
        if (mysqli_num_rows($details) == 1) {
            return $result = true; // User is a facilitator
        } else {
            return $result = false; // User is not a facilitator
        }
        return $result;
    }


    // A function to update the password for a student
    function updateStudentPassword($conn, $userId, $newPassword) {
        // Hash the new password before updating it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // SQL query to update the password
        $sql = "UPDATE student SET pwd = ?  WHERE student_id = ?";
        $stmt = mysqli_stmt_init($conn);

    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../student/pwd_reset.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userId);
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../student/st_dashboard.php");
        exit(); // Return true if the password is updated successfully
        
    }

    // A function to update the password for a facilitator
    function updateFacilitatorPassword($conn, $userId, $newPassword) {
        // Hash the new password before updating it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // SQL query to update the password
        $sql = "UPDATE facilitator SET pwd = ?  WHERE facilitator_id = ?";
        $stmt = mysqli_stmt_init($conn);

    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../student/pwd_reset.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userId);
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../staff/facilitator.php");
        exit(); // Return true if the password is updated successfully
        
    }
    