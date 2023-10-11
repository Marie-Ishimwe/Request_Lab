<?php
// Function to shorten a text to at most 5 words
    function shortenText($text, $maxWords = 5) {
        $words = explode(' ', $text);
        if (count($words) > $maxWords) {
            $shortenedText = implode(' ', array_slice($words, 0, $maxWords)) . '...';
        } else {
            $shortenedText = $text;
        }
        return $shortenedText;
    }

    include_once '../includes/dbc.php';     // connecting to the database

    // Start a session (if not already started)
    session_start();
    
    
    // Check if the user_id session variable exists
    if (!isset($_SESSION["userId"])) {
        // Redirect to the login page or display an error message
        header("Location: ../login/login.php");
        exit();
    } else {
        $userId = $_SESSION["userId"];
        
        // Query the database to retrieve the username using the $userId
        $sql = "SELECT * FROM facilitator WHERE facilitator_id = $userId";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $username = $row["lname"]; // Assuming "lname" is the column where usernames are stored
        } else {
            // Handle the database query error
            // You can redirect or display an error message
            echo "Error: " . mysqli_error($conn);
        }

        // Query to extract information from the database
       // Fetch student data from the database--------------------------------------------------------------------------------------------
       $select_students = "SELECT * FROM student";
       $total_students = mysqli_query($conn , $select_students);

       // academic requests
       $select_acad = "SELECT * FROM academic_request ORDER BY request_id DESC";
       $s = mysqli_query($conn , $select_acad);
       $total_academic = mysqli_num_rows($s);


// Pending Requests
$pending = "SELECT * FROM academic_request WHERE comment IS NULL ORDER BY request_id DESC";
$pending_requests = mysqli_query($conn , $pending);
$total_pending_requests = mysqli_num_rows($pending_requests);

// Resolved Requests

$solved = "SELECT * FROM academic_request WHERE comment IS NOT NULL ORDER BY request_id DESC";
$solved_requests = mysqli_query($conn , $solved);
$total_solved_requests = mysqli_num_rows($solved_requests);

    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request.lab</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Request.lab</h1>
        </div>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <!-- <li><a href="#">Profile</a></li> -->
            <li><a href="../student/pwd_reset.php">Reset password</a></li>
            <li style="margin-top: 100%;"><a href="../includes/logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="user">
                    <h2 style="margin-left:85%"> Facilitator</h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_pending_requests;?> </h1>
                        <h3>Pending Requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_solved_requests;?> </h1>
                        <h3>Resolved Requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_academic;?> </h1>
                        <h3>Total Requests</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1> <?php echo mysqli_num_rows($total_students);?></h1>
                        <h3>Total Students</h3>
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="requests">
                    <div class="title">
                        <h2>Resolved Requests</h2>
                    </div>
                    <?php
                        while($row = mysqli_fetch_assoc($solved_requests)){
                             $requestID= $row['request_id'] ;
                    ?>
                    <div class="my-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                            <p><?php echo $row['request_text'] ?></p>
                            <p style="margin-left:250px; font-style: italic;">On <?php echo $row['date_submitted']?></p>
                            <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: <?php echo $row['comment'] ?></p>                     
                            <!-- <a href="#" class="btn">View</a> -->
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="pending">
                    <div class="title">
                        <h2>Pending requests</h2>
                    </div>
                        <?php
                            while ($row = mysqli_fetch_assoc($pending_requests)) {
                                $requestID = $row['request_id'];
                                ?>
                                <div class="pending-requests">
                                    <div class="student-avatar">
                                        <img src="../assets/img/student.png" alt="Student avatar">
                                    </div>
                                    <div class="request-content">
                                        <p><?php echo $row['request_text'] ?></p>
                                        <p style="margin-left: 250px; font-style: italic;">On <?php echo $row['date_submitted'] ?></p>
                                        <!-- Modify the link to include the request_id as a query parameter -->
                                        <a href="request_response.php?request_id=<?php echo $requestID ?>" class="btn">Comment</a>

                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>