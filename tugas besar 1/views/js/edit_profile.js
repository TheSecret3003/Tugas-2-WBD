document.getElementById("b-button").addEventListener("click", function(e){
    e.preventDefault();
    window.history.back();
})

function validate() {
    var e = document.getElementById("phone_number");
    var val = e.value;
    var re = new RegExp("[0-9]{9,12}$");
    if (re.test(val)) {
        return true;
    }
    else {
        alert("Please input a phone number consist of 9-12 digits")
        return false;
    }
}