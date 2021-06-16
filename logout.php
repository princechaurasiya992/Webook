<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['expire']);
unset($_SESSION['remember_login']);
unset($_SESSION['allow_reset_password']);

echo "<script>alert('You are successfully logged out!')</script>";
echo ("<script>location.href='index.php'</script>");
?>
