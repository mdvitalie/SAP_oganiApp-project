<?php
include("include/config.php");
//session_start();
session_destroy();
echo "<p style='color:green; text-align:center;'>You have Logged out Successfully</p>";
// Redirect to the login page:
header('Location: sign-in.php');

exit();

?>



