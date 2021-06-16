function insertCommentFunction(p_id, content_type, is_logged_in) {
    const XHR8 = new XMLHttpRequest();
    const FD8 = new FormData(commentForm);
    XHR8.addEventListener("load", function (event) {
        alertBoxFunction(this.responseText);
        document.getElementById("commentForm").reset();
        commentBoxRefreshFunction(p_id, content_type, is_logged_in);
    });
    XHR8.addEventListener("error", function (event) {
        alert("Oops! Something went wrong.");
    });
    XHR8.open("POST", "comment_insert_script.php?p_id=" + p_id + "&content_type=" + content_type);
    XHR8.send(FD8);
}

window.addEventListener("load", function () {
    const commentForm = document.getElementById("commentForm");
    commentForm.addEventListener("submit", function (event) {
        event.preventDefault();
    });
});