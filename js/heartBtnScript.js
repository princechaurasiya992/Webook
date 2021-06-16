function heartButtonFunction(p_id, heart_btn_id, total_hearts_id, is_logged_in) {
    var heartButton = document.getElementById(heart_btn_id);
    var totalHearts = document.getElementById(total_hearts_id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (is_logged_in) {
                heartButton.classList.toggle("bi-heart");
                heartButton.classList.toggle("bi-heart-fill");
                totalHearts.innerHTML = this.responseText;
            } else {
                alertBoxFunction(this.responseText);
            }
        }
    };
    xhttp.open("POST", "heart_button_script.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("p_id=" + p_id);
}