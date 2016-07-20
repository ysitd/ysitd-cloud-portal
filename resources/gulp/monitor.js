import Elxir, {Task, Notification, config} from 'laravel-elixir';
import gulp from 'gulp';


Elxir.extend('monitor', function () {
  new Task('monitor', function () {
    gulp.watch([
      `${config.get('assets.css.sass.folder')}/**/*.scss`
    ], ['css']);

    gulp.watch([
      `${config.get('assets.js.folder')}/**/*.js`
    ], ['js']);

    gulp.watch([
      `${config.get('assets.images.folder')}/**/*.*`
    ], ['image']);
  });
});