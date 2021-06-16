<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

date_default_timezone_set('Asia/Kolkata');

$sender_id = $_SESSION['id'];
$receiver_id = $_GET['receiver_id'];
$output = "";

$chat_select_query = "SELECT * FROM chats WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) OR (receiver_id = $sender_id AND sender_id = $receiver_id) ORDER BY id";
$chat_selection_result = mysqli_query($con, $chat_select_query) or die(mysqli_error($con));

if (mysqli_num_rows($chat_selection_result) > 0) {
    while ($row = mysqli_fetch_array($chat_selection_result)) {
        $time = "";
        $time = $row['date'];
        if ($row['sender_id'] == $sender_id) {
        $output .= '<li style="margin: 5px 0px; width: 100%; display: table;">
                                <div style="float: right; border-radius: 10px 10px 0px 10px; max-width: calc(80% - 50px); font-size: 15px; padding: 0px; background-color: #d4fccf; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <div style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;">
                                    <div style="padding: 10px;">
                                        <p style="font-size: 14px; margin: 0; padding: 0; float: left;">'. $row["message"] .'</p><br>
                                        <p style="font-size: 10px; margin: 0; padding: 0; color: #bbb; float: right;">'. date('h:i A',strtotime('+5 hour +30 minutes',strtotime($row['date']))) .'</p>
                                    </div>
                                </div>
                                </div>
                            </li>';
         } else if ($row['receiver_id'] == $sender_id) {
             $output .= '<li style="margin: 5px 0px; width: 100%; display: table;">
                                <div style="float: left; border-radius: 0px 10px 10px 10px; max-width: calc(80% - 50px); font-size: 15px; padding: 0px; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <div style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;">
                                    <div style="padding: 10px;">
                                        <p style="font-size: 14px; margin: 0; padding: 0; float: left;">'. $row["message"] .'</p><br>
                                        <p style="font-size: 10px; margin: 0; padding: 0; color: #bbb; float: right;">'. date('h:i A',strtotime('+5 hour +30 minutes',strtotime($row['date']))) .'</p>
                                    </div>
                                </div>
                                </div>
                            </li>';
         }
    }
    
} else {
    $output = '<div style="text-align: center">
                          <p>Start messaging now!</p>
                      </div>';
}
echo $output;
?>
