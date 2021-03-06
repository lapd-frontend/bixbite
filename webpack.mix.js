const mix = require('laravel-mix');
const isPanel = process.argv.includes('--skin');

mix.options({
    processCssUrls: false
});

/**
 * Skin.
 */
if (isPanel) {
    const SKIN = process.env.APP_SKIN;
    const SKIN_PATH = './resources/skins/' + SKIN;

    mix.webpackConfig({
            resolve: {
                extensions: [
                    '.js',
                    '.vue',
                ],

                alias: {
                    '@': __dirname + '/resources/skins/'+SKIN+'/assets/js'
                }
            }
        })
        .setPublicPath(SKIN_PATH + '/public/')
        .js(SKIN_PATH + '/assets/js/app.js', 'js')
        .sass(SKIN_PATH + '/assets/sass/app.scss', 'css')
        .js(SKIN_PATH + '/assets/js/code-editor.js', 'js')
        .sass(SKIN_PATH + '/assets/sass/code-editor.scss', 'css')
        .sass(SKIN_PATH + '/assets/sass/login.scss', 'css')
        .copyDirectory('node_modules/font-awesome/fonts',
            SKIN_PATH + '/public/css/fonts/font-awesome');
} else {
    /**
     * Theme.
     */
    const THEME = process.env.APP_THEME;
    const THEME_PATH = './resources/themes/' + THEME;

    mix.setPublicPath(THEME_PATH + '/public/')
        .js(THEME_PATH + '/assets/js/app.js', 'js')
        .sass(THEME_PATH + '/assets/sass/app.scss', 'css')
        .copyDirectory('node_modules/font-awesome/fonts',
            THEME_PATH + '/public/css/fonts/font-awesome');
}

/**
 * This has the benefit of not needing to cache-bust the vendor.js file,
 * if no changes have been made to the dependencies that have been extracted.
 * JavaScript jQuery и Twitter Bootstrap - не используются.
 */
mix.extract([
    'axios',
    // 'baguettebox.js',
    // 'codemirror',
    // '@emmetio/codemirror-plugin',
    // // 'bxb-modal',
    // // 'bxb-notification',
    // // 'bxb-scroll-to-top',
    // // 'lodash',
    // 'quill',
    // 'vue',
]);

mix.inProduction() && mix.version();

/**
 * ----------------------------------------------------------------------------
 * Mix Asset Management
 * ----------------------------------------------------------------------------
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your Laravel application. By default, we are compiling the Sass
 * file for the application as well as bundling up all the JS files.
 * ----------------------------------------------------------------------------
 * Full API Mix
 * ----------------------------------------------------------------------------
 */
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });

// Aditional from https://scotch.io/tutorials/using-laravel-mix-with-webpack-for-all-your-assets
// .standaloneSass('src', output) // Faster, but isolated from Webpack.
// .fastSass('src', output) // Alias for mix.standaloneSass().
// .options({
//     extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//     uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
// })

// // Add shell command plugin configured to create JavaScript language file.
// const WebpackShellPlugin = require('webpack-shell-plugin');
//
// mix.webpackConfig({
//     plugins: [
//         new WebpackShellPlugin({
//             onBuildStart: ['php artisan lang:js --quiet'],
//             onBuildEnd: []
//         })
//     ]
// });
