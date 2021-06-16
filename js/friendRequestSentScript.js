sentFriendRequestsFunction();

sentRequestList = document.querySelector(".sentRequestContainer .list-styling");
function sentFriendRequestsFunction(){

    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            sentRequestList.innerHTML = this.responseText;
        }
    };
    xhttp3.open("POST", "sent_friend_requests_script.php", true);
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send();
}