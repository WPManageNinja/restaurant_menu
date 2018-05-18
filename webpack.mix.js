const mix = require('laravel-mix');

mix.js('src/js/app.js', 'assets/app.js');
mix.js('src/js/tiny_mce_button.js', 'assets/tiny_mce_button.js');
mix.sass('src/css/styles.scss', 'assets/styles.css');