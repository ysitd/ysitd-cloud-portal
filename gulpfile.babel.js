import gulp from 'gulp';
import {log} from 'gulp-util';
import rename from 'gulp-rename';

import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';

import babelify from 'babelify';
import browserify from 'browserify';
import streamify from 'gulp-streamify';
import uglify from 'gulp-uglify';
import source from 'vinyl-source-stream';

import imagemin from 'gulp-imagemin';
import svgmin from 'gulp-svgmin';

import jsonminify from 'gulp-jsonminify';

const src = './assets';
const dest = './public';

gulp.task('json', function() {
  gulp.src(`${src}/json/**/*.json`)
    .pipe(jsonminify())
    .pipe(gulp.dest(`${dest}/json`));
});

gulp.task('css', function() {
  gulp.src(`${src}/scss/**/*.scss`)
    .pipe(sass())
    .on('error', log)
    .pipe(gulp.dest(`${dest}/css`))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(cleanCss())
    .pipe(gulp.dest(`${dest}/css`));
});

gulp.task('js', function() {
  browserify({
    entries: './assets/js/material/index.js',
    extensions: ['.js'],
    debug: false
  })
    .require('jquery', {expose: 'jQuery'})
    .transform(babelify.configure())
    .bundle()
    .on('error', log)
    .pipe(source('vendor.js'))
    .pipe(gulp.dest(`${dest}/js`))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(streamify(uglify()))
    .pipe(gulp.dest(`${dest}/js`));

  browserify({
    entries: './assets/js/app.js',
    extensions: ['.js'],
    debug: true
  })
    .require('react', {expose: 'React'})
    .require('react-dom', {expose: 'ReactDOM'})
    .require('classnames', {expose: 'classNames'})
    .transform(babelify.configure())
    .bundle()
    .on('error', log)
    .pipe(source('app.js'))
    .pipe(gulp.dest(`${dest}/js`))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(streamify(uglify()))
    .pipe(gulp.dest(`${dest}/js`));
});

gulp.task('images', function () {
  gulp.src(`${src}/images/**/*.*`)
    .pipe(imagemin())
    .on('error', log)
    .pipe(gulp.dest(`${dest}/images`));
});

gulp.task('watch', function () {
  gulp.watch([
    `${src}/js/**/*.js`
  ], ['js']);

  gulp.watch([
    `${src}/scss/**/*.scss`
  ], ['css']);

  gulp.watch([
    `${src}/images/**/*.*`
  ], ['images']);

  gulp.watch([
    `${src}/json/**/*.json`
  ], ['json']);
});

gulp.task('build', ['js', 'css', 'images', 'json']);

gulp.task('dev', ['build', 'watch']);
