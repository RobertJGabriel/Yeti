var gulp = require('gulp');
var less = require('gulp-less');
var jshint = require('gulp-jshint');
var gutil = require('gulp-util');
var minifyCSS = require('gulp-minify-css');
var uglify = require('gulp-uglify');


gulp.task('less', function () {
    gulp.src('assests/css/styles.less')
        .pipe(less()
            .on('error', gutil.log)
            .on('error', gutil.beep)
            .on('error', function (err) {
                console.log('err', err);
                var pathToFile = err.fileName.split('\\');
                file = pathToFile[pathToFile.length - 1];
                // say.speak('Albert', 'Less is fucked---' + file + '--- Line ' + err.lineNumber);
            })
        )
        .pipe(minifyCSS({
            keepSpecialComments: 1
        }))
        .pipe(gulp.dest('assests/css/'));
});


gulp.task('compressJs', function () {
    return gulp.src('assests/js/site.js')
        .pipe(uglify())
        .pipe(gulp.dest('assests/js/'));
});

gulp.task('build', ['less', 'compressJs']);

gulp.task('default', ['build']);
