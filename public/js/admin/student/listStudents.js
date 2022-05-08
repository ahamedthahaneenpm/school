$(function () {
    app.options.datatables.ajax = {
        url: $("#studentList").data("url"),
        type: "POST",
        data: function (data) {
            data._token = _token;
            data.status = $("#student-status").val();
            data.teacher_id = $("#teacher_id").val();
        },
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        {
            data: "name",
            name: "name",
            orderable: true,
            searchable: true,
        },
        {
            data: "teacher.name",
            name: "teacher.name",
            orderable: true,
            searchable: true,
        },
        {
            data: "age",
            name: "age",
            orderable: true,
            searchable: true,
        },
        {
            data: "sex",
            name: "sex",
            orderable: true,
            searchable: true,
        },
        { data: "status", orderable: false, searchable: false },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [[1, "asc"]];
    window.dataTables[$("#studentList").attr("id")] = $(
        "#studentList"
    ).DataTable(app.options.datatables);
});
$("#studentFilterAttribute").on("submit", function (e) {
    e.preventDefault();
    dataTables["studentList"].ajax.reload();
    return false;
});

$(".reset_search").click(function (e) {
    $(".select2").val(null).trigger("change");
    $(".searchform select").prop("selectedIndex", 0); //Sets the first option as selected
    $("#division_id").empty();
    dataTables["studentList"].ajax.reload();
    return false;
});
