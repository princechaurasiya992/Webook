<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$category_id = $_GET['id'];
$current_page = $_GET['page'];
$page = $_POST['jump_to_page'];

if (strlen($page) != 0) {
    $location = "pictures.php?id=" . $category_id . "&page=" . $page;
    echo ("<script>location.href='$location'</script>");
} else {
    $location = "pictures.php?id=" . $category_id . "&page=" . $current_page;
    echo ("<script>location.href='$location'</script>");
}
