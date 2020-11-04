$(function () {
    cathedras = null;
    statuses = null;
    devicetypes = null;
    devicemodels = null;

    $.ajax({
        type: "GET",
        url: "/statuses/"
    }).done(function (result) {
        statuses = result;
        start_engine();
    });

    $.ajax({
        type: "GET",
        url: "/devicetypes/"
    }).done(function (result) {
        devicetypes = result;
        start_engine();
    });
    $.ajax({
        type: "GET",
        url: "/devicemodels/"
    }).done(function (result) {
        devicemodels = result;
        start_engine();
    });

    $.ajax({
        type: "GET",
        url: "/cathedras/"
    }).done(function (result) {
        cathedras = result;
        start_engine();
    });

    function start_engine() {
        if (cathedras && statuses && devicetypes && devicemodels) {

            statuses.unshift({ id: "0", name: "----" });
            devicetypes.unshift({ id: "0", name: "----" });
            devicemodels.unshift({ id: "0", name: "----" });
            cathedras.unshift({ id: "0", name: "----" });

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
                    { name: "cathedraid", title: "Кафедра", type: "select", width: 150, items: cathedras, valueField: "id", textField: "name", filtering: true },
                    { name: "typeid", title: "Тип", type: "select", width: 100, items: devicetypes, valueField: "id", textField: "name" },
                    { name: "modelid", title: "Модель", type: "select", width: 150, items: devicemodels, valueField: "id", textField: "name", filtering: true },
                    { name: "serial", title: "Серійний Номер", type: "text", width: 100 },
                    { name: "datemanufacture", title: "Дата виробництва", type: "text", sorting: true, filtering: true },
                    { name: "dateaccept", title: "Введення в експлуатацію", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                    { name: "statusid", title: "Статус", type: "select", width: 100, items: statuses, valueField: "id", textField: "name" },
                    { name: "lastverify", title: "попередня повірка", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                    { name: "nextverify", title: "Наступна повірка", type: "text", width: 100, items: cathedras, valueField: "id", textField: "name" },
                    { type: "control" }

                    //{ name: "cathedraid", title: "Кафедра", type: "text", width: 150},
                    //{ type: "control" }
                ]
            });

        };
    };


});
