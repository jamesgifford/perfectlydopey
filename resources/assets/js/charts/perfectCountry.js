// Show count of Perfect Dopeys by Country
function drawChartPerfectCountry() {
    var data = google.visualization.arrayToDataTable(PerfectlyDopey.countByCountry);

    var options = {
        chart: {
            title: 'Perfect Dopeys by Country'
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
        colorAxis: {
            colors: ['#BFD3B3', 'green']
        }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('perfectCountry'));
    chart.draw(data, options);
};