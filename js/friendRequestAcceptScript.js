function acceptFriendRequestFunction(senderId, requestType){
    acceptFriendRequestBtn = document.getElementById("acceptFriendRequestBtn" + senderId);

    var xhttp5 = new XMLHttpRequest();
    xhttp5.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    acceptFriendRequestBtn.innerHTML = this.responseText;
}
};
    xhttp5.open("POST", "accept_friend_request_script.php", true);
    xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp5.send("sender_id=" + senderId + "&request_type=" + requestType);
}