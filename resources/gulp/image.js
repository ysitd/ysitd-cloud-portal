import Elxir, {Task, config} from 'laravel-elixir';
import gulp from 'gulp';
import {log} from 'gulp-util';
import imagemin from 'gulp-imagemin';

Elxir.extend('image', function () {
  new Task('image', function () {
    gulp.src(`${config.get('assets.images.folder')}/**/*.*`)
      .pipe(imagemin())
      .pipe(gulp.dest(config.get('public.images.outputFolder')));
  });
});