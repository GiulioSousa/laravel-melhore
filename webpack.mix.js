const mix = require('laravel-mix');

mix
    .styles([
        'resources/css/reset.css'
    ],
        'public/css/reset.css')
    .styles([
        'resources/css/login/login.css',
        'resources/css/login/style.css',
    ],
        'public/css/login/login.css')
    .styles([
        'resources/css/style.css',
        'resources/css/style-responsive.css'
    ],
        'public/css/panel/style.css')
    .scripts(['resources/js/header.js'], 'public/js/header.js')
    .version();
