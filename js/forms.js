function formhash(form, password) {
    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    // Finally submit the form.
    form.submit();
}

function updateFormHash(form, uid, email, password, conf) {
    $("#username").removeClass("error");
	$("#email").removeClass("error");
	$("#password").removeClass("error");
	$("#confirmpwd").removeClass("error");

	if (uid.value == '') {
		uid.className += " error";
		enterErrorText("Please enter a Username");
		uid.focus();
		return false;
	}

	if (email.value == '') {
		email.className += " error";
		enterErrorText("Please enter an Email");
		email.focus();
		return false;
	}

    if (password.value != '') {
        if (conf.value == '') {
            conf.className += " error";
            enterErrorText("Please confirm your Password");
            conf.focus();
            return false;
        }
        if (password.value.length < 6) {
            enterErrorText('Passwords must be at least 6 characters long.  Please try again');
            form.password.focus();
            form.password.className += " error";
            return false;
        }

        var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        if (!re.test(password.value)) {
            enterErrorText('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
            password.className += " error";
            password.focus();
            return false;
        }

        if (password.value != conf.value) {
            enterErrorText('Your password and confirmation do not match. Please try again');
            form.password.focus();
            form.password.className += " error";
            return false;
        }
    }

    re = /^\w+$/;
    if(!re.test(form.username.value)) {
        enterErrorText("Username must contain only letters, numbers and underscores. Please try again");
        form.username.focus();
		form.username.className += " error";
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    if (password.value != '') {
        p.value = hex_sha512(password.value);
    } else {
        p.value = '';
    }

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";
    // Finally submit the form.
    form.submit();
    return true;
}

function regformhash(form, uid, email, password, conf) {
	$("#username").removeClass("error");
	$("#email").removeClass("error");
	$("#password").removeClass("error");
	$("#confirmpwd").removeClass("error");

     // Check each field has a value
    /*if (uid.value == ''         ||
          email.value == ''     ||
          password.value == ''  ||
          conf.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }*/
	if (uid.value == '') {
		uid.className += " error";
		enterErrorText("Please enter a Username");
		uid.focus();
		return false;
	}

	if (email.value == '') {
		email.className += " error";
		enterErrorText("Please enter an Email");
		email.focus();
		return false;
	}

	if (password.value == '') {
		password.className += " error";
		enterErrorText("Please enter a Password");
		password.focus();
		return false;
	}

	if (conf.value == '') {
		conf.className += " error";
		enterErrorText("Please confirm your Password");
		conf.focus();
		return false;
	}

    // Check the username

    re = /^\w+$/;
    if(!re.test(form.username.value)) {
        enterErrorText("Username must contain only letters, numbers and underscores. Please try again");
        form.username.focus();
		form.username.className += " error";
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        enterErrorText('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        form.password.className += " error";
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(password.value)) {
        enterErrorText('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        password.className += " error";
        password.focus();
        return false;
    }

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        enterErrorText('Your password and confirmation do not match. Please try again');
        form.password.focus();
        form.password.className += " error";
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";
    console.log("test");
    // Finally submit the form.
    form.submit();
    return true;
}

function enterErrorText(text) {
    console.log(text);
    $(".errormsg").text(text);
	$(".errormsg").removeClass("hideError");
}
