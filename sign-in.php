<?php
require "include/config.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //encrypting password SHA1
    $encrypted_password = hash('SHA1', $password);

    $sql = "select * from users where email = '$email' AND password='$encrypted_password'";

    $result = mysqli_query($conn, $sql) or die("Data Retreival Error");

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        echo "<p style='color:green; font-weight: bold; padding-top: 5%; text-align:center;'>You have Login Successfully</p>";

        header("Location: index.php");

    } else {
        echo "<p style='color:red; font-weight: bold; padding-top: 5%; text-align:center;'>Invalid email or password</p>";

    }

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
                                            <input type="email" name="email"  class="form-control" placeholder="Email address" >

                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-floating p-0">
                                            <input type="password" name="password"  class="form-control" placeholder="Password">

                                            <label for="password">Password</label>
                                        </div>

                                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                                            Sign in
                                        </button>

                                        <p class="text-center">Don’t have an account? <a href="sign-up.php">Sign Up</a></p>

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
