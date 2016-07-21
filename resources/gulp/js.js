import Elxir, {Task, Notification} from 'laravel-elixir';
import gulp from 'gulp';
import {log} from 'gulp-util';
import browserify from 'browserify';
import babelify from 'babelify';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import concat from 'gulp-concat';
import streamify from 'gulp-streamify';

import source from 'vinyl-source-stream';
import {gulpPaths} from './utils';


Elxir.extend('js', function (src, output) {
  const path = gulpPaths(
    'assets.js.folder', src || 'app.js',
    'public.js.outputFolder', output || 'app.js');
  const dest = path.output.baseDir;
  new Task('js', function () {
    gulp.src(`${path.src.baseDir}/vendor/**/*.js`)
      .pipe(concat('vendor.js'))
      .pipe(gulp.dest(dest))
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(uglify())
      .pipe(gulp.dest(dest));
    browserify({
        entries: path.src.path,
        extensions: ['.js'],
        debug: true
      })
        .require('react', {expose: 'React'})
        .require('react-dom', {expose: 'ReactDOM'})
        .require('classnames', {expose: 'classNames'})
        .transform(babelify.configure())
        .bundle()
        .on('error', function (e) {
          log.apply(null, arguments);
          new Notification().error(e, 'scss Compilation Failed');
        })
        .pipe(source('app.js'))
        .pipe(gulp.dest(dest))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(streamify(uglify()))
        .pipe(gulp.dest(dest));
    });
});
