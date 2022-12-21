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
        'public/css/login/login.css').version();
