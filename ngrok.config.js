import { createServer, loadConfigFromFile, mergeConfig } from "vite";
import ngrok from "@ngrok/ngrok";
import dotenv from "dotenv";
import { fileURLToPath } from "url";
import { dirname, resolve } from "path";

dotenv.config();

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const start = async () => {
  const port = process.env.NGROK_APP_PORT || 3000;

  // carrega config do vite (o mesmo que `vite.config.js`)
  const viteConfig = await loadConfigFromFile(
    { command: "serve", mode: "development" },
    resolve(__dirname, "vite.config.js")
  );

  // faz merge da config com a porta/host
  const finalConfig = mergeConfig(viteConfig.config);

  // sobe o vite
  const server = await createServer(finalConfig);
  await server.listen();

  // conecta ngrok
  const listener = await ngrok.connect({
    addr: 8080,
    authtoken: process.env.NGROK_AUTHTOKEN,
    // se tiver domínio fixo no .env, usa; senão ngrok gera um aleatório
    domain: process.env.NGROK_DOMAIN,
  });

  console.log(`🚀 Vite rodando em http://localhost:${port}`);
  console.log(`🌍 Ngrok exposto em ${listener.url()}`);

  // mantém processo vivo
  process.stdin.resume();
};

start().catch(console.error);
