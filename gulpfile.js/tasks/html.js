var gulp = require("gulp"),
    fileinclude = require('gulp-file-include'),
    vars = require('../variables');

// copy html files from src folder to dist folder, also copy favicons
const copyHtml = function () {
    const baseTemplates = vars.getBaseTemplatesPath() + 'view/';
    const out = vars.getBaseBuildPath();

    // copy partials

    return gulp
        .src([
            baseTemplates + "*.html",
            baseTemplates + "*.ico", // favicons
            baseTemplates + "*.png"
        ])
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file',
            indent: true
        }))
        .pipe(gulp.dest(out));
}

gulp.task(copyHtml);