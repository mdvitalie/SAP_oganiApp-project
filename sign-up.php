
<!-- https://www.phphelp.com/t/php-registration-page-check-for-email-in-table/26320 -->
<!-- www.w3schools.com -->
<!-- https://www.php.net/ -->

<?php
require "include/config.php";

if (isset($_POST['email'])) {
    // Sanitizing user input to prevent injection attacks
    $email = test_input($_POST["email"]);
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $password = test_input($_POST["password"]);
    $confirm_password = $_POST["confirm_password"];

    // Check if user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists in the database
    if ($result->num_rows > 0) {
        echo "<p style='color:red;font-weight: bold; padding-top: 5%; text-align:center;'>User already exists with this email  address '$email'</p>";
    } else {
        if ($password == $confirm_password) {
            //encrypting password using bcrypt
            $encrypted_password = password_hash($password, PASSWORD_BCRYPT);
            //A03:2021 Preparing a secure SQL statement to prevent injection attacks
            $stmt = $conn->prepare("INSERT INTO users (email, firstname, lastname, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $firstname, $lastname, $encrypted_password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Displaying success message if user account created successfully
                echo "<p style='color:green; font-weight: bold; padding-top: 5%; text-align:center;'>User Account Created Successfully</p>";
                //After registration the page will be redirected to the sign-in.php page
                header("Refresh:5; url=sign-in.php");
            } else {
                echo "<p style='color:red; text-align:center;'>Data Not Saved!</p>";
            }

        } else {
            // Displaying error message if password confirmation fails
            echo "<p style='color:red; font-weight: bold; padding-top: 5%; text-align:center;'>Please Re-Confirm Your Password</p>";
        }
    }
}

function test_input($data) //https://www.w3schools.com/php/php_form_validation.asp
{
    // Sanitize user input to prevent injection attacks
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

?>


<!-- #################################################################################################################### -->


<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Ogani App - Sign Up Page</title>

       
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-icons.css" rel="stylesheet">

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

                            <h1 class="hero-title text-center mb-5">Sign Up</h1>                         

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="post">

                                        <div class="form-floating">
                                            <input type="email" name="email" id="email"  class="form-control" placeholder="Email address"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                            required>

                                            <label for="email">Email address</label>
                                        </div>
                    
                                        <div class="form-floating my-4">
                                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required>

                                            <label for="firstname">Firstname</label>
                                            
                                        </div>
                    
                                        <div class="form-floating my-4">                                      
                                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" required>

                                            <label for="surname">Lastname</label>
                                            
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="password" name="password" id="password"  class="form-control" placeholder="Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                          title="The password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>

                                            <label for="password">Password</label>
                                            
                                        </div>

                                        <div class="form-floating">
                                            <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                          title="The password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            required>

                                            <label for="confirm_password">Confirm Password</label>
                                        </div>

                                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                                            Create account
                                        </button>

                                        <p class="text-center">Already have an account? <a href="sign-in.php">Sign In</a></p>

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
