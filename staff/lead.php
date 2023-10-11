<?php
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
        // Query to extract information from the database
       // Fetch student data from the database--------------------------------------------------------------------------------------------
       $select_students = "SELECT * FROM student";
       $total_students = mysqli_query($conn , $select_students);

       // academic requests
       $select_acad = "SELECT * FROM academic_request ORDER BY request_id DESC";
       $academic_requests = mysqli_query($conn , $select_acad);
       $total_academic = mysqli_num_rows($academic_requests);
       // administrative requests
       $select_admin = "SELECT * FROM administrative_request ORDER BY request_id DESC ";
       $t = mysqli_query($conn , $select_admin);
       $total_administrative = mysqli_num_rows($t);

       // Total requests
       $total_requests = $total_administrative + $total_academic;

       // Pending Admin Requests
       $pending_admin = "SELECT * FROM administrative_request WHERE comment IS NULL ORDER BY request_id DESC";
    $pending_admin_requests = mysqli_query($conn , $pending_admin);
    $total_pending_admin_requests = mysqli_num_rows($pending_admin_requests);

    // Pending Academic Requests
    $pending_academic = "SELECT * FROM academic_request WHERE comment IS NULL ORDER BY request_id DESC";
    $pending_academic_requests = mysqli_query($conn , $pending_academic);
    $total_pending_academic_requests = mysqli_num_rows($pending_academic_requests);

       // Resolved Admin Requests
       $solved_admin = "SELECT * FROM administrative_request WHERE comment IS NOT NULL ORDER BY request_id DESC";
       $solved_admin_requests = mysqli_query($conn , $solved_admin);
       $total_solved_admin_requests = mysqli_num_rows($solved_admin_requests);

       // Resolved Academic Requests
       $solved_academic = "SELECT * FROM administrative_request WHERE comment IS NOT NULL ORDER BY request_id DESC";
       $solved_academic_requests = mysqli_query($conn , $solved_academic);
       $total_solved_academic_requests = mysqli_num_rows($solved_academic_requests);

    
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
            <li><a href="signup.php">Add student</a></li>
            <li><a href="add_facilitator.php">Add Facilitator</a></li>
            <!-- <li><a href="add_lead.php">Add Lead</a></li> -->
            <li style="margin-top: 80%;"><a href="../includes/logout.php">Log out</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="user">
                    <h2 style="margin-left:85%">Admin</h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                    <div class="card">
                    <div class="box">
                       <h1><?php echo $total_administrative;?> </h1>
                        <h3>Administrative requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_academic;?> </h1>
                        <h3>Academic requests</h3>
                    </div>

                </div>
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_pending_admin_requests;?> </h1>
                        <h3>Pending Requests</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                    <h1><?php echo $total_solved_admin_requests;?> </h1>
                        <h3>Resolved Requests</h3>
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="requests">
                    <div class="title">
                        <h2>Pending Admin requests</h2>
                    </div>
                    <?php
                            while ($row = mysqli_fetch_assoc($pending_admin_requests)) {
                                $requestID = $row['request_id'];
                                ?>
                    <div class="pending-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                        <p><?php echo $row['request_text'] ?></p>
                            <p style="margin-left: 250px; font-style: italic; width:100%">On <?php echo $row['date_submitted'] ?></p>
                            <a href="admin_response.php?request_id=<?php echo $requestID ?>" class="btn">Comment</a>
                        </div>

                    </div>
                    <?php
                            }
                        ?>    
                </div>
                <div class="pending">
                    <div class="title">
                        <h2>Resolved Admin Requests</h2>
                    </div>
                    <?php
                            while ($row = mysqli_fetch_assoc($solved_admin_requests)) {
                                $requestID = $row['request_id'];
                                ?>
                    <div class="pending-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                        <p><?php echo $row['request_text'] ?></p>
                            <p style="margin-left: 250px; font-style: italic; width:100%">On <?php echo $row['date_submitted'] ?></p>
                            <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: <?php echo $row['comment'] ?></p>

                    </div>
                    <?php
                            }
                        ?>

                    
                </div>
                <div class="requests">
                    <div class="title">

                        <h2>Pending Academic Requests</h2>
                    </div>
                    <?php
                            while ($row = mysqli_fetch_assoc($pending_academic_requests)) {
                                ?>
                    <div class="my-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                        <p><?php echo $row['request_text'] ?></p>
                        <p style="margin-left: 250px; font-style: italic; width:100%">On <?php echo $row['date_submitted'] ?></p>
                        <!-- <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: </p> -->
                    </div>
                    </div>  <?php
                            }
                        ?>

                </div>
                <div class="requests">
                    <div class="title">

                        <h2>Resolved Academic Requests</h2>
                    </div>
                    <?php
                            while ($row = mysqli_fetch_assoc($solved_academic_requests)) {
                                ?>
                    <div class="my-requests">
                        <div class="student-avatar">
                            <img src="../assets/img/student.png" alt="Student avatar">
                        </div>
                        <div class="request-content">
                        <p><?php echo $row['request_text'] ?></p>
                        <p style="margin-left: 250px; font-style: italic; width:100%">On <?php echo $row['date_submitted'] ?></p>
                        <p style="margin-left: 30px; font-style: italic; font-size:14px;">Comment: <?php echo $row['comment'] ?></p>
                    </div>
                    </div>  <?php
                            }
                        ?>

                </div>
            </div>
        </div>
    </div>
</body>