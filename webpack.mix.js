const mix = require('laravel-mix');


mix.scripts([
    'resources/js/jquery-3.5.1.min.js',
    'resources/js/underscore-min.js',
    'resources/js/lodash.min.js',
    'resources/js/bootstrap.bundle.min.js',
    'resources/js/jquery.fancybox.min.js',
    'resources/js/datatables.min.js',
    'resources/js/autoNumeric.min.js',
    'resources/js/upload.js',
    'resources/js/marketer.js',
    'resources/js/client.js',
    'resources/js/category.js',
    'resources/js/product.js',
    'resources/js/order.js',
    'resources/js/cart.js',
    'resources/js/main.js',
    'resources/js/application.js',
],  'public/js/app.js');


mix.styles(
    [

        'resources/css/bootstrap.min.css',
        'resources/css/bootstrap-extension.min.css',
        'resources/css/jquery.fancybox.min.css',
        'resources/css/font.css',
        'resources/css/datatables.min.css',
        'resources/css/main.css',

    ], 'public/css/app.css');
