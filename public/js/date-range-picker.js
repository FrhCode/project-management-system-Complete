import * as func from "./func.js";

export function modalAdd() {
    $("#add_project_project_date").daterangepicker({
        ranges: {
            Today: [moment(), moment()],
            Tomorrow: [moment(), moment().add(1, "days")],
            "Next 7 Days": [moment(), moment().add(7, "days")],
            "Next 30 Days": [moment(), moment().add(30, "days")],
            "This Month": [moment(), moment().endOf("month")],
            "Next Month": [
                moment(),
                moment()
                    .add(1, "month")
                    .endOf("month")
            ]
        },
        startDate: moment(),
        endDate: moment(),
        minDate: moment().format("MM/DD/YYYY"),
        maxDate: moment()
            .endOf("YEAR")
            .format("MM/DD/YYYY"),
        drops: "up"
    });
}

export function modalTask() {
    $("#add_task_task_date").daterangepicker({
        ranges: {
            Today: [moment(), moment()],
            Tomorrow: [moment(), moment().add(1, "days")],
            "Next 7 Days": [moment(), moment().add(7, "days")],
            "Next 30 Days": [moment(), moment().add(30, "days")],
            "This Month": [moment(), moment().endOf("month")],
            "Next Month": [
                moment(),
                moment()
                    .add(1, "month")
                    .endOf("month")
            ]
        },
        startDate: moment(),
        endDate: moment(),
        minDate: moment()
            .startOf("YEAR")
            .format("MM/DD/YYYY"),
        maxDate: moment()
            .endOf("YEAR")
            .format("MM/DD/YYYY"),
        drops: "up"
    });
}

export function projectCreate() {
    $("#project-deadline").daterangepicker({
        startDate: moment(),
        endDate: moment(),
        minDate: moment()
            .add(1, "days")
            .format("DD/MMMM/YYYY"),
        drops: "up",
        locale: {
            format: "DD/MMMM/YYYY"
        },
        showDropdowns: true,
        alwaysShowCalendars: true,
        singleDatePicker: true
    });

    // Ngasih tulisan selisih disampingnya data berubah
    $("#project-deadline").change(function (e) {
        let start = moment();
        let end = moment($(this).val(), "DD/MMMM/YYYY");
        $(this)
            .next()
            .children()
            .html(end.diff(start, "days") + " Days");

        if (end.diff(start, "Hour") > 24) {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "days") + " Hari");
        } else {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "Hour") + " Jam");
        }
    });

    // Ngasih tulisan selisih disampingnya saat init
    let start = moment();
    let end = moment($("#project-deadline").val(), "DD/MMMM/YYYY");
    if (end.diff(start, "Hour") > 24) {
        $(".project--dateDiff")
            .first()
            .html(end.diff(start, "days") + " Hari");
    } else {
        $(".project--dateDiff")
            .first()
            .html(end.diff(start, "Hour") + " Jam");
    }
}

export function projectEdit(startDate, minDate) {
    $("#project-deadline").daterangepicker({
        startDate: startDate,
        minDate: minDate,
        drops: "up",
        locale: {
            format: "DD/MMMM/YYYY"
        },
        showDropdowns: true,
        alwaysShowCalendars: true,
        singleDatePicker: true
    });

    // Ngasih tulisan selisih disampingnya data berubah
    $("#project-deadline").change(function (e) {
        let start = moment();
        let end = moment($(this).val(), "DD/MMMM/YYYY");
        $(this)
            .next()
            .children()
            .html(end.diff(start, "days") + " Days");

        if (end.diff(start, "Hour") > 24) {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "days") + " Hari");
        } else {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "Hour") + " Jam");
        }
    });

    // Ngasih tulisan selisih disampingnya saat init
    let start = moment();
    let end = moment($("#project-deadline").val(), "DD/MMMM/YYYY");
    if (end.diff(start, "Hour") > 24) {
        $(".project--dateDiff")
            .first()
            .html(end.diff(start, "days") + " Hari");
    } else {
        $(".project--dateDiff")
            .first()
            .html(end.diff(start, "Hour") + " Jam");
    }
}

export function taskEdit(startDate, maxDate) {
    $("#task-deadline").daterangepicker({
        startDate: startDate,
        minDate: moment().format('DD/MMMM/YYYY'),
        maxDate: moment(maxDate).format('DD/MMMM/YYYY'),
        drops: "up",
        locale: {
            format: "DD/MMMM/YYYY"
        },
        showDropdowns: true,
        alwaysShowCalendars: true,
        singleDatePicker: true
    });

    // Ngasih tulisan selisih disampingnya data berubah
    $("#task-deadline").change(function (e) {
        let start = moment();
        let end = moment($(this).val(), "DD/MMMM/YYYY");
        $(this)
            .next()
            .children()
            .html(end.diff(start, "days") + " Days");

        if (end.diff(start, "Hour") > 24) {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "days") + " Hari");
        } else {
            $(this)
                .next()
                .children()
                .html(end.diff(start, "Hour") + " Jam");
        }
    });

    // Ngasih tulisan selisih disampingnya saat init
    let start = moment();
    let end = moment($("#task-deadline").val(), "DD/MMMM/YYYY");
    if (end.diff(start, "Hour") > 24) {
        $(".task--dateDiff")
            .first()
            .html(end.diff(start, "days") + " Hari");
    } else {
        $(".task--dateDiff")
            .first()
            .html(end.diff(start, "Hour") + " Jam");
    }
}

export function taskDeadline(maxDate, element = $(".project-task-deadline")) {
    element
        .first()
        .daterangepicker({
            startDate: moment(),
            minDate: moment()
                .add(1, "Days")
                .format("DD/MMMM/YYYY"),
            maxDate: moment(maxDate, "DD/MMMM/YYYY").format("DD/MMMM/YYYY"),
            drops: "down",
            locale: {
                format: "DD/MMMM/YYYY"
            },
            showDropdowns: true,
            alwaysShowCalendars: true,
            singleDatePicker: true
        });

    element.change(function (e) {
        // console.log(this);
        let start = moment();
        let end = moment($(this).val(), "DD/MMMM/YYYY");
        if (end.diff(start, "Hour") > 24) {
            return $(this)
                .next()
                .children()
                .html(end.diff(start, "days") + " Hari");
        }
        return $(this)
            .next()
            .children()
            .html(end.diff(start, "Hour") + " Jam");
    });
    // Ngasih tulisan selisih disampingnya saat init
    let start = moment();
    let end = moment(element.val(), "DD/MMMM/YYYY");
    if (end.diff(start, "Hour") > 24) {
        $(".task--dateDiff")
            .html(end.diff(start, "days") + " Hari");
    } else {
        $(".task--dateDiff")
            .html(end.diff(start, "Hour") + " Jam");
    }

}
