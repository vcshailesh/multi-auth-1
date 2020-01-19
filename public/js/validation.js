function isNumberKey(evt) {
    // var charCode = (evt.which) ? evt.which : event.keyCode;
    var charCode = /^[0-9]+$/;
    if (evt.key.match(charCode)) {
        return true;
    } else {
        return false;
    }
}

function isAlphaNumberKey(evt) {

    var letters = /^[0-9a-zA-Z]+$/;

    if (evt.key.match(letters)) {
        return true;
    } else {
        return false;
    }

}

function isAlphaKey(evt) {

    var letters = /^[a-zA-Z]+$/;

    if (evt.key.match(letters)) {
        return true;
    } else {
        return false;
    }

}

function isAlphanumericSpecialCharacters(evt) {
    var password = /^[ A-Za-z0-9_@./#&+-]*$/;

    if (evt.key.match(password)) {
        return true;
    } else {
        return false;
    }
}