<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Perfectly Dopey</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="/css/iefix.css" rel="stylesheet">

        <style>
            .full-width-tabs > ul.nav.nav-tabs {
                display: table;
                width: 100%;
                table-layout: fixed; /* To make all "columns" equal width regardless of content */
            }
            .full-width-tabs > ul.nav.nav-tabs > li {
                float: none;
                display: table-cell;
                width: 100%;
            }
            .full-width-tabs > ul.nav.nav-tabs > li > a {
                text-align: center;
            }
            .take-all-space-you-can {
                width:100%;
            }

            .navbar {
                margin-bottom: 0;
            }

            #data-nav,
            #data-nav > li {
              float:none;
              display:inline-block;
              *display:inline; /* ie7 fix */
              *zoom:1; /* hasLayout ie7 trigger */
              vertical-align: top;
            }

            #data-nav .container {
              text-align:center;
            }

            .affix{
                position:fixed;
                top: 100px;
            }

            #data-nav {
                width: 100%;
                z-index: 1000;
                border-radius: 0;
            }
        </style>
        
        @yield('header')
    </head>
    <body>

        <!-- Header -->
        <nav id="header" class="navbar navbar-default navbar-fixed-top" style="background: #A6C000; border: 0;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="" style="color: #A200A4">Perfectly Dopey</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul id="bx-pagelr" class="nav navbar-nav navbar-right">
                        <li><a href="">Home</a></li>
                        <li><a href="">Data</a></li>
                        <li><a href="">About</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <!-- -->
        <div class="jumbotron" style="margin-bottom: 0; background: #A6C000;">
            <div class="container" style="padding-top: 4em; padding-bottom: 4em;">
                <h1 style="text-align: center; text-transform: uppercase; color: #A200A4;">Perfectly Dopey</h1>
                <p style="color: #A200A4;">This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            </div>
        </div><!-- /.jumbotron -->

        <!-- Slider Navigation -->
        <div id="data-nav" style="background: #A6C000; border: 0;">
            <div class="container">
                <ul id="bx-pager" class="" style="list-style: none;">
                    <li><a data-slide-index="0" href="" style="color: #A200A4">Perfect</a></li>
                    <li><a data-slide-index="1" href="" style="color: #A200A4">Overall</a></li>
                    <li><a data-slide-index="2" href="" style="color: #A200A4">2016</a></li>
                    <li><a data-slide-index="3" href="" style="color: #A200A4">2015</a></li>
                    <li><a data-slide-index="4" href="" style="color: #A200A4">2014</a></li>
                </ul>
            </div>
        </div>

        <!-- Data Sections -->
        <div id="thecontent">

            <div>
                <!-- Perfect Dopeys -->
                <div class="container-fluid">
                    <div class="row" style="background: #A200A4;">
                        <h2 style="color: #A6C000;">Perfect Dopeys</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h2>Totals and Averages 1</h2>
                        </div>
                        <div class="col-md-6">
                            <h2>Count By Year</h2>
                            <canvas id="results1" height="300" width="300"></canvas>
                        </div>

                        <div class="col-md-4">
                            <h2>Count By Gender</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Age</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Location</h2>
                        </div>

                        <div class="col-md-12">
                            <h2>Stuff 1<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />More Stuff 1</h2>
                        </div>
                    </div>
                </div> <!-- /.container -->
            </div>

            <div>
                <!-- Perfect Dopeys -->
                <div class="container-fluid">
                    <div class="row">
                        <h2>Overall Data</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Totals and Averages 2</h2>
                        </div>
                        <div class="col-md-6">
                            <h2>Count By Year</h2>
                            <canvas id="results1" height="300" width="300"></canvas>
                        </div>

                        <div class="col-md-4">
                            <h2>Count By Gender</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Age</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Location</h2>
                        </div>

                        <div class="col-md-12">
                            <h2>Stuff 2<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />More Stuff 2</h2>
                        </div>
                    </div>
                </div> <!-- /.container -->
            </div>

            <div>
                <!-- Perfect Dopeys -->
                <div class="container-fluid">
                    <div class="row">
                        <h2>Year 2016</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h2>Totals and Averages 3</h2>
                        </div>
                        <div class="col-md-6">
                            <h2>Count By Year</h2>
                            <canvas id="results1" height="300" width="300"></canvas>
                        </div>

                        <div class="col-md-4">
                            <h2>Count By Gender</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Age</h2>
                        </div>
                        <div class="col-md-4">
                            <h2>Count By Location</h2>
                        </div>

                        <div class="col-md-12">
                            <h2>Stuff 3<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />More Stuff 3</h2>
                        </div>
                    </div>
                </div> <!-- /.container-fluid -->
            </div>

        </div>

        <!-- Footer -->
        <div class="container-fluid">
            <footer>
                <p>&copy; 2015 Company, Inc.</p>
            </footer>
        </div> <!-- /.container-fluid -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="/js/iefix.js"></script>
        <script src="/js/vendor/chart.min.js"></script>
        <script src="/js/vendor/jquery.bxslider.min.js"></script>

        <script>
            var stickySidebar = $('#data-nav').offset().top;
            var headerOffset = $('#header').height();
            console.log(headerOffset);
            $(window).scroll(function() {  
                if ($(window).scrollTop() > (stickySidebar - headerOffset)) {
                    console.log($('.navbar').css('margin-bottom'));
                    $('#data-nav').css('position', 'fixed').css('top', headerOffset);
                    $('#thecontent').css('margin-top', headerOffset + 0);
                }
                else {
                    $('#data-nav').css('position', 'relative').css('top', 'inherit');
                    $('#thecontent').css('margin-top', 0);
                }  
            });

            (function () {
                var context = document.getElementById('results1').getContext('2d');
                var chart = {
                    labels: {{ json_encode($years) }},
                    datasets: [
                        {
                            data: {{ json_encode($totals) }}
                        }
                    ]
                }

                Chart.defaults.global.responsive = true;
                Chart.defaults.global.maintainAspectRatio = false;

                new Chart(context).Bar(chart, { 
                    bezierCurve: false, 
                    scaleBeginAtZero : true, 
                    scaleOverride: true, 
                    scaleStartValue: 5000, 
                    scaleStepWidth: 1000, 
                    scaleSteps: 5 
                });

                $('#thecontent').bxSlider({
                    nextSelector: '#slider-next',
                    prevSelector: '#slider-prev',
                    pagerCustom: '#bx-pager'
                });
            })();
        </script>

        @yield('footer')
    </body>
</html>