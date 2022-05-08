var userStepper = document.querySelector("#userStepper");
var userStepperInstace = new MStepper(userStepper, app.options.stepper);
$(function () {
    app.options.validation.rules = {
        name: {
            required: true,
        },
        email: {
            required: true,
        },
        /* role_id: {
             required: true
         }, */
    };
    app.options.validation.messages = {
        name: {
            required: "Please enter name",
        },
        email: {
            required: "Please enter email",
        },
        role_id: {
            required: "Please select user role",
        },
    };
    $("#userForm").validate(app.options.validation);

    app.options.validation.rules = {
        password: {
            required: true,
            minlength: 6,
        },
        password_confirm: {
            equalTo: "#password",
        },
    };
    app.options.validation.messages = {
        password: {
            required: "Please enter password",
            minlength: "Password must be minimum of 6 charecters",
        },
        password_confirm: {
            equalTo: "Confirm password does not match",
        },
    };
    $("#userPasswordForm").validate(app.options.validation);

    app.options.select2.ajax.ajax.url = $("#warehouse_id").data("option-url");
    app.options.select2.ajax.minimumInputLength = 0;
    app.options.select2.ajax.ajax.data = function (params) {
        return {
            q: params.term,
        };
    };
    $("#warehouse_id").select2(app.options.select2.ajax);
});
