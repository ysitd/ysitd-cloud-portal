import gulp from 'gulp';
import './css';
import './js';
import './image';
import './monitor';

gulp.task('build', ['css', 'js', 'image', 'copy']);
gulp.task('dev', ['build', 'monitor']);
