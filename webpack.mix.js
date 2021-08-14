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

mix.combine(['resources/js/*'], 'public/js/app.js')
   .sass('resources/css/app.scss', 'public/css')
   .version();

mix.styles([
    'resources/css/normalize.css',
    //'public/css/vendor/videojs.css'
], 'public/css/all.css');

mix.copyDirectory('resources/img', 'public/img')

if (mix.inProduction()) {
   mix.version();
}
