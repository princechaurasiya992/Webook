document.getElementById("articles").classList.add("active");

var article_field = document.getElementById("article_field");

function zoom_inFunction() {
    article_field.style.fontSize = (parseFloat(article_field.style.fontSize) + 5) + "px";
}

function zoom_outFunction() {
    article_field.style.fontSize = (parseFloat(article_field.style.fontSize) - 5) + "px";
}

function fontFunction(language) {
    if (document.getElementById("article_field").style.fontFamily !== "NotoSans-Regular") {
        document.getElementById("article_field").style.fontFamily = "NotoSans-Regular";
    } else if (language == "hindi") {
        document.getElementById("article_field").style.fontFamily = "Karma-Regular";
    } else {
        document.getElementById("article_field").style.fontFamily = "ProximaNova-Regular";
}
}

function italicFunction() {
    if (document.getElementById("article_field").style.fontStyle !== "italic") {
        document.getElementById("article_field").style.fontStyle = "italic";
    } else {
        document.getElementById("article_field").style.fontStyle = "normal";
    }
}

function boldFunction() {
    if (document.getElementById("article_field").style.fontWeight !== "bold") {
        document.getElementById("article_field").style.fontWeight = "bold";
    } else {
        document.getElementById("article_field").style.fontWeight = "normal";
    }
}

function refreshFunction(language) {
    article_field.style.fontSize = "20px";
    if (language == "hindi") {
        document.getElementById("article_field").style.fontFamily = "NotoSans-Regular";
    } else {
        document.getElementById("article_field").style.fontFamily = "ProximaNova-Regular";
    }
document.getElementById("article_field").style.fontStyle = "normal";
document.getElementById("article_field").style.fontWeight = "normal";
}