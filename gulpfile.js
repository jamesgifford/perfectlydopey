const elixir = require('laravel-elixir');

elixir((mix) => {
    // Mix all Sass files into one
    mix.sass('app.scss');

    // Mix all vendor scripts together
    mix.scripts(
        ['jquery/dist/jquery.min.js'],
        'resources/assets/js/vendor.js',
        'node_modules'
    );

    // Mix all script files into one
    mix.scripts(
        ['vendor.js', 'app.js'],
        'public/js/app.js'
    );

    // Copy vendor assets to public
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap')
       .copy('node_modules/font-awesome/fonts', 'public/fonts');
});




/*
var elixir = require('laravel-elixir');

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
*/

