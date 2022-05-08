$(function () {
    app.options.datatables.ajax = {
        url: $("#scoreList").data("url"),
        type: "POST",
        data: function (data) {
            data._token = _token;
            data.status = $("#score-status").val();
        },
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        {
            data: "student.name",
            name: "student.name",
            orderable: true,
            searchable: true,
        },
        {
            data: "maths",
            name: "maths",
            orderable: true,
            searchable: true,
        },
        {
            data: "sceince",
            name: "sceince",
            orderable: true,
            searchable: true,
        },
        {
            data: "history",
            name: "history",
            orderable: true,
            searchable: true,
        },
        {
            data: "term",
            name: "term",
            orderable: true,
            searchable: true,
        },
        {
            data: "total",
            name: "total",
            orderable: true,
            searchable: true,
        },
        {
            data: "created",
            name: "created",
            orderable: true,
            searchable: true,
        },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [[1, "asc"]];
    window.dataTables[$("#scoreList").attr("id")] = $("#scoreList").DataTable(
        app.options.datatables
    );
});
$("#scoreFilterAttribute").on("submit", function (e) {
    e.preventDefault();
    dataTables["scoreList"].ajax.reload();
    return false;
});

$(".reset_search").click(function (e) {
    $(".select2").val(null).trigger("change");
    $(".searchform select").prop("selectedIndex", 0); //Sets the first option as selected
    $("#division_id").empty();
    dataTables["scoreList"].ajax.reload();
    return false;
});
