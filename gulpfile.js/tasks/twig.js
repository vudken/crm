var gulp = require('gulp'),
    vars = require('../variables'),
    twig = require('gulp-twig');

// compile and copy twig files from src folder to dist folder
const compileTwig = function () {
    const baseAssets = vars.getBaseAssetsPath();
    const out = vars.getBaseBuildPath();

    return gulp
        .src([baseAssets + 'twig/**/*'])
        .pipe(twig({
            data: {
                title: 'Gulp and Twig',
                benefits: [
                    'Fast',
                    'Flexible',
                    'Secure'
                ]
            }
        }))
        .pipe(gulp.dest(out));
};

// gulp.task(compileTwig);