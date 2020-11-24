// Defining a function to display error message
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var name = document.signup_form.name.value;
    var email = document.signup_form.email.value;
    var password = document.signup_form.password.value;
    var account = document.signup_form.account.value;
    
	// Defining error variables with a default value
    var nameErr = emailErr = passwordErr = accountErr = true;
    
    // Validate name
    if(name == "") {
        alert("Please enter a name");
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }
    
    // Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    
    // Validate mobile number
    if(password == "") {
        printError("mobileErr", "Please enter your mobile number");
    } else {
        var regex = /^[1-9]\d{9}$/;
        if(regex.test(mobile) === false) {
            printError("mobileErr", "Please enter a valid 10 digit mobile number");
        } else{
            printError("mobileErr", "");
            mobileErr = false;
        }
    }
    
    // Validate account
    if(account == "Select") {
        printError("accountErr", "Please select your account");
    } else {
        printError("accountErr", "");
        accountErr = false;
    }
    
    // Prevent the form from being submitted if there are any errors
    if((nameErr || emailErr || passwordErr || accountErr) == true) {
       return false;
    } else {
        return true;
    }
};