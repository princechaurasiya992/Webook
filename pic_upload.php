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

$categories = array("adventure", "travel", "beach", "holy_place", "festival", "zoo", "sport");

$categories2 = array("Adventure", "Travel", "Beach", "Holy Place", "Festival", "Zoo", "Sport");

$categories_size = count($categories);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload Picture</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="icons-1.4.0/font/bootstrap-icons.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <style>
            input[type=file] {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 0px;
                box-sizing: border-box;
                resize: vertical;
                background-color: #fff;
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
                    <li><a style="color: black;">Upload Pictures</a></li>
                    </ul>
             <div class="container">     
            <div class="row row_style">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div style="background-color: #ffffff;" class="panel-heading">
                            <h4 class="text-center">Picture Upload</h4>
                        </div>
                        <div class="panel-body">                                          
                            <form method="POST" action="pic_upload_script.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Select Picture:</label>
                                    <input type="file" name="uploadedimage">
                                </div>
                                <?php
                                for ($i =0; $i < $categories_size; $i++) {
	                            ?>
		                        <label class="checkbox_container"><?php echo $categories2[$i]; ?>
                                <input type="checkbox" id="<?php echo $categories[$i]; ?>" name="<?php echo $categories[$i]; ?>">
                          	  <span class="checkmark"></span>
                                </label><br>
                                <?php
                                    }
                                ?>

                                <button type="submit" class="button btn btn-primary btn-block">Upload</button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>            
        </div>
        <?php
        include 'includes/footer.php';
        include 'includes/navbar_script.php';
        ?>
        <script>
            document.getElementById("upload").classList.add("active");
        </script>
        
    </body>
</html>
