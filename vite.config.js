import { defineConfig } from "vite";

export default defineConfig({
  server: {
    host: "localhost", // acessível externamente
    port: 3000,
    cors: {
      origin: true,
      credentials: true,
    },
    allowedHosts: [
      ".trycloudflare.com", // permite qualquer subdomínio do Cloudflare Tunnel
    ],
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
      ],
    },
  },
  plugins: [
    {
      name: "watch-codeigniter-views",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".php")) {
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
