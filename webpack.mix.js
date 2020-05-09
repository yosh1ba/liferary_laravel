const mix = require('laravel-mix')
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

mix.browserSync({
    host: 'liferary.test',
    proxy: {
        target: 'http://127.0.0.1:8000'
    }
})
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .webpackConfig({
        plugins: [
            new VuetifyLoaderPlugin(),
        ],
    })
