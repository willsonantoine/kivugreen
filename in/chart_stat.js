
if (jQuery("#chart-genre").length) {
    options = {
        chart: {
            width: 380,
            type: "pie"
        },
        labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
        series: [44, 55, 13, 43, 22],
        colors: ["#1e3d73", "#fe517e", "#6ce6f4", "#99f6ca", "#c8c8c8"],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: "bottom"
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#chart-genre"), options)).render()
}