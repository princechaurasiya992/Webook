<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$message = mysqli_real_escape_string($con, $_POST['message']);
$sender_id = $_SESSION['id'];
$receiver_id = mysqli_real_escape_string($con, $_GET['receiver_id']);

$chat_insert_query = "INSERT into chats(sender_id, receiver_id, message) values ('$sender_id', '$receiver_id', '$message')";
$chat_insertion_result = mysqli_query($con, $chat_insert_query) or die(mysqli_error($con));
?>
