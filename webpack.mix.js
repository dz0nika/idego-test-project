const mix = require('laravel-mix')
const path = require('path')
const webpack = require('webpack')
require('mix-tailwindcss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js('resources/js/app.js', 'public/js')
  .vue()
  .postCss('resources/css/app.css', 'css', [require('postcss-import'), require('autoprefixer')])
  .tailwind()
  .alias({
    '@': path.resolve('resources/js'),
  })
  .webpackConfig({
    output: {
      chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
    plugins: [
      new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
      }),
    ],
    stats: {
      children: true,
    },
  })

if (mix.inProduction()) {
  mix.version()
}
