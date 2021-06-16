<?php

//Checking if session is active or expired...
if (isset($_SESSION['email'])) {

    if (!isset($_SESSION['remember_login'])) {
        if (isset($_SESSION['expire'])) {
            if (time() > $_SESSION ['expire']) {
                unset($_SESSION['id']);
                unset($_SESSION['email']);
                unset($_SESSION['remember_login']);
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}

?>
