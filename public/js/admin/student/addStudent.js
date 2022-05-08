$(function () {
    app.options.validation.rules = {
        name: {
            required: true,
        },
        age: {
            required: true,
        },
        teacher_id: {
            required: true,
        },
    };
    app.options.validation.messages = {
        name: {
            required: "Please enter name",
        },
        age: {
            required: "Please enter age",
        },
        teacher_id: {
            required: "Please select teacher",
        },
    };
    $("#studentForm").validate(app.options.validation);
});
