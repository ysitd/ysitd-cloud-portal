import Elxir, {Task, Notification} from 'laravel-elixir';
import gulp from 'gulp';
import {log} from 'gulp-util';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCss from 'gulp-clean-css';
import {gulpPaths} from './utils';

Elxir.extend('css', function (output) {

  const path = gulpPaths(
    'assets.css.sass.folder', 'app.scss',
    'public.css.outputFolder', output || 'app.css');
  const dest = path.output.baseDir;

  new Task('css', function () {
    gulp.src(`${path.src.baseDir}/**/*.scss`)
      .pipe(sass())
      .on('error', function (e) {
        log.apply(null, arguments);
        new Notification().error(e, 'scss Compilation Failed');
      })
      .pipe(gulp.dest(dest))
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(cleanCss())
      .pipe(gulp.dest(dest));
  });
});