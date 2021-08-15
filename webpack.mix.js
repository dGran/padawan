const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const isProd = mix.inProduction();
const tailwindConfig = require("./tailwind.config")(isProd);

mix.js("resources/js/app.js", "public/js/app.js")
    .sass("resources/sass/app.scss", "public/css/app.css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss(tailwindConfig)],
    })
    .sourceMaps();

if (isProd) {
    mix.version();
}