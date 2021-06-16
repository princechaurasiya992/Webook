<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (isset($_SESSION['email'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
    * {box-sizing: border-box}
    /* Full-width input fields */
    input[class=login-input] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: 1px solid #bbb;
        background: #f1f1f1;
    }

    /* Add a background color when the inputs get focus */
    input[class=login-input]:focus {
        background-color: #ddd;
        outline: none;
        border: 1px solid #ec407a;
        box-shadow: 0px 0px 5px 2px #ec407a;
        transition: box-shadow .2s;
    }

    .loginbtn {
        padding: 11px 20px;
        background-color: #ec407a;
        border: 2px solid #ec407a;
        float: left;
        width: 50%;
        color: #fff;
        font-size: 18px;
    }

    .loginbtn:hover {
        padding: 11px 20px;
        float: left;
        width: 50%;
        border-color: #fff;
        background-color: #000;
        color: #fff;
        font-size: 18px;
    }

    .content-login {
        background-color: #fefefe;
        position: relative;
        margin-bottom: 20px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
    @media only screen and (min-width: 768px) {
            	.content-login {
                 	margin: 25px 300px;
                 }
            	
            }

    .login-container {
        padding: 20px;
    }

    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Clear floats */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    @media screen and (max-width: 300px) {
        .loginbtn {
            width: 100%;
        }
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
                    <li><a style="color: black;">Log In</a></li>
                    </ul>
        <div class="container">
            <form id="loginForm" class="content-login" method="POST" action="login_script.php">
        <div class="login-container">
            <h1 style="display: inline-block;">Log In</h1>
            <p>Please fill in this form to log into your account.</p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input class="login-input" type="email" placeholder="Enter Valid Email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">

            <label for="password"><b>Password</b></label>
            <input class="login-input" type="password" placeholder="Password (Min. 6 characters)" name="password" required pattern=".{6,}">

            <label class="checkbox_container" style="color: #000; text-align: left; width: 60%; display: inline-block; margin-bottom: 15px;"> Remember me
                <input type="checkbox" name="remember" checked>
                <span class="checkmark"></span>
            </label>
            
            <p>Forgot Password? <a href="forgot_password.php" style="color: #ec407a">Click here</a>.</p>
            <p>Don't have any account? <a href="signup.php" style="color: #ec407a">Click here</a> to sign up.</p>

            <div class="clearfix">
                <button type="submit" class="loginbtn">Login</button>
            </div>
        </div>
    </form>
        </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("login").classList.add("active");
        </script>
        
        <script>
                            window.addEventListener( "load", function () {
                            function sendData() {
                            const XHR = new XMLHttpRequest();
                            const FD = new FormData( form );
                            XHR.addEventListener( "load", function(event) {
                            alertBoxFunction(event.target.responseText);
                            const success = "You are logged in successfully!";
                            if (event.target.responseText.match(success)) {
                                setTimeout(locationChange, 1500);
                            }
                            } );
                            XHR.addEventListener( "error", function( event ) {
                            alert( 'Oops! Something went wrong.' );
                            } );
                            XHR.open( "POST", "login_script.php" );
                            XHR.send( FD );
                            }
                            const form = document.getElementById( "loginForm" );
                            form.addEventListener( "submit", function ( event ) {
                            event.preventDefault();

                              sendData();
                               } );
                               } );
                          </script>
    </body>
</html>
