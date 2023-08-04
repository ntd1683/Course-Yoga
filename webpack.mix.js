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
    .js('resources/js/user/app.js', 'public/js/user')
    .postCss('resources/css/user/app.css', 'public/css/user')
    .js('resources/js/user/auth.js', 'public/js/user')
    .postCss('resources/css/user/auth.css', 'public/css/user')
    .js('resources/js/lib/toasting.js', 'public/js/lib')
    .postCss('resources/css/lib/toasting.css', 'public/css/lib')
    .scripts(['node_modules/magnific-popup/dist/jquery.magnific-popup.min.js'],
        'public/js/magnific-popup.js')
    .postCss('resources/css/admin/app.css', 'public/css/admin')
    .js('resources/js/admin/app.js', 'public/js/admin')
    .scripts(['node_modules/jquery-slimscroll/jquery.slimscroll.js'],
        'public/js/jquery-slimscroll.js')
    .disableNotifications();

mix.postCss('resources/css/admin/style.css', 'public/css/admin')
    .options({
    processCssUrls: false,
})

if (mix.inProduction()) {
    mix.version();
}
