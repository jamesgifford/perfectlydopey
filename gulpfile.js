var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // Mix all scss files into one css file
    mix.sass([
        'charts.scss',
        'app.scss'
    ], 'public/css/app.css');

    // Mix all chart JS files into a master charts file
    mix.scriptsIn(
        'resources/assets/js/charts', 
        'public/js/charts.js'
    );

    // Mix common JS files into one file
    mix.scripts([
        'app.js'
    ], 'public/js/app.js');
});
