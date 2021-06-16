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
$picture_id = mysqli_real_escape_string($con, $_POST['p_id']);
$user_id = $_SESSION["id"];

$heart_select_query = "SELECT * FROM likes WHERE picture_id = '$picture_id' AND user_id = '$user_id'";
$heart_selection_result = mysqli_query($con, $heart_select_query) or die(mysqli_error($con));
if (mysqli_num_rows($heart_selection_result) > 0) {
    $query = "DELETE FROM likes WHERE picture_id = $picture_id AND user_id = $user_id";
    $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    $likes_select_query = "SELECT * FROM likes WHERE picture_id = '$picture_id'";
    $likes_selection_result = mysqli_query($con, $likes_select_query) or die(mysqli_error($con));
    
    echo mysqli_num_rows($likes_selection_result);
} else {
    $heart_insert_query = "insert into likes(picture_id, user_id) values ('$picture_id', '$user_id' '')";
    $heart_insertion_result = mysqli_query($con, $heart_insert_query) or die(mysqli_error($con));
    
    $likes_select_query = "SELECT * FROM likes WHERE picture_id = '$picture_id'";
    $likes_selection_result = mysqli_query($con, $likes_select_query) or die(mysqli_error($con));
                             
    echo mysqli_num_rows($likes_selection_result);
}
}

?>
