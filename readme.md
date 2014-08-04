# onimage

![License](https://poser.pugx.org/laravel/framework/license.svg)

Onimage is a image upload and display site built with Angular.js, Laravel, and Bootstrap.  It utilizes dropzone.js for robust, simple, and easily customizable drag-and-drop multiple file uploading.

It uses Gulp.js for easy setup and compilation of Sass and Jade files.

### Installing

1. Clone (or fork) the repository.
2. You'll need [Composer](http://getcomposer.org), [node.js](http://nodejs.org/), [npm](https://www.npmjs.org/), and [Gulp.js](http://gulpjs.com) installed globally if you don't already have them.
3. You also need the php-gd library installed and enabled for your PHP installation.
4. Run `composer install` in the repository root directory to get Laravel and dependencies set up.
5. Run `php artisan onimage:install` to automatically install the Node.js dependencies, and execute the Gulp tasks to compile the Sass and Jade files.
6. Install your database of choice if you haven't already.  Your database connection info goes in app/config/database.php
7. Run `php artisan migrate` to create the database table.  Use the `--seed` option if you want some sample cat image data.  Note that this will fill your public/uploads with cat images.
8. That's it.  `php artisan serve` and you're ready to start developing locally. `gulp watch` will compile changes you make to the Sass and Jade on the fly.

### Contributing

Onimage currently needs:

* Automated tests.  Codeception is in the composer dev requirements.
* Reimplementation of ng-infinite-scroll in a way to allow the Search field to work properly.

### Third party libraries and tools

Onimage uses the following:

* Angular.js
* Laravel
* Twitter Bootstrap
* dropzone.js
* Composer
* Font Awesome
* Faker
* gulp
* Assorted gulp libraries, such as gulp-jade, gulp-sass, gulp-minifycss, gulp-prettifyhtml, etc
* Codeception
* npm
* node.js
* Jade
* Sass
* ngDialog
* jQuery
* ng-infinite-scroll

### License

Onimage is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Acknowledgements
Huge thanks to my friend Robert for introducing me to Laravel and Angular.js, and helping me to understand them better.
Huge thanks also to my friend Bryan, who inspired this project.
