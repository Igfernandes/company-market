import { defineConfig } from "vite";

export default defineConfig({
  server: {
    host: "0.0.0.0", // acessível externamente
    port: 3000,
    cors: {
      origin: true,
      credentials: true,
    },
    watch: {
      usePolling: true,
      interval: 300,
      ignored: [
        "**/node_modules/**",
        "**/vendor/**",
        "**/storage/**",
        "**/.git/**",
        "**/tests/**",
        "**/support/**",
        "**/scss/**",
        "**/githooks/**",
        "**/**.test.js",
        "**/app/Api/**",
      ],
    },
  },
  plugins: [
    {
      name: "watch-codeigniter-views",
      handleHotUpdate({ file, server }) {
        const pathsAvailable = ["Components", "Views", "Language"];
        const hasAvailablePath = pathsAvailable.some((path) =>
          file.includes(path)
        );
        if (file.endsWith(".php") && hasAvailablePath) {
          server.ws.send({ type: "full-reload", path: "*" });
        }
      },
    },
    {
      name: "watch-js-files",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".js")) {
          server.ws.send({ type: "full-reload", path: "*" });
        }
      },
    },
    {
      name: "watch-css-files",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".css")) {
          server.ws.send({ type: "full-reload", path: "*" });
        }
      },
    },
  ],
});
