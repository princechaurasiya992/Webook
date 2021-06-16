<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';

//Checking if session is active or expired...
if (isset($_SESSION['email'])) {

    if (!isset($_SESSION['remember_login'])) {
        if (isset($_SESSION['expire'])) {
            if (time() > $_SESSION ['expire']) {
                unset($_SESSION['id']);
                unset($_SESSION['email']);
                unset($_SESSION['remember_login']);
                echo "<script>alert('Session expired! Please login again!')</script>";
                echo("<script>location.href='login.php'</script>");
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}
if (!isset($_SESSION['email'])) {
    echo "You need to login first!";
} else {
    $content_id = mysqli_real_escape_string($con, $_POST['p_id']);
    $content_type = mysqli_real_escape_string($con, $_POST['content_type']);
    if ($content_type == 'article') {
        $table_name = "article_comments";
        $content_column_id_name = "article_id";
    } elseif ($content_type == 'picture') {
        $table_name = "picture_comments";
        $content_column_id_name = "picture_id";
    }
    $user_id = $_SESSION["id"];
    $output = "";

    $comment_select_query = "SELECT * FROM $table_name WHERE $content_column_id_name = '$content_id'";
    $comment_selection_result = mysqli_query($con, $comment_select_query) or die(mysqli_error($con));
    if (mysqli_num_rows($comment_selection_result) > 0) {
        while ($row = mysqli_fetch_array($comment_selection_result)) {
            $time = "";
            $time = $row['date'];
            $photo = "";
            $comment_id = $row['id'];

            $commented_person = $row['user_id'];
            $user_select_query = "SELECT name, email_id, photo FROM users WHERE id = '$commented_person'";
            $user_selection_result = mysqli_query($con, $user_select_query) or die(mysqli_error($con));
            if (mysqli_num_rows($user_selection_result) > 0) {
                while ($row2 = mysqli_fetch_array($user_selection_result)) {
                    $photo = $row2['photo'];
                }
            }

            $onclickCommentOption = "pictureOptionBtnFunction('commentOptionBtn$comment_id' , 'commentOptionBlock$comment_id' )";

            if ($commented_person == $user_id) {
                $output .= '<li style="margin: 10px 0px; width: 100%; display: table;">
                                <div style="width: 60px; padding: 5px; height: 60px; float: right; position: relative;">
                                     <div style="width: 50px; height: 50px; padding: 0; border-radius: 50%; overflow: hidden;"><img src="img/profile/' . $photo . '" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                </div>
                                <div style="float: right; border-radius: 10px 10px 0px 10px; width: calc(100% - 120px); font-size: 15px; padding: 0px; background-color: #dddddd;">
                                <div style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;">
                                    <div style="padding: 10px; position: relative;">
                                        <div class="comment-option-block" id="commentOptionBlock'. $comment_id .'">
                                            <ul style="text-align: left; list-style-type: none; width: 100%; padding-left: 0; margin-bottom: 0;">
                                                <li><a>Reply</a></li>
                                                <li><a>Edit</a></li>
                                                <li><a onclick="deleteCommentFunction('. $content_id .', '. $comment_id .', \''. $content_type .'\', '. isset($_SESSION['email']) .')">Delete</a></li>
                                            </ul>
                                        </div>
                                        <p class="comment-option-btn" onclick="'. $onclickCommentOption .'"><span id="commentOptionBtn'. $comment_id .'" class="bi bi-three-dots-vertical"></span></p>
                                        <p style="text-align: left; width: 100%; font-size: 14px; margin: 0; padding: 0; float: left;">' . $row["text"] . '</p><br>
                                        <p style="text-align: right; width: 100%; font-size: 12px; margin: 0; padding: 0; color: #bbb; float: left;">' . date('h:i A', strtotime('+5 hour +30 minutes', strtotime($row['date']))) . '</p>
                                    </div>
                                </div>
                                </div>
                            </li>';
            } else {
                $output .= '<li style="margin: 10px 0px; width: 100%; display: table;">
                                <div style="width: 60px; padding: 5px; height: 60px; float: left; position: relative;">
                                     <div style="width: 50px; height: 50px; padding: 0; border-radius: 50%; overflow: hidden;"><img src="img/profile/' . $photo . '" alt="" style="height: 100%; width: 100%; object-fit: cover;"></div>
                                </div>
                                <div style="float: left; border-radius: 0px 10px 10px 10px; width: calc(100% - 120px); font-size: 15px; padding: 0px; background-color: #f1f1f1;">
                                <div style="display: inline-block; height: 100%; width: 100%; font-size: 15px; padding: 0px;">
                                    <div style="padding: 10px; position: relative;">
                                        <div class="comment-option-block" id="commentOptionBlock'. $comment_id .'">
                                            <ul style="text-align: left; list-style-type: none; width: 100%; padding-left: 0; margin-bottom: 0;">
                                                <li><a>Reply</a></li>
                                                <li><a>Report</a></li>
                                            </ul>
                                        </div>
                                        <p class="comment-option-btn" onclick="'. $onclickCommentOption .'"><span id="commentOptionBtn'. $comment_id .'" class="bi bi-three-dots-vertical"></span></p>
                                        <p style="text-align: left; width: 100%; font-size: 14px; margin: 0; padding: 0; float: left;">' . $row["text"] . '</p><br>
                                        <p style="text-align: right; width: 100%; font-size: 12px; margin: 0; padding: 0; color: #bbb; float: left;">' . date('h:i A', strtotime('+5 hour +30 minutes', strtotime($row['date']))) . '</p>
                                    </div>
                                </div>
                                </div>
                            </li>';
            }
        }
    } else {
        $output .= '<div style="text-align: center">
                          <p>No comments!</p>
                      </div>';
    }
    echo $output;
}

?>
