<style>
    .alertBoxModal {
        display: block;
        position: fixed; /* Stay in place */
        z-index: 151; /* Sit on top */
        left: 0;
        top: 0;
        width: 0%; /* Full width */
        height: 100%; /* Full height */
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .alertBoxContent {
        background-color: #ec407a;
        color: #fff;
        z-index: 151;
        text-align: center;
        position: fixed;
        margin: 0 10%;
        padding: 20px;
        width: 80%;
        height: 100px;
        top: -100px;
        transition: top 0.5s;
    }
</style>

<div id="alertBoxModal" class="alertBoxModal" onclick="alertBoxModelFunction()">
    <div id="alertBoxContent" class="alertBoxContent">
        <p id="alertBoxMessage">Some text in the Modal..</p>
    </div>
</div>

<script>
    var alertModal = document.getElementById("alertBoxModal");
    var alertContent = document.getElementById("alertBoxContent");
    var alertMessage = document.getElementById("alertBoxMessage");

    function alertBoxFunction(message) {
        alertMessage.innerHTML = message;
        alertModal.style.width = "100%";
        alertContent.style.top = "100px";
    }

    function alertBoxModelFunction() {
        alertModal.style.width = "0%";
        alertContent.style.top = "-200px";
    }
</script>