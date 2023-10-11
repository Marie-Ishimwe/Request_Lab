<?php
include_once '../includes/dbc.php'; // connecting to the database

// Start a session (if not already started)
session_start();

// Check if the user_id session variable exists
if (!isset($_SESSION["userId"])) {
    // Redirect to the login page or display an error message
    header("Location: ../login/login.php");
    exit();
}

// Retrieve the request_id from the query parameters
if (isset($_GET["request_id"])) {
    $requestId = $_GET["request_id"];
} else {
    // Handle the case where request_id is missing in the URL
    // You can redirect or display an error message here
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student login</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="login-dark" action="" id="hero">
        <!-- Error handling ~ displaying to the user -->

        <form method="post">
            <div class="illustration">
                <h3><a href="st_dashboard.php">Academic request</a></h3>
            </div>

            <div class="form-group">
                <textarea class="form-control" id="comment" name="comment" rows="4" cols="50" placeholder="Comment" required></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Send Comment</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $comment = $_POST["comment"];

    $sql = "UPDATE academic_request SET comment = ? WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $comment, $requestId); // Use $requestId from the URL
    if ($stmt->execute()) {
        echo "Request submitted successfully.";
        header("location:../staff/facilitator.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        echo "MySQL Error: " . mysqli_error($conn);
        // Redirect back with the request_id as a query parameter
        header("location:request_response.php?request_id=" . $requestId);
        exit(); // Get detailed MySQL error message
    }

    $stmt->close();
    $conn->close();
}
?>
