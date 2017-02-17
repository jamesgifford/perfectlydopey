<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Perfectly Dopey</title>

        <link href="/css/app.css" rel="stylesheet" type="text/css">
        {!! Charts::assets() !!}
    </head>
    <body id="page-results">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Perfectly Dopey</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><label>Results:</label></li>
                        <li class="dropdown mode">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {!! $mode !!} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/results/overall">Overall</a></li>
                                <li><a href="/results/perfect">Perfect</a></li>
                                <li><a href="/results/2017">2017</a></li>
                                <li><a href="/results/2016">2016</a></li>
                                <li><a href="/results/2015">2015</a></li>
                                <li><a href="/results/2014">2014</a></li>
                            </ul>
                        </li>
                        <li><label>Category:</label></li>
                        <li id="categories" class="dropdown category">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="dropdown-current">Totals</span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="totals" href="#totals">Totals</a></li>
                                <li><a class="gender" href="#gender">Gender</a></li>
                                <li><a class="age" href="#age">Age</a></li>
                                <li><a class="pace" href="#pace">Pace</a></li>
                                <li><a class="location" href="#location">Location</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        @yield('content')

        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
