<script>
    window.onscroll = function () {
        scrollFunction();
        myFunction();
    };
    var content = document.getElementById("content");
    var navbar = document.getElementById("myNavbar");
    var sticky = navbar.offsetTop;

//Get the button
    var mybutton = document.getElementById("myBtn");

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky");
            navbar.style.position = "fixed";
            content.classList.add("content-padding");
        } else {
            navbar.classList.remove("sticky");
            navbar.style.position = "relative";
            content.classList.remove("content-padding");
        }
    }
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    
</script>