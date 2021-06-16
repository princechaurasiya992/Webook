<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (isset($_SESSION['email'])) {
    if (!empty($_POST['text'])) {
        $text = mysqli_real_escape_string($con, $_POST['text']);
        $user_id = $_SESSION['id'];
        $content_id = mysqli_real_escape_string($con, $_GET['p_id']);
        $content_type = mysqli_real_escape_string($con, $_GET['content_type']);
        if ($content_type == 'article') {
            $table_name = "article_comments";
            $content_column_id_name = "article_id";
        } elseif ($content_type == 'picture') {
            $table_name = "picture_comments";
            $content_column_id_name = "picture_id";
        }

        $comment_insert_query = "INSERT into $table_name ($content_column_id_name, user_id, text) values ('$content_id', '$user_id', '$text')";
        $comment_insertion_result = mysqli_query($con, $comment_insert_query) or die(mysqli_error($con));
        echo "The comment has been added successfully!";
    } else {
        echo "Comment field is empty! Please, write some text in the field!";
    }
}
?>
