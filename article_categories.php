<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$language_id = $_GET['id'];

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

$english_article_array = array();
$english_article_select_query = "SELECT id, category FROM articles WHERE language = 'english'";
$english_article_selection_result = mysqli_query($con, $english_article_select_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($english_article_selection_result)) {
    array_push($english_article_array, $row["category"]);
}

$hindi_article_array = array();
$hindi_article_select_query = "SELECT id, category FROM articles WHERE language = 'hindi'";
$hindi_article_selection_result = mysqli_query($con, $hindi_article_select_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($hindi_article_selection_result)) {
    array_push($hindi_article_array, $row["category"]);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Articles</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        <div class="content" id="content">
        	
        	<ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a style="color: black;">Articles</a></li>
                    </ul>

            <div class="container">
                <div class="jumbotron text-center">
                    <h1 style="color: #ec407a; text-transform: capitalize;">Articles</h1>
                    <p>We have total <?php echo count($english_article_array) + count($hindi_article_array); ?> articles for you.</p>                
                </div>
                
                <div style="background-color: #eee; padding: 10px 16px; margin-bottom: 20px;">
                        <p style="font-size: 18px; display: inline;">Article Categories</p>
                </div>
                
                <div style="height: 40px; width: 100%; font-size: 18px; margin-bottom: 20px;">
                    <a id="englishCategoriesButton" onclick="englishCategoriesFunction()" style="height: 100%; width: 50%; text-align: center; float: left; padding: 6px; color: #fff; text-decoration: none; background-color: #ec407a;">
                        <p style="">English</p>
                    </a>
                    <a id="hindiCategoriesButton" onclick="hindiCategoriesFunction()" style="height: 100%; width: 50%; text-align: center; padding: 6px; background-color: #bbb; color: #fff; text-decoration: none; float: left;">
                        <p style="">Hindi</p>
                    </a>
                </div>
                    
                <div>
                    <ul id="englishCategoriesContainer" class="list-styling" style="list-style-type: none; padding: 0;">
                        <?php
                        for ($i = 0; $i < count($categories); $i++) {
                            ?>
                            <li style="padding: 5px;">
                                <a style="border: 1px solid #000; border-radius: 10px; height: 35px; font-size: 15px; background-color: #eee;" href="articles.php?categ=<?php echo $categories[$i]; ?>&lang=english">
                                    <p style="float: left;"><?php echo $english_categories[$i]; ?></p>

                                    <?php
                                    $count = 0;
                                    for ($j = 0; $j < count($english_article_array); $j++) {
                                        if ($english_article_array[$j] == $categories[$i]) {
                                            $count++;
                                        }
                                    }
                                    ?>
                                    <p style="float: right;"><?php echo $count; ?></p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                
                <div>
                    <ul id="hindiCategoriesContainer" class="list-styling" style="list-style-type: none; padding: 0; display: none;">
                        <?php
                        for ($i = 0; $i < count($categories); $i++) {
                            ?>
                            <li style="padding: 5px;">
                                <a style="border: 1px solid #000; border-radius: 10px; height: 35px; font-size: 15px; background-color: #eee; font-family: NotoSans-Regular;" href="articles.php?categ=<?php echo $categories[$i]; ?>&lang=hindi">
                                    <p style="float: left;"><?php echo $hindi_categories[$i]; ?></p>

                                    <?php
                                    $count = 0;
                                    for ($j = 0; $j < count($hindi_article_array); $j++) {
                                        if ($hindi_article_array[$j] == $categories[$i]) {
                                            $count++;
                                        }
                                    }
                                    ?>
                                    <p style="float: right;"><?php echo $count; ?></p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("articles").classList.add("active");
        </script>
        
        <script>
            function englishCategoriesFunction() {
                document.getElementById("englishCategoriesButton").style.background = "#ec407a";
                document.getElementById("hindiCategoriesButton").style.background = "#bbb";
                document.getElementById("hindiCategoriesContainer").style.display = "none";
                document.getElementById("englishCategoriesContainer").style.display = "block";
            }
            function hindiCategoriesFunction() {
                document.getElementById("englishCategoriesButton").style.background = "#bbb";
                document.getElementById("hindiCategoriesButton").style.background = "#ec407a";
                document.getElementById("hindiCategoriesContainer").style.display = "block";
                document.getElementById("englishCategoriesContainer").style.display = "none";
            }
        </script>

    </body>
</html>
