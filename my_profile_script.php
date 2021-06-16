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

$user_id = $_SESSION['id'];
$submit_id = $_GET["id"];

if ($submit_id == "pic") {

    function GetImageExtension($imagetype) {
        if (empty($imagetype)) {
            return false;
        }
        switch ($imagetype) {
            case 'image/bmp': return '.bmp';
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            default: return false;
        }
    }

    if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = date("d-m-Y") . "-" . time() . $ext;
        $target_path = "img/profile/" . $imagename;
        if (move_uploaded_file($temp_name, $target_path)) {
            $pic_select_query = "SELECT photo FROM users WHERE id = '$user_id'";
            $pic_selection_result = mysqli_query($con, $pic_select_query) or die(mysqli_error($con));
            $row = mysqli_fetch_array($pic_selection_result);
            unlink("img/profile/".$row['photo']);
            $update_query = "UPDATE users SET photo = '$imagename' WHERE id = '$user_id'";
            $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            echo "<script>alert('Profile picture uploaded successfully!')</script>";
            echo ("<script>location.href='my_profile.php'</script>");
        }
    } else {
        echo "<script>alert('Select an image, first!')</script>";
        echo ("<script>location.href='my_profile.php'</script>");
    }
}

if ($submit_id == "details") {
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $secured_password = md5($password);
        $password_select_query = "SELECT email_id, password FROM users WHERE id = '$user_id'";
        $password_selection_result = mysqli_query($con, $password_select_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($password_selection_result);
        if ($secured_password == $row['password']) {
            $name = mysqli_real_escape_string($con, $_POST["name"]);
            $email_id = mysqli_real_escape_string($con, $_POST["email_id"]);
            $phone = mysqli_real_escape_string($con, $_POST["phone"]);
            $gender = mysqli_real_escape_string($con, $_POST["gender"]);
            $dob = mysqli_real_escape_string($con, $_POST["dob"]);
            $profession = mysqli_real_escape_string($con, $_POST["profession"]);
            $address = mysqli_real_escape_string($con, $_POST["address"]);
            if (!empty($_POST['email_id']) && $email_id != $row["email_id"]) {
                $user_select_query = "SELECT email_id FROM users WHERE email_id='$email_id'";
                $user_selection_result = mysqli_query($con, $user_select_query) or die(mysqli_error($con));
                if (mysqli_num_rows($user_selection_result) > 0) {
                    echo "<script>alert('Email id already exists!')</script>";
                    echo ("<script>location.href='my_profile.php'</script>");
                } else {
                    $update_query = "UPDATE users SET email_id = '$email_id' WHERE id = '$user_id'";
                    $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
                }
            }

            if (!empty($_POST['name'])) {
                $update_query = "UPDATE users SET name = '$name' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            if (!empty($_POST['phone'])) {
                $update_query = "UPDATE users SET phone = '$phone' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            if (!empty($_POST['gender'])) {
                $update_query = "UPDATE users SET gender = '$gender' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            if (!empty($_POST['dob'])) {
                $update_query = "UPDATE users SET dob = '$dob' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            if (!empty($_POST['profession'])) {
                $update_query = "UPDATE users SET profession = '$profession' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            if (!empty($_POST['address'])) {
                $update_query = "UPDATE users SET address = '$address' WHERE id = '$user_id'";
                $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            }
            echo "Your Profile Details have been updated successfully!";
            
        } else {
            echo "Password is incorrect!";
   
        }
    } else {
        echo "Enter the password, first!";
  
    }
}
?>
