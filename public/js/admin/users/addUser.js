$(function() {
    app.options.validation.rules = {
        name: {
            required: true
        },
        email: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        },
        password_confirm: {
            required: true,
            equalTo: "#password"
        },
        role_id: {
            required: true
        },
    };
    app.options.validation.messages = {
        name: {
            required: "Please enter name",
        },
        email: {
            required: "Please enter email",
        },
        password: {
            required: "Please enter password",
            minlength: "Password must be minimum of 6 charecters",
        },
        password_confirm: {
            required: 'Please enter password',
            equalTo: "Confirm password does not match"
        },
        role_id: {
            required: "Please select user role",
        },
    }

    $("#userForm").validate(app.options.validation);
});