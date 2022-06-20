/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
const barConfig = {
    type: "bar",
    data: {
        labels: films,
        datasets: dataset,
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
    },
};

const barsCtx = document.getElementById("bars");
window.myBar = new Chart(barsCtx, barConfig);
