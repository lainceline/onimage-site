var gulp            = require('gulp');
var sass            = require('gulp-sass');
var autoprefixer    = require('gulp-autoprefixer');
var minifycss       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var notify          = require('gulp-notify');
var codecept	    = require('gulp-codeception');
var git             = require('gulp-git');
var jade            = require('gulp-jade');

gulp.task('sass', function() {
    return gulp.src('src/styles/sass/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version', 'safari 5', 'ie 9', 'android 4', 'ios 7'))
        .pipe(rename({ suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('jade', function() {
   gulp.src('src/views/*.jade')
       .pipe(jade())
       .pipe(gulp.dest('public/views/'));

   // Do this to please Laravel.  It will only route to a .php file
   gulp.src('public/views/index.html')
       .pipe(rename({ extname: '.php' }));
});

gulp.task('test', function() {
    return gulp.src('./app/tests/**/*.php').pipe(codecept());
});

gulp.task('watch', function() {
    gulp.watch('src/styles/sass/**/*.scss', ['sass']);
    gulp.watch('src/views/*.jade', ['jade']);
});
