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
$friend_id = $_GET['id'];
$select_friend_query = "SELECT * FROM users WHERE id = '$friend_id'";
$friend_selection_result = mysqli_query($con, $select_friend_query) or die(mysqli_error($con));
$row_friend = mysqli_fetch_array($friend_selection_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Friend's Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            
            .profile_pic {
                float: left;
                width: 100%;
                height: 100%;
            }
            
            #profile_details {
                float: left;
                width: 100%;
                height: 100%;
            }
            
            @media only screen and (min-width: 768px) {
                .profile_pic {
                      float: right;
                      width: 30%;
                 }
            	#profile_details {
                     width: 70%;
                 }
            }
            
            label {
                padding: 12px 6px 12px 12px;
                display: inline-block;
            }

            
            .row {
                margin: 5px 0 5px 0;
            }

            .details-box {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
            }

            /* Style the container */
            .container {
                background-color: #f2f2f2;
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
                    <li><a style="color: black;"><?php echo $row_friend["name"]; ?></a></li>
                    </ul>
                    
        <div class="container">
                    
             <div class="profile_pic">
                <div style="margin: 40px; width: 250px; height: 250px; border: 10px solid #fff; overflow: hidden;">
                    <?php
                    if ($row_friend["photo"] == null) {
                        ?>
                        <center><span style="font-size:230px; margin: 0;" class="glyphicon glyphicon-user"></span></center>
                        <?php
                    } else {
                        ?>
                        <img src="img/profile/<?php echo $row_friend["photo"]; ?>" alt="" style="height: 100%; width: 100%; object-fit: cover;">
                        <?php
                    }
                    ?>
                </div>
            </div>
        
            <div id="profile_details">
                <div class="row">
                    <h3>Basic Details</h3>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="name">Name</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="name" class="details-box"><?php echo $row_friend["name"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="email_id">E-mail</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="email_id" class="details-box"><?php echo $row_friend["email_id"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="phone">Mobile Number</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="phone" class="details-box"><?php echo $row_friend["phone"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="registration_time">Registration Date</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p class="details-box"><?php echo date_format(date_create($row_friend["registration_time"]), "jS M-Y"); ?></p>
                    </div>
                </div>

                <div class="row">
                    <h3>Additional Details</h3>
                </div>

                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="gender">Gender</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="gender" class="details-box"><?php echo ucfirst($row_friend["gender"]); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="dob" class="details-box"><?php echo date_format(date_create($row_friend["dob"]), "jS M-Y"); ?></p>
                    </div>
                </div>
                <div class="row" id="category_english">
                    <div style="float: left; width: 30%;">
                        <label for="profession">Profession</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="profession" class="details-box"><?php echo ucwords($row_friend["profession"]); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="address">Address</label>
                    </div>
                    <div style="float: left; width: 70%; height: auto;">
                        <p id="address" class="details-box"><?php echo $row_friend["address"]; ?></p>
                    </div>
                </div>
            </div>

        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        
    </body>
</html>
