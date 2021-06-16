<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';


$categories = array("adventure", "travel", "beach", "holy_place", "festival", "zoo", "sport");
    
$categories_size = count($categories);
$user_id = $_SESSION['id'];

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

$picture_id = 0;

function GetImageExtension($imagetype) {
    if (empty($imagetype)) {
        return false;
    }
    switch ($imagetype) {
        case 'image/bmp': return '.bmp';
        case 'image/gif': return '.gif';
        case 'image/jpeg': return '.jpg';
        case 'image/png': return '.png';
        default: return false;
    }
}

if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name = $_FILES["uploadedimage"]["name"];
    $temp_name = $_FILES["uploadedimage"]["tmp_name"];
    $imgtype = $_FILES["uploadedimage"]["type"];
    $ext = GetImageExtension($imgtype);
    $imagename = date("d-m-Y") . "-" . time() . $ext;
    $target_path = "img/pictures/" . $imagename;
    if (move_uploaded_file($temp_name, $target_path)) {
        $picture_insert_query = "insert into pictures(name, user_id) values ('$imagename', '$user_id')";
        $picture_insertion_result = mysqli_query($con, $picture_insert_query) or die(mysqli_error($con));
        $picture_id = mysqli_insert_id($con);
    }
} else {
    echo "<script>alert('Select a picture, first!')</script>";
    echo ("<script>location.href='pic_upload.php'</script>");
}

for ($i = 0; $i < $categories_size; $i++)
{
    if (!empty($_POST[$categories[$i]])) {
        $query = "insert into $categories[$i](picture_id) values ('$picture_id')";
        $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
     }
}

echo "<script>alert('Picture uploaded successfully!')</script>";
echo ("<script>location.href='pic_upload.php'</script>");

?>
