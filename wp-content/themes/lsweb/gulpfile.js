/* Configuration of entry points and paths for all tasks */
const config = {
	scripts: {
		main: {
			src: [
				'node_modules/object-fit-images/dist/ofi.js', // object-fit polyfill
				'node_modules/slick-carousel/slick/slick.min.js',
				'src/js/**/*.js',
			],
			file: 'main.js',
			dest: 'assets/js/main',
		},
		//editor: {
		//	src: 'src/js/editor.js',
		//	dest: 'assets/js/editor',
		//},
	},
	styles: {
		main: {
			src: 'src/scss/main.scss',
			dest: 'assets/css',
			file: 'main.css',
			watchSrc: 'src/scss/**/*.scss',
		},
		admin: {
			src: 'src/scss/admin.scss',
			dest: 'assets/admin',
			file: 'main.css',
			watchSrc: 'src/scss/partials/pages/**/*.scss',
		},
		bootstrap: {
			src: 'src/scss/bootstrap.scss',
			dest: 'assets/css',
			file: 'bootstrap.css',
			watchSrc: 'src/scss/**/*.scss',
		},
		editor: {
			src: 'src/scss/editor-style.scss',
			dest: 'assets/css',
			file: 'editor-style.css',
			watchSrc: 'src/scss/**/*.scss',
		},
		blocks: {
			src: 'src/scss/blocks-editor-style.scss',
			dest: 'assets/css',
			file: 'blocks-editor-style.css',
			watchSrc: 'src/scss/**/*.scss',
		},
	},
};

const sassTildeImporter = ( url ) => {
	return url[ 0 ] === '~' ? { file: url.substr( 1 ) } : null;
};

const gulp = require( 'gulp' );
const plumber = require( 'gulp-plumber' );
const concat = require( 'gulp-concat' );
const sourcemaps = require( 'gulp-sourcemaps' );

const sassGlob = require( 'gulp-sass-glob' );
const sass = require('gulp-sass')(require('sass'));

const postcss = require( 'gulp-postcss' );
const cssnano = require( 'cssnano' );
const autoprefixer = require( 'autoprefixer' );

const objectFitImages = require( 'postcss-object-fit-images' );

const babel = require( 'gulp-babel' );
const uglify = require( 'gulp-uglify-es' ).default; // we use ES6 compatible minifier for future :)
const gulpIf = require( 'gulp-if' );

gulp.task( 'styles', () => {
	return gulp
		.src( config.styles.main.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe( sassGlob() )
		.pipe(
			sass( {
				silenceDeprecations: [ 'color-functions', 'legacy-js-api' ],
				includePaths: [ 'node_modules' ],
				importer: sassTildeImporter,
			} )
		)
		.pipe( concat( config.styles.main.file ) )
		.pipe( postcss( [ objectFitImages, autoprefixer, cssnano ] ) )
		.pipe( sourcemaps.write( '.' ) )

		.pipe( gulp.dest( config.styles.main.dest ) );
} );

gulp.task( 'admin', () => {
	return gulp
		.src( config.styles.admin.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe( sassGlob() )
		.pipe(
			sass( {
				silenceDeprecations: [ 'color-functions', 'legacy-js-api' ],
				includePaths: [ 'node_modules' ],
				importer: sassTildeImporter,
			} )
		)
		.pipe( concat( config.styles.admin.file ) )
		.pipe( postcss( [ objectFitImages, autoprefixer, cssnano ] ) )
		.pipe( sourcemaps.write( '.' ) )

		.pipe( gulp.dest( config.styles.admin.dest ) );
} );

gulp.task( 'bootstrap', () => {
	return gulp
		.src( config.styles.bootstrap.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe( sassGlob() )
		.pipe(
			sass( {
				silenceDeprecations: [ 'color-functions', 'legacy-js-api' ],
				includePaths: [ 'node_modules' ],
				importer: sassTildeImporter,
			} )
		)
		.pipe( concat( config.styles.bootstrap.file ) )
		.pipe( postcss( [ objectFitImages, autoprefixer, cssnano ] ) )
		.pipe( sourcemaps.write( '.' ) )

		.pipe( gulp.dest( config.styles.bootstrap.dest ) );
} );

gulp.task( 'editor-styles', () => {
	return gulp
		.src( config.styles.editor.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe( sassGlob() )
		.pipe(
			sass( {
				silenceDeprecations: [ 'color-functions', 'legacy-js-api' ],
				includePaths: [ 'node_modules' ],
				importer: sassTildeImporter,
			} )
		)
		.pipe( concat( config.styles.editor.file ) )
		.pipe( postcss( [ objectFitImages, autoprefixer, cssnano ] ) )
		.pipe( sourcemaps.write( '.' ) )

		.pipe( gulp.dest( config.styles.editor.dest ) );
} );

gulp.task( 'block-styles', () => {
	return gulp
		.src( config.styles.blocks.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe( sassGlob() )
		.pipe(
			sass( {
				silenceDeprecations: [ 'color-functions', 'legacy-js-api' ],
				includePaths: [ 'node_modules' ],
				importer: sassTildeImporter,
			} )
		)
		.pipe( concat( config.styles.blocks.file ) )
		.pipe( postcss( [ objectFitImages, autoprefixer, cssnano ] ) )
		.pipe( sourcemaps.write( '.' ) )

		.pipe( gulp.dest( config.styles.blocks.dest ) );
} );

gulp.task( 'scripts', () => {
	return gulp
		.src( config.scripts.main.src )
		.pipe( sourcemaps.init() )
		.pipe(
			plumber( {
				errorHandler: function( err ) {
					console.log( err );
					this.emit( 'end' );
				},
			} )
		)
		.pipe(
			babel( {
				presets: [ '@babel/env' ],
			} )
		)
		.pipe( concat( config.scripts.main.file ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulpIf( '*.js', uglify() ) )
		.pipe( gulp.dest( config.scripts.main.dest ) );
} );

gulp.task( 'watch:styles', () =>
	gulp.watch( config.styles.main.watchSrc, gulp.series( 'styles' ) )
);
gulp.task( 'watch:bootstrap', () =>
	gulp.watch( config.styles.bootstrap.watchSrc, gulp.series( 'bootstrap' ) )
);
gulp.task( 'watch:editor-styles', () =>
	gulp.watch( config.styles.editor.watchSrc, gulp.series( 'editor-styles' ) )
);
gulp.task( 'watch:block-styles', () =>
	gulp.watch( config.styles.blocks.watchSrc, gulp.series( 'block-styles' ) )
);
gulp.task( 'watch:scripts', () =>
	gulp.watch( config.scripts.main.src, gulp.series( 'scripts' ) )
);

gulp.task(
	'watch',
	gulp.series(
		gulp.parallel( 'styles', 'editor-styles', 'block-styles', 'scripts' ),
		gulp.parallel( 'watch:styles', 'watch:editor-styles', 'watch:block-styles', 'watch:scripts' )
	)
);

gulp.task( 'default', gulp.parallel( 'styles', 'editor-styles', 'scripts' ) );
