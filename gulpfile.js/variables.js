var args = require('yargs').argv;

/**
 * ---------------------------------------------------------------------------------------------
 * Global settings
 * ---------------------------------------------------------------------------------------------
*/

// const DEFAULT_DEMO = 'default';
// const AVAILABLE_DEMOS = ['corporate','creative', 'default', 'material', 'modern', 'saas'];

var FOLDER_PATHS = {
    baseSrc: "src/", // source files
    baseBuild: "public/build/", // build files
    baseAssets: "assets/", // base assets
};

// const selectedDemo = (args['demo'] ? (AVAILABLE_DEMOS.indexOf(args['demo']) >= 0 ? args['demo'] : null) : null) ? args['demo'] : DEFAULT_DEMO;

// function getSrcFolderPath() {
//     return FOLDER_PATHS.baseSrc + selectedDemo + "/";
// }

// function getBuildFolderPath() {
//     return FOLDER_PATHS.baseBuild + selectedDemo + "/";
// }

// // function getBuildAssetFolderPath() {
// //     return getBuildFolderPath(selectedDemo) + "assets/";
// // }

module.exports = {
    // getSelectedDemo: function () { return selectedDemo },
    getBaseSrcPath: function () { return FOLDER_PATHS.baseSrc },
    getBaseBuildPath: function () { return FOLDER_PATHS.baseBuild },
    getBaseAssetsPath: function () { return FOLDER_PATHS.baseAssets },
    // getSrcPath: getSrcFolderPath,
    // getBuildPath: getBuildFolderPath,
    getBuildAssetsPath: function () { return FOLDER_PATHS.baseBuild + 'assets/' },
}