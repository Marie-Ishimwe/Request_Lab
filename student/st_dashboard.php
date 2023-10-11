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
        $sql = "SELECT * FROM student WHERE student_id = $userId";
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
        $select_acad = "SELECT * FROM academic_request WHERE student_id =  $userId ORDER BY request_id DESC";
        $s = mysqli_query($conn , $select_acad);
        $total_academic = mysqli_num_rows($s);

        // administrative requests
        $select_admin = "SELECT * FROM administrative_request WHERE student_id =  $userId ORDER BY request_id DESC ";
        $t = mysqli_query($conn , $select_admin);
        $total_administrative = mysqli_num_rows($t);

        // All requests
        // $select_requests = "SELECT * FROM academic_request WHERE student_id =  $userId
        // UNION
        // SELECT * FROM administrative_request WHERE student_id =  $userId";
        // $u = mysqli_query($conn , $select_requests);
        // $total_requests = mysqli_num_rows($u);

        $total_requests = $total_administrative + $total_academic;


        // Query to get the last academic request made by the student
        $select_last_acad_request = "SELECT * FROM academic_request WHERE student_id =  $userId ORDER BY request_id DESC LIMIT 1";
        $last_acad_request_result = mysqli_query($conn, $select_last_acad_request);

        // Check if there is a last academic request
        if ($last_acad_request_result && mysqli_num_rows($last_acad_request_result) > 0) {
            $last_acad_request = mysqli_fetch_assoc($last_acad_request_result);
            
            // Extract and display the relevant information from the last academic request
            $last_acad_request_text = $last_acad_request['request_text'];
            $last_acad_request_date = $last_acad_request['date_submitted'];
            
        } else {
            echo 'No academic requests found for this student.';
        }




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
            <li><a href="pwd_reset.php">Reset password</a></li>
            <li style="margin-top: 100%;"><a href="../includes/logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <?php
                ?>
                <div class="user">
                    <!-- <a href="#" class="btn">Add New</a>
                    <img src="notifications.png" alt=""> -->
                    <h2 style="margin-left:85%">Student</h2>
                </div>
            </div>
        </div>


        
        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1><?php echo $total_administrative;?></h1>
                        <h3>Admin requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                        <h1> <?php echo $total_academic;?></h1>
                        <h3>Academic requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $total_requests;?> </h1>
                        <h3>Total requests</h3>
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
                <div class="academic">
                    <div class="title">
                        
                        <h2>Academic requests</h2>
                        <a href="academic_request.php" class="btn">Make request</a>
                    </div>

                    <?php
                        while($row = mysqli_fetch_assoc($s)){

                    ?>
                    <div class="academic-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                            <!--Display the last academic request information-->
                            <p><?php echo $row['request_text'] ?></p>
                            <p style="margin-left:60%; font-style: italic;">On <?php echo $row['date_submitted']?></p>
                            <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: <?php echo $row['comment'] ?></p>
                        
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    
                </div>
                <div class="requests">
                    <div class="title">
                        <h2>Administrative requests</h2>
                        <a href="admin_request.php" class="btn">Make request</a>
                    </div>
                    <?php
                        while($row = mysqli_fetch_assoc($t)){

                    ?>
                    <div class="admin-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                            <!--Display the last academic request information-->
                            <p><?php echo $row['request_text'] ?></p>
                            <p style="margin-left:250px; font-style: italic;">On <?php echo $row['date_submitted']?></p>
                            <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: <?php echo $row['comment'] ?></p>
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