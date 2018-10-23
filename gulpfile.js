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
    mix.sass([
        'theme-default.scss',
        'fonts/1.css',
        'fonts/2.css',
        'fonts/3.css',
        'app.sass',
        'app2.sass'
    ]);
});


elixir(function(mix) {
    mix.scripts([
        'plugins.js',
        'actions.js',
        'app.js',
    ], 'public/js/app.js');
});