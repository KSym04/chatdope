const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require("path");

module.exports = (env, argv) => ({
  entry: {
    admin: ["./assets/js/admin.js", "./assets/css/backend.scss"],
    public: ["./assets/js/public.js", "./assets/css/frontend.scss"],
  },
  output: {
    filename: "assets/dist/js/[name].js",
    path: path.resolve(__dirname),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          "css-loader",
          "sass-loader",
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: (chunkData) => {
        return chunkData.chunk.name === "admin"
          ? "assets/dist/css/backend.css"
          : "assets/dist/css/frontend.css";
      },
    }),
  ],
  devtool: argv.mode === "development" ? "source-map" : false,
});
