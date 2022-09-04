const mix = require("laravel-mix");

mix.ts("resources/js/app.ts", "public/js").vue({version: 3})
    .css("resources/css/app.css", "public/css");
