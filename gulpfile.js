var gulp            = require('gulp');
var sass            = require('gulp-sass');
var autoprefixer    = require('gulp-autoprefixer');
var minifycss       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var notify          = require('gulp-notify');
var codecept	    = require('gulp-codeception');
var git             = require('gulp-git');
var runsequence     = require('run-sequence');
var jade            = require('gulp-jade');

gulp.task('sass', function() {
    return gulp.src('src/styles/sass/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version', 'safari 5', 'ie 9', 'android 4', 'ios 7'))
        .pipe(rename({ suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'))
        .pipe(notify({ message: 'Sass task complete'}));
});

gulp.task('jade', function() {
   return gulp.src('src/views/*.jade')
       .pipe(jade())
       .pipe(gulp.dest('public/views/'))
});

gulp.task('test', function() {
    return gulp.src('./app/tests/**/*.php').pipe(codecept());
});

gulp.task('pull', function() {
    git.pull('origin', 'master');
});

gulp.task('post-pull', ['win'], function () {
    gulp.start('sass', 'test');
});

gulp.task('win', function() {
   runsequence('pull', 'post-pull');
});

gulp.task('watch', function() {
    gulp.watch('src/styles/sass/*.scss', ['styles']);
});
