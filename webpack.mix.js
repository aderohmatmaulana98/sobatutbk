let mix = require("laravel-mix");

// mix
// 	.js("src/js/exam/app.js", "asset/exam/js")
// 	.postCss("src/css/exam/app.css", "asset/exam/css", [
// 		require("tailwindcss"),
// 		require("autoprefixer"),
// 	]);

mix
	.js("src/js/homepage/app.js", "asset/homepage/js")
	.postCss("src/css/homepage/app.css", "asset/homepage/css", [
		require("tailwindcss"),
		require("autoprefixer"),
	]);
