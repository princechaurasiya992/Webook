<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';


$user_id = $_SESSION['id'];
$output = "";

$chat_heads_id_array = array();
$chat_heads_select_query = "SELECT sender_id, receiver_id FROM chats WHERE (sender_id = '$user_id' OR receiver_id = '$user_id')";
$chat_heads_selection_result = mysqli_query($con, $chat_heads_select_query) or die(mysqli_error($con));
if (mysqli_num_rows($chat_heads_selection_result) > 0) {
while ($row = mysqli_fetch_array($chat_heads_selection_result)) {
    if ($row['sender_id'] == $user_id) {
        if (!in_array($row["receiver_id"], $chat_heads_id_array, TRUE)) {
             array_push($chat_heads_id_array, $row['receiver_id']);
        }
    } else if ($row['receiver_id'] == $user_id) {
        if (!in_array($row["sender_id"], $chat_heads_id_array, TRUE)) {
             array_push($chat_heads_id_array, $row['sender_id']);
        }
    }
}
}

$total_chat_heads = count($chat_heads_id_array);

if ($total_chat_heads > 0) {
for ($i = 0; $i < $total_chat_heads; $i++) {
    $chat_head_id = $chat_heads_id_array[$i];
    $chat_heads_select_query = "SELECT name, photo FROM users WHERE id = '$chat_head_id'";
    $chat_heads_selection_result = mysqli_query($con, $chat_heads_select_query) or die(mysqli_error($con));
    if (mysqli_num_rows($chat_heads_selection_result) > 0) {
        while ($row = mysqli_fetch_array($chat_heads_selection_result)) {
            $last_chat_select_query = "SELECT * FROM chats WHERE (receiver_id = '$chat_head_id' AND sender_id = '$user_id') OR (receiver_id = '$user_id' AND sender_id = '$chat_head_id') ORDER BY id DESC LIMIT 1";
            $last_chat_selection_result = mysqli_query($con, $last_chat_select_query) or die(mysqli_error($con));
            if (mysqli_num_rows($last_chat_selection_result) > 0) {
                while ($row2 = mysqli_fetch_array($last_chat_selection_result)) {
                     $last_message = "";
                     if (strlen($row2['message']) > 12) {
                         $last_message = substr($row2['message'], 0, 12) . "...";
                     } else {
                         $last_message = $row2['message'];
                     }
                         
                     if ($row2['sender_id'] == $user_id) {
                         $last_message = "You: " . $last_message;
                     }
                     
                     $output .= '<li style="padding: 5px;">
                                <div style="height: 60px; font-size: 15px; padding: 0px; background-color: #fff; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);">
                                <a style="height: 60px; font-size: 15px; padding: 0px;" href="chat_box.php?friend_id='. $chat_head_id .'">
                                    <div style="width: 60px; padding: 5px; height: 60px; float: left; position: relative;">
                                        <div style="width: 50px; height: 50px; padding: 0; border-radius: 50%; overflow: hidden;"><img src="img/profile/'. $row["photo"] .'" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                    </div>
                                    <div style="padding: 10px;">
                                        <p style="margin: 0; padding: 0; float: left;">'. $row["name"] .'</p>
                                        <p style="margin: 0; padding: 0; float: right; color: #ec407a;">online</p>
                                        <br>
                                         <p style="float: left; color: #bbb; margin: 0; padding: 0;">'. $last_message .'</p>
                                         <p style="margin: 0; padding: 0; float: right;">'. date_format(date_create($row2['date']), "h:i A") .'</p>
                                    </div>
                                </a>
                                </div>
                            </li>';
                }
            }
        }
    }
}
} else {
    $output = '<div style="text-align: center">
                          <p>No chat heads available! Click on the + icon to start chat with someone.</p>
                      </div>';
}
echo $output;
?>
