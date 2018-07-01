/* 
 * @author hc
 * @since 3 трав. 2017
 */

var gulp = require('gulp');

gulp.task('default', function () {
    gulp.start('html');
    gulp.watch([
        './public_html/base/*.html',
        './public_html/pages/*.html'
    ], ['html']);
    //gulp.watch('./public_html/css/*', ['css']);
});

gulp.task('html', function() {
    var concat = require('gulp-concat');
    var html = './public_html/';
    
    fs = require("fs");
    files = fs.readdirSync('./public_html/pages/');
    
    for (i in files) {
        var matches = files[i].match(/([0-9a-z_-]+).html/i);
        var name = matches[1];
        if (name === undefined) {
            console.warn("Can't parse filename");
            continue;
        }
        gulp.src([
            html + 'base/header.html',
            html + 'pages/' + name + '.html', 
            html + 'base/footer.html'
        ])
        .pipe(concat(name + '.html'))
        .pipe(gulp.dest(html));
    }
    return true;
});

gulp.task('css', function() {
    var minify = require('gulp-clean-css');
    var concat = require('gulp-concat');
    
    return gulp.src('./public_html/css/*.css')
    .pipe(minify({compatibility: 'ie9'}))
    .pipe(concat('style.min.css'))
    .pipe(gulp.dest('./public_html/css/'));
});
