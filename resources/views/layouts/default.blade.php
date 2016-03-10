<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Perfectly Dopey</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <style>
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
 
        @yield('header')
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Perfectly Dopey</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Home</a></li>
                        <li class="active"><a href="#data">Data</a></li>
                        <li><a href="#about">About</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="jumbotron">
            <div class="container">
                <h1>Perfectly Dopey</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            </div>
        </header>

        <main role="main" id="data">

            <div class="data-nav navbar navbar-default">
                <div class="container">
                    <ul class="data-nav-links nav navbar-nav">
                        <li><a class="data-nav-prev" href=""></a></li>
                        <li><a data-slide-index="0" href="">Perfect</a></li>
                        <li><a data-slide-index="1" href="">Overall</a></li>
                        <li><a data-slide-index="2" href="">2016</a></li>
                        <li><a data-slide-index="3" href="">2015</a></li>
                        <li><a data-slide-index="4" href="">2014</a></li>
                        <li><a class="data-nav-next" href=""></a></li>
                    </ul>
                </div>
            </div> <!-- /.data-nav -->

            <div class="data-wrap">
                <!-- Perfect data -->
                <div id="data-perfect">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Perfect</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>Summary</h3>
                                <table>
                                    <tr>
                                        <td>Total Perfect Dopeys</td>
                                        <td>1,387</td>
                                    </tr>
                                    <tr>
                                        <td>Average Age</td>
                                        <td>45</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h3>Count By Year</h3>
                                <canvas id="results1" height="300" width="300"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Count By Gender</h3>
                                <canvas id="results2" height="300" width="300"></canvas>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By Age</h3>
                                <canvas id="results3" height="300" width="300"></canvas>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By State</h3>
                                <canvas id="results4" height="300" width="300"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Count By Time</h3>
                                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                            </div>
                        </div>
                    </div>
                </div> <!-- /#data-perfect -->

                <!-- Overall data -->
                <div id="data-overall">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Overall</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>Totals and Averages</h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Count By Year</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Count By Gender</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By Age</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By State</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Count By Time</h3>
                            </div>
                        </div>
                    </div>
                </div> <!-- /#data-overall -->

                <!-- Year 2016 data -->
                <div id="data-year-2016">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>2016</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>Totals and Averages</h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Count By Year</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Count By Gender</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By Age</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By State</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Count By Time</h3>
                            </div>
                        </div>
                    </div>
                </div> <!-- /#data-year-2016 -->

                <!-- Year 2015 data -->
                <div id="data-year-2015">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>2015</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>Totals and Averages</h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Count By Year</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Count By Gender</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By Age</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By State</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Count By Time</h3>
                            </div>
                        </div>
                    </div>
                </div> <!-- /#data-year-2015 -->

                <!-- Year 2014 data -->
                <div id="data-year-2014">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>2014</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>Totals and Averages</h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Count By Year</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Count By Gender</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By Age</h3>
                            </div>
                            <div class="col-md-4">
                                <h3>Count By State</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Count By Time</h3>
                            </div>
                        </div>
                    </div>
                </div> <!-- /#data-year-2014 -->
            </div> <!-- /.data-wrap -->

            <div id="about">
                <div class="container">
                    <div class="row">
                        About
                    </div>
                </div>
            </div>

        </main>

        <footer class="container" role="contentinfo">
            <div class="row">
                <small>Copyright &copy; <time datetime="2016">2016</time></small>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="/js/iefix.js"></script>
        <script src="/js/vendor/chart.min.js"></script>
        <script src="/js/vendor/jquery.bxslider.min.js"></script>

        <script>
            var navPosition = $('.data-nav').offset().top;
            var navbarOffset = $('.navbar').height();
            $(window).scroll(function() {
                if ($(window).scrollTop() > (navPosition - navbarOffset)) {
                    $('.data-nav').css('position', 'fixed').css('top', navbarOffset);
                    $('.data-wrap').css('margin-top', navbarOffset + 0);
                }
                else {
                    $('.data-nav').css('position', 'relative').css('top', 'inherit');
                    $('.data-wrap').css('margin-top', 0);
                }
            });

            (function () {
                var context1 = document.getElementById('results1').getContext('2d');
                var context2 = document.getElementById('results2').getContext('2d');
                var context3 = document.getElementById('results3').getContext('2d');
                var context4 = document.getElementById('results4').getContext('2d');

                var chartPerfectsByYear = {
                    labels: {{ json_encode($perfectsByYear['year']) }},
                    datasets: [
                        {
                            data: {{ json_encode($perfectsByYear['count']) }}
                        }
                    ]
                };
                var chartPerfectsByGender = {
                    labels: {!! json_encode($perfectsByGender['gender']) !!},
                    datasets: [
                        {
                            data: {{ json_encode($perfectsByGender['count']) }}
                        }
                    ]
                };
                var chartPerfectsByAge = {
                    labels: {{ json_encode($perfectsByAge['age']) }},
                    datasets: [
                        {
                            data: {{ json_encode($perfectsByAge['count']) }}
                        }
                    ]
                };
                var chartPerfectsByState = {
                    labels: {!! json_encode($perfectsByState['state']) !!},
                    datasets: [
                        {
                            data: {{ json_encode($perfectsByState['count']) }}
                        }
                    ]
                };

                Chart.defaults.global.responsive = true;
                Chart.defaults.global.maintainAspectRatio = false;

                new Chart(context1).Bar(chartPerfectsByYear, { 
                    bezierCurve: false, 
                    scaleBeginAtZero : true, 
                    scaleOverride: true, 
                    scaleStartValue: 0, 
                    scaleStepWidth: 1000, 
                    scaleSteps: 7 
                });
                new Chart(context2).Bar(chartPerfectsByGender, { 
                    bezierCurve: false, 
                    scaleBeginAtZero : true, 
                    scaleOverride: true, 
                    scaleStartValue: 0, 
                    scaleStepWidth: 100, 
                    scaleSteps: 6 
                });
                new Chart(context3).Line(chartPerfectsByAge, { 
                    bezierCurve: true, 
                    scaleBeginAtZero : true, 
                    scaleOverride: true, 
                    scaleStartValue: 0, 
                    scaleStepWidth: 1, 
                    scaleSteps: 60 
                });
                new Chart(context4).Bar(chartPerfectsByState, { 
                    bezierCurve: true, 
                    scaleBeginAtZero : true, 
                    scaleOverride: true, 
                    scaleStartValue: 0, 
                    scaleStepWidth: 1, 
                    scaleSteps: 60 
                });

                $('.data-wrap').bxSlider({
                    nextSelector: '.data-nav-next',
                    prevSelector: '.data-nav-prev',
                    pagerCustom: '.data-nav-links'
                });
            })();
        </script>

        @yield('footer')
    </body>
</html>