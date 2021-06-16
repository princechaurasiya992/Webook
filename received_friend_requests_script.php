<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$user_id = $_SESSION['id'];
$output = "";
$accept = 1;
$reject = 0;

$friend_request_query = "SELECT friend_requests.sender_id, users.name, users.photo, friend_requests.date FROM friend_requests INNER JOIN users ON friend_requests.sender_id = users.id WHERE friend_requests.receiver_id = $user_id";
$friend_request_query_result = mysqli_query($con, $friend_request_query) or die(mysqli_error($con));

if (mysqli_num_rows($friend_request_query_result) > 0) {
    while ($row = mysqli_fetch_array($friend_request_query_result)) {
        $output .= '<li style="padding: 5px;">
                                <div id="acceptFriendRequestBtn'. $row['sender_id'] .'" style="height: 60px; font-size: 15px; padding: 0px; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <a style="display: inline-block; height: 100%; width: 60%; font-size: 15px; padding: 0px;" href="friends_profile.php?id='. $row['sender_id'] .'">
                                    <div style="width: 60px; padding: 5px; height: 60px; float: left; position: relative;">
                                        <div style="width: 50px; height: 50px; padding: 0; border-radius: 50%; overflow: hidden;"><img src="img/profile/'. $row['photo'] .'" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                    </div>
                                    <div style="padding: 10px;">
                                        <p style="margin: 0; padding: 0; float: left;">'. substr($row['name'], 0, 13) . "..." .'</p>
                                        <br>
                                        <p style="float: left; color: #bbb; margin: 0; padding: 0;">Azamgarh</p>
                                    </div>
                                </a>
                                <a onclick="acceptFriendRequestFunction('. $row['sender_id'] .' , '. $accept .')" style="float: right; display: inline-block; width: 20%; padding: 5px; height: 100%; position: relative;">
                                        <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-check2"></span></div>
                                </a>
                                <a onclick="acceptFriendRequestFunction('. $row['sender_id'] .' , '. $reject .')" style="float: right; display: inline-block; width: 20%; padding: 5px; height: 100%; position: relative;">
                                        <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-x"></span></div>
                                </a>
                                </div>
                            </li>';
    }
    
} else {
    $output = '<div style="text-align: center">
                          <p>There are no friend requests received!</p>
                      </div>';
}
echo $output;
?>
