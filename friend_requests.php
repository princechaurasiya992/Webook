<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

mysqli_set_charset($con, 'utf8');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Friend Requests</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <style>
        form.search-friend input[type=text] {
            padding: 10px;
            font-size: 17px;
            border: 1px solid #ec407a;
            border-radius: 5px 0px 0px 5px;
            outline: none;
            float: left;
            width: 80%;
            background: #f1f1f1;
        }

        /* Style the submit button */
        form.search-friend button {
            float: left;
            width: 20%;
            padding: 10px;
            background: #ec407a;
            color: white;
            font-size: 17px;
            border: 1px solid #ec407a;
            border-radius: 0px 5px 5px 0px;
            border-left: none; /* Prevent double borders */
            outline: none;
            cursor: pointer;
        }

        form.search-friend button:hover {
            outline: none;
            border-color: #000;
            background-color: #000;
            color: #fff;
        }

        /* Clear floats */
        form.search-friend::after {
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

    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a style="color: black;">Friend Requests</a></li>
    </ul>

    <div class="container">

        <form class="search-friend" action="">
            <input type="text" placeholder="Search for new friends.." name="search">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
        <br>

        <div style="height: 40px; width: 100%; font-size: 18px; margin-bottom: 20px;">
            <a id="receivedRequestButton" onclick="receivedRequestFunction()"
               style="height: 100%; width: 50%; text-align: center; float: left; padding: 6px; color: #fff; text-decoration: none; background-color: #ec407a;">
                <p style="">Received requests</p>
            </a>
            <a id="sentRequestButton" onclick="sentRequestFunction()"
               style="height: 100%; width: 50%; text-align: center; padding: 6px; background-color: #bbb; color: #fff; text-decoration: none; float: left;">
                <p style="">Sent requests</p>
            </a>
        </div>

        <div id="receivedRequestContainer" class="receivedRequestContainer">
            <ul class="list-styling" style="list-style-type: none; padding: 0;"></ul>
        </div>

        <div id="sentRequestContainer" class="sentRequestContainer" style="display: none;">
            <ul class="list-styling" style="list-style-type: none; padding: 0;"></ul>
        </div>

        <div id="searchFriendListContainer" class="searchFriendListContainer" style="display: none;">
            <ul class="list-styling" style="list-style-type: none; padding: 0;"></ul>
        </div>

    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/navbar_script.php';
?>
<script>
    document.getElementById("friend_requests").classList.add("active");
</script>

<script>
    function receivedRequestFunction() {
        document.getElementById("receivedRequestButton").style.background = "#ec407a";
        document.getElementById("sentRequestButton").style.background = "#bbb";
        document.getElementById("sentRequestContainer").style.display = "none";
        document.getElementById("receivedRequestContainer").style.display = "block";
        document.getElementById("searchFriendListContainer").style.display = "none";
    }

    function sentRequestFunction() {
        document.getElementById("receivedRequestButton").style.background = "#bbb";
        document.getElementById("sentRequestButton").style.background = "#ec407a";
        document.getElementById("sentRequestContainer").style.display = "block";
        document.getElementById("receivedRequestContainer").style.display = "none";
        document.getElementById("searchFriendListContainer").style.display = "none";
    }
</script>

<script src="js/friendSearchScript.js"></script>
<script src="js/friendRequestSendScript.js"></script>
<script src="js/friendRequestSentScript.js"></script>
<script src="js/friendRequestReceivedScript.js"></script>
<script src="js/friendRequestAcceptScript.js"></script>

</body>
</html>
