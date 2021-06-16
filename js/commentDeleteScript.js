function deleteCommentFunction(p_id, c_id, content_type, is_logged_in) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alertBoxFunction(this.responseText);
            commentBoxRefreshFunction(p_id, content_type, is_logged_in);
        }
    };
    xhttp.open("POST", "comment_delete_script.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("p_id=" + p_id + "&c_id=" + c_id + "&content_type=" + content_type);
}