function changeRating(e) {
    console.log(e);
    document.getElementById("rating").value = e;
    drawStar(e);
}

function drawStar(e) {
    var x = document.getElementsByClassName("star-image");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].src = "../img/star-regular.png";
    }

    for (i = 0; i < e; i++) {
        x[i].src = "../img/star-solid.png";
    }
}

function reloadStar() {
    drawStar(document.getElementById("rating").value);
}