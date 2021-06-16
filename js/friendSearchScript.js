const searchFriendBox = document.querySelector(".search-friend input[type=text]");
searchFriendBtn = document.querySelector(".search-friend button");
searchFriendList = document.querySelector(".searchFriendListContainer .list-styling");

searchFriendBox.onkeyup = function () {
    var searchTerm = searchFriendBox.value;
    if (searchTerm != "") {
        document.getElementById("sentRequestContainer").style.display = "none";
        document.getElementById("receivedRequestContainer").style.display = "none";
        document.getElementById("searchFriendListContainer").style.display = "block";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                searchFriendList.innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "search_new_friend_script.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("searchTerm=" + searchTerm);
    } else {
        document.getElementById("sentRequestContainer").style.display = "none";
        document.getElementById("receivedRequestContainer").style.display = "block";
        document.getElementById("searchFriendListContainer").style.display = "none";
    }
};