function pictureOptionBtnFunction(btn_id, block_id) {
    document.getElementById(btn_id).classList.toggle("bi-x");
    document.getElementById(btn_id).classList.toggle("bi-three-dots-vertical");

    const x = document.getElementById(block_id);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}