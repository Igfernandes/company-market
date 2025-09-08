import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  entry: "./ts/app.ts",
  mode: "development",
  devtool: "source-map",
  watch: true,
  output: {
    path: path.resolve(__dirname, "public/script"),
    filename: "bundle.js", // precisa ter filename também
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
