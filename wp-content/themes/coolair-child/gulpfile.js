const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Source and destination paths.
const srcPath = './scss/**/*.scss';
const destPath = './css';

// Task to compile SCSS to CSS.
gulp.task('sass', function () {
  return gulp.src(srcPath)
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(gulp.dest(destPath));
});

// Watch for changes in SCSS files.
gulp.task('watch', function () {
  gulp.watch(srcPath, gulp.series('sass'));
});

// Default task.
gulp.task('default', gulp.series('sass', 'watch'));
