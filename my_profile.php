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

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['id'];
$select_user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_selection_result = mysqli_query($con, $select_user_query) or die(mysqli_error($con));
$row_user = mysqli_fetch_array($user_selection_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            
            .profile_pic {
                float: left;
                width: 100%;
                height: 100%;
            }
            
            #profile_details, #edit_profile_details {
                float: left;
                width: 100%;
                height: 100%;
            }
            
            @media only screen and (min-width: 768px) {
                .profile_pic {
                      float: right;
                      width: 30%;
                 }
            	#profile_details, #edit_profile_details {
                     width: 70%;
                 }
            }
            
            /* Style inputs, select elements and textareas */
            input[type=text], input[type=date], input[type=password], input[type=email], input[type=phone], textarea, select {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
            }
            
            input[type=file] {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
                background-color: #fff;
            }

            /* Style the label to display next to the inputs */
            label {
                padding: 12px 6px 12px 12px;
                display: inline-block;
            }

            /* Style the submit button */
            input[type=submit], input[type=button] {
                background-color: #ec407a;
                color: white;
                padding: 12px 20px;
                border: 2px solid #ec407a;
                border-radius: 5px;
                cursor: pointer;
                float: right;
                margin-top: 6px;
            }
            input[type=submit]:hover, input[type=button]:hover {
                background-color: #fff;
                border-color: #ec407a;
                color: #ec407a;
            }
            .row {
                margin: 5px 0 5px 0;
            }

            .details-box {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
            }

            /* Style the container */
            .container {
                background-color: #f2f2f2;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                .col-25, .col-75, input[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            } 
        </style>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
    
    	<div class="content" id="content">
        	
        <ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a style="color: black;">My Profile</a></li>
                    </ul>
                    
        <div class="container">
                    
             <div class="profile_pic">
                <div style="margin: 40px; width: 250px; height: 250px; border: 10px solid #fff; overflow: hidden;">
                    <?php
                    if ($row_user["photo"] == null) {
                        ?>
                        <center><span style="font-size:230px; margin: 0;" class="glyphicon glyphicon-user"></span></center>
                        <?php
                    } else {
                        ?>
                        <img src="img/profile/<?php echo $row_user["photo"]; ?>" alt="" style="height: 100%; width: 100%; object-fit: cover;">
                        <?php
                    }
                    ?>
                </div>
                <div id="change_profile_pic" style="margin: 0px 40px 0px 40px;">
                    <input onclick="changeProfilePic()" style="margin: 5px 0; width: 250px;" type="submit" value="Change Profile Picture">
                </div>
                <div id="upload_profile_pic" style="margin: 0px 40px 0px 40px; display: none;">
                    <form method="POST" action="my_profile_script.php?id=pic" enctype="multipart/form-data">
                        <label for="uploadedimage">Select Picture:</label>
                        <input type="file" name="uploadedimage">
                        <input style="margin: 5px 0;" type="submit" value="Upload">
                    </form>
                </div>
            </div>
        
            <div id="profile_details">
                <div class="row">
                    <h3>Basic Details</h3>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="name">Name</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="name" class="details-box"><?php echo $row_user["name"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="email_id">E-mail</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="email_id" class="details-box"><?php echo $row_user["email_id"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="phone">Mobile Number</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="phone" class="details-box"><?php echo $row_user["phone"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="registration_time">Registration Date</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p class="details-box"><?php echo date_format(date_create($row_user["registration_time"]), "jS M-Y"); ?></p>
                    </div>
                </div>

                <div class="row">
                    <h3>Additional Details</h3>
                </div>

                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="gender">Gender</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="gender" class="details-box"><?php echo ucfirst($row_user["gender"]); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="dob" class="details-box"><?php echo date_format(date_create($row_user["dob"]), "jS M-Y"); ?></p>
                    </div>
                </div>
                <div class="row" id="category_english">
                    <div style="float: left; width: 30%;">
                        <label for="profession">Profession</label>
                    </div>
                    <div style="float: left; width: 70%;">
                        <p id="profession" class="details-box"><?php echo ucwords($row_user["profession"]); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 30%;">
                        <label for="address">Address</label>
                    </div>
                    <div style="float: left; width: 70%; height: auto;">
                        <p id="address" class="details-box"><?php echo $row_user["address"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <input onclick="profileDetails()" style="margin: 5px 0;" type="submit" value="Edit Details">
                </div>
            </div>

            <div id="edit_profile_details" style="display: none;">
                <form id="myProfileForm">
                    <div class="row">
                        <h3>Basic Details</h3>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="name">Name</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="text" value="<?php echo $row_user["name"]; ?>" name="name" placeholder="Enter Your Name...">
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="email_id">E-mail</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="email" value="<?php echo $row_user["email_id"]; ?>" name="email_id" placeholder="Enter Your Email...">
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="phone">Mobile Number</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="phone" value="<?php echo $row_user["phone"]; ?>" name="phone" placeholder="Enter Your Mobile Number...">
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="registration_time">Registration Date</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="text" value="<?php echo date_format(date_create($row_user["registration_time"]), "jS M-Y"); ?>" name="registration_time" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <h3>Additional Details</h3>
                    </div>

                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="gender">Gender</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <label class="radio-inline"><input type="radio" value="male" name="gender" <?php
                                if ($row_user["gender"] == "male") {
                                    echo "checked";
                                }
                                ?>>Male</label>
                            <label class="radio-inline"><input type="radio" value="female" name="gender" <?php
                                if ($row_user["gender"] == "female") {
                                    echo "checked";
                                }
                                ?>>Female</label>
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="dob">Date of Birth</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="date" value="<?php echo $row_user["dob"]; ?>" name="dob">
                        </div>
                    </div>
                    <div class="row" id="category_english">
                        <div style="float: left; width: 30%;">
                            <label for="profession">Profession</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <select name="profession">
                                <option value="agriculture" <?php
                                if ($row_user["profession"] == "agriculture") {
                                    echo "selected";
                                }
                                ?>>Agriculture</option>
                                <option value="government_employee" <?php
                                if ($row_user["profession"] == "government_employee") {
                                    echo "selected";
                                }
                                ?>>Government Employee</option>
                                <option value="private_sector" <?php
                                if ($row_user["profession"] == "private_sector") {
                                    echo "selected";
                                }
                                ?>>Private Sector</option>
                                <option value="entrepreneur" <?php
                                if ($row_user["profession"] == "entrepreneur") {
                                    echo "selected";
                                }
                                ?>>Entrepreneur</option>
                                <option value="student" <?php
                                if ($row_user["profession"] == "student") {
                                    echo "selected";
                                }
                                ?>>Student</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="address">Address</label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <textarea style="height: 100px; width: 100%;" name="address" placeholder="Enter Your Address..."><?php echo $row_user["address"]; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 30%;">
                            <label for="password"></label>
                        </div>
                        <div style="float: left; width: 70%;">
                            <input type="password" name="password" placeholder="Enter Your Password to Proceed...">
                        </div>
                    </div>
                    <div class="row">
                        <input style="margin: 5px 0;" type="submit" value="Submit">
                        <input onclick="editProfileDetails()" style="margin: 5px 15px;" type="button" value="Cancel">
                    </div>
                </form>
            </div>

           
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("my_profile").classList.add("active");

            function profileDetails() {
                document.getElementById('profile_details').style.display = 'none';
                document.getElementById('edit_profile_details').style.display = 'block';
            }
            function editProfileDetails() {
                document.getElementById('edit_profile_details').style.display = 'none';
                document.getElementById('profile_details').style.display = 'block';
            }
            function changeProfilePic() {
                document.getElementById('change_profile_pic').style.display = 'none';
                document.getElementById('upload_profile_pic').style.display = 'block';
            }
            function updateData() {
                
            }
        </script>
        

<script>
  window.addEventListener( "load", function () {
  function sendData() {
    const XHR = new XMLHttpRequest();
    const FD = new FormData( form );
    XHR.addEventListener( "load", function(event) {
      alert( event.target.responseText );
      updateData();
      editProfileDetails();
    } );
    XHR.addEventListener( "error", function( event ) {
      alert( 'Oops! Something went wrong.' );
    } );
    XHR.open( "POST", "my_profile_script.php?id=details" );
    XHR.send( FD );
  }
  const form = document.getElementById( "myProfileForm" );
  form.addEventListener( "submit", function ( event ) {
    event.preventDefault();

    sendData();
  } );
} );
  </script>
    </body>
</html>
