function commentBoxRefreshFunction(p_id, content_type, is_logged_in) {
    var commentMessage = document.getElementById("commentBoxMessage");

    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (is_logged_in) {
                commentMessage.innerHTML = this.responseText;
            } else {
                alertBoxFunction(this.responseText);
            }
        }
    };
    xhttp3.open("POST", "comment_box_script.php", true);
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send("p_id=" + p_id + "&content_type=" + content_type);
}