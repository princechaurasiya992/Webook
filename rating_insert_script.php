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
    echo "You need to login first!";
} else {
    $article_id = mysqli_real_escape_string($con, $_POST['article_id']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $user_id = $_SESSION["id"];

    $rating_select_query = "SELECT * FROM user_ratings WHERE article_id = '$article_id' AND user_id = '$user_id'";
    $rating_selection_result = mysqli_query($con, $rating_select_query) or die(mysqli_error($con));
    if (mysqli_num_rows($rating_selection_result) > 0) {
        $query = "DELETE FROM user_ratings WHERE article_id = '$article_id' AND user_id = '$user_id'";
        $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
    }
    $rating_insert_query = "insert into user_ratings(article_id, user_id, star) values ('$article_id', '$user_id', '$rating')";
    $rating_insertion_result = mysqli_query($con, $rating_insert_query) or die(mysqli_error($con));
    echo "Thanks for the rating! We appreciate you for giving us your valuable time!";
}

?>
