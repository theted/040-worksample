const pkg = require('./package.json')
const appName = 'app'
const version = appName + pkg.version
const baseSrc = 'src/'

module.exports = {
  name: appName,
  version: version,
  environment: 'DEVELOPMENT',
  port: 6666,
  browserSyncPort: 8285,
  path: 'dist/',
  bsFiles: 'dist/**/*.*',
  bsConfig: {
    server: {
      baseDir: './dist/'
    },
    files: [
      './src/**/*.*',
      './dist/' + version + '.css',
      './dist/' + version + '.js',
      './dist/**/*.html'
    ],
    browser: []
  },
  pugConfig: {
    compileDebug: true,
    pretty: true,
    verbose: true
  },
  paths: {
    js: baseSrc + 'js/**.js',
    style: baseSrc + 'style/style.styl',
    // style: baseSrc + 'style/**.styl',
    views: baseSrc + 'content/**.pug'
  },
  out: {
    css: version + '.css',
    js: version + '.js',
    jsMin: version + '-min.js'
  }
}
