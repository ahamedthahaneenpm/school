$(function () {
    app.options.validation.rules = {
        name: {
            required: true,
        },
    };
    app.options.validation.messages = {
        name: {
            required: "Please enter name",
        },
    };
    $("#teacherForm").validate(app.options.validation);
});
