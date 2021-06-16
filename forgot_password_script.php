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
                echo ("<script>location.href='login.php'</script>");
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}

if (isset($_SESSION['allow_reset_password'])) {
$email = $_SESSION['email'];
$new_password = mysqli_real_escape_string($con, $_POST['new_password']);
$re_type_new_password = mysqli_real_escape_string($con, $_POST['re_type_new_password']);
$secured_new_password = md5($new_password);

if (strlen($new_password) < 6) {
    echo "Password length is too short!";
} else if ($new_password != $re_type_new_password) {
    echo "Password Mismatched!";
} else {
        $update_query = "UPDATE users SET password = '$secured_new_password' WHERE email_id = '$email'";
        $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
           unset($_SESSION['allow_reset_password']);
           unset($_SESSION['id']);
           unset($_SESSION['email']);
        echo "Password Reset Successful!";
}

} else {

$email = mysqli_real_escape_string($con, $_POST['email']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$gender = mysqli_real_escape_string($con, $_POST["gender"]);
$dob = mysqli_real_escape_string($con, $_POST["dob"]);
$profession = mysqli_real_escape_string($con, $_POST["profession"]);
$fav_question = mysqli_real_escape_string($con, $_POST['fav_question']);
$answer = mysqli_real_escape_string($con, $_POST['answer']);
$startDate = date('Y-m-d', strtotime(mysqli_real_escape_string($con, $_POST['start_date'])));
$endDate = date('Y-m-d', strtotime(mysqli_real_escape_string($con, $_POST['end_date'])));

$select_query = "SELECT * FROM users WHERE email_id = '$email'";
$selection_result = mysqli_query($con, $select_query) or die(mysqli_error($con));

if (mysqli_num_rows($selection_result) > 0) {
    $row = mysqli_fetch_array($selection_result);
    if ($name == $row['name'] && $phone == $row['phone'] && $dob == $row['dob'] && $fav_question == $row['fav_question'] && $answer == $row['answer'] && $gender == $row['gender'] && $profession == $row['profession']) {
        if ((date('Y-m-d', strtotime($row['registration_time'])) >= $startDate) && (date('Y-m-d', strtotime($row['registration_time'])) <= $endDate)){
            $_SESSION['allow_reset_password'] = "true";
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email_id'];
            echo "Data Validation Successful!";
        }else{
            echo "failed";  
        }
    } else {
        echo "Personal data not matched with the database!";  
    }
}
}
?>
