const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    
    // Adição do BrowserSync para recarregar a página automaticamente
    .browserSync({
        proxy: 'localhost', // Substitua por 'localhost:8000' se estiver usando o PHP Artisan
        files: [
            'app/**/*.php',
            'resources/views/**/*.php',
            'routes/**/*.php',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ],
        open: false, // Evita que o navegador seja aberto automaticamente
    });

