<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>About Us</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            .about_me {
                width: 40%;
                float: right;
                height: 100%;
                padding: 25px;
            }

            .about_website {
                width: 60%;
                float: left;
                height: 100%;
                padding: 25px;
                background-color: #eeeeee;
            }

            @media only screen and (max-width: 600px) {
                .about_me {
                    width: 100%;
                }

                .about_website {
                    width: 100%;
                }
            }

            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center;
                background-color: #fff;
            }

            .title {
                color: grey;
                font-size: 18px;
            }

            .contact-button {
                border: none;
                outline: 0;
                display: inline-block;
                padding: 8px;
                color: white;
                background-color: #000;
                text-align: center;
                cursor: pointer;
                width: 100%;
                font-size: 18px;
            }

            .social-media-link {
                text-decoration: none;
                font-size: 22px;
                color: black;
            }

        </style>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>

  <div class="content" id="content">

     <ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a style="color: black;">About Us</a></li>
                    </ul>
                    
            <div class="container" style="background-color: #e0e0e0;">
            <div class="about_website">
                <div float="left">
                    <h1>Who are we?</h1>
                    <p>This website is developed and handled by a single person at present.
                        The developer's profile is given below. The idea of this website is
                        to provide the best social media platform for the people all over the
                        world while maintaining their privacy.</p>
                </div>
                <div float="left">
                    <h1>Why choose us?</h1>
                    <p>We are committed to our users privacy. Read our <a href="privacy_policy.php">Privacy Policy</a>.
                        <br><br>We do not sell user's data in any case. </p>
                </div>
                <div float="left">
                    <h1>Why are we doing this?</h1>
                    <p>In the world of full of technology, smartphone, 4G and 5G the
                        world has become a smaller place. And the social media platforms are
                        playing a major role in connecting the people across the globe. But,
                        here the problem comes. It's the privacy of the users and their data.
                        User's data is the new fuel of this modern world. Most of the social
                        media platforms don't care about the user's data and they sell it other companies.</p>
                </div>
                <div float="right">
                    <h1>Contact us</h1>
                    <p><span class="bi bi-envelope-fill"></span> princechaurasiya992@gmail.com</p>
                    <p><span class="bi bi-facebook"></span> princechaurasiya992</p>
                    <p><span class="bi bi-twitter"></span> prince_chauras1</p>
                    <p><span class="bi bi-instagram"></span> princechaurasiya992</p>
                </div>
            </div>
            <div class="about_me">
                <div class="card">
                    <img src="img/developer/developer.jpg" alt="John" style="width:100%">
                    <h1>Prince Chaurasiya</h1>
                    <p class="title">Final year student, Electrical Engineering</p>
                    <p>Rajkiya Engineering College, Kannauj</p>
                    <a class="social-media-link" href="#"><i class="bi bi-twitter"></i></a>
                    <a class="social-media-link" href="#"><i class="bi bi-linkedin"></i></a>
                    <a class="social-media-link" href="#"><i class="bi bi-facebook"></i></a>
                    <p><button class="contact-button">Contact</button></p>
                </div>
            </div>
        </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("about_us").classList.add("active");
        </script>
    </body>
</html>
