@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2>Perfects By Year</h2>
                <div id="perfect-count-by-year" class="ct-chart ct-golden-section ct-line"></div>
            </div>
            <div class="col-md-6">
                <h2>Perfects By Gender</h2>
                <div id="perfect-count-by-gender" class="ct-golden-section ct-pie"></div>
            </div>
        </div>
    </div>

@endsection

@section('header')

    <style>
        h2 {
            text-align: center;
        }

        .navbar {
            border: 0;
            margin-bottom: 0;
        }

        .jumbotron {
            margin-bottom: 0;
        }

        .data-nav .container {
            text-align:center;
        }

        .data-nav-links,
        .data-nav-links > li {
            float:none;
            display:inline-block;
            *display:inline; /* ie7 fix */
            *zoom:1; /* hasLayout ie7 trigger */
            vertical-align: top;
        }

        .data-nav {
            width: 100%;
            z-index: 1000;
            border-radius: 0;
        }
    </style>

@endsection

@section('footer')

    <script>
        // Perfect count by year
        new Chartist.Line('#perfect-count-by-year', {
            labels: {!! json_encode($perfect['countByYear']['labels']) !!},
            series: [{!! json_encode($perfect['countByYear']['series']) !!}]
        }, {
            fullWidth: true,
            showArea: true,
            lineSmooth: Chartist.Interpolation.none(),
            plugins: [
                Chartist.plugins.tooltip()
            ],
            chartPadding: {
                right: 50,
                left: 50,
                top: 50,
                bottom: 50,
            }
        });

        // Perfect count by gender
        var data = {
            series: {!! json_encode($perfect['countByGender']['series']) !!}
        };

        var sum = function(a, b) { return a + b };
        
        new Chartist.Pie('#perfect-count-by-gender', data, {
            labelInterpolationFnc: function(value) {
                return Math.round(value / data.series.reduce(sum) * 100) + '%';
            },
            plugins: [
                Chartist.plugins.tooltip()
            ],
            chartPadding: {
                right: 50,
                left: 50,
                top: 50,
                bottom: 50,
            }
        });

        // Perfect count by age
        new Chartist.Bar('#perfect-count-by-age', {
            labels: {!! json_encode($perfect['countByAge']['labels']) !!},
            series: [{!! json_encode($perfect['countByAge']['series']) !!}]
        }, {
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });

        // Perfect count by state
        new Chartist.Bar('#perfect-count-by-state', {
            labels: {!! json_encode($perfect['countByState']['labels']) !!},
            series: [{!! json_encode($perfect['countByState']['series']) !!}]
        }, {
            fullWidth: true,
            seriesBarDistance: 10,
            reverseData: true,
            horizontalBars: true,
            axisY: {
                
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });

        // Perfect count by country
        new Chartist.Bar('#perfect-count-by-country', {
            labels: {!! json_encode($perfect['countByCountry']['labels']) !!},
            series: [{!! json_encode($perfect['countByCountry']['series']) !!}]
        }, {
            fullWidth: true,
            seriesBarDistance: 10,
            reverseData: true,
            horizontalBars: true,
            axisY: {
                offset: 70,
            },
            axisX: {
                type: Chartist.AutoScaleAxis,
                ticks: [0, 1, 5, 100, 812],
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });
    </script>

@endsection