/* eslint-disable */
import { exec } from "child_process";
import through2 from "through2";

import gulp from "gulp";
import ejs from "gulp-ejs";
import sourcemaps from "gulp-sourcemaps";
import replace from "gulp-replace";
import prettier from "gulp-prettier";
import rename from "gulp-rename";
import prettify from "gulp-prettify";
import debug from "gulp-debug";
import plumber from "gulp-plumber";
import filter from "gulp-filter";
import notify from "gulp-notify";
import pug from "gulp-pug";
import dartSass from "gulp-dart-sass";
import postcss from "gulp-postcss";
import autoprefixer from "autoprefixer";
import cssnano from "cssnano";
import gulpif from "gulp-if";
import sassGlob from "gulp-sass-glob-use-forward";
import cached from "gulp-cached";
import dependents from "gulp-dependents";
import browserSync from "browser-sync";
import webp from "gulp-webp";

const { src, dest, watch, series, parallel, lastRun, task } = gulp;
const isProd = process.env.NODE_ENV === "production";
const useBrowsersync = true;

const isCssCompress = true;
const autoprefixerOption = {
	cascade: false,
	grid: false,
};
const postCssOptions = isCssCompress ? [autoprefixer(autoprefixerOption), cssnano] : [autoprefixer(autoprefixerOption)];

const paths = {
	scss: {
		src: ["src/sass/**/*.scss", "!src/sass/public/**/*.scss"],
		base: "src/sass",
		includes: ["src/sass", "src/sass/import"],
		dest: "public/common/css",
	},
	scssPublic: {
		src: "src/sass/public/**/*.scss",
		base: "src/sass/public",
		includes: ["src/sass", "src/sass/import"],
		dest: "public",
	},
	jpg: {
		src: "src/img/**/*.jpg",
		base: "src/img",
		dest: "public",
	},
	png: {
		src: "src/img/**/*.png",
		base: "src/img",
		dest: "public",
	},
	pug: {
		src: "src/pug/**/*.pug",
		base: "src/pug/",
		dest: "public",
		outputExtension: ".php",
	},
	php: {
		src: "src/**/*.php",
		dest: "public",
	},
};

export function pug2php() {
	return gulp
		.src(paths.pug.src, { since: lastRun(pug2php) })
		.pipe(plumber({ errorHandler: notify.onError("<%= error.message %>") }))
		.pipe(filter((file) => !/\/_/.test(file.path) && !/^_/.test(file.relative)))
		.pipe(pug())
		.pipe(
			prettify({
				indent_size: 1,
				indent_char: "	",
				space_before_conditional: false,
				preserve_newlines: true,
				wrap_line_length: 0,
				unformatted: ["a", "span", "img", "code", "pre", "sub", "sup", "em", "strong", "b", "i", "u", "strike", "big", "small", "pre", "h1", "h2", "h3", "h4", "h5", "h6", "?php"], // List of tags that should not be reformatted
			})
		)
		.pipe(rename({ extname: paths.pug.outputExtension }))
		.pipe(dest(paths.pug.dest))
		.pipe(debug({ title: "pug dest:" }))
		.pipe(browserSync.reload({ stream: true }));
}

export function php() {
	return gulp
		.src(paths.pug.src, { since: lastRun(php) })
		.pipe(plumber({ errorHandler: notify.onError("<%= error.message %>") }))
		.pipe(gulp.dest(paths.pug.dest))
		.pipe(debug({ title: "php dest:" }))
		.pipe(browserSync.reload({ stream: true }));
}

// Ejs
export function compileEjs() {
	return gulp
		.src(["./src/**/*.ejs"], { since: lastRun(compileEjs) })
		.pipe(plumber())
		.pipe(ejs())
		.pipe(replace(/^[\t]*n\n/gim, ""))
		.pipe(rename({ extname: ".html" }))
		.pipe(dest("./public/"))
		.pipe(prettier())
		.pipe(
			dest(function (file) {
				return file.base;
			})
		)
		.pipe(browserSync.reload({ stream: true }));
}

// コンパイルされたhtmlをprittierを使って自動整形
export function formatHtml() {
	return gulp
		.src("./public/**/*.html", { since: lastRun(formatHtml) })
		.pipe(prettier())
		.pipe(
			dest(function (file) {
				return file.base;
			})
		)
		.pipe(browserSync.reload({ stream: true }));
}

const dependentsConfig = {
	".scss": {
		parserSteps: [
			/(?:^|;|{|}|\*\/)\s*@(import|use|forward|include)\s+((?:"[^"]+"|'[^']+'|url\((?:"[^"]+"|'[^']+'|[^)]+)\)|meta\.load\-css\((?:"[^"]+"|'[^']+'|[^)]+)\))(?:\s*,\s*(?:"[^"]+"|'[^']+'|url\((?:"[^"]+"|'[^']+'|[^)]+)\)|meta\.load\-css\((?:"[^"]+"|'[^']+'|[^)]+)\)))*)(?=[^;]*;)/gm,
			/"([^"]+)"|'([^']+)'|url\((?:"([^"]+)"|'([^']+)'|([^)]+))\)|meta\.load\-css\((?:"([^"]+)"|'([^']+)'|([^)]+))\)/gm,
		],
		prefixes: ["_"],
		postfixes: [".scss", ".sass"],
		basePaths: [],
	},
};
// Post CSS
export function styles() {
	return (
		gulp
			.src(paths.scss.src, { since: lastRun(styles) })
			.pipe(plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
			.pipe(sourcemaps.init())
			.pipe(sassGlob())
			// .pipe(cached("scss"))
			.pipe(dependents(dependentsConfig))
			.pipe(sassGlob())
			.pipe(
				dartSass
					.sync({
						includePaths: ["node_modules", paths.scss.base],
						// outputStyle: "expanded",
					})
					.on("error", dartSass.logError)
			)
			.pipe(postcss(postCssOptions))
			.pipe(sourcemaps.write("."))
			.pipe(dest(paths.scss.dest))
			.pipe(debug({ title: "scss dest:" }))
			.pipe(browserSync.reload({ stream: true }))
	);
}
// Post CSS - to public
export function stylesPublic() {
	return (
		gulp
			.src(paths.scssPublic.src, { since: lastRun(styles) })
			.pipe(plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
			.pipe(sourcemaps.init())
			.pipe(sassGlob())
			// .pipe(cached("scss"))
			.pipe(dependents(dependentsConfig))
			.pipe(sassGlob())
			.pipe(
				dartSass
					.sync({
						includePaths: ["node_modules", paths.scssPublic.base],
						// outputStyle: "expanded",
					})
					.on("error", dartSass.logError)
			)
			.pipe(postcss(postCssOptions))
			.pipe(sourcemaps.write("."))
			.pipe(dest(paths.scssPublic.dest))
			.pipe(debug({ title: "scss dest:" }))
			.pipe(browserSync.reload({ stream: true }))
	);
}

// webp
export function jpg2webp() {
	return gulp
		.src(paths.jpg.src)
		.pipe(
			webp({
				quality: 80,
				method: 6,
			})
		)
		.pipe(gulp.dest(paths.jpg.dest))
		.pipe(debug({ title: "jpg2webp dest:" }))
		.pipe(browserSync.reload({ stream: true }));
}
export function png2webp() {
	return gulp
		.src(paths.png.src)
		.pipe(
			webp({
				lossless: true,
			})
		)
		.pipe(gulp.dest(paths.png.dest))
		.pipe(debug({ title: "png2webp dest:" }))
		.pipe(browserSync.reload({ stream: true }));
}

export function serve() {
	if (useBrowsersync)
		browserSync.init({
			proxy: "localhost",
			browser: ["chrome"],
			streamDelay: 0,
			open: false,
			// https: true,
			ghostMode: {
				clicks: false,
				forms: false,
				scroll: false,
			},
			// bs: {
			// 	port: '80',
			//     baseDir: `./${opt.dest}`,
			// }
		});
}

export function watches() {
	if (useBrowsersync) {
		serve();
	}
	watch(paths.scss.src, styles);
	watch(paths.scssPublic.src, stylesPublic);
	watch(paths.jpg.src, jpg2webp);
	watch(paths.png.src, png2webp);
	watch(paths.pug.src, pug2php);
}

export const build = series(parallel(pug2php, php, compileEjs, formatHtml, styles, stylesPublic, jpg2webp, png2webp));
export const image = series(parallel(jpg2webp, png2webp));
export const sass = styles;
export const scss = styles;
export default watches;
