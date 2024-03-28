let mix = require('laravel-mix')
let path = require('path')
require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('src/Nova/deep-link.js', 'js')
  .vue({version: 3})
  .alias({'@': path.join(__dirname, 'src/Nova/')})
  .sass('src/Nova/deep-link.scss', 'css')
  .nova('{{vendor}}')
  .version()
