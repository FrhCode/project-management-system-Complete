import * as summernote from "./summernote.js";
import * as daterangepicker from "./date-range-picker.js";
import * as projectAddTask from "./project-addTask.js";
import * as func from "./func.js";

let addTaskHTML;
let taskCounter = 0;
let first = 1;
function addTask(item) {
    let maxDate = $("#project-deadline").val();

    item.parents(".card-header")
        .next()
        .prepend(addTaskHTML);

    $(".task--number")
        .first()
        .html(`Task ${++taskCounter}`);

    if (first) {
        $(".card--add_task")
            .first()
            .show();
        first = 0;
    } else {
        $(".card--add_task")
            .first()
            .show("normal");
    }

    function formatData(data) {
        if (!data.id) {
            return data.text;
        }
        let imgProfile = $(data.element).data("src");
        var $result = $(
            `<span class='d-flex d-flex justify-content-between'>${data.text} <img src="/img/${imgProfile}" style="max-height:60px;"> </span>`
        );
        return $result;
    }

    $(".taskPIC")
        .first()
        .select2({
            placeholder: "Person in charge(PIC)",
            allowClear: true,
            templateResult: formatData,
            templateSelection: formatData
        });
    // summernote.summernoteAddTask();
    daterangepicker.taskDeadline(maxDate);
    // console.log($(".project-task-deadline").first());
    let start = moment();
    let end = moment(
        $(".project-task-deadline")
            .first()
            .val(),
        "DD/MMMM/YYYY"
    );
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

export function init() {
    // Templating form add task
    projectAddTask.setAddTaskHTML(
        $(".card--add_task")
            .parent()
            .html()
    );

    $(".card--add_task")
        .parent()
        .remove();
    // End templating form add task

    // Ketika tombol + kecil yang di bagian add task dipencet
    $("#add-task-for-project").click(function(e) {
        // console.log('hi')
        addTask($(this));
    });
}

export function deleteButton() {
    // Apa yang akan terjadi ketika tombol x pada add task ditekan
    $(document).on("click", ".icon--deleteTask", function() {
        let i = --taskCounter;
        $(this)
            .parents(".card--add_task")
            .hide("normal", function() {
                $(this).remove();
                $(".task--number").each(function() {
                    $(this).html(`Task ${i--}`);
                });
            });
    });
}

export function select2AddTaskEvent() {
    $(document).on("select2:close", ".taskPIC", function(e) {
        $(this)
            .parents(".col-lg-6")
            .first()
            .find("img")
            .addClass("d-none");
    });
}

export function getAddTaskHTML() {
    return addTaskHTML;
}

export function setAddTaskHTML(value) {
    addTaskHTML = value;
}
