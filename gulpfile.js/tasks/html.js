var gulp = require("gulp"),
    fileinclude = require('gulp-file-include'),
    vars = require('../variables'),
    gulpif = require('gulp-if'),
    twig = require('gulp-twig');

// copy html files from src folder to dist folder, also copy favicons
const copyHtml = function () {
    const baseViews = vars.getBaseViewsPath();
    const out = vars.getBaseBuildPath();

    return gulp
        .src([
            baseViews + '*.html',
            baseViews + '*.ico', // favicons
            baseViews + '*.png',
            baseViews + '*.twig'
        ])
        .pipe(gulpif('*.twig', twig({
            data: {
                title: 'Gulp and Twig',
                benefits: [
                    'Fast',
                    'Flexible',
                    'Secure'
                ]
            }
        })))
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file',
            indent: true
        }))
        .pipe(gulp.dest(out));
};

// gulp.task(copyHtml);