// Show count of Perfect Dopeys by Age
function drawChartPerfectAge() {
    //var data = google.visualization.arrayToDataTable(PerfectlyDopey.countByAge);

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Age');
    data.addColumn('number', 'Total');
    data.addRows(PerfectlyDopey.countByAge);

    var options = {
        chart: {
            title: 'Perfect Dopeys by Age'
        },
        chartArea: {
            left: 35,
            top: 10,
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
            format: '',
            showTextEvery: 4
        },
        theme: 'material',
        bar: {
            groupWidth: "100%"
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('perfectAge'));
    chart.draw(data, options);
};