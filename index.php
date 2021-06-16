<?php
require 'includes/common.php';

if (isset($_SESSION['is_welcomed'])) {
    if (!isset($_SESSION['email'])) {
        header('location: login.php');
    }
}
//Checking if session is active or expired...
if (isset($_SESSION['email'])) {

    if (!isset($_SESSION['remember_login'])) {
        if (isset($_SESSION['expire'])) {
            if (time() > $_SESSION ['expire']) {
                unset($_SESSION['id']);
                unset($_SESSION['email']);
                unset($_SESSION['remember_login']);
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}

$categories = array("adventure", "travel", "beach", "holy_place", "festival", "zoo", "sport");

$categories2 = array("Adventure", "Travel", "Beach", "Holy Place", "Festival", "Zoo", "Sport");

$categories_size = count($categories);
$total_pictures_stored = 0;

$picture_count_query = "SELECT COUNT(id) FROM pictures;";
$picture_count_result = mysqli_query($con, $picture_count_query) or die(mysqli_error($con));

while ($row = mysqli_fetch_array($picture_count_result)) {
    $total_pictures_stored = $row['COUNT(id)'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Webook | Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            * {box-sizing: border-box;}
        
            .mySlides {
                display: none;
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0%;
            }
            img {
                vertical-align: middle;  
            }

            /* Slideshow container */
            .slideshow-container {
                width: 100%;
                padding-top: 40%;
                overflow: hidden;
                position: relative;
            }

            /* Caption text */
            .text {
                font-weight: bold;
                padding: 5px;
                position: absolute;
                bottom: 0%;
                margin: 0%;
                text-align: center;
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */ 
                color: #fff;
                left: 50%;
                transform: translate(-50%, 0%);
                width: 100%;
            }

            /* Number text (1/3 etc) */
            .numbertext {
            	margin: 0%;
                color: #fff;
                padding: 5px;
                position: absolute;
                top: 0%;
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */ 
            }
          
            @media only screen and (min-width: 600px) {
            	.slideshow-container {
                 	padding-top: 26.20%;
                 }
            	
            }

            /* The dots/bullets/indicators */
            .dot {
                height: 10px;
                width: 10px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
            }

            .text-block {
                position: absolute;
                top: 0px;
                right: 0px;
                background-color: rgba(0,0,0,0.4);
                color: white;
                padding: 5px;
                width: 35%;
            }

            .text-block-caption {
                position: absolute;
                bottom: 0;
                margin: 0;
                background-color: rgba(0,0,0,0.4);
                color: white;
                padding: 5px;
                width: 100%;
            }

            .active {
                background-color: #ec407a;
            }

            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
            }

            @keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
                .text {font-size: 11px}
            }
            .myImgContainer{
                position: relative;
                float: left;
                width: 50%;
                padding-top: 50%;
            }
            .myImg {
                cursor: pointer;
                transition: 0.3s;
                display: inline-block;
                width: 100%;
                height: 100%;
                position: relative;
                border: 0px solid #bbb;
                border-radius: 0px;
                box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
                overflow: hidden;
            }

            .myImg:hover {opacity: 0.7;}
            
              @media only screen and (min-width: 600px) {
            	.myImgContainer {
                    width: 33.33%;
                 	padding-top: 33.33%;
                 }
                 
            }
            @media only screen and (min-width: 768px) {
            	.myImgContainer {
                     width: 25%;
                 	padding-top: 25%;
                 }
                 .welcome_statement {
                     width: 50%;
                  }
             }
             
            
            

            .enter_btn{
                background-color: #ec407a;
                color: white;
                font-size: 20px;
                padding: 5px 12px;
                border: 4px solid #ec407a;
                border-radius: 10px;
                cursor: pointer;
                
            
            }
            .enter_btn:hover {
                background-color: #fff;
                border-color: #ec407a;
                color: #ec407a;
            }

        </style>
    </head>
    <body>
        <?php
        if (!isset($_SESSION['is_welcomed'])) {
            ?>
            <div id="welcome">
                <div style="position: fixed; width: 100%; height: 110%; z-index: 120; opacity: 0.9; background-color: #000;"></div>
                <div style="position: absolute; width: 100%; height: 100%; z-index: 121;">
                    <h1 style="font-size: 66px; width: 100%; color: #ec407a; text-align: center; font-family: Playball-Regular, sans-serif;">We<span style="color: #fff;">book</span></h1>
                    <div class="welcome_statement" style="margin-top: 20px; position: relative; padding: 0px 20px; text-align: justify; background-color: transparent; left: 50%; transform: translate(-50%,-0%); border: 5px solid #ec407a; border-radius: 10px;">
                        <h1 style="font-size: 20px; width: 100%; color: #ec407a; text-align: center;">Welcome to Webook!</h1>
                        <p style="font-size: 15px; width: 100%; color: #fff;">We welcome you to the Webook!.</p><br>
                        <p style="font-size: 15px; width: 100%; color: #fff;">By clicking on the "Enter" button, and by entering this website you agree with all the above given statement.</p>
                    </div>
                    <div style= "width: 100%; position: relative; margin: 30px 0px;">
                        <a href="welcome_confirmation_script.php" class="enter_btn" style="position: absolute; left: 50%; transform: translate(-50%, 0%); text-decoration: none;">Enter</a>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>

            <?php
            include 'includes/header.php';
            ?>
                    
            <div class="content" id="content">
            	
                    <ul class="breadcrumb">
                    <li><a style="color: black;">Home</a></li>
                    </ul>
                    
                <div class="container">
                    <div class="jumbotron text-center">
                        <h1 style="color: #ec407a; font-weight: bold;">Welcome to Webook!</h1>
                        <p>This website is under development. Although you can still enjoy some of the features of this website. Thank you!</p>
                    </div>
                </div>

            </div>
            <?php
            include 'includes/footer.php';
            include 'includes/navbar_script.php';
            ?>
            <script>
                document.getElementById("home").classList.add("active");
            </script>
            <?php
        }
        ?>
    </body>
</html>
