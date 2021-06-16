<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

mysqli_set_charset($con, 'utf8');
$friend_id = $_GET['friend_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Box</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <style>

        .inputFieldContainer {
            padding: 5px;
            height: 50px;
            width: 100%;
            background-color: #ec407a;
            position: fixed;
            bottom: 0px;
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

?>
<div class="content" id="content">

    <div class="my-navbar" id="myNavbar" style="position: fixed; top: 0px;">
        <div class="my-navbar-header">
            <button class="hamburger-button" type="button" title="Side Bar"><i class="bi bi-three-dots-vertical"></i>
            </button>
            <a class="my-navbar-brand" id="back" href="chat_heads.php"><i class="bi bi-arrow-left"></i></a>
            <a style="height: 50px; width: calc(100% - 100px); padding: 0px;"
               href="friends_profile.php?id=<?php echo $friend_id; ?>">

                <?php
                $friend_select_query = "SELECT name, photo FROM users WHERE id = '$friend_id'";
                $friend_selection_result = mysqli_query($con, $friend_select_query) or die(mysqli_error($con));
                while ($row2 = mysqli_fetch_array($friend_selection_result)) {
                    ?>
                    <div style="width: 40px; padding: 5px; height: 40px; float: left;">
                        <div style="width: 40px; height: 40px; padding: 0; border-radius: 50%; overflow: hidden;"><img
                                    src="img/profile/<?php echo $row2["photo"]; ?>" alt=""
                                    style="height: 100%; width: 100%; object-fit: cover;"></div>
                    </div>
                    <div style="float: left; padding: 10px 20px; width: calc(100% - 40px); line-height: 10px;">
                        <p style="padding: 0; color: #fff; float: left; text-align: left; width: 100%;"><?php echo $row2["name"]; ?></p>
                        <p style="float: left; color: #000; text-align: left; width: 100%; padding: 0;"><?php echo "online"; ?></p>
                    </div>
                    <?php
                }
                ?>

            </a>
        </div>
    </div>
    <div class="inputFieldContainer">
        <form id="messageForm" class="type-message" action="">
            <input type="text" placeholder="Type here..." name="message">
            <button type="submit"><i class="bi bi-telegram"></i></button>
        </form>
    </div>

    <div class="container" style="padding: 60px 20px 60px 20px;">
        <ul class="message-list updateChats" style="list-style-type: none; padding: 0;"></ul>
    </div>

</div>
<script>
    window.addEventListener("load", function () {
        function sendData() {
            const XHR = new XMLHttpRequest();
            const FD = new FormData(form);
            XHR.addEventListener("load", function (event) {
                document.getElementById("messageForm").reset();
            });
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
            });
            XHR.open("POST", "chat_box_insert_script.php?receiver_id=<?php echo $friend_id; ?>");
            XHR.send(FD);
        }

        const form = document.getElementById("messageForm");
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData();
        });
    });
</script>

<script>
    var scroll_bottom = 1;

    messageList = document.querySelector(".container .message-list");


    setInterval(
        function () {
            if (messageList.classList.contains("updateChats")) {
                var xhttp3 = new XMLHttpRequest();
                xhttp3.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        messageList.innerHTML = this.responseText;
                        if (scroll_bottom == 1) {
                            bottomFunction();
                        }
                    }
                };
                xhttp3.open("POST", "chat_box_refresh_script.php?receiver_id=<?php echo $friend_id; ?>", true);
                xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp3.send();
            }
        }, 500);


    function bottomFunction() {
        document.body.scrollTop = document.body.scrollHeight;
        document.documentElement.scrollTop = document.documentElement.scrollHeight;
    }

    window.onscroll = function () {

        if (window.scrollY < (document.body.scrollHeight - window.innerHeight) || window.scrollY < (document.body.scrollHeight - window.innerHeight)) {
            scroll_bottom = 0;
            messageList.classList.remove("updateChats");
        } else {
            scroll_bottom = 1;
            messageList.classList.add("updateChats");
        }
    };
</script>

</body>
</html>
