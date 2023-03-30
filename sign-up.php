
<!-- https://www.phphelp.com/t/php-registration-page-check-for-email-in-table/26320 -->
<!-- www.w3schools.com -->
<?php
require "include/config.php";

if (isset($_POST['email'])) {
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User already exists
        echo "<p style='color:red;font-weight: bold; padding-top: 5%; text-align:center;'>User already exists with this email  address '$email'</p>";
    } else {
        if ($password == $confirm_password) {
            //encrypting password SHA1
            $encrypted_password = hash('SHA1', $password);
            $sql = "INSERT INTO users (email, firstname, lastname, password) VALUES ('$email', '$firstname', '$lastname', '$encrypted_password')";
            mysqli_query($conn, $sql) or die("Data is Not Saved!");

            echo "<p style='color:green; font-weight: bold; padding-top: 5%; text-align:center;'>User Account Created Successfully</p>";
            //After registration the page will be redirected to the sign-in.php page
            header("Refresh:5; url=sign-in.php");

        } else {
            echo "<p style='color:red; font-weight: bold; padding-top: 5%; text-align:center;'>Please Re-Confirm Your Password</p>";
        }
    }
}
?>

<!-- #################################################################################################################### -->


<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>OganiApp - Sign-Up Page</title>

       
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
                                            <input type="email" name="email"   class="form-control" placeholder="Email address">

                                            <label for="email">Email address</label>
                                        </div>
                    
                                        <div class="form-floating my-4">
                                            <input type="text" name="firstname"  class="form-control" placeholder="Firstname" >

                                            <label for="firstname">Firstname</label>
                                            
                                        </div>
                    
                                        <div class="form-floating my-4">                                      
                                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" >

                                            <label for="surname">Lastname</label>
                                            
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="password" name="password" id="password"  class="form-control" placeholder="Password">

                                            <label for="password">Password</label>
                                            
                                        </div>

                                        <div class="form-floating">
                                            <input type="password" name="confirm_password"  class="form-control" placeholder="Password">

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
