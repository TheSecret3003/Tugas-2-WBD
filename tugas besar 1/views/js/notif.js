var pos = false;
function turnover() {
    var notif = document.getElementById("ac");
    if (pos) {
        notif.style.zIndex = "-100";
        notif.style.display = "none";
        console.log("atas");
        pos = false;
    }
    else {
        notif.style.zIndex = "2";
        notif.style.display = "block";
        pos = true;
        console.log("bawah");
    }
}

function makeTransaction() {
    var user_id = document.getElementById("user-id").innerHTML;
    var book_id = document.getElementById("book-id").innerHTML;
    var number_books = document.getElementById("nb-of-books").value;
    console.log(user_id, book_id, number_books);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText != "kacau") {
                document.getElementById("transactione").innerHTML = "Nomor Transaksi : " + this.responseText;
                turnover();
            }
        }
    };
    xmlhttp.open("GET", "include/transaction.php?user=" + user_id + "&book=" + book_id + "&number=" + number_books, true);
    xmlhttp.send();
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}