<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['id'];
    $content_id = mysqli_real_escape_string($con, $_POST['p_id']);
    $comment_id = mysqli_real_escape_string($con, $_POST['c_id']);
    $content_type = mysqli_real_escape_string($con, $_POST['content_type']);
    if ($content_type == 'article') {
        $table_name = "article_comments";
        $content_column_id_name = "article_id";
    } elseif ($content_type == 'picture') {
        $table_name = "picture_comments";
        $content_column_id_name = "picture_id";
    }

    $query = "SELECT * FROM $table_name WHERE (id = '$comment_id') & ($content_column_id_name = '$content_id') & (user_id = '$user_id')";
    $data = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_num_rows($data) > 0) {
        $comment_delete_query = "DELETE FROM $table_name WHERE (id = '$comment_id') & ($content_column_id_name = '$content_id') & (user_id = '$user_id')";
        $comment_deletion_result = mysqli_query($con, $comment_delete_query) or die(mysqli_error($con));
        echo "The comment has been deleted successfully!";
    } else {
        echo "The given comment id is incorrect!";
    }
}
?>
