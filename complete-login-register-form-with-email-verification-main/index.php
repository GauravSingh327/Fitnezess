<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    include 'config.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: welcome.php");
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form</title>
    <style>
        .start {
                background-image: url("images/home.gif");
                background-color: #cccccc;
                height: 500px;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            }

            .start-text {
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
            }
            .topnav {
            overflow: hidden;
            background-color: #333;
            }

            .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            }

            .topnav a:hover {
            background-color: #ddd;
            color: black;
            }

            .topnav a.active {
              background-color: #04AA6D;
             color: white;
            }
        </style>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>
<header>
            <div class="header" style="color:white;">
                <a href="homepage.html">
                    <center><img src="https://cdn0.iconfinder.com/data/icons/fat-overweight-man-playing-sports-and-exercise/313/fat-man-sport-exercise-17-256.png" width=75px height=75px ></center>
                    <center><h1 style="display: inline; ">FITNEZESS</h1></center>
                    <br>
                 </a>
                </div>
            </div>
        </header>

        <nav>
            <div class="topnav">
                <a href="../homepage.html">Home</a>
                <a class="active" href="index.php">Log-In</a>
                <a href="register.php">Sign-Up</a>
                <a href="../health.html">Healthy Living</a>
                <a href="../faq.html">FAQ</a>
                <a href="../contactus.html">Contact Us</a>
                <a href="../help.html">Help</a>
                <a href="../member.html">Member's Area</a>
            </div>
        </nav>
    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
    <footer >
            <div class="footer">
                
                
                <center>
                    FOLLOW US ON
                    <div id="social-media"  >
                        <br>
                        <br>
                        <a href="https://www.instagram.com/its_gaurav.kholiya/" style="margin-right:50px"><img src="https://cdn2.iconfinder.com/data/icons/social-icons-33/128/Instagram-256.png" alt="visit our instagram " class="social" style="width: 50px; height:50px;"></a>
                        
                        <a href="https://www.facebook.com/gauravkholiya121" style="margin-right:50px"><img src="images/fb.jpeg" alt="visit our facebook" style="width: 50px; height:50px;"></a>
                    </div>
                </center>
                <!-- Copyright -->
                <br>
                <br>
                <div class="footer-copyright" style=" background-color:rgba(255, 255, 255, 0.13);">
                    &#169; 2022 Copyright:
                  <a href="#homepage" style="text-decoration:none; color:rgba(8, 8,8, 0.979);"> Fitnezess.com</a> 
                  All rights reserved.<br>
                </div>
                <!-- Copyright -->
            </div>
        </footer>
</body>

</html>