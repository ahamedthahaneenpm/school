$(".login-form").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
        }
    },
    messages: {
        useemailrname: {
            required: "Enter a email",
            type: email
        }
    },
    errorElement: 'div',
    errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
    }
});