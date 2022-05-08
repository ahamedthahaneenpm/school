$(function () {
    app.options.validation.rules = {
        student_id: {
            required: true,
        },
        maths: {
            required: true,
        },
        sceince: {
            required: true,
        },
        history: {
            required: true,
        },
        term: {
            required: true,
        },
    };
    $("#scoreForm").validate(app.options.validation);
});
