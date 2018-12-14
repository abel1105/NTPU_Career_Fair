var gulp = require('gulp');
var concat = require('gulp-concat');
var uncss = require('gulp-uncss');
var minifyCss = require('gulp-minify-css');
gulp.task('default',['minify-css']);
//gulp.task('uncss', function() {
//    return gulp.src('assets/**/*.css')
//        .pipe(uncss({
//            html: ['index.html']
//        }))
//        .pipe(concat('main.css'))
//        .pipe(gulp.dest('./dist'));
//});

gulp.task('minify-css', function() {
    return gulp.src('assets/**/*.css')
        .pipe(minifyCss({compatibility: 'ie8',relativeTo: './dist', target: './dist'}))
        .pipe(concat('main.css'))
        .pipe(gulp.dest('./dist'));
});