function refreshRatingContainerFunction(article_id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("user_rating_container").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "rating_refresh_script.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("article_id=" + article_id);
}
