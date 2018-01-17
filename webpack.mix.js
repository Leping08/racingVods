let mix = require('laravel-mix');

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


mix.js('resources/assets/js/app.js', 'public/js');

mix.styles([
    'node_modules/vuetify/dist/vuetify.css',
    'node_modules/v-calendar/lib/v-calendar.min.css',
    'resources/assets/css/custom.css'
], 'public/css/app.css');
