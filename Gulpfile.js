// gulpfile
// derived from https://github.com/theted/gulp-broilerplate - needs optimization!
const { watch, src, dest, parallel, series } = require('gulp')
const browserSync = require('browser-sync').create()
const data = require('./data.js')
const config = require('./config')
const pug = require('gulp-pug')
const stylus = require('gulp-stylus')
const concat = require('gulp-concat')
const rename = require('gulp-rename')
const spawn = require('child_process').spawn

// data.version = config.version
config.pugConfig.data = data

const pathbuilder = (path) => {
  path.extname = ".php"
}

// compile pug -> HTML
const html = () => src(config.paths.views)
  .pipe(pug(config.pugConfig))
  .pipe(rename((path) => { pathbuilder(path) }))
  .pipe(dest('views'))

// compile stylus -> HTML
const css = () => src(config.paths.style)
  .pipe(stylus({ 'include css': true }))
  .pipe(concat(config.out.css))
  .pipe(dest('dist'))

// concatinate & minify JS
const js = () => src(config.paths.js)
  .pipe(concat('app.js'))
  .pipe(dest('dist'))

// watch files; compile on file event changes
const watchFiles = () => {
  // watch(config.paths.style, css)
  watch('src/style/**.styl', css)
  watch(config.paths.views, html)
  watch(config.paths.js, js)
  watch('./data.js', html)
  watch('Gulpfile.js', reload)
  watch('data.js', reload)
}

// setup browserSync; auto-reload compiled assets in open browser(s)
const bs = () => browserSync.init(config.bsConfig)

// auto-reload
const reload = () => {
  spawn('gulp', [], { stdio: 'inherit' })
  process.exit()
}

// setup global build script; build all resources
const build = parallel(html, css, js)
const defaultTask = parallel(build, bs, watchFiles)

module.exports = { build, bs, js, css, html, watch: watchFiles, default: defaultTask }
