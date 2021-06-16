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
                echo("<script>location.href='login.php'</script>");
            }
        }

        $inactive = 30;
        $_SESSION['expire'] = time() + $inactive; // static expire
    }
}
if (!isset($_SESSION['email'])) {
    echo "You need to login first!";
} else {
    $article_id = mysqli_real_escape_string($con, $_POST['article_id']);
    $user_id = $_SESSION["id"];
    $output = "";
    $rating = 0;

    $one_star = "";
    $two_star = "";
    $three_star = "";
    $four_star = "";
    $five_star = "";

    $one_star2 = "";
    $two_star2 = "";
    $three_star2 = "";
    $four_star2 = "";
    $five_star2 = "";

    $ratings_select_query = "SELECT * FROM user_ratings WHERE article_id = '$article_id'";
    $ratings_selection_result = mysqli_query($con, $ratings_select_query) or die(mysqli_error($con));
    $total_ratings = mysqli_num_rows($ratings_selection_result);

    $five_star_select_query = "SELECT * FROM user_ratings WHERE (article_id = '$article_id') & (star = '5')";
    $five_star_selection_result = mysqli_query($con, $five_star_select_query) or die(mysqli_error($con));
    $total_five_stars = mysqli_num_rows($five_star_selection_result);

    $four_star_select_query = "SELECT * FROM user_ratings WHERE (article_id = '$article_id') & (star = 4)";
    $four_star_selection_result = mysqli_query($con, $four_star_select_query) or die(mysqli_error($con));
    $total_four_stars = mysqli_num_rows($four_star_selection_result);

    $three_star_select_query = "SELECT * FROM user_ratings WHERE (article_id = '$article_id') & (star = '3')";
    $three_star_selection_result = mysqli_query($con, $three_star_select_query) or die(mysqli_error($con));
    $total_three_stars = mysqli_num_rows($three_star_selection_result);

    $two_star_select_query = "SELECT * FROM user_ratings WHERE (article_id = '$article_id') & (star = '2')";
    $two_star_selection_result = mysqli_query($con, $two_star_select_query) or die(mysqli_error($con));
    $total_two_stars = mysqli_num_rows($two_star_selection_result);

    $one_star_select_query = "SELECT * FROM user_ratings WHERE (article_id = '$article_id') & (star = '1')";
    $one_star_selection_result = mysqli_query($con, $one_star_select_query) or die(mysqli_error($con));
    $total_one_stars = mysqli_num_rows($one_star_selection_result);

    $user_rating_select_query = "SELECT * FROM user_ratings WHERE article_id = '$article_id' AND user_id = '$user_id'";
    $user_rating_selection_result = mysqli_query($con, $user_rating_select_query) or die(mysqli_error($con));
    if (mysqli_num_rows($user_rating_selection_result) > 0) {
        while ($row = mysqli_fetch_array($user_rating_selection_result)) {
            if ($row["star"] >= 1) {
                $one_star = "-fill checked";
            }
            if ($row["star"] >= 2) {
                $two_star = "-fill checked";
            }
            if ($row["star"] >= 3) {
                $three_star = "-fill checked";
            }
            if ($row["star"] >= 4) {
                $four_star = "-fill checked";
            }
            if ($row["star"] == 5) {
                $five_star = "-fill checked";
            }
        }
        $output = '<p>You have rated this article...</p>
            <span class="bi bi-star'. $one_star .' star-big-size" onclick="insertRatingFunction('.$article_id.', 1, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star'. $two_star .' star-big-size" onclick="insertRatingFunction('.$article_id.', 2, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star'. $three_star .' star-big-size" onclick="insertRatingFunction('.$article_id.', 3, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star'. $four_star .' star-big-size" onclick="insertRatingFunction('.$article_id.', 4, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star'. $five_star .' star-big-size" onclick="insertRatingFunction('.$article_id.', 5, '.isset($_SESSION['email']).')"></span>
            <br><br>';
    } else {
        $output = '<p>Rate this article...</p>
            <span class="bi bi-star star-big-size" onclick="insertRatingFunction('.$article_id.', 1, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star star-big-size" onclick="insertRatingFunction('.$article_id.', 2, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star star-big-size" onclick="insertRatingFunction('.$article_id.', 3, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star star-big-size" onclick="insertRatingFunction('.$article_id.', 4, '.isset($_SESSION['email']).')"></span>
            <span class="bi bi-star star-big-size" onclick="insertRatingFunction('.$article_id.', 5, '.isset($_SESSION['email']).')"></span>
            <br><br>';
    }

    if ($total_ratings == 0) {
        $rating = 0;
    } else {
        $rating = (5 * $total_five_stars + 4 * $total_four_stars + 3 * $total_three_stars + 2 * $total_two_stars + 1 * $total_one_stars) / $total_ratings;
    }

    if ($rating >= 1) {
        $one_star2 = "-fill checked";
    }
    if ($rating >= 2) {
        $two_star2 = "-fill checked";
    }
    if ($rating >= 3) {
        $three_star2 = "-fill checked";
    }
    if ($rating >= 4) {
        $four_star2 = "-fill checked";
    }
    if ($rating == 5) {
        $five_star2 = "-fill checked";
    }

    if ($rating > 1 && $rating < 2) {
        $two_star2 = "-half checked";
    }
    if ($rating > 2 && $rating < 3) {
        $three_star2 = "-half checked";
    }
    if ($rating > 3 && $rating < 4) {
        $four_star2 = "-half checked";
    }
    if ($rating > 4 && $rating < 5) {
        $five_star2 = "-half checked";
    }

    if ($total_ratings == 0) {
        $bar_5_width = 0;
        $bar_4_width = 0;
        $bar_3_width = 0;
        $bar_2_width = 0;
        $bar_1_width = 0;
    } else {
        $bar_5_width = $total_five_stars / $total_ratings * 100;
        $bar_4_width = $total_four_stars / $total_ratings * 100;
        $bar_3_width = $total_three_stars / $total_ratings * 100;
        $bar_2_width = $total_two_stars / $total_ratings * 100;
        $bar_1_width = $total_one_stars / $total_ratings * 100;
    }

    $output .= '<span class="heading">User Rating</span>
            <span class="bi bi-star'. $one_star2 .' star-normal-size"></span>
            <span class="bi bi-star'. $two_star2 .' star-normal-size"></span>
            <span class="bi bi-star'. $three_star2 .' star-normal-size"></span>
            <span class="bi bi-star'. $four_star2 .' star-normal-size"></span>
            <span class="bi bi-star'. $five_star2 .' star-normal-size"></span>
            <p>'. number_format(round($rating, 1), 1) .' average based on '.$total_ratings.' ratings.</p>
            <hr style="border:3px solid #f1f1f1">

            <div class="custom_row">
                <div class="side">
                    <p><span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        5 star
                    </p>
                </div>

                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-5" style="width: '. $bar_5_width .'%"></div>
                    </div>
                </div>
                <div class="side right">
                    <div>'.$total_five_stars.'</div>
                </div>
                <div class="side">
                    <div><span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        4 star
                    </div>
                </div>

                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-4" style="width: '. $bar_4_width .'%"></div>
                    </div>
                </div>
                <div class="side right">
                    <div>'.$total_four_stars.'</div>
                </div>
                <div class="side">
                    <div><span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        3 star
                    </div>
                </div>

                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-3" style="width: '. $bar_3_width .'%"></div>
                    </div>
                </div>
                <div class="side right">
                    <div>'.$total_three_stars.'</div>
                </div>
                <div class="side">
                    <div><span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        2 star
                    </div>
                </div>

                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-2" style="width: '. $bar_2_width .'%"></div>
                    </div>
                </div>
                <div class="side right">
                    <div>'.$total_two_stars.'</div>
                </div>
                <div class="side">
                    <div><span class="bi bi-star-fill checked star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        <span class="bi bi-star star-normal-size"></span>
                        1 star
                    </div>
                </div>

                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-1" style="width: '. $bar_1_width .'%"></div>
                    </div>
                </div>

                <div class="side right">
                    <div>'.$total_one_stars.'</div>
                </div>
            </div>';
    echo $output;
}
