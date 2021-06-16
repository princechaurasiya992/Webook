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

$hindi_categories = array("टेक्नोलॉजी", "मेडिकल", "सिनेमा", "अंतरिक्ष", "गेमिंग", "स्वास्थ्य", "लाइफ हैक्स", "पॉलिटिक्स", "एजुकेशन", "फैशन");
$categories = array("technology", "medical", "cinema", "space", "gaming", "health",
    "life_hacks", "politics", "education", "fashion");

$english_categories = array("Technology", "Medical", "Cinema", "Space", "Gaming", "Health",
    "Life Hacks", "Politics", "Education", "Fashion");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload Articles</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            /* Style inputs, select elements and textareas */
            input[type=text], select, textarea{
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
            }

            /* Style the label to display next to the inputs */
            label {
                padding: 12px 12px 12px 25px;
                display: inline-block;
            }

            /* Style the submit button */
            input[type=submit] {
                background-color: #ec407a;
                color: white;
                padding: 12px 20px;
                border: 2px solid #ec407a;
                border-radius: 25px;
                cursor: pointer;
                float: right;
                margin-top: 6px;
            }
            input[type=submit]:hover {
                background-color: #fff;
                border-color: #ec407a;
                color: #ec407a;
            }

            /* Style the container */
            .container {
                background-color: #f2f2f2;
                padding: 25px;
            }

            /* Floating column for labels: 25% width */
            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
            }

            /* Floating column for inputs: 75% width */
            .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                .col-25, .col-75, input[type=submit] {
                    width: 100%;
                    margin-top: 0;
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
                    <li><a style="color: black;">Upload Articles</a></li>
                    </ul>
                    
       <div class="container">
                    
            <form method="POST" action="article_upload_script.php">
                <div class="row">
                    <div class="col-25">
                        <label for="title">Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="title" placeholder="Article Title...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="description" name="description" placeholder="Article Description...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="language">Language</label>
                    </div>
                    <div class="col-75">
                        <label onclick="hindiFunction()" class="radio-inline"><input type="radio" value="hindi" name="language" checked>Hindi</label>
                        <label onclick="englishFunction()" class="radio-inline"><input type="radio" value="english" name="language">English</label>
                    </div>
                </div>
                <div class="row" id="category_hindi" style="display: block;">
                    <div class="col-25">
                        <label for="category1">Category</label>
                    </div>
                    <div class="col-75">
                        <select id="category1" name="category1">
                            <?php
                            for ($i = 0; $i < count($hindi_categories); $i++) {
                                ?>
                                <option value="<?php echo $categories[$i]; ?>"><?php echo $hindi_categories[$i]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row" id="category_english">
                    <div class="col-25">
                        <label for="category2">Category</label>
                    </div>
                    <div class="col-75">
                        <select id="category2" name="category2">
                            <?php
                            for ($i = 0; $i < count($english_categories); $i++) {
                                ?>
                                <option value="<?php echo $categories[$i]; ?>"><?php echo $english_categories[$i]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Content</label>
                    </div>
                    <div class="col-75">
                        <textarea id="content" name="content" placeholder="Write your article..." style="height:200px"></textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div> 
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("upload").classList.add("active");
        </script>
        <script>
            var hindi = document.getElementById("category_hindi");
            var english = document.getElementById("category_english");
            var category1 = document.getElementById("category1");
            var category2 = document.getElementById("category2");

            hindi.style.display = "block";
            english.style.display = "none";
            category1.disabled = false;
            category2.disabled = true;

            function hindiFunction() {
                hindi.style.display = "block";
                english.style.display = "none";
                category1.disabled = false;
                category2.disabled = true;
            }
            function englishFunction() {
                hindi.style.display = "none";
                english.style.display = "block";
                category1.disabled = true;
                category2.disabled = false;
            }
        </script>
    </body>
</html>
