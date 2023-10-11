<!-- Storing server, database usernname, database password, and the actual name of our database in variables -->
<?php
$server = "localhost";   
$dbUser = "root";
$dbPassword = "";
$database = "security";
 
$conn = mysqli_connect($server, $dbUser, $dbPassword, $database);  // creating a connection to the database using varibale $conn

if (!$conn){
    die("Connection failed: ". mysqli_connect_error());  // displaying an error in case we can not connect to the database
}