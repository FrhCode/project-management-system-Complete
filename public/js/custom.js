import * as activeLink from "./activeLink.js";
import * as summernote from "./summernote.js";
import * as modal from "./modal.js";
import * as daterangepicker from "./date-range-picker.js";
import * as select2 from "./select2.js";
import * as dropzone from "./dropzone.js";
import * as numberInput from "./numberInput.js";
import * as chart from "./chart.js";
import * as projectAddTask from "./project-addTask.js";
import * as func from "./func.js";
// import *
//dropzone.init();
$(document).ready(function () {

    $.fn.extend({
        toggleText: function (a, b) {
            return this.text(this.text() == b ? a : b);
        }
    });
    // $(".post").removeClass("d-none");

    activeLink.init();

    modal.addModalTask();

    daterangepicker.modalAdd();

    daterangepicker.modalTask();

    // dropzone.addTask();

    //Pie Chart in home && task-detail

    //EndPie Chart in home

    // $("#tableProject,#tableProjectProgress").DataTable();

    // Bikin semua input type number jadi bener

    // Logic BTN Plus add task

    $("form").submit(function (e) {
        $(":disabled").each(function (e) {
            $(this).removeAttr("disabled");
        });
        return true;
    });

    setInterval(function () {
        if (
            $(".dot")
                .first()
                .is(":visible")
        ) {
            $(".dot:visible")
                .last()
                .hide();
        } else {
            $(".dot:hidden")
                .last()
                .show();
        }
    }, 1000);

    // setTimeout(() => {
    //     $('#loader').addClass('hide')
    //     console.log('hi')
    // }, 5000);

    $('[data-toggle="tooltip"]').tooltip();
});
