import { api } from "../../data/Api.js";
import { Ajax } from "../../libs/Ajax/index.js";

export async function searchCNPj(document) {
  const ajax = new Ajax();
  const token = "129938705GPLZmCRHey234600392";

  const { data } = await ajax.get(`${api.hubdo.default}/cnpj/`, {
    token,
    cnpj: document.replaceAll(".", "").replaceAll("-", "").replaceAll("/", ""),
  });

  return data;
}
