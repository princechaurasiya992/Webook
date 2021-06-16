<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$receiver_id = $_SESSION["id"];
$sender_id = mysqli_real_escape_string($con, $_POST['sender_id']);
$request_type = mysqli_real_escape_string($con, $_POST['request_type']);
$output = "";

$friend_request_query = "SELECT id FROM friend_requests WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
$friend_request_query_result = mysqli_query($con, $friend_request_query) or die(mysqli_error($con));

if (mysqli_num_rows($friend_request_query_result) > 0) {
    if ($request_type == 0) {
    $query = "DELETE FROM friend_requests WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
    $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
    
        $output .= '<a style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;" href="">
                                    <div style="padding: 10px;">
                                        <p style="text-align: center;">Friend Request Rejected!</p>
                                    </div>
                           </a>';
    } else if ($request_type == 1) {
        $friend_request_insert_query = "INSERT into friends(user_id, friend_id) values ('$receiver_id', '$sender_id')";
        $friend_request_insertion_result = mysqli_query($con, $friend_request_insert_query) or die(mysqli_error($con));
        
        $query = "DELETE FROM friend_requests WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
        $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
    
        $output .= '<a style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;" href="">
                                    <div style="padding: 10px;">
                                        <p style="text-align: center;">Friend Request Accepted!</p>
                                    </div>
                           </a>';
    }
        
} else {
    $output = "some error";
}
echo $output;
?>
