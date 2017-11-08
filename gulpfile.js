'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var browserSync   = require('browser-sync');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var pump = require('pump');
var uglifycss = require('gulp-uglifycss');


gulp.task('default', () =>
gulp.src('./css/**/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(autoprefixer({
    browsers: ['last 2 versions'],
    cascade: false
  }))
  .pipe(gulp.dest('./css'))
);

gulp.task('sass', function () {
 gulp.src('./css/**/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(autoprefixer({
    browsers: ['last 2 versions'],
    cascade: false
  }))
  .pipe(uglifycss({
    "maxLineLen": 80,
    "uglyComments": false
  }))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./css'));
});

gulp.task('browser-sync', function() {
  browserSync.init({
    notify: config.notify,
    open: config.open,
    port: config.port,
    server: {
      baseDir: config.server.basedir
    },
    xip: config.xip
  });
});



// Watch
gulp.task('sass:watch', function () {
  gulp.watch('./css/**/*.scss', ['sass']);
 });

// Watch files for changes, recompile/rebuild and reload the browser
gulp.task('watch', function() {
  // No browser reload needed here, browserSync injects the stylesheet into browsers
  gulp.watch('./css/**/*.scss', ['sass']);
});
