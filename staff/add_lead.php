<!-- Connection to the database -->
<?php
	include_once '../includes/dbc.php'; 
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
    <div class="login-dark" id='hero'>
        <?php
        // Communicating that all fields aint filled
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                        <div style="top: 0; right: 0;">
                            <div class="toast-header">
                                <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                All fields must be filled.
                            </div>
                        </div>
                    </div>';
                }

                // communicating that the username already exists
                else if ($_GET["error"] == "invalid_firstname"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Invalid first name format.
                        </div>
                    </div>
                </div>';
                }

                else if ($_GET["error"] == "invalid_lastname"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Invalid last name format.
                        </div>
                    </div>
                </div>';
                }


                else if ($_GET["error"] == "invalid_emailaddress"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Incorrct email format.
                        </div>
                    </div>
                </div>';
                }


                // Communicating that passwords don't match
                else if ($_GET["error"] == "passwordsdontmatch"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Passwords should be the same.
                        </div>
                    </div>
                </div>';
                }

                // Communicating that username is taken
                else if ($_GET["error"] == "usernameExists"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            User already exists.
                        </div>
                    </div>
                </div>';
                }

                // Communicating that something went wrong
                else if ($_GET["error"] == "stmtfailed"){
                    echo '<div class="toast" style="min-height: 40px; background-color:red; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Something went wrong, try again.
                        </div>
                    </div>
                </div>';
                }

                // Successfully signed up
                else if ($_GET["error"] == "none"){
                    echo '<div class="toast" style="min-height: 40px; background-color:green; width:auto; margin-left:70%; text-align:center; padding:10px; margin-top:1%;">
                    <div style="top: 0; right: 0;">
                        <div class="toast-header">
                            <button type="button" class="ml-2 mb-1 close" onclick="closeToast()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            User created successfully.
                        </div>
                    </div>
                </div>';
                }
            }
        ?>
        <form method="post" action="../includes/add_lead.php">
            <div class="illustration">
                <h3><a href="../index.php"> Request<span>.</span>Lab</a></h3>
            </div>
            <!-- First name -->
            <div class="form-group">
                <label for="fname">First name</label>
                <input class="form-control" type="text" id="fname" name="fname">
            </div>

            <!-- Last name -->
            <div class="form-group">
                <label for="lname">Last name</label>
                <input class="form-control" type="text" id="lname" name="lname">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="floatingInput">Email address</label>
                <input class="form-control" id="email" type="email" name="email">
            </div>
            
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" onkeyup="password_validate()" onclick="showPasswordRequirements()">
                <div class="password-requirements" style="display: none;">
                    <ul>
                        <li class="upper">At least one uppercase</li>
                        <li class="lower">At least one lowercase</li>
                        <li class="number">At least one number</li>
                        <li class="length">At least 8 characters</li>
                    </ul>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input class="form-control" id="confirm_password" type="password" name="confirm_password" onkeyup="password_validate()"> 
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="creating-lead">Add lead</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPasswordRequirements() {
            // Display the password requirements when the password field is clicked
            var passwordRequirements = document.querySelector(".password-requirements");
            passwordRequirements.style.display = "block";
        }

        function password_validate() {
            var pass = document.getElementById('password');
            var upper = document.querySelector('.upper');
            var lower = document.querySelector('.lower');
            var num = document.querySelector('.number');
            var len = document.querySelector('.length');

            // Checking if the password contains any number
            if (pass.value.match(/[0-9]/)) {
                num.style.color = 'green';
            } else {
                num.style.color = 'red';
            }

            // Checking for any upper case
            if (pass.value.match(/[A-Z]/)) {
                upper.style.color = 'green';
            } else {
                upper.style.color = 'red';
            } 

            // Checking for any lower char
            if (pass.value.match(/[a-z]/)) {
                lower.style.color = 'green';
            } else {
                lower.style.color = 'red';
            } 

            // Checking the length of the password
            if (pass.value.length >= 8) {
                len.style.color = 'green';
            } else {
                len.style.color = 'red';
            }

            // Check if all requirements are satisfied, then hide them
            if (num.style.color === 'green' && upper.style.color === 'green' && lower.style.color === 'green' && len.style.color === 'green') {
                var passwordRequirements = document.querySelector(".password-requirements");
                passwordRequirements.style.display = "none";
            } else {
                var passwordRequirements = document.querySelector(".password-requirements");
                passwordRequirements.style.display = "block";
            }
        }

        <!-- JavaScript to close the toast -->
    function closeToast() {
        var toast = document.querySelector(".toast");
        toast.style.display = "none";
    }
    </script>
</body>
</html>
