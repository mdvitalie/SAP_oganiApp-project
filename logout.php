<?php
// Start a session
session_start();

// Check if last activity was set
// Unset all of the session variables
$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear all the cookies by setting their expiration time to a time in the past
foreach ($_COOKIE as $name => $value) {
    setcookie($name, '', time() - 3600);
}

// Clear local storage
echo '<script>localStorage.clear();</script>';

echo "<p style='color:green; text-align:center;'>You have Logged out Successfully</p>";

// Redirect the user to the login page
header('Location: sign-in.php');
exit();
?>


