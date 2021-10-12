import * as func from "./func.js";
export function pieChart(target, tercapai, sisa) {
    let pencapaian = [tercapai, sisa];
    const data = {
        labels: ["Tercapai", "Sisa"],
        datasets: [
            {
                data: [tercapai, sisa],
                backgroundColor: ["#007bff", "#6c757d"],
                hoverOffset: 4
            }
        ]
    };
    const options = {
        tooltips: false,
        plugins: {
            // Change options for ALL labels of THIS CHART
            datalabels: {
                color: "#FFF",
                font: {
                    size: 20,
                    weight: "600"
                },
                formatter: function(value, context) {
                    // console.log(value);
                    // console.log(context.dataIndex);
                    let index = context.dataIndex;
                    return (
                        ((value / target) * 100).toFixed(2) +
                        `%\n(${func.numWithComma(pencapaian[index])})`
                    );
                }
            }
        }
    };
    const config = {
        type: "pie",
        data: data,
        plugins: [ChartDataLabels],
        options: options
    };
    const ctx = document.getElementById("progress-chart");
    var myChart = new Chart(ctx, config);
}

export function init(activeLink) {
    let canvas = $("#progress-chart");
    let target = canvas.data("target");
    let tercapai = canvas.data("tercapai");
    let sisa = target - tercapai;

    pieChart(target, tercapai, sisa);
}
