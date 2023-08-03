const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .js('resources/js/auth.js', 'public/js')
    .postCss('resources/css/auth.css', 'public/css')
    .js('resources/js/lib/toasting.js', 'public/js/lib')
    .postCss('resources/css/lib/toasting.css', 'public/css/lib')
    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
}
