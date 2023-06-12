const mix = require('laravel-mix');
const webpack = require('webpack');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');



mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
        'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
        'resources/css/cloudflare_bootstrap.min.css'
    ], 'public/css/datatables.css')
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/datatables.net/js/jquery.dataTables.min.js',
        'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js'
    ], 'public/js/datatables.js')
    .webpackConfig({
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
            }),
        ],
    });

