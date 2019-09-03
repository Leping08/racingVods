const mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

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

mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});

mix.browserSync(process.env.APP_URL);

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/js'),
            '$comp': path.join(__dirname, './resources/js/components')
        }
    },
    plugins: [
        new VuetifyLoaderPlugin()
    ]
});

//.sass('resources/styles/app.sass', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js').version();

mix.sass('resources/assets/css/app.sass', 'public/css/theme.css').version();

mix.styles([
    //'node_modules/vuetify/dist/vuetify.css',
    'resources/assets/css/custom.css'
], 'public/css/app.css').version();