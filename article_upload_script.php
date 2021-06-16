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
mysqli_set_charset($con, 'utf8');

$title = mysqli_real_escape_string($con, $_POST['title']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$content = mysqli_real_escape_string($con, $_POST['content']);
$language_id = mysqli_real_escape_string($con, $_POST['language']);
$category_id = "";
if (!empty($_POST['category1'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category1']);
} else {
    $category_id = mysqli_real_escape_string($con, $_POST['category2']);
}


if (!empty($title)) {
    if (!empty($description)) {
        if (!empty($content)) {
            $story_insert_query = "insert into articles(title, description, content, language, category) values ('$title','$description','$content','$language_id','$category_id')";
            $story_insertion_result = mysqli_query($con, $story_insert_query) or die(mysqli_error($con));
            echo "<script>alert('Your article has been uploaded successfully!')</script>";
            echo ("<script>location.href='article_upload.php'</script>");
        } else {
            echo "<script>alert('Error!!! Content section is empty!')</script>";
            echo ("<script>location.href='article_upload.php'</script>");
        }
    } else {
        echo "<script>alert('Error!!! Description section is empty!')</script>";
        echo ("<script>location.href='article_upload.php'</script>");
    }
} else {
    echo "<script>alert('Error!!! Title section is empty!')</script>";
    echo ("<script>location.href='article_upload.php'</script>");
}
?>