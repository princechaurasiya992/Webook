<?php
require 'includes/common.php';
require 'includes/is_welcomed.php';
require 'includes/remember_login.php';

if (isset($_SESSION['email'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>

/* Style the form */
#forgotPasswordForm {
  background-color: #fefefe;
  position: relative;
  margin-bottom: 20px;
  padding: 20px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

#newPasswordForm {
  display: none;
  background-color: #fefefe;
  position: relative;
  margin-bottom: 20px;
  padding: 20px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

/* Style the input fields */
input, select {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: 1px solid #bbb;
        background: #f1f1f1;
}

input:focus, select:focus {
        background-color: #ddd;
        outline: none;
        border: 1px solid #ec407a;
        box-shadow: 0px 0px 5px 2px #ec407a;
        transition: box-shadow .2s;
}

.multi-step-form-btn {
        padding: 11px 20px;
        background-color: #ec407a;
        border: 2px solid #ec407a;
        width: 40%;
        color: #fff;
        font-size: 18px;
    }

    .multi-step-form-btn:hover {
        border-color: #fff;
        background-color: #000;
    }

    @media screen and (max-width: 300px) {
        .multi-step-form-btn {
            width: 100%;
        }
    }
    
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }
    
/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #ec407a;
}

            .alertBoxModal {
                display: block;
                position: fixed; /* Stay in place */
                z-index: 150; /* Sit on top */
                left: 0;
                top: 0;
                width: 0%; /* Full width */
                height: 100%; /* Full height */
                overflow: hidden;
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.alertBoxContent {
  background-color: #ec407a;
  color: #fff;
  z-index: 151;
  text-align: center;
  position: fixed;
  margin: 0 10%;
  padding: 20px;
  width: 80%;
  height: 100px;
  top: -100px;
  transition: top 0.5s;
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
                    <li><a style="color: black;">Forgot Password</a></li>
                    </ul>
        <div class="container">
            
<form id="newPasswordForm">
   <h1>New Password</h1>
   <p>Please fill in this form to reset your password.</p>
   <hr>
  <label for="new_password"><b>New password</b></label>
  <input type="password" name="new_password" placeholder="Enter your new password" minlength="6" required oninput="this.className = ''">
  <label for="re_type_new_password"><b>Verify new password</b></label>
  <input type="password" name="re_type_new_password" placeholder="Re-type your new password" minlength="6" required oninput="this.className = ''">
<div style="width: 100%; display: table;">
    <button style="float: right;" class="multi-step-form-btn" type="submit" id="submitPasswordBtn">Submit</button>
</div>
</form> 


<form id="forgotPasswordForm">

<h1>Forgot Password</h1>
<p>Please fill in this form to reset your password.</p>
<hr>

<!-- One "tab" for each step in the form: -->
<div class="tab"><b>Name</b>
  <input type="text" placeholder="Enter your full name..." name="name" minlength="1" oninput="this.className = ''">
</div>

<div class="tab"><b>Enter your contact details</b>
  <hr>
  <label for="email"><b>Email</b></label>
  <input type="email" name="email" placeholder="E-mail..." required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninput="this.className = ''">
  <label for="phone"><b>Phone</b></label>
  <input type="tel" placeholder="Enter your phone number (Ex: 9044291375)" maxlength="10" name="phone" required pattern="[0-9]{10}" oninput="this.className = ''">
</div>

<div class="tab"><b>Personal Details</b>
<hr>
  <label for="dob"><b>Birthday</b></label>
  <input type="date" name="dob" oninput="this.className = ''">
  <label for="gender"><b>Gender</b></label>
  <select name="gender">
      <option value="male">Male</option>
      <option value="female">Female</option>
  </select>
  <label for="profession"><b>Profession</b></label>
  <select name="profession">
      <option value="agriculture">Agriculture</option>
      <option value="government_employee">Government Employee</option>
      <option value="private_sector">Private Sector</option>
      <option value="entrepreneur">Entrepreneur</option>
      <option value="student">Student</option>
  </select>
</div>

<div class="tab"><b>When did you register to this website?</b>
  <hr>
  <label for="start_date"><b>From</b></label>
  <input type="date" name="start_date" oninput="this.className = ''">
  <label for="end_date"><b>To</b></label>
  <input type="date" name="end_date" oninput="this.className = ''">
</div>

<div class="tab"><b>Answer your favourite question</b>
  <hr>
  <label for="fav_question"><b>Question</b></label>
  <select name="fav_question">
      <option value="fav_book">What is your favourite book name?</option>
      <option value="best_friend">What is your best friend's name?</option>
      <option value="fav_place">What is your favourite place?</option>
      <option value="first_crush">Who is the first you had a crush on?</option>
      <option value="fav_superhero">Who is your favourite superhero?</option>
      <option value="fav_pet">What is your favourite pet's name?</option>
  </select>
  <label for="answer"><b>Answer</b></label>
  <input type="text" placeholder="Enter your answer..." name="answer" minlength="1" oninput="this.className = ''">
</div>

<div style="width: 100%; display: table;">
    <button style="float: right;" class="multi-step-form-btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    <button style="float: right; display: none;" class="multi-step-form-btn" type="submit" id="submitBtn">Submit</button>
    <button style="float: left;" class="multi-step-form-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
</div>
<br>

<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center; margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>

</form>
        </div>
        </div>
        <div id="alertBoxModal" class="alertBoxModal">
            <div id="alertBoxContent" class="alertBoxContent">
            <p id="alertBoxMessage">Some text in the Modal..</p>
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("login").classList.add("active");
        </script>
        <script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= (x.length - 1)) {
    //...the form gets submitted:
    document.getElementById("nextBtn").style.display = 'none';
    document.getElementById("submitBtn").style.display = 'block';
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
        </script>
        <script>
            window.addEventListener( "load", function () {
                            function sendData() {
                            const XHR = new XMLHttpRequest();
                            const FD = new FormData( form );
                            XHR.addEventListener( "load", function(event) {
                            var response = event.target.responseText
                            document.getElementById("alertBoxMessage").innerHTML = response;
                            alertBoxFunction();
                            
                            if (response.match("Data Validation Successful!")){
                                document.getElementById( "forgotPasswordForm" ).style.display = 'none';
                                document.getElementById( "newPasswordForm" ).style.display = 'block';
                            } else if (response == "failed") {
                                currentTab = 0;
                                showTab(currentTab); 
                                document.getElementById( "forgotPasswordForm" ).style.display = 'block';
                                document.getElementById( "newPasswordForm" ).style.display = 'none';
                            }
                            
                            } );
                            XHR.addEventListener( "error", function( event ) {
                            alert( 'Oops! Something went wrong.' );
                            } );
                            XHR.open( "POST", "forgot_password_script.php" );
                            XHR.send( FD );
                            }
                            
                            function sendData2() {
                            const XHR = new XMLHttpRequest();
                            const FD = new FormData( form2 );
                            XHR.addEventListener( "load", function(event) {
                            var response = event.target.responseText
                            document.getElementById("alertBoxMessage").innerHTML = response;
                            alertBoxFunction();
                            
                            if (response.match("Password Reset Successful!")){
                                currentTab = 0;
                                showTab(currentTab); 
                                document.getElementById( "forgotPasswordForm" ).style.display = 'block';
                                document.getElementById( "newPasswordForm" ).style.display = 'none';
                            } else if (response == "failed") {
                                document.getElementById( "forgotPasswordForm" ).style.display = 'none';
                                document.getElementById( "newPasswordForm" ).style.display = 'block';
                            }
                            
                            } );
                            XHR.addEventListener( "error", function( event ) {
                            alert( 'Oops! Something went wrong.' );
                            } );
                            XHR.open( "POST", "forgot_password_script.php" );
                            XHR.send( FD );
                            }

                            const form = document.getElementById( "forgotPasswordForm" );
                            const form2 = document.getElementById( "newPasswordForm" );
                            form.addEventListener( "submit", function ( event ) {
                            event.preventDefault();

                              sendData();
                               } );
                            form2.addEventListener( "submit", function ( event ) {
                            event.preventDefault();

                              sendData2();
                               } );
                               } );
        </script>
        <script>
            var alertModal = document.getElementById("alertBoxModal");
            var alertContent = document.getElementById("alertBoxContent");
            function alertBoxFunction() {
            alertModal.style.width = "100%";
            alertContent.style.top = "100px";
            }

            window.onclick = function(event) {
            if (event.target == alertModal) {
            alertModal.style.width = "0%";
            alertContent.style.top = "-200px";
            }
         }
        </script>
    </body>
</html>
