import fs from "fs";
import os from "os";
import open from "open"; // npm install open

const envPath = ".env";
const port = 8080;

// Função para atualizar o .env
function updateEnv(newUrl) {
  let content = fs.existsSync(envPath) ? fs.readFileSync(envPath, "utf8") : "";
  if (content.includes("app.baseURL=")) {
    content = content.replace(/app.baseURL=.*/i, `app.baseURL=${newUrl}`);
  } else {
    content += `\napp.baseURL=${newUrl}`;
  }
  fs.writeFileSync(envPath, content, "utf8");
  console.log(`✅ app.baseURL atualizado para: ${newUrl}`);
}

// Função para pegar o IP da rede (LAN)
function getLocalIp() {
  const interfaces = os.networkInterfaces();
  for (const name of Object.keys(interfaces)) {
    for (const iface of interfaces[name]) {
      if (iface.family === "IPv4" && !iface.internal) {
        return iface.address;
      }
    }
  }
  return "127.0.0.1"; // fallback
}

// Monta a URL completa usando o IP da rede e a porta do CI
const localIp = getLocalIp();
const url = `http://${localIp}:${port}/`;

updateEnv(url);

// Abre o navegador na URL da LAN
open(url).then(() => {
  console.log("🎉 Navegador aberto na URL da rede local:", url);
});
