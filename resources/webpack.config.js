const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const config = {
    mode: process.env.NODE_ENV,
    context: path.resolve(__dirname, ''),
    devtool: 'eval-source-map',

    watchOptions: {
      poll: 200,
      ignored: /node_modules/
    },

    output: {
      path: path.resolve(__dirname, './dist'),
      filename: 'js/[name].js',
      publicPath: '/'
  },

  resolve: {
    alias: {
      '@': path.resolve(__dirname, './assets/js/'),
      vue$: 'vue/dist/vue.esm.js'
    },
    extensions: ['.js', '.vue', '.json']
  },

  performance: {
      hints: false
  },

  module: {
    noParse: /^(vue|vue-router|vuex|vuex-router-sync)$/,
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            js: 'babel-loader'
          }
        }
      },

      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "babel-loader"
      },

      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader']
      },

      {
        test: /\.less$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'less-loader']
      },

      {
        test: /\.(png|jpg|jpeg|gif|svg|ico)$/,
        loader: 'file-loader',
        options: {
          name: 'images/[name].[ext]',
          emitFile: false,
        },
      },

      {
        test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/i,
        loader: 'file-loader',
        options: {
          name: 'fonts/[name].[ext]',
          emitFile: false,
        },
      },
    ]
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    }),

    new VueLoaderPlugin(),

    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),

    new webpack.optimize.ModuleConcatenationPlugin()
  ],

  optimization: {
      splitChunks: {
        cacheGroups: {
          vendors: {
            name: 'vendor',
            test: /[\\/]node_modules[\\/]/,
            priority: -10,
            chunks: 'initial'
          },
          default: {
            minChunks: 2,
            priority: -20,
            chunks: 'initial',
            reuseExistingChunk: true
          }
        }
      }
  },

  entry: {
    vendor: ['vue','jquery','uikit','vue-resource'],
    danelli: ['./assets/js/danelli.js']
  }
}

if (config.mode === 'production') {
  config.devtool = 'source-map',

  config.plugins = (config.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"',
      },
    })
  ]),

  Object.assign(config.optimization, {
    minimize: true,
    minimizer: [
      new UglifyJsPlugin({sourceMap: true}),
      new OptimizeCSSAssetsPlugin({})
    ]
  })
}

module.exports = config;
