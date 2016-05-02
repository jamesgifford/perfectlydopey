// Show count of Perfect Dopeys by State
function drawChartPerfectState() {
    var data = google.visualization.arrayToDataTable(PerfectlyDopey.countByState);

    var options = {
        chart: {
            title: 'Perfect Dopeys by State'
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
        theme: 'material',
        region: "US",
        resolution: "provinces",
        colorAxis: {
            colors: ['blue', 'black']
        }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('perfectState'));
    chart.draw(data, options);
};