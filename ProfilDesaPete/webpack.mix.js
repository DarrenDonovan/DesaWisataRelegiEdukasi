const mix = require("laravel-mix");

// Compile CSS
mix.postCss("resources/css/style.css", "public/css/app.css", [
    require("autoprefixer")({
        overrideBrowserslist: ["last 10 versions"],
        grid: true,
    }),
]);

// Compile JS
mix.scripts(
    ["resources/js/main.js", "resources/js/jquery-3.7.1.min.js"],
    "public/js/app.js"
);

// Minify files
mix.minify("public/css/app.css");
mix.minify("public/js/app.js");

// Enable live reload
mix.browserSync("localhost:8000");

mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');