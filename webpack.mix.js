const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
	   'resources/assets/css/libs/blog-post.css',
	   'resources/assets/css/libs/bootstrap.css',
	   'resources/assets/css/libs/bootstrap.min.css',
	   'resources/assets/css/libs/font-awesome.css',
	   'resources/assets/css/libs/metisMenu.css',
	   'resources/assets/css/libs/sb-admin-2.css',
	   'resources/assets/css/libs/styles.css'
   ], './public/css/libs.css')
   .scripts([
	   'resources/assets/js/libs/jquery.js',
	   'resources/assets/js/libs/bootstrap.js',
	   'resources/assets/js/libs/metisMenu.js',
	   'resources/assets/js/libs/sb-admin-2.js'
   ], './public/js/libs.js');



//
//mix.styles([
//    'public/css/vendor/normalize.css',
//    'public/css/vendor/videojs.css'
//], 'public/css/all.css');
//
//mix.scripts([
//    'public/js/admin.js',
//    'public/js/dashboard.js'
//], 'public/js/all.js');