<!-- https://www.phphelp.com/t/php-registration-page-check-for-email-in-table/26320 -->
<!-- www.w3schools.com -->
<!-- https://www.php.net/ -->
<!-- ############################################################################################################# -->

<?php
require "include/config.php";

if (isset($_POST['email'], $_POST['password'])) {
    // Sanitizing user input to prevent injection attacks
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    //By using prepared statements it prevents SQL injection 
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // password verification by using a strong hashing algorithm like bcrypt
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            echo "<p style='color:green; font-weight: bold; padding-top: 5%; text-align:center;'>You have Sing In Successfully</p>";
            header("Location: index.php");
            exit();
        }
    }
    echo "<p style='color:red; font-weight: bold; padding-top: 5%; text-align:center;'>Invalid email or password</p>";
}

function test_input($data) //https://www.w3schools.com/php/php_form_validation.asp
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $data;
}

?>

<!-- ############################################################################################################# -->

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>OganiApp - Sign In Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-icons.css" rel="stylesheet">

        <!-- <link rel="stylesheet" href="assets/css/slick.css"/> -->
        <link rel="stylesheet" href="assets/css/main.css"/>

        <link href="assets/css/tooplate-little-fashion.css" rel="stylesheet">
        

    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign In</h1>

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="post">

                                        <div class="form-floating mb-4 p-0">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-floating p-0">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="The password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            required>

                                            <label for="password">Password</label>
                                        </div>

                                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                                            Sign in
                                        </button>

                                        <p class="text-center">Don’t have an account? <a href="sign-up.php">Sing Up</a></p>

                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

        </main>


        <!-- JAVASCRIPT FILES -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/custom.js"></script>

    </body>
</html>
