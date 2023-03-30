<?php

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 60) {
    // last request was more than 1 minute ago
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location: sign-in.php"); // redirect to Sign In page
}
$_SESSION['last_activity'] = time(); // update last activity time stamp

?>
