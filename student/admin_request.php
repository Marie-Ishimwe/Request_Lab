<?php
    include_once '../includes/dbc.php';     // connecting to the database

    // Start a session (if not already started)
    session_start();

    // Check if the user_id session variable exists
    if (!isset($_SESSION["userId"])) {
        // Redirect to the login page or display an error message
        header("Location: ../login/login.php");
        exit();
    } 
    else{
        // Fetch facilitators from the database
        $facilitators = array();
        $sql = "SELECT lead_id, fname, lname FROM cs_lead";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            
            // $facilitators = mysqli_fetch_array($result);
            while ($row = $result->fetch_assoc()) {
                $Leads[] = ["name"=>$row["fname"] . ' ' . $row["lname"],"id"=>$row["lead_id"]];
            }
            } else {
        echo "No CS Leads found in the database.";
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the form data
            $requestText = $_POST["requestText"];
            $leadId = $_POST["lead"];


            // Prepare and execute an SQL query to insert the request into the database
            $sql = "INSERT INTO administrative_request (request_text, date_submitted, student_id, lead_id) VALUES (?, NOW(),?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $requestText,  $_SESSION["userId"], $leadId);

            // Replace $studentId with the ID of the currently logged-in student
            if ($stmt->execute()) {
                echo "Request submitted successfully.";
                header("location:../student/st_dashboard.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
                echo "MySQL Error: " . mysqli_error($conn);
                header("location:academic_request.php");
                exit(); // Get detailed MySQL error message
            }

            $stmt->close();
            $conn->close();
        }
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request.Lab login</title>
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

    <!-- Error handling ~ displaying to user -->
        
        <form method="post">
            <div class="illustration">
                <h3><a href="st_dashboard.php">Admin request</a></h3>
            </div>

            <div class="form-group">
                <label for="email">Request</label>
                <textarea class="form-control" id="requestText" name="requestText" rows="4" cols="50" required></textarea>
            </div>
            <div class="form-group">
                <label for="password">Choose a Lead</label>
                <select class="form-control" id="lead" name="lead" required>
                    <?php
                        // Generate options for the dropdown based on fetched facilitators
                        foreach ($Leads as $lead) {
                            
                            ?>
                            <option value=<?=$lead["id"]?>><?=$lead["name"] ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Submit request</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>