const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
var path = require('path')

module.exports = {
  entry: {
    app: './src/js/app.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].js',
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: './css/[name].css',
    }),

    // Uncomment this if you want to use CSS Live reload
    new BrowserSyncPlugin(
      {
        proxy: 'http://localhost/kharidpack',
        files: ['dist/*.css'],
        injectCss: true,
      },
      { reload: false }
    ),
  ],
  module: {
    rules: [
      {
        test: /\.s?[c]ss$/i,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
      },
      {
        test: /\.sass$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: { indentedSyntax: true },
            },
          },
        ],
      },
      {
        test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
        use: 'url-loader?limit=1024',
      },
    ],
  },
}
