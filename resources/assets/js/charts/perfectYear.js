// Show count of Perfect Dopeys by Year
function drawChartPerfectYear() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('number', 'Total');
    data.addRows(PerfectlyDopey.countByYear);

    var options = {
        chart: {
            title: 'Perfect Dopeys by Year'
        },
        chartArea: {
            height: '88%',
            left: 35,
            top: 0,
            width: '90%'
        },
        backgroundColor: {
            fill: 'none'
        },
        legend: {
            position: 'none'
        },
        pointSize: 10,
        lineWidth: 5,
        vAxis: {
            title: '',
            format: '',
            maxValue: 7000,
            gridlines: {
                count: 10
            },
            viewWindow: {
                max: 7000
            }
        },
        hAxis: {
            title: '',
            format: '',
            gridlines: {
                color: '#000'
            },
            slantedText: true,
        },
        theme: 'material'
    };

    var chart = new google.visualization.AreaChart(document.getElementById('perfectYear'));
    chart.draw(data, options);
};
