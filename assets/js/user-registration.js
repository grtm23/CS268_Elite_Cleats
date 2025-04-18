document.getElementById('signUpForm').addEventListener('submit', function(e) {

    e.preventDefault();

    let valid = true;

    const FirstName = document.getElementById('FirstName').value.trim();

    const LastName = document.getElementById('LastName').value.trim();
    
    const address = document.getElementById('address').value.trim();

    const email = document.getElementById('email').value.trim();

    const phone = document.getElementById('phone').value.trim();

    const verify_em = document.getElementById('verify_em').value.trim();

    const password = document.getElementById('password').value.trim();

    const confirm_pass = document.getElementById('confirm_pass').value.trim();

    if (!FirstName) {

        document.getElementById('FirstName_error').textContent = "First Name is required.";
        
        valid = false;
    }
    else {

        document.getElementById('FirstName_error').textContent = "";

    }

    if (!LastName) {

        document.getElementById('LastName_error').textContent = "Last Name is required.";
        
        valid = false;
    }
    else {

        document.getElementById('LastName_error').textContent = "";

    }

    if (!address) {

        document.getElementById('address_error').textContent = "Street address is required.";
        
        valid = false;
    }
    else {

        document.getElementById('address_error').textContent = "";

    }

    if (!email) {

        document.getElementById('email_error').textContent = "Email is invalid.";
        
        valid = false;
    }
    else {

        document.getElementById('email_error').textContent = "";

    }

    if (!phone) {

        document.getElementById('phone_error').textContent = "Phone number is required -- Format: (###) ###-####";
        
        valid = false;
    }
    else {

        document.getElementById('phone_error').textContent = "";

    }

    if (!verify_em) {

        document.getElementById('verify_em_error').textContent = "Email is invalid.";
        
        valid = false;
    }
    else {

        document.getElementById('verify_em_error').textContent = "";

    }

    /* Email match check */
    if (email != verify_em) {

        document.getElementById('no_match').textContent = "Email does not match.";

        valid = false;

    }
    else {

        document.getElementById('no_match').textContent = "";

    }

    if (!password) {

        document.getElementById('password_error').textContent = "Password is required.";

        valid = false;

    }
    else {

        document.getElementById('password_error').textContent = "";

    }

    if (!confirm_pass) {

        document.getElementById('confirm_pass_error').textContent = "Password is required.";

        valid = false;

    }
    else {

        document.getElementById('confirm_pass_error').textContent = "";

    }

    /* Password match check */
    if (password != confirm_pass) {
        document.getElementById('pass_check').textContent = "Passwords do not match.";

        valid = false;

    }
    else {

        document.getElementById('pass_check').textContent = "";

    }

    if (valid) {

        window.location.href = "products.html"


    }
    
});

