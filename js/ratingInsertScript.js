function insertRatingFunction(article_id, rating, is_logged_in) {
    if (is_logged_in) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                refreshRatingContainerFunction(article_id);
                alertBoxFunction(this.responseText);
            }
        };
        xhttp.open("POST", "rating_insert_script.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("article_id=" + article_id + "&rating=" + rating);
    } else {
        alertBoxFunction("You need to login first!");
    }
}
