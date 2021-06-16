<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);
$btn_output = "";
$output = "";
$user_id = $_SESSION['id'];
$receiver_id = "";

$friend_search_query = "SELECT id, name, photo FROM users WHERE name LIKE '%{$searchTerm}%' AND NOT id = '$user_id'";
$friend_search_query_result = mysqli_query($con, $friend_search_query) or die(mysqli_error($con));

if (mysqli_num_rows($friend_search_query_result) > 0) {
    while ($row = mysqli_fetch_array($friend_search_query_result)) {
        
        $receiver_id = $row['id'];
        $friend_request_query = "SELECT id FROM friend_requests WHERE sender_id = '$user_id' AND receiver_id = '$receiver_id'";
        $friend_request_query_result = mysqli_query($con, $friend_request_query) or die(mysqli_error($con));
        
        if (mysqli_num_rows($friend_request_query_result) > 0) {
              $btn_output = '<div style="width: 100%; padding: 0px; height: 100%; position: relative;">
                                            <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-check2"></span></div>
                                        </div>';
        } else {
               $btn_output = '<a onclick="sendFriendRequestFunction('. $row['id'] .')" style="width: 100%; padding: 0px; height: 100%; position: relative; border-bottom: 0px;">
                                            <div style="font-size: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><span class="bi bi-person-plus-fill"></span></div>
                                         </a>';
        }
        
        $output .= '<li style="padding: 5px;">
                              <div style="height: 60px; font-size: 15px; padding: 0px; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <a style="display: inline-block; height: 100%; width: 80%; font-size: 15px; padding: 0px; border-bottom: 0px;" href="friends_profile.php?id='. $row['id'] .'">
                                    <div style="width: 60px; padding: 5px; height: 60px; float: left; position: relative;">
                                        <div style="width: 50px; height: 50px; padding: 0; border-radius: 50%; overflow: hidden;"><img src="img/profile/'. $row['photo'] .'" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                    </div>
                                    <div style="padding: 10px;">
                                        <p style="margin: 0; padding: 0; float: left;">'. $row['name'] .'</p>
                                        <p style="margin: 0; padding: 0; float: right;">online</p>
                                        <br>
                                        <p style="float: left; color: #bbb; margin: 0; padding: 0;">Azamgarh</p>
                                    </div>
                                </a>
                                <div id="sendFriendRequestBtn'. $row['id'] .'" style="float: right; display: inline-block; width: 20%; padding: 5px; height: 100%; position: relative;">
                                    '. $btn_output .'
                                </div>
                              </div>
                            </li>';
    }
    
} else {
    $output = '<div style="text-align: center">
                          <p>'. $searchTerm .' is not available!</p>
                      </div>';
}
echo $output;
?>
