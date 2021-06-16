<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$language_id = $_GET['lang'];
$category_id = $_GET['categ'];

$hindi_categories = array("टेक्नोलॉजी", "मेडिकल", "सिनेमा", "अंतरिक्ष", "गेमिंग", "स्वास्थ्य", "लाइफ हैक्स", "पॉलिटिक्स", "एजुकेशन", "फैशन");
$categories = array("technology", "medical", "cinema", "space", "gaming", "health",
    "life_hacks", "politics", "education", "fashion");

$english_categories = array("Technology", "Medical", "Cinema", "Space", "Gaming", "Health",
    "Life Hacks", "Politics", "Education", "Fashion");

$language_categories = array();
if ($language_id == "hindi") {
    $language_categories = $hindi_categories;
} else {
    $language_categories = $english_categories;
}

mysqli_set_charset($con, 'utf8');

$story_select_query = "SELECT id, title, description, date FROM articles WHERE language = '$language_id' AND category = '$category_id'";
$story_selection_result = mysqli_query($con, $story_select_query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $language_categories[array_search($category_id, $categories)]; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            .stories_row{
            	overflow: hidden;
                border-radius: 10px;
                border: 1px solid #000;
                padding: 0px 20px;
                background-color: #eee;
                color: #ec407a;
            }
            .stories_row:hover{
                background-color: #ec407a;
                color: #fff;
                border-color: #ec407a;
            }
            .stories_row p{
                color: #000;
                display: block;
                width: 100%;
                float: left;
            }
            .stories_row:hover p{
                color: #fff;
            }
            .stories_row h4{
                float: left;
            }
            .stories_row h5{
                float: left;
            }
            @media only screen and (min-width: 600px) {
            	.stories_row h5 {
                 	float: right;
                 }
        </style>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>

        <div class="leftnav" id="leftnav" style="left: -200px; <?php if ($language_id == "hindi") { echo "font-family: NotoSans-Regular;"; } ?>">
            <div class="left-navigation-bar" id="left-navigation-bar">
                <ul class="inner-left-navigation-bar">
                    <li><h3 style="padding-left: 15px;">Categories</h3></li>
                    <?php
                    for ($i = 0; $i < count($categories); $i++) {
                        ?>
                        <li><a <?php if ($i == array_search($category_id, $categories)) { ?> class="active"<?php } ?> href="stories.php?categ=<?php echo $categories[$i]; ?>&lang=<?php echo $language_id; ?>"><?php echo $language_categories[$i]; ?></a></li>
                        <?php
                    }
                    ?>
                    <li style="padding-bottom: 25px;"></li>
                </ul>
            </div>
        </div>
        
        <button onclick="categoriesFunction()" id="categoriesBtn" title="Categories"><span id="categoriesButtonChevron"; class="bi bi-chevron-right"></span></button>

        <div class="content" id="content">
        	
         <ul class="breadcrumb" style="<?php if ($language_id == "hindi") { echo "font-family: NotoSans-Regular;"; } ?>">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="article_categories.php?id=<?php echo $language_id; ?>"><?php echo ucfirst($language_id) . " Articles"; ?></a></li>
                    <li><a style="color: black;"><?php echo $language_categories[array_search($category_id, $categories)]; ?></a></li>
                    </ul>

            <div class="container">
                <div class="jumbotron text-center">
                    <h1 style="color: #ec407a; <?php if ($language_id == "hindi") { echo "font-family: NotoSans-Regular;"; } ?>"><?php echo $language_categories[array_search($category_id, $categories)]; ?></h1>           
                </div>
                
               
                    
                <?php
                while ($row = mysqli_fetch_array($story_selection_result)) {
                    ?>
                <a href="article_reading.php?article_id=<?php echo $row["id"]; ?>" style="text-decoration: none; <?php if ($language_id == "hindi") { echo "font-family: NotoSans-Regular;"; } ?>">
                        <div class="stories_row">
                            <div>
                                <h4><?php echo $row["title"]; ?></h4>
                                <h5><span class="bi bi-calendar-week"></span> Date: <?php echo $row["date"]; ?></h5>
                                <p><?php echo $row["description"]; ?></p>
                            </div>
                            
                        </div>
                    </a>
                    <br>
                    <br>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        	
        <script>
        	var categoriesbutton = document.getElementById("categoriesBtn");
            var categoriesbuttonchevron = document.getElementById("categoriesButtonChevron");
            var leftnavbar = document.getElementById("leftnav");

            function categoriesFunction() {
                if (leftnavbar.style.left == "-200px") {
                    leftnavbar.style.left = "0%";
                    categoriesbuttonchevron.classList.toggle("bi-chevron-right");
                    categoriesbuttonchevron.classList.toggle("bi-chevron-left");
                } else {
                    leftnavbar.style.left = "-200px";
                    categoriesbuttonchevron.classList.toggle("bi-chevron-left");
                    categoriesbuttonchevron.classList.toggle("bi-chevron-right");
                }
            
            }
            </script>
            
        <script>
            if (window.addEventListener) {
                window.addEventListener("scroll", function () {
                    fix_sidemenu();
                });
                window.addEventListener("resize", function () {
                    fix_sidemenu();
                });
                window.addEventListener("touchmove", function () {
                    fix_sidemenu();
                });
                window.addEventListener("load", function () {
                    fix_sidemenu();
                });
            } else if (window.attachEvent) {
                window.attachEvent("onscroll", function () {
                    fix_sidemenu();
                });
                window.attachEvent("onresize", function () {
                    fix_sidemenu();
                });
                window.attachEvent("ontouchmove", function () {
                    fix_sidemenu();
                });
                window.attachEvent("onload", function () {
                    fix_sidemenu();
                });
            }
            function fix_sidemenu() {
                var top = window.pageYOffset;

                if (top == 0) {
                    document.getElementById("leftnav").style.top = "130px";
                }
                if (top > 0 && top < sticky) {
                    document.getElementById("leftnav").style.top = (130 - top) + "px";
                }
                if (top > sticky) {
                    document.getElementById("leftnav").style.top = "50px";
                }

                if (top > sticky) {
                    document.getElementById("left-navigation-bar").style.paddingTop = "50px";
                } else {
                    document.getElementById("left-navigation-bar").style.paddingTop = (130 - top) + "px";
                }
            }
        </script>
        <script>
            document.getElementById("articles").classList.add("active");
        </script>

    </body>
</html>
