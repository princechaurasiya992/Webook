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
                 .adult_warning_statement {
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
            include 'includes/header.php';
            ?>
    
            <div class="content" id="content">
            	
             <ul class="breadcrumb">
                    <li><a style="color: black;">Home</a></li>
                    </ul>
                    
                <div class="slideshow-container">
                    <?php
                    for ($i = 0; $i < $categories_size; $i++) {
                        ?>
                        <div class="mySlides fade">
                            <h5 class="numbertext"><?php echo ($i + 1) . " / " . $categories_size; ?></h5>
                            <img src="img/sliders/<?php echo $categories[$i]; ?>.jpg" style="height: 100%; width: 100%; object-fit: cover;">
                            <h5 class="text"><?php echo $categories2[$i]; ?></h5>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <br>

                <div style="text-align:center">
                    <?php
                    for ($i = 0; $i < $categories_size; $i++) {
                        ?>
                        <span class="dot"></span> 
                        <?php
                    }
                    ?>
                </div>

                <script>
                    var slideIndex = 0;
                    showSlides();

                    function showSlides() {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("dot");
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {
                            slideIndex = 1
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                        setTimeout(showSlides, 2000); // Change image every 2 seconds
                    }
                </script>
                
               

                <div class="container">
                    <div class="jumbotron text-center">
                        <h1 style="color: #ec407a; font-weight: bold;">Welcome to Webook!</h1>
                        <p>We have total <?php echo $total_pictures_stored; ?> pictures for you.</p>                
                        <a style="font-size: 20px;" href="pictures.php?id=pictures&page=1" name="pictures" class="button btn">Explore All Pictures</a>
                    </div>
                    
                    <div style="background-color: #eee; padding: 10px 16px; margin-bottom: 20px;">
                        <p style="font-size: 18px; display: inline;">Picture Categories</p>
                    </div>
                    
                  

                    <div class="row text-center">
                        <?php
                        for ($i = 0; $i < $categories_size; $i++) {
                            $picture_select_query = "SELECT $categories[$i].id, pictures.name FROM $categories[$i] INNER JOIN pictures ON $categories[$i].picture_id = pictures.id";
                            $picture_selection_result = mysqli_query($con, $picture_select_query) or die(mysqli_error($con));

                            $picture_array = array();
                            while ($row_picture = mysqli_fetch_array($picture_selection_result)) {
                                array_push($picture_array, $row_picture["name"]);
                            }
                            $total_pictures = count($picture_array);
                            ?>
                        <div class="myImgContainer">
                                <div style="height: 100%; width: 100%; position: absolute; top: 0; padding: 10px;">
                                    
                                        <a class="myImg" href="pictures.php?id=<?php echo $categories[$i]; ?>&page=1">
                                            <div class="text-block"><?php echo $total_pictures; ?></div>
                                            <img style="height: 100%; width: 100%; object-fit: cover;" src="img/thumbnails/<?php echo $categories[$i]; ?>.jpg" alt="">
                                            <h4 class="text-block-caption"><?php echo $categories2[$i]; ?></h4>
                                        </a>
                                    
                                </div>
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
            <?php
            include 'includes/footer.php';
            include 'includes/navbar_script.php';
            ?>
            <script>
                document.getElementById("pictures").classList.add("active");
            </script>
    </body>
</html>
