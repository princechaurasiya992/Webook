<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';

//Checking if session is active or expired...
if (isset($_SESSION['email'])) {

    if (!isset($_SESSION['remember_login'])) {
        if (isset($_SESSION['expire'])) {
            if (time() > $_SESSION ['expire']) {
                unset($_SESSION['id']);
                unset($_SESSION['email']);
                unset($_SESSION['remember_login']);
                echo "<script>alert('Session expired! Please login again!')</script>";
                echo ("<script>location.href='login.php'</script>");
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}

if (!isset($_SESSION['email'])) {
 header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Settings</title>
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
    input[class=login-modal-input] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: 1px solid #bbb;
        background: #f1f1f1;
    }

    /* Add a background color when the inputs get focus */
    input[class=login-modal-input]:focus {
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

    .modal-content-login {
        background-color: #fefefe;
        position: relative;
        margin-bottom: 20px;
        border: 1px solid #888;
    }
    @media only screen and (min-width: 768px) {
            	.modal-content-login {
                 	margin: 25px 300px;
                 }
            	
            }

    .login-modal-container {
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

    /* Change styles for cancel button and signup button on extra small screens */
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
        <div class="container content" id="content">
                <form class="modal-content-login" method="POST" action="change_password_script.php">
        <div class="login-modal-container">
            <h1 style="display: inline-block;">Change Password</h1>
            <p>Please fill in this form to change your password.</p>
            <hr>

            <label for="old_password"><b>Old Password</b></label>
            <input class="login-modal-input" type="password" placeholder="Old Password (Min. 6 characters)" name="old_password" required pattern=".{6,}">
            
            <label for="new_password"><b>New Password</b></label>
            <input class="login-modal-input" type="password" placeholder="New Password (Min. 6 characters)" name="new_password" required pattern=".{6,}">
            
            <label for="re_type_new_password"><b>Re-Type New Password</b></label>
            <input class="login-modal-input" type="password" placeholder="Re-type New Password (Min. 6 characters)" name="re_type_new_password" required pattern=".{6,}">

            <div class="clearfix">
                <button type="submit" class="loginbtn">Change</button>
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
            document.getElementById("change_password").classList.add("active");
        </script>
    </body>
</html>
