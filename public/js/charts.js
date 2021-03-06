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
            height: '70%'
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
            colors: ['#BFD3B3', 'green']
        }
    };

    var chart = new google.visualization.GeoChart(document.getElementById('perfectState'));
    chart.draw(data, options);
};
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

//# sourceMappingURL=charts.js.map
