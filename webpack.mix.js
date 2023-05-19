let mix = require('laravel-mix');

mix
.setPublicPath('public')
.js(['resources/js/libs/gsap.min.js','resources/js/libs/ScrollTrigger.min.js', 'resources/js/libs/ScrollSmoother.min.js'], 'public/dist/js/libs/appLibs.js')
.js('resources/js/app.js','dist/js/app/app.js')
.sass('resources/scss/app.scss','dist/css/app/app.css');

