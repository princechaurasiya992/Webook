receivedFriendRequestsFunction();

receivedRequestList = document.querySelector(".receivedRequestContainer .list-styling");
function receivedFriendRequestsFunction(){

    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            receivedRequestList.innerHTML = this.responseText;
        }
    };
    xhttp4.open("POST", "received_friend_requests_script.php", true);
    xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp4.send();
}