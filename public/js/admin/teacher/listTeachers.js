$(function () {
    app.options.datatables.ajax = {
        url: $("#teacherList").data("url"),
        type: "POST",
        data: function (data) {
            data._token = _token;
            data.status = $("#teacher-status").val();
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
        { data: "status", orderable: false, searchable: false },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [[1, "asc"]];
    window.dataTables[$("#teacherList").attr("id")] = $(
        "#teacherList"
    ).DataTable(app.options.datatables);
});
$("#teacherFilterAttribute").on("submit", function (e) {
    e.preventDefault();
    dataTables["teacherList"].ajax.reload();
    return false;
});

$(".reset_search").click(function (e) {
    $(".select2").val(null).trigger("change");
    $(".searchform select").prop("selectedIndex", 0); //Sets the first option as selected
    $("#division_id").empty();
    dataTables["teacherList"].ajax.reload();
    return false;
});
