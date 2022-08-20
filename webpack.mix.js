const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const isProd = mix.inProduction();
const tailwindConfig = require("./tailwind.config")(isProd);

mix.js("resources/js/app.js", "public/js/app.js")
    .js('resources/js/eteam/listeners.js', 'public/js/eteam/listeners.js')
    .js('resources/js/eteam/focus-search.js', 'public/js/eteam/focus-search.js')
    .sass("resources/sass/app.scss", "public/css/app.css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss(tailwindConfig)],
    })
    .sourceMaps();

if (isProd) {
    mix.version();
}