<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';


$categories = array("adventure", "travel", "beach", "holy_place", "festival", "zoo", "sport");
    
$categories_size = count($categories);

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
$picture_id = $_GET["id"];

for ($i = 0; $i < $categories_size; $i++)
{
    if (!empty($_POST[$categories[$i]])) {
        $picture_select_query = "SELECT id FROM $categories[$i] WHERE picture_id = $picture_id";
        $picture_selection_result = mysqli_query($con, $picture_select_query) or die(mysqli_error($con));
        if (empty(mysqli_fetch_array($picture_selection_result))) {
            $query = "insert into $categories[$i](picture_id) values ('$picture_id')";
            $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
     } else {
         $picture_select_query = "SELECT id FROM $categories[$i] WHERE picture_id = $picture_id";
        $picture_selection_result = mysqli_query($con, $picture_select_query) or die(mysqli_error($con));
        if (!empty(mysqli_fetch_array($picture_selection_result))) {
            $query = "DELETE FROM $categories[$i] WHERE picture_id = $picture_id";
            $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
     }
}

echo "Categories Updated, Successfully!";
}

?>
