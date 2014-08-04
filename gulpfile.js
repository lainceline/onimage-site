var gulp            = require('gulp');
var sass            = require('gulp-sass');
var autoprefixer    = require('gulp-autoprefixer');
var minifycss       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var notify          = require('gulp-notify');
var codecept	    = require('gulp-codeception');
var git             = require('gulp-git');
var jade            = require('gulp-jade');
var clean           = require('gulp-clean');
var prettifyhtml    = require('gulp-html-prettify');

gulp.task('sass', function() {
    return gulp.src('src/styles/sass/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version', 'safari 5', 'ie 9', 'android 4', 'ios 7'))
        .pipe(rename({ suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('make-jade', function() {
   return gulp.src('src/views/*.jade')
       .pipe(jade())
       .pipe(prettifyhtml())
       .pipe(gulp.dest('public/views/'));
});

gulp.task('jade', ['make-jade'], function() {
    // Do this to please Laravel.  It will only route to a .php file
    return gulp.src('public/views/index.html')
        .pipe(clean({force: true}))
        .pipe(rename({ extname: '.php' }))
        .pipe(gulp.dest('public/views/'));
});

gulp.task('make', ['jade', 'sass'], function() {
    //just execute the other tasks
})

gulp.task('test', function() {
    return gulp.src('./app/tests/**/*.php').pipe(codecept());
});

gulp.task('watch', function() {
    gulp.watch('src/styles/sass/**/*.scss', ['sass']);
    gulp.watch('src/views/*.jade', ['jade']);
});

gulp.task('clean-views', function() {
   return gulp.src('public/views/*')
       .pipe(clean());
});

gulp.task('clean-css', function() {
    return gulp.src('public/css/*')
        .pipe(clean());
});

gulp.task('clean', ['clean-views', 'clean-css'], function() {
    //Just runs the individual clean tasks
});
