<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta property="og:title" content="Perfectly Dopey" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://perfectlydopey.com" />
        <meta property="og:image" content="http://perfectlydopey.com/assets/img/dopey-3a.jpg" />
        <meta property="og:description" content="At the Walt Disney World Marathon Weekend there are four running events held over four days: a 5k, 10k, half marathon, and full marathon. To finish all four races is known as the Dopey Challenge. To complete every Dopey Challenge since the first one is known as being Perfectly Dopey." />

        <!-- Page title -->
        <title>Perfectly Dopey</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Raleway:300,500,800|Source+Sans+Pro:100,300,400,600,700,900" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        @yield('content')

        @include('footer')
    </body>
</html>
