import { api } from "../../data/Api.js";
import { Ajax } from "../../libs/Ajax/index.js";

export async function searchCPF(document, bithdate) {
  const ajax = new Ajax();
  const token = "129938705GPLZmCRHey234600392";
  const CPF_FILTERED = document
    .replaceAll(".", "")
    .replaceAll("-", "")
    .replaceAll("/", "");
  const Payload = {
    token,
    cpf: CPF_FILTERED,
    data: bithdate,
  };

  const { data } = await ajax.get(`${api.hubdo.default}/cpf/`, Payload, {
    reference: "searchCpf",
  });

  return data;
}
