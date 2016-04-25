Chart.defaults.global.responsive = true;
Chart.defaults.global.maintainAspectRatio = true;

var context1 = document.getElementById('chart1').getContext('2d');
var chart1 = {
    labels: {!! json_encode($perfectsByGender['gender']) !!},
    datasets: [
        {
            data: {!! json_encode($perfectsByGender['count']) !!}
        }
    ]
}
new Chart(context1).Bar(chart1, { 
    barValueSpacing : 50
});
