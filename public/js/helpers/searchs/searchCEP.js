import { api } from "../../data/Api.js";
import { Ajax } from "../../libs/Ajax/index.js";

export async function searchCEP(cep) {
  const ajax = new Ajax();
  const token = "129938705GPLZmCRHey234600392";

  const {
    data: { result },
  } = await ajax.get(
    `${api.hubdo.cep}`,
    {
      token,
      cep: cep,
    },
    {
      reference: "searchCep",
    }
  );

  return result ? result : false;
}
