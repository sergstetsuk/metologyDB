$(function () {

    $.ajax({
        type: "GET",
        url: "/cathedras/"
    }).done(function (cathedras) {

        cathedras.unshift({ id: "0", name: "" });

        $("#jsGrid").jsGrid({
            height: "70%",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete device?",
            controller: {
                loadData: function (filter) {
                    return $.ajax({
                        type: "GET",
                        url: "/devices/",
                        data: filter
                    });
                },
                insertItem: function (item) {
                    return $.ajax({
                        type: "POST",
                        url: "/devices/",
                        data: item
                    });
                },
                updateItem: function (item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/devices/",
                        data: item
                    });
                },
                deleteItem: function (item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/devices/",
                        data: item
                    });
                }
            },
            fields: [
                { name: "cathedra", title: "Кафедра", type: "select", width: 150, items: cathedras, valueField: "id", textField: "name" },
                { name: "type", title: "Тип", type: "select", width: 150 },
                { name: "model", title: "Модель", type: "select", width: 150, filtering: true },
                { name: "serial", title: "Серійний Номер", type: "text", width: 100 },
                { name: "manufacture", title: "Дата виробництва", type: "text", sorting: true, filtering: true },
                { name: "dateIntoEx", title: "Введення в експлуатацію", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                { name: "status", title: "Статус", type: "select", width: 100, items: cathedras, valueField: "id", textField: "name" },
                { name: "prevVeryf", title: "попередня повірка", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                { name: "nextVeryf", title: "Наступна повірка", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                { type: "control" }
            ]
        });

    });


});
