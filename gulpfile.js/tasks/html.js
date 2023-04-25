var gulp = require("gulp"),
    fileinclude = require('gulp-file-include'),
    vars = require('../variables');

// copy html files from src folder to dist folder, also copy favicons
const copyHtml = function () {
    const baseSrc = vars.getBaseSrcPath() + 'View/';
    const out = vars.getBaseBuildPath();

    // copy partials

    return gulp
        .src([
            baseSrc + "*.html",
            baseSrc + "*.ico", // favicons
            baseSrc + "*.png"
        ])
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file',
            indent: true
        }))
        .pipe(gulp.dest(out));
}

gulp.task(copyHtml);