const path = require("path");
module.exports = {
  entry: "/ts/app.ts",
  mode: "development",
  devtool: "source-map",
  watch: true,
  output: {
    path: path.resolve(__dirname, "public/script"),
  },
  resolve: {
    extensions: [".ts", ".js"],
  },
  module: {
    rules: [
      {
        test: /\.ts$/,
        use: "ts-loader",
        exclude: /node_modules/,
      },
    ],
  },
};
