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
    .scripts(['node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'],
        'public/js/bootstrap-datepicker.js')
    .scripts(['node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js'],
        'public/js/lib/datatable.js')
    .styles(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css'],
        'public/css/lib/datatable.css')
    .scripts(['node_modules/select2/dist/js/select2.js'],
        'public/js/lib/select2.js')
    .styles(['node_modules/select2/dist/css/select2.css'],
        'public/css/lib/select2.css')
    .scripts(['node_modules/wowjs/dist/wow.js'],
        'public/js/lib/wow.js')
    .postCss('resources/css/admin/tag.css', 'public/css/admin')
    .js('resources/js/admin/tag.js', 'public/js/admin')
    .styles(['node_modules/select2/dist/css/select2.css'],
        'public/css/lib/select2.css')
    .copy('resources/css/img/footer_bg.jpg', 'public/css/img')
    .copy('resources/css/img/nw_selarw.png', 'public/css/img')
    .disableNotifications();

mix.postCss('resources/css/admin/style.css', 'public/css/admin')
    .options({
    processCssUrls: false,
})

mix.styles(['node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'],
    'public/css/bootstrap-datepicker.css')
    .options({
        processCssUrls: false,
        sourceMaps: false,
    });

if (mix.inProduction()) {
    mix.version();
}
