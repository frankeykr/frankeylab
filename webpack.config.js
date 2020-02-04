const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  mode: 'development',
  entry: {
    base: [
      path.join(__dirname, 'src/scss/style.scss'),
    ],

    infinite_scroll: [
      './src/js/infinite_scroll.js',
    ],
  },
  output: {
    path: path.join(__dirname, 'web/app/themes/frankeylab/dist'),
    filename: 'js/[name].js',
  },
  resolve: {
    // モジュールを読み込むときに検索するディレクトリの設定
    modules: [
      path.join(__dirname, 'src/js'),
      path.join(__dirname, 'src/scss'),
      path.join(__dirname, 'node_modules')
    ],
    // importするときに省略できる拡張子の設定
    extensions: ['.js', '.scss'],
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        query: {
          presets: ['@babel/preset-env']
        },
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              url: false
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              plugins: [
                require('cssnano')({
                  preset: 'default',
                }),
                require('autoprefixer')({
                  "overrideBrowserslist": [
                    "> 1%",
                    "IE 10",
                  ]
                })
              ]
            },
          },
          'sass-loader',
        ]
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    })
  ],
};
