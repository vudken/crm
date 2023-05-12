var gulp = require("gulp"),
    rename = require("gulp-rename"),
    vars = require('../variables');
    sourcemaps = require("gulp-sourcemaps")
    concat = require("gulp-concat")
    npmdist = require('gulp-npm-dist')
    vars = require('../variables');

// Copy assets/vendors from their node_module package to dist folder
const copyAssets = function () {

    const out = vars.getBuildAssetsPath() + "js/";

    gulp

        .src([
            vars.getBuildAssetsPath() + "libs/jquery/jquery.min.js",
            vars.getBuildAssetsPath() + "libs/bootstrap/js/bootstrap.bundle.min.js",
            vars.getBuildAssetsPath() + "libs/simplebar/simplebar.min.js",
            vars.getBuildAssetsPath() + "libs/node-waves/waves.min.js",
            vars.getBuildAssetsPath() + "libs/waypoints/lib/jquery.waypoints.min.js",
            vars.getBuildAssetsPath() + "libs/jquery.counterup/jquery.counterup.min.js",
        ])

        .pipe(sourcemaps.init())
        .pipe(concat("vendor.js"))
        .pipe(
            rename({
                // rename vendor.js to vendor.min.js
                suffix: ".min"
            })
        )
        .pipe(gulp.dest(out));

    // data (json data) folder copy form src folder
    var outData = vars.getBuildAssetsPath() + "data/";

    return gulp.src([vars.getBaseAssetsPath() + "data/**/*"]).pipe(gulp.dest(outData));

}

const copyLibs = function () {
    const outLibs = vars.getBuildAssetsPath() + "libs/";
    return gulp
        .src(npmdist(), { base: "./node_modules" })
        .pipe(rename(function(path) {
            path.dirname = path.dirname.replace(/\/dist/, '').replace(/\\dist/, '');
        }))
        .pipe(gulp.dest(outLibs));

}

gulp.task(copyAssets);
gulp.task(copyLibs);