import * as chart from "./chart.js";

export function select2PieChart() {
    $(".select2-pie-chart").select2();

    $("body").on("change", ".select2-pie-chart", function() {
        // e.preventDefault();

        let data = {
            id: $(this).val()
        };
        $.ajax({
            type: "GET",
            url: "/ajax/pie-chart",
            data: data,
            dataType: "html",
            success: function(response) {
                $("#ajax-pie-chart").html(response);
                let canvas = $("#progress-chart");
                let target = canvas.data("target");
                let tercapai = canvas.data("tercapai");
                let sisa = target - tercapai;
                chart.pieChart(target, tercapai, sisa);
                $(".select2-pie-chart").select2();
            }
        });
    });
}

export function select2ProjectProgress() {
    $(".select2-project-progress").select2();

    $("body").on("change", ".select2-project-progress", function() {
        // e.preventDefault();

        let data = {
            id: $(this).val()
        };
        // console.log(data);
        $.ajax({
            type: "GET",
            url: "/ajax/project-progress",
            data: data,
            dataType: "html",
            success: function(response) {
                $("#ajax-project-progress").html(response);
                // console.log(response);
                $(".select2-project-progress").select2();
            }
        });
    });
}

export function select2ModalTask() {
    $(".select2-add-task").select2({
        dropdownParent: $("#addTaskModal")
    });
}
