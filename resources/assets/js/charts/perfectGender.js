// Show count of Perfect Dopeys by Gender
function drawChartPerfectGender() {
    var data = google.visualization.arrayToDataTable(PerfectlyDopey.countByGender);

    var options = {
        chart: {
            title: 'Perfect Dopeys by Gender'
        },
        chartArea: {
            left: 35,
            top: 10,
            width: '90%',
            height: '88%'
        },
        backgroundColor: {
            fill: 'none'
        },
        legend: {
            position: 'none'
        },
        theme: 'material'
    };

    var chart = new google.visualization.PieChart(document.getElementById('perfectGender'));
    chart.draw(data, options);
};