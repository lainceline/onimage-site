var gulp            = require('gulp');
var sass            = require('gulp-sass');
var autoprefixer    = require('gulp-autoprefixer');
var minifycss       = require('gulp-minify-css');
var rename          = require('gulp-rename');
var notify          = require('gulp-notify');
var codecept	    = require('gulp-codeception');
var git             = require('gulp-git');

gulp.task('sass', function() {
    return gulp.src('src/styles/sass/*.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 version', 'safari 5', 'ie 9', 'android 4', 'ios 7'))
        .pipe(gulp.dest('public/css'))
        .pipe(rename({ suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'))
        .pipe(notify({ message: 'Sass task complete'}));
});

gulp.task('test', function() {
    return gulp.src('./app/tests/**/*.php').pipe(codecept());
});

gulp.task('git', function() {
    git.pull('origin', 'master');
    gulp.start('sass', 'test');
})

gulp.task('watch', function() {
    gulp.watch('src/styles/sass/*.scss', ['styles']);
});
