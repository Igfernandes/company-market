import fs from "fs";
import os from "os";
import open from "open"; // npm install open

const envPath = ".env";
const port = 8080;

function updateEnv(newUrl) {
  let content = fs.existsSync(envPath) ? fs.readFileSync(envPath, "utf8") : "";

  if (/^\s*app\.baseURL\s*=.*$/im.test(content)) {
    // Substitui a linha existente
    content = content.replace(/^\s*app\.baseURL\s*=.*$/im, `app.baseURL='${newUrl}'`);
  } else {
    // Garante que vai ter quebra de linha antes de adicionar
    content = content.trimEnd() + `\napp.baseURL=${newUrl}\n`;
  }

  fs.writeFileSync(envPath, content, "utf8");
  console.log(`✅ app.baseURL atualizado para: ${newUrl}`);
}

function getLocalIp() {
  const interfaces = os.networkInterfaces();
  for (const name of Object.keys(interfaces)) {
    for (const iface of interfaces[name]) {
      if (iface.family === "IPv4" && !iface.internal) {
        return iface.address;
      }
    }
  }
  return "127.0.0.1";
}

const localIp = getLocalIp();
const url = `http://${localIp}:${port}/`;

updateEnv(url);

open(url).then(() => {
  console.log("🎉 Navegador aberto na URL da rede local:", url);
});
