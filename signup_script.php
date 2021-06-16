<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$name = $_POST['name'];
$email = $_POST['email'];
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$password = $_POST['password'];
$phone = $_POST['phone'];

if (strlen($name) == 0) {
    echo "Enter your name!";
} else if (!preg_match($regex_email, $email)) {
    echo "Enter valid Email";
} else if (strlen($password) < 6) {
    echo "Enter correct Password";
} else if (strlen($phone) < 10) {
    echo "Invalid mobile number!";
} else {

$email = mysqli_real_escape_string($con, $email);
$name = mysqli_real_escape_string($con, $_POST['name']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$password = mysqli_real_escape_string($con, $password);
$secured_password = md5($password);

//This query is written just to check whether a user is already registered.
$user_select_query = "SELECT * FROM users WHERE email_id='$email'";
$user_select_result = mysqli_query($con, $user_select_query) or die(mysqli_error($con));
if (mysqli_num_rows($user_select_result) > 0) {
    echo "Email id already exists!";
} else {

    //Now, since the user is not registered before, so we insert the users information into database.
    $user_registration_query = "insert into users(email_id, name, phone, password) values ('$email', '$name', '$phone', '$secured_password')";
    $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
    $_SESSION['email'] = $email;
    $_SESSION['id'] = mysqli_insert_id($con);
    
    if (!empty($_POST['remember'])) {
            $_SESSION['remember_login'] = "true";
    }
    echo "You are successfully registered!";
}
}
?>
