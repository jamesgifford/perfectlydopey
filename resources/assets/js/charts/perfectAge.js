// Show count of Perfect Dopeys by Age
function drawChartPerfectAge() {
    var data = google.visualization.arrayToDataTable(PerfectlyDopey.countByAge);

    var options = {
        chart: {
            title: 'Perfect Dopeys by Age'
        },
        chartArea: {
            left: 35,
            top: 0,
            width: '87%',
            height: '82%'
        },
        backgroundColor: {
            fill: 'none'
        },
        legend: {
            position: 'none'
        },
        vAxis: {
            title: '',
            format: ''
        },
        hAxis: {
            title: '',
            format: ''
        },
        theme: 'material',
        bar: {
            groupWidth: "45%"
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('perfectAge'));
    chart.draw(data, options);
};