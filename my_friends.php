<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

mysqli_set_charset($con, 'utf8');
$user_id = $_SESSION['id'];

$friends_id_array = array();
$friends_select_query = "SELECT user_id, friend_id FROM friends WHERE user_id = '$user_id' OR friend_id = '$user_id'";
$friends_selection_result = mysqli_query($con, $friends_select_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($friends_selection_result)) {
    if ($row["user_id"] == $user_id) {
        array_push($friends_id_array, $row["friend_id"]);
    } else if ($row["friend_id"] == $user_id) {
        array_push($friends_id_array, $row["user_id"]);
    }
}
$total_friends = count($friends_id_array);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Friends</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>

        </style>
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
                    <li><a style="color: black;">My Friends</a></li>
                    </ul>

            <div class="container">
                
                <form class="search-friend" action="">
                     <input type="text" placeholder="Search.." name="search">
                     <button type="submit"><i class="bi bi-search"></i></button>
                </form>
                <br>

                <div>
                    <ul class="list-styling" style="list-style-type: none; padding: 0;">
                        <?php
                         
                        for ($i = 0; $i < $total_friends; $i++) {
                            
$friends_select_query = "SELECT name, photo FROM users WHERE id = '$friends_id_array[$i]'";
$friends_selection_result = mysqli_query($con, $friends_select_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($friends_selection_result)) {
    
                            ?>
                            <li style="padding: 5px;">
                                <div style="height: 60px; font-size: 15px; padding: 0px; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <a style="display: inline-block; height: 100%; width: 80%; font-size: 15px; padding: 0px;" href="friends_profile.php?id=<?php echo $friends_id_array[$i]; ?>">
                                    <div style="width: 60px; padding: 5px; height: 60px; float: left; position: relative;">
                                        <div style="width: 50px; height: 50px; padding: 0; border: 1px solid #000; border-radius: 50%; overflow: hidden;"><img src="img/profile/<?php echo $row["photo"]; ?>" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                    </div>
                                    <div style="padding: 10px;">
                                        <p style="margin: 0; padding: 0; float: left;"><?php echo $row['name']; ?></p>
                                        <p style="margin: 0; padding: 0; float: right;">online</p>
                                        <br>
                                        <p style="float: left; color: #bbb; margin: 0; padding: 0;">Azamgarh</p>
                                    </div>
                                </a>
                                <a style="float: right; display: inline-block; width: 20%; padding: 5px; height: 100%; position: relative;" href="chat_box.php?friend_id=<?php echo $friends_id_array[$i]; ?>">
                                        <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-chat-square-text"></span></div>
                                </a>
                                </div>
                            </li>
                            <?php
}
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
            document.getElementById("my_friends").classList.add("active");
        </script>

    </body>
</html>
