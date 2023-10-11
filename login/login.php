<!-- Connection to the database -->
<?php
	include_once '../includes/dbc.php'; 
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
    <div class="login-dark" id="hero">

    <!-- Error handling ~ displaying to user -->
        <?php
            // empty fields
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo '<div class="toast" style="position:absolute; min-height: 40px; background-color:red; width:25%; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                        <div style="top: 0; right: 0;">
                            <div class="toast-header">
                                <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body" style ="color: white">
                                All fields must be filled.
                            </div>
                        </div>
                    </div>';
                }
        // incorrect username OR password
                else if ($_GET["error"] == "incorrectlogin"){
                    echo '<div class="toast" style="position:absolute; min-height: 40px; background-color:red; width:25%; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                        <div style="top: 0; right: 0;">
                            <div class="toast-header">
                                <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body" style ="color: white">
                                Incorrect email or password
                            </div>
                        </div>
                    </div>';
                }
            }
        ?>
        <form method="post" action="../includes/login.php">
            <div class="illustration">
                <h3><a href="../index.php"> Request<span>.</span>Lab</a></h3>
            </div>

            <div class="form-group">
            <label for="floatingInput">Email address</label>
                <input class="form-control" type="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="login-submit">Log In</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        <!-- JavaScript to close the toast -->
        function closeToast() {
            var toast = document.querySelector(".toast");
            toast.style.display = "none";
        }
    </script>
</body>

</html>