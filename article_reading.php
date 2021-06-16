<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

mysqli_set_charset($con, 'utf8');

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION["id"];
}

$article_id = $_GET['article_id'];

$article_select_query = "SELECT title, description, content, date, language, category FROM articles WHERE id = $article_id";
$article_selection_result = mysqli_query($con, $article_select_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($article_selection_result)) {
    $heading = $row["title"];
    $description = $row["description"];
    $content = $row["content"];
    $date = $row["date"];
    $language = $row["language"];
    $category = $row["category"];
}

$hindi_categories = array("टेक्नोलॉजी", "मेडिकल", "सिनेमा", "अंतरिक्ष", "गेमिंग", "स्वास्थ्य", "लाइफ हैक्स", "पॉलिटिक्स", "एजुकेशन", "फैशन");
$categories = array("technology", "medical", "cinema", "space", "gaming", "health",
    "life_hacks", "politics", "education", "fashion");

$english_categories = array("Technology", "Medical", "Cinema", "Space", "Gaming", "Health",
    "Life Hacks", "Politics", "Education", "Fashion");

$language_categories = array();
if ($language == "hindi") {
    $language_categories = $hindi_categories;
} else {
    $language_categories = $english_categories;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $heading; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <style>
        .article-bar {
            height: 50px;
            width: 100%;
            z-index: 150;
            cursor: pointer;
        }

        .article-bar a {
            float: left;
            display: block;
            text-align: center;
            padding: 17px;
            color: #fff;
            background-color: #ec407a;
            font-size: 15px;
            height: 100%;
            width: 16.66%;
        }

        .article-bar a:hover {
            background-color: #000;
        }
    </style>
    <style>
        * {
            box-sizing: border-box;
        }

        .user-rating-container {
            background-color: #fefefe;
            position: relative;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .heading {
            font-size: 25px;
            margin-right: 25px;
        }

        .fa {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
            height: 30px;
        }

        .middle {
            float: left;
            width: 70%;
            margin-top: 10px;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        .star-normal-size {
            font-size: 20px;
        }

        .star-big-size {
            font-size: 40px;
            width: 19%;
        }

        /* Clear floats after the columns */
        .custom_row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        /* Individual bars */
        .bar-5 {
            width: 60%;
            height: 18px;
            background-color: #4CAF50;
        }

        .bar-4 {
            width: 30%;
            height: 18px;
            background-color: #2196F3;
        }

        .bar-3 {
            width: 10%;
            height: 18px;
            background-color: #00bcd4;
        }

        .bar-2 {
            width: 4%;
            height: 18px;
            background-color: #ff9800;
        }

        .bar-1 {
            width: 15%;
            height: 18px;
            background-color: #f44336;
        }

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {
            .side, .middle {
                width: 100%;
            }

            /* Hide the right column on small screens */
            .right {
                display: none;
            }
        }
    </style>
    <style>

        .comment_section-container {
            background-color: #fefefe;
            position: relative;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        /* Chat containers */
        .comments-container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        /* Clear floats */
        .comments-container::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .comments-container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .comments-container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        /* Style time text */
        .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: left;
            color: #999;
        }

        .picture-option-btn-block, .comment-option-btn {
            position: absolute;
            top: 0px;
            right: 0px;
            background-color: rgba(255, 255, 255, 0.6);
            color: #ec407a;
            padding: 5px;
            width: 30px;
            height: 30px;
        }

        .comment-option-btn {
            background-color: transparent;
        }

        .picture-option-btn-block:hover, .comment-option-btn:hover {
            background-color: #ec407a;
            color: #ffffff;
        }

        .picture-option-block, .comment-option-block {
            position: absolute;
            display: none;
            top: 0px;
            right: 30px;
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
            color: #ec407a;
            padding: 0px;
            width: 100px;
            height: fit-content;
        }

        .picture-option-block a, .comment-option-block a {
            text-decoration: none;
            padding: 5px;
            text-align: center;
            color: #ec407a;
            display: block;
        }

        .picture-option-block a:hover, .comment-option-block a:hover {
            background-color: #ec407a;
            color: #ffffff;
        }
    </style>
    <style>
        .commentBoxContent {
            background-color: #fff;
            color: #000;
            z-index: 151;
            text-align: center;
            position: fixed;
            margin: 0;
            padding: 0px;
            width: 90%;
            height: 90%;
            bottom: calc(-90%);
            transition: bottom 0.5s;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 25px;
            overflow: hidden;
        }
    </style>

    <style>
        .inputFieldContainer {
            padding: 5px;
            height: 50px;
            width: 100%;
            background-color: #ec407a;
            position: relative;
            top: 0px;
        }

        form.type-message {
            width: 100%;
        }

        form.type-message input[type=text] {
            padding: 10px;
            font-size: 17px;
            border: 1px solid #ec407a;
            border-radius: 20px;
            outline: none;
            float: left;
            width: 80%;
            height: 40px;
            background: #f1f1f1;
        }

        /* Style the submit button */
        form.type-message button {
            float: left;
            width: 20%;
            height: 40px;
            padding: 10px;
            background: #ec407a;
            color: white;
            font-size: 17px;
            border: 1px solid #ec407a;
            border-radius: 20px;
            border-left: none; /* Prevent double borders */
            outline: none;
            cursor: pointer;
        }

        form.type-message button:hover {
            outline: none;
            border-color: #000;
            background-color: #000;
            color: #fff;
        }

        /* Clear floats */
        form.type-message::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
<?php
include 'includes/header.php';
?>

<div class="content" id="content">

    <ul class="breadcrumb" style="<?php if ($language == "hindi") {
        echo "font-family: NotoSans-Regular;";
    } ?>">
        <li><a href="index.php">Home</a></li>
        <li>
            <a href="article_categories.php?id=<?php echo $language; ?>"><?php echo ucfirst($language) . " Articles"; ?></a>
        </li>
        <li>
            <a href="articles.php?categ=<?php echo $category; ?>&lang=<?php echo $language; ?>"><?php echo $language_categories[array_search($category, $categories)]; ?></a>
        </li>
        <li><a style="color: black;"><?php echo $heading; ?></a></li>
    </ul>

    <div class="container">
        <div class="jumbotron text-center">
            <h1 style="color: #ec407a; <?php if ($language == "hindi") {
                echo "font-family: NotoSans-Regular;";
            } ?>"><?php echo $heading; ?></h1>
            <p><span class="bi bi-calendar-week"></span> Date: <?php echo $date; ?></p>
        </div>


        <div class="article-bar">
            <a onclick="zoom_inFunction()" title="Zoom in"><span class="bi bi-zoom-in"></span></a>
            <a onclick="zoom_outFunction()" title="Zoom out"><span class="bi bi-zoom-out"></span></a>
            <a onclick="fontFunction('<?php echo $language; ?>')" title="Font"><span class="bi bi-fonts"></span></a>
            <a onclick="italicFunction()" title="Italic"><span class="bi bi-type-italic"></span></a>
            <a onclick="boldFunction()" title="Bold"><span class="bi bi-type-bold"></span></a>
            <a onclick="refreshFunction('<?php echo $language; ?>')" title="Refresh"><span class="bi bi-arrow-clockwise"></span></a>
        </div>

        <div id="article_field"
             style=" padding: 20px 20px; margin-bottom: 20px; color: #000; font-size: 20px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); text-align: justify; <?php if ($language == "hindi") {
                 echo "font-family: NotoSans-Regular;";
             } ?>">
            <p><?php echo $description; ?></p>
            <br>
            <p><?php echo $content; ?></p>
        </div>

        <div class="user-rating-container" id="user_rating_container">
        </div>

        <?php
        $comments_select_query = "SELECT * FROM article_comments WHERE article_id = '$article_id'";
        $comments_selection_result = mysqli_query($con, $comments_select_query) or die(mysqli_error($con));
        ?>

        <div class="comment_section-container">
            <p>How much did you like this story? Tell us in the comment section.</p>
            <span class="heading">Comments</span>
            <p>Total <?php echo mysqli_num_rows($comments_selection_result); ?> comments.</p>
            <hr style="border:3px solid #f1f1f1">

            <div class="inputFieldContainer">
                <form id="commentForm" class="type-message" action="">
                    <input type="text" placeholder="Type here..." name="text">
                    <button type="submit" id="commentInsertBtn" onclick="insertCommentFunction(<?php echo $article_id; ?>, 'article', <?php echo isset($_SESSION['email']); ?>)"><i class="bi bi-telegram"></i></button>
                </form>
            </div>

            <hr style="border:3px solid #f1f1f1">

            <div style="overflow: scroll; width: 100%; height: 100%; padding-bottom: 100px;">
                <div id="commentBoxMessage">Some text in the Modal..</div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/navbar_script.php';
?>

<script src="js/barArticleScript.js"></script>
<script src="js/ratingRefreshScript.js"></script>
<script src="js/ratingInsertScript.js"></script>
<script src="js/commentInsertScript.js"></script>
<script src="js/commentDeleteScript.js"></script>
<script src="js/commentBoxRefreshScript.js"></script>
<script src="js/optionBtnScript.js"></script>

<script>
    refreshRatingContainerFunction(<?php echo $article_id; ?>);
</script>
<script>
    commentBoxRefreshFunction(<?php echo $article_id; ?>, 'article', <?php echo isset($_SESSION['email']); ?>);
</script>

</body>
</html>
