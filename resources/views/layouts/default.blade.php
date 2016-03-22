<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Perfectly Dopey</title>

        <link rel="stylesheet" href="/css/chartist-plugin-tooltip.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

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
                <h1>The Dopey Challenge</h1>
                <p>Disney's ultimate running experience involves four races in four days</p>
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <p>Perfecly Dopey</p>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="/js/iefix.js"></script>
        <script src="/js/vendor/jquery.bxslider.min.js"></script>
        <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <script src="/js/chartist-plugin-tooltip.min.js"></script>

        @yield('footer')
    </body>
</html>