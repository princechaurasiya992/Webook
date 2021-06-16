<?php

require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

$email = $_POST['email'];
$password = $_POST['password'];
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    echo "Enter valid Email";
} else if (strlen($password) < 6) {
    echo "Enter valid Password";
} else {
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);
$secured_password = md5($password);

//Here we are checking that the email id of the user is present in the database.
$query = "SELECT id, email_id, password FROM users WHERE email_id = '$email'";
$data = mysqli_query($con, $query) or die(mysqli_error($con));

if (mysqli_num_rows($data) > 0) {
    $row = mysqli_fetch_array($data);
    if ($secured_password == $row['password']) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email_id'];
        
        if (!empty($_POST['remember'])) {
            $_SESSION['remember_login'] = "true";
        }
        echo "You are logged in successfully!";
    } else {
        echo "Incorrect Password!";
    }
} else {
    echo "Provided email is not registered yet!";
}
}
?>
