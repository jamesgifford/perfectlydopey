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
                <h1>Perfectly Dopey</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            </div>
        </header>

        <main role="main" id="data">
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