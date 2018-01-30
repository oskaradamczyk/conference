'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoPrefixer = require('gulp-autoprefixer');
var cssMin = require('gulp-cssmin');
var rename = require('gulp-rename');
var importCss = require('gulp-import-css');

/**
 * Compile scss to css
 */
gulp.task('sass', function () {
    return gulp.src('./web/assets/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoPrefixer())
        .pipe(importCss())
        .pipe(cssMin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./web/assets/css'));
});


/**
 * Watch for changes in files and trigger build process
 */
gulp.task('watch', function () {
    gulp.watch('./web/assets/sass/*.scss', ['sass']);
});

/**
 * Default task
 */
gulp.task('default', ['sass']);
