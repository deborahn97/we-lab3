// Remember Me
function rememberMe() {
    var email = document.forms["user_login"]["email_id"].value;
    var pass = document.forms["user_login"]["password_id"].value;
    var remember_me = document.forms["user_login"]["remember_id"].checked;

    if (!remember_me) {
        setCookies("cemail", "", 0);
        setCookies("cpass", "", 0);
        setCookies("crem", false, 0);

        document.forms["user_login"]["remember_id"].checked = false;

        alert("Preference removed");
    } else {
        if (email == "" || pass == "") {
            document.forms["user_login"]["remember_id"].checked = false;

            alert("Please enter your credentials");
            return false;
        } else {
            setCookies("cemail", email, 30);
            setCookies("cpass", pass, 30);
            setCookies("crem", remember_me, 30);

            alert("Preference stored");
        }
    }
}

// Cookies
function setCookies(cookiename, cookiedata, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));

    var expires = "expires=" + d.toUTCString();
    document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
}

function loadCookies() {
    var email = getCookie("cemail");
    var pass = getCookie("cpass");
    var remember_me = getCookie("crem");

    document.forms["user_login"]["email_id"].value = email;
    document.forms["user_login"]["password_id"].value = pass;
    
    if (remember_me) {
        document.forms["user_login"]["remember_id"].checked = true;
    } else {
        document.forms["user_login"]["remember_id"].checked = false;
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for (var i = 0; i < ca.length; i++) {
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

function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();

    document.cookie = cname + "=;" + expires + ";path=/";
}
    
function acceptCookieConsent() {
    deleteCookie('user_cookie_consent');
    setCookies('user_cookie_consent', 1, 30);
    document.getElementById("cookieNotice").style.display = "none";
}
