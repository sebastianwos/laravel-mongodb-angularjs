const elixir = require('laravel-elixir');

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

elixir(mix => {
    mix.sass('app.scss')
    .webpack('app.js')
    .scripts([
        'resources/assets/js/components/lines.component.js',
        'resources/assets/js/components/stop-detail.component.js',
        'resources/assets/js/components/line-detail.component.js',
        'resources/assets/js/components/time.component.js'
    ])
    .copy('resources/assets/js/components/*.html', 'public/js/components/');
});
