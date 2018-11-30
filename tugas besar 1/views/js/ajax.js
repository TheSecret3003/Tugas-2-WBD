var checkUser = false;
var checkEmail = false;
var checkPassword = false;
var checkPhone = false;
var checkCardNumber = false;
var checkList = document.createElement('img');
checkList.src = "../img/checklist.png";
checkList.width = 20;
checkList.height = 20;
var anotherCheckList = document.createElement('img');
anotherCheckList.src = "../img/checklist.png";
anotherCheckList.width = 20;
anotherCheckList.height = 20;


function checkUserEmail() {
    var usr = document.getElementById("email");
    var term = usr.value;
    var re = new RegExp("[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,3}$");
    if (re.test(term)) {
        console.log("Valid");
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText == "aman") {
                    usr.style.marginRight = 0;
                    document.getElementById("input-email").appendChild(checkList);
                    checkEmail = true;
                }
                else {
                    usr.style.marginRight = "29px";
                    document.getElementById("input-email").removeChild(checkList);
                    checkEmail = false;
                }
            }
            else {
                checkEmail = false;
            }
        };
        xhttp.open("GET", "include/check_email.php?email=".concat(usr.value), true);
        xhttp.send();
    } else {
        console.log("Invalid");
    }
}

function checkPhonePattern() {
    var e = document.getElementById("phone_number");
    var val = e.value;
    var re = new RegExp("[0-9]{9,12}$");
    if (re.test(val)) {
        checkPhone = true;
    }
    else {
        checkPhone = false;
    }
}

function checkUserName() {
    var usr = document.getElementById("username");
    var term = usr.value;
    var re = new RegExp("[a-z0-9A-Z]{1,20}$");
    if (re.test(term)) {
        console.log("Valid");
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText == "aman") {
                    usr.style.marginRight = 0;
                    document.getElementById("input-username").appendChild(anotherCheckList);
                    checkUser = true;
                }
                else {
                    usr.style.marginRight = "29px";
                    document.getElementById("input-username").removeChild(anotherCheckList);
                    checkUser = false;
                }
            }
            else {
                checkUser = false;
            }
        };
        xhttp.open("GET", "include/check_user.php?usr=".concat(usr.value), true);
        xhttp.send();
    } else {
        console.log("Invalid");
        checkUser = false;
    }
}

function checkUserPassword() {
    var pass = document.getElementById("password");
    var pass_con = document.getElementById("confirm_password");

    if (pass.value == pass_con.value) {
        checkPassword = true;
    }
    else {
        checkPassword = false;
    }
}

function checkCardNumber() {
    var card_num = document.getElementById("card_number");
    if (isNaN(0 - card_num)){
        checkCardNumber = false;
        alert("Card number must consist of numbers only");
    } else if (card_number.length != 16){
        checkCardNumber = false;
        alert("Card number length is wrong");
    }
}

function checkValidate() {
    var checkFill = true;
    var x = document.getElementsByClassName("validate");
    var i;
    for (i = 0; i < x.length; i++) {
        if (x[i].value == "") {
            checkFill = false;
        }
    }
    if (!checkFill) {
        alert("You have to fill all of the form");
    }

    return checkFill;
}

function validate() {
    var checkFill = checkValidate();
    if (!checkFill) {
    }
    else if (!checkUser) {
        alert("You're username is not valid");
    }
    else if (!checkEmail) {
        alert("You're email already been taken");
    }
    else if (!checkPassword) {
        alert("You're password doesn't match");
    }
    else if (!checkPhone) {
        alert("Please input a phone number consist of 9-12 numbers");
    } else if (!checkCardNumber) {
        checkCardNumber();
    }

    return checkUser && checkEmail && checkPassword && checkFill && checkPhone && checkCardNumber;
}
