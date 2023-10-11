<!-- Destroying all session to be able to log out -->
<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../index.php");  // Redirecting to the index or home page
    exit();
?>