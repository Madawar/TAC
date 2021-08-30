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

 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .combine(['resources/js/plugins/signature_pad.min.js','./node_modules/plotly.js-dist/plotly.js','resources/js/plugins/flatpickr.js'],'public/js/plugins.js')
 .postCss('resources/css/app.css', 'public/css', [
    // './node_modules/tippy.js/dist/tippy.css',
    // require('tippy.js'),
     require('postcss-import'),
     require('tailwindcss'),
     require('autoprefixer'),
 ]);

