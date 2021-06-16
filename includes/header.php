<style>
    * {
        box-sizing: border-box
    }

    /* Full-width input fields */
    input[class=signup-modal-input] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: 1px solid #bbb;
        background: #f1f1f1;
    }

    /* Add a background color when the inputs get focus */
    input[class=signup-modal-input]:focus {
        background-color: #ddd;
        outline: none;
        border: 1px solid #ec407a;
        box-shadow: 0px 0px 5px 2px #ec407a;
        transition: box-shadow .2s;
    }

    /* Extra styles for the cancel button */
    .cancelbtn-sign-up {
        padding: 11px 20px;
        float: left;
        width: 50%;
        background-color: #fff;
        border: 2px solid #ec407a;
        color: #ec407a;
        font-size: 18px;
    }

    .signupbtn {
        padding: 11px 20px;
        background-color: #ec407a;
        border: 2px solid #ec407a;
        float: left;
        width: 50%;
        color: #fff;
        font-size: 18px;
    }

    .cancelbtn-sign-up:hover, .signupbtn:hover {
        padding: 11px 20px;
        float: left;
        width: 50%;
        border-color: #fff;
        background-color: #000;
        color: #fff;
        font-size: 18px;
    }

    .modal-sign-up {
        display: none;
        position: fixed;
        z-index: 150;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: auto;
    }

    .modal-content-sign-up {
        background-color: #fefefe;
        position: relative;
        margin: 25px 5px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @media only screen and (min-width: 768px) {
        .modal-content-sign-up {
            margin: 25px 300px;
        }

    }

    .signup-modal-container {
        padding: 20px;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }
        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }
        to {
            transform: scale(1)
        }
    }

    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    .close-sign-up {
        position: relative;
        font-size: 30px;
        color: #f1f1f1;
    }

    .close-sign-up:hover,
    .close-sign-up:focus {
        color: #f44336;
        cursor: pointer;
    }

    /* Clear floats */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Change styles for cancel button and signup button on extra small screens */
    @media screen and (max-width: 300px) {
        .cancelbtn-sign-up, .signupbtn {
            width: 100%;
        }
    }

    input[class=login-dropdown-input] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: 1px solid #bbb;
        background: #f1f1f1;
    }

    /* Add a background color when the inputs get focus */
    input[class=login-dropdown-input]:focus {
        background-color: #ddd;
        outline: none;
        border: 1px solid #ec407a;
        box-shadow: 0px 0px 5px 2px #ec407a;
        transition: box-shadow .2s;
    }

    .login-dropdown-container {
        padding: 10px;
        overflow: hidden;
    }

    .login-dropdown-button {
        border-radius: 5px;
        width: 30%;
        float: right;
        padding: 5px;
    }

    .show_login_content {
        height: 242px;
    }

    .show_articles_content {
        height: 104px;
    }

    .show_upload_content {
        height: 104px;
    }

    .show_settings_content {
        height: <?php if (isset($_SESSION['email'])) {?>156px<?php } else {  ?>52px<?php }  ?>;
    }

    .main_sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: -250px;
        background-color: #000;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 0px;
    }

    #mainBackSidenav {
        z-index: 100;
        position: fixed;
        height: 100%;
        width: 0%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0);
        transition: background-color 0.5s;
    }
</style>

<div style="height: 80px; width: 100%; overflow: hidden; z-index: 99">

    <div class="logo-container">
        <p class="logo-title">Webook</p>
        <p class="logo-sub-title">connecting world</p>
    </div>

    <div style="float: right;">
        <!--   <img src="img/logo/webook_logo.jpg" alt="webook" height="40px">  -->
    </div>

</div>

<!-- Main Side Navigation Bar -->
<div onclick="closeSideNav()" id="mainBackSidenav"></div>
<div id="mainSidenav" class="main_sidenav" style="z-index: 101;">
    <div style="height: 50px; width: 100%; overflow: hidden;">
        <a href="index.php"><p
                    style="margin-top: 0px; background-color: #000; width: 100%; font-size: 40px; padding: 0px 20px;"
                    class="logo-title">We<span style="color: #fff;">book</span></p></a>
    </div>

    <div class="ulSideNav" style="background-color: #000;">

        <?php
        if (isset($_SESSION['email'])) {
            $user_id = $_SESSION['id'];
            $select_user_query = "SELECT * FROM users WHERE id = '$user_id'";
            $user_selection_result = mysqli_query($con, $select_user_query) or die(mysqli_error($con));
            $row_user = mysqli_fetch_array($user_selection_result);
            ?>

            <div style="width: 100%; background-color: #fff; padding: 15px;">

                <?php
                if ($row_user["photo"] == null) {
                    ?>
                    <div style="width: 100%; height: 100px; padding: 0 0 0 0; margin-left: 15px; align: center; position: relative; left: 50%; transform: translateX(-50%);">
                        <div style="width: 100px; height: 100px; float: left; position: relative;"><a
                                    href="my_profile.php"
                                    style=" margin: 0; padding: 0 0 0 0; width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid #ec407a; font-size: 92px; color: #000; overflow: hidden; position: absolute;"><span
                                        class="bi bi-person"></span></a></div>
                    </div>

                    <?php
                } else {
                    ?>

                    <div style="width: 100%; height: 100px; padding: 0 0 0 0; margin-left: 15px; align: center; position: relative; left: 50%; transform: translateX(-50%);">
                        <div style="width: 100px; height: 100px; overflow: hidden; float: left;"><a
                                    href="my_profile.php"
                                    style=" margin: 0; padding: 0 0 0 0; width: 100%; height: 100%; border-radius: 50%; border: 4px solid #ec407a; overflow: hidden;"><img
                                        style=" margin: 0; padding: 0 0 0 0; width: 100%; height: 100%; object-fit: cover;"
                                        src="img/profile/<?php echo $row_user["photo"]; ?>" alt=""></a></div>
                    </div>
                    <?php
                }
                ?>
                <h4><?php echo $row_user["name"]; ?></h4>
                <p><?php echo $row_user["email_id"]; ?></p>
            </div>

            <a class="navlist" href="my_profile.php" id="my_profile"><i class="bi bi-person-circle"></i></span>  My
                Profile</a>
            <a class="navlist" href="my_friends.php" id="my_friends"><i class="bi-people-fill"></i> My Friends</a>
            <div class="dropdown clicked-dropdown navlist">
                <button onclick="uploadDropdownFunction()" class="dropbtn" id="upload"><i
                            class="bi bi-cloud-arrow-up-fill"></i> Upload <span style="float: right;"
                                                                                id="upload_dropdown_chevron"
                                                                                class="bi bi-chevron-down"></span>
                </button>
                <div id="upload_dropdown_content" class="dropdown-content navlist">
                    <a href="pic_upload.php">Pictures</a>
                    <a href="article_upload.php">Articles</a>
                </div>
            </div>

            <a class="navlist" href="change_password.php" id="change_password"><i class="bi bi-pencil-square"></i>
                Change Password</a>
            <a class="navlist" href="logout.php" id="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
        <?php
        } else {
        ?>
            <a class="navlist" onclick="document.getElementById('modalSignUp').style.display = 'block'" id="signup"
               style="cursor: pointer;"><i class="bi bi-person-fill"></i>
                Sign Up</a>

            <div class="clicked-dropdown navlist">
                <button onclick="loginDropdownFunction()" class="dropbtn" id="login"><i
                            class="bi bi-box-arrow-in-right"></i> Login <span style="float: right;"
                                                                              id="login_dropdown_chevron"
                                                                              class="bi bi-chevron-down"></span>
                </button>
                <div id="login_dropdown_content" class="dropdown-content" style="right: 0; width: 250px;">
                    <form id="headerLoginForm" method="POST" , action="login_script.php">
                        <div class="login-dropdown-container">

                            <label for="email"><b>Email</b></label>
                            <input class="login-dropdown-input" type="email" placeholder="Enter Valid Email"
                                   name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">

                            <label for="password"><b>Password</b></label>
                            <input class="login-dropdown-input" type="password"
                                   placeholder="Password (Min. 6 characters)" name="password" required pattern=".{6,}">

                            <label class="checkbox_container"
                                   style="color: #000; text-align: left; width: 60%; display: inline-block;"> Remember
                                me
                                <input type="checkbox" name="remember" checked>
                                <span class="checkmark"></span>
                            </label>
                            <button type="submit" class="login-dropdown-button button" style="display: inline-block;">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                window.addEventListener("load", function () {
                    function sendData5() {
                        const XHR5 = new XMLHttpRequest();
                        const FD5 = new FormData(form5);
                        XHR5.addEventListener("load", function (event) {
                            alertBoxFunction(event.target.responseText);
                            const success = "You are logged in successfully!";
                            if (event.target.responseText.match(success)) {
                                setTimeout(locationChange, 1500);
                            }
                        });
                        XHR5.addEventListener("error", function (event) {
                            alert('Oops! Something went wrong.');
                        });
                        XHR5.open("POST", "login_script.php");
                        XHR5.send(FD5);
                    }

                    const form5 = document.getElementById("headerLoginForm");
                    form5.addEventListener("submit", function (event) {
                        event.preventDefault();

                        sendData5();
                    });
                });
            </script>
            <script>
                function loginDropdownFunction() {
                    document.getElementById("login_dropdown_content").classList.toggle("show_login_content");
                    document.getElementById("login_dropdown_chevron").classList.toggle("bi-chevron-up");
                    document.getElementById("login_dropdown_chevron").classList.toggle("bi-chevron-down");
                }

                function locationChange() {
                    location.href = 'index.php';
                }
            </script>

            <?php
        }
        ?>

        <div class="dropdown clicked-dropdown navlist">
            <button onclick="settingsDropdownFunction()" class="dropbtn" id="settings"><i class="bi bi-gear-fill"></i>
                Settings <span style="float: right;" id="settings_dropdown_chevron" class="bi bi-chevron-down"></span>
            </button>
            <div id="settings_dropdown_content" class="dropdown-content navlist">
                <a href="general_settings.php">General Settings</a>
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <a href="my_profile.php">Account Settings</a>
                    <a href="privacy_settings.php">Privacy Settings</a>
                    <?php
                }
                ?>
            </div>
        </div>

        <a class="navlist" href="about_us.php" id="about_us"><i class="bi bi-info-circle-fill"></i> About Us</a>

    </div>
</div>

<!-- Top Navigation Bar -->
<div class="my-navbar" id="myNavbar">

    <div class="my-navbar-header">

        <button class="hamburger-button" type="button" onclick="openSideNav()" title="Side Bar">
            <i class="bi bi-list"></i>
        </button>

        <a class="my-navbar-brand" id="home" href="index.php"><i class="bi bi-house-door-fill"></i></a>
        <a class="my-navbar-brand" id="friend_requests" href="friend_requests.php"><i
                    class="bi bi-person-plus-fill"></i></a>
        <a class="my-navbar-brand" id="chats" href="chat_heads.php"><i class="bi bi-chat-text-fill"></i></span></a>
        <a class="my-navbar-brand" id="pictures" href="picture_categories.php"><i class="bi bi-image-fill"></i></a>
        <a class="my-navbar-brand" id="articles" href="article_categories.php?id=english"><i
                    class="bi bi-book-half"></i></a>
    </div>
</div>


<button onclick="topFunction()" id="myBtn" title="Go to top"><span class="bi bi-chevron-double-up"></span></button>

<div id="modalSignUp" class="modal-sign-up">
    <form id="headerSignupForm" class="modal-content-sign-up" method="POST" action="signup_script.php">
        <div class="signup-modal-container">
            <h1 style="display: inline-block;">Sign Up</h1>
            <span style="z-index: 2; display: inline-block; float: right;"
                  onclick="document.getElementById('modalSignUp').style.display = 'none'" class="close-sign-up"
                  title="Close Signup Modal"><span style="color: #000;" class="bi bi-x-circle"></span></span>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="name"><b>Name</b></label>
            <input class="signup-modal-input" type="text" placeholder="Enter Name" name="name" minlength="1" required>

            <label for="email"><b>Email</b></label>
            <input class="signup-modal-input" type="email" placeholder="Enter Valid Email" name="email" required
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">

            <label for="password"><b>Password</b></label>
            <input class="signup-modal-input" type="password" placeholder="Password (Min. 6 characters)" name="password"
                   required pattern=".{6,}">

            <label for="phone"><b>Mobile Number</b></label>
            <input class="signup-modal-input" type="tel" placeholder="Enter Valid Phone Number (Ex: 9044291375)"
                   maxlength="10" name="phone" required pattern="[0-9]{10}">

            <label class="checkbox_container"
                   style="color: #000; text-align: left; width: 60%; display: inline-block; margin-bottom: 15px;">
                Remember me
                <input type="checkbox" name="remember" checked>
                <span class="checkmark"></span>
            </label>

            <p>By creating an account you agree to our <a href="privacy_policy.php" style="color: #ec407a">Terms &
                    Privacy</a>.</p>

            <div class="clearfix">
                <button type="button" onclick="document.getElementById('modalSignUp').style.display = 'none'"
                        class="cancelbtn-sign-up">Cancel
                </button>
                <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </div>
    </form>
</div>

<script>
    var modal_sign_up = document.getElementById('modalSignUp');

    window.onclick = function (event) {
        if (event.target == modal_sign_up) {
            modal_sign_up.style.display = "none";
        }
    }
</script>

<script>
    window.addEventListener("load", function () {
        function sendData4() {
            const XHR4 = new XMLHttpRequest();
            const FD4 = new FormData(form4);
            XHR4.addEventListener("load", function (event) {
                alertBoxFunction(event.target.responseText);
                const success = "You are logged in successfully!";
                if (event.target.responseText.match(success)) {
                    setTimeout(locationChange, 1500);
                }
            });
            XHR4.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
            });
            XHR4.open("POST", "signup_script.php");
            XHR4.send(FD4);
        }

        const form4 = document.getElementById("headerSignupForm");
        form4.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData4();
        });
    });
</script>

<script>
    /* When the user clicks on the button, 
     toggle between hiding and showing the dropdown content */
    function uploadDropdownFunction() {
        document.getElementById("upload_dropdown_content").classList.toggle("show_upload_content");
        document.getElementById("upload_dropdown_chevron").classList.toggle("bi-chevron-up");
        document.getElementById("upload_dropdown_chevron").classList.toggle("bi-chevron-down");
    }

    function settingsDropdownFunction() {
        document.getElementById("settings_dropdown_content").classList.toggle("show_settings_content");
        document.getElementById("settings_dropdown_chevron").classList.toggle("bi-chevron-up");
        document.getElementById("settings_dropdown_chevron").classList.toggle("bi-chevron-down");
    }

</script>
<script>
    function openSideNav() {
        document.getElementById("mainSidenav").style.left = "0px";
        document.getElementById("mainBackSidenav").style.backgroundColor = "rgba(0,0,0,0.4)";
        document.getElementById("mainBackSidenav").style.width = "100%";
    }

    function closeSideNav() {
        document.getElementById("mainSidenav").style.left = "-250px";
        document.getElementById("mainBackSidenav").style.backgroundColor = "rgba(0,0,0,0)";
        document.getElementById("mainBackSidenav").style.width = "0%";
    }
</script>

</script>
<?php
include 'includes/alert_box.php';
?>