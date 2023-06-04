const mix = require('laravel-mix');

mix.scripts([
        'public/assets/js/intlTelInput.min.js',
    ], 'public/assets/js/app.min.js')
    .styles([
        'public/assets/css/font-electro.css',
        'public/assets/css/theme.css',
        'public/assets/css/style.css',
        'public/assets/css/custom.css',
        'public/assets/css/intlTelInput.min.css',
        'public/assets/css/custom-style-front.css'
    ], 'public/assets/css/app.min.css')
    .styles([
        'public/assets/css/rtl.css',
        'public/assets/css/custom-style-front-rtl.css'
    ], 'public/assets/css/rtl.min.css')
    .version();
