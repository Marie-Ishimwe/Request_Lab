<?php
    include_once '../includes/dbc.php'; // Include database connection

    // Start a session (if not already started)
    session_start();

    if (!isset($_SESSION["userId"])) {
        // Redirect to the login page or display an error message
        header("Location: ../login/login.php");
        exit();
    }

    if (isset($_POST["reset-submit"])) {
        // Retrieve new password and confirmation from the form
        $newPassword = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        // Perform password validation checks
        if (passwordValidationChecksPass($newPassword, $confirmPassword)) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Get the user's ID from the session
            $userId = $_SESSION["userId"];

            // Update the user's password in the database
            $sql = "UPDATE student SET pwd = ? WHERE student_id = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userId);
                if (mysqli_stmt_execute($stmt)) {
                    // Password updated successfully
                    header("Location: ../success.php");
                    exit();
                } else {
                    // Password update failed
                    header("Location: ../error.php");
                    exit();
                }
                mysqli_stmt_close($stmt);
            } else {
                // Failed to prepare the SQL statement
                header("Location: ../error.php");
                exit();
            }
        } else {
            // Password validation checks failed
            header("Location: reset_password.php?error=passwordsdontmatch");
            exit();
        }
    }
    
    function passwordValidationChecksPass($newPassword, $confirmPassword) {
        // Implement your password validation checks here
        // Return true if checks pass, false otherwise
        // Example checks: length, uppercase, lowercase, number, etc.
        // You can use regular expressions for validation.
        // Return true if checks pass, false otherwise
        return true;
    }
?>
