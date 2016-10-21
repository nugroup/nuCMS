var gulp = require('gulp');
var fs = require('fs'); // node file system
var assets = JSON.parse(fs.readFileSync('./assets.json')); // path to JSON of copied files
// Load plugins
var less = require('gulp-less');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify');
var pump = require('pump');
var connect = require('gulp-connect');
var less_glob = require('less-plugin-glob');
var watch = require('gulp-watch');
var handlebars = require('gulp-compile-handlebars');
var rename = require('gulp-rename');
var notify = require("gulp-notify");
var dirSync = require( 'gulp-directory-sync' );
var browserSync = require('browser-sync').create();


// --------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------- Gulp Tasks
// --------------------------------------------------------------------------------------------------------

// copy assets from assets.json
gulp.task('assets', function(){
    for (var i = 0; i < assets.assets.length; i++) {
        gulp.src(assets.assets[i].source).pipe(gulp.dest(assets.assets[i].copyTo))
    }
});

// less to css and autoprefix
gulp.task('less', function () {
    return gulp.src('app/less/nu.less')
    .pipe(less( { plugins: [require('less-plugin-glob')] } ))
    .on('error', swallowError)
    .pipe(autoprefixer({ browsers: ['last 2 versions'] }))
    .pipe(cleanCSS())
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('assets/css/'))
    .pipe(browserSync.reload({stream: true}));
});

// concat JS files
gulp.task('js', function() {
    return gulp.src('app/js/**/*.js')
    .pipe(concat('nu.js'))
    .pipe(minify({
        ext:{
            min:'.min.js'
        },
    }))
    .pipe(gulp.dest('assets/js/'))
    .pipe(browserSync.reload({stream: true}));
});

// copy media folder
gulp.task('copy_media', function() {
    return gulp.src('')
    .pipe(dirSync( 'app/media/', 'assets/media/', { printSummary: true } ))
    .pipe(browserSync.reload({stream: true}));
});

// --------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------- Watches and multitasks
// --------------------------------------------------------------------------------------------------------

// browser sync and watches
gulp.task('start', ['assets', 'copy_media', 'js', 'less'], function () {

    // browser sync
    browserSync.init({
        server: {
            baseDir: './'
        },
        ui: false,
        browser: 'chrome',
        scrollProportionally: false
        // notify: false
    });

    // watches
    watch('./app/js/**/*.js', function(){
        gulp.start('js');
    });
    watch('./app/less/**/*.less', function(){
        gulp.start('less');
    });
    watch('./app/media/**', function(){
        gulp.start('copy_media');
    });
});

// --------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------- Helpers
// --------------------------------------------------------------------------------------------------------

// helper for not stoping watch when error
function swallowError (error) {
    console.log(error.toString())
    this.emit('end')
};
