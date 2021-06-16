function sendFriendRequestFunction(receiverId) {
    sendFriendRequestBtn = document.getElementById("sendFriendRequestBtn" + receiverId);

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            sendFriendRequestBtn.innerHTML = this.responseText;
            sentFriendRequestsFunction();
        }
    };
    xhttp2.open("POST", "send_friend_request_script.php", true);
    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp2.send("receiver_id=" + receiverId);
}