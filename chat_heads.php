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
        <title>Chat Heads</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            #newChat {
    position: fixed;
    width: 40px;
    height: 40px;
    bottom: 80px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: #ec407a;
    color: white;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

#newChat:hover {
    border: 2px solid #ec407a;
    background-color: #fff;
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
                    <li><a href="index.php">Home</a></li>
                    <li><a style="color: black;">Chats Heads</a></li>
                    </ul>

            <div class="container">
                    <a href="my_friends.php" id="newChat" title="New Chat"><span class="bi bi-plus"></span></a>
                <div>
                    <ul class="list-styling" style="list-style-type: none; padding: 0;"></ul>
                </div>
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("chats").classList.add("active");
        </script>
        
        <script>
               chatHeadList = document.querySelector(".container .list-styling");
               
               setInterval(
                       function(){
                             var xhttp3 = new XMLHttpRequest();
                             xhttp3.onreadystatechange = function() {
                              if (this.readyState == 4 && this.status == 200) {
                                   chatHeadList.innerHTML = this.responseText;
                              }
                              };
                              xhttp3.open("POST", "chat_heads_script.php", true);
                              xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                              xhttp3.send();
                       }, 500);
        </script>

    </body>
</html>
