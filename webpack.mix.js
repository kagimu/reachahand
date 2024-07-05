const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [require("postcss-import"), require("tailwindcss"), require("autoprefixer")]
);
mix.copyDirectory(
    "node_modules/tinymce/icons",
    "public/node_modules/tinymce/icons"
);
mix.copyDirectory(
    "node_modules/tinymce/models",
    "public/node_modules/tinymce/models"
);
mix.copyDirectory(
    "node_modules/tinymce/plugins",
    "public/node_modules/tinymce/plugins"
);
mix.copyDirectory(
    "node_modules/tinymce/skins",
    "public/node_modules/tinymce/skins"
);
mix.copyDirectory(
    "node_modules/tinymce/themes",
    "public/node_modules/tinymce/themes"
);
mix.copy(
    "node_modules/tinymce/tinymce.js",
    "public/node_modules/tinymce/tinymce.js"
);
mix.copy(
    "node_modules/tinymce/tinymce.min.js",
    "public/node_modules/tinymce/tinymce.min.js"
);
