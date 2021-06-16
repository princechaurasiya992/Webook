<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$receiver_id = mysqli_real_escape_string($con, $_POST['receiver_id']);
$sender_id = $_SESSION["id"];
$output = "";

$friend_request_query = "SELECT id FROM friend_requests WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
$friend_request_query_result = mysqli_query($con, $friend_request_query) or die(mysqli_error($con));

if (mysqli_num_rows($friend_request_query_result) > 0) {
    $query = "DELETE FROM friend_requests WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id'";
    $query_result = mysqli_query($con, $query) or die(mysqli_error($con));
    
        $output .= '<div style="width: 100%; padding: 0px; height: 100%; position: relative;">
                                 <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-check2"></span></div>
                           </div>';
    
} else {
    $friend_request_insert_query = "INSERT into friend_requests(sender_id, receiver_id) values ('$sender_id', '$receiver_id')";
    $friend_request_insertion_result = mysqli_query($con, $friend_request_insert_query) or die(mysqli_error($con));
    
    $output .= '<div style="width: 100%; padding: 0px; height: 100%; position: relative;">
                            <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-check2"></span></div>
                       </div>';
}
echo $output;
?>
