import {Notification, config} from 'laravel-elixir';
import gulp from 'gulp';
import {log} from 'gulp-util';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCss from 'gulp-clean-css';

const src = config.get('assets.css.sass.folder');
const dest = config.get('public.css.outputFolder');
gulp.task('css', function () {
  gulp.src(`${src}/**/*.scss`)
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