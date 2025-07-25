import { getClubService } from "../../../services/Club/Get.js";

export function Clubs() {
  this.handle = async (ev) => {
    const element = ev.currentTarget ?? ev;
    const selectsClub = document.querySelectorAll(
      `[data-target-clubs='${element.dataset.referenceClubs}']`
    );

    const queryString = {};

  
    if (element.value) queryString["federacao"] = element.value;

    const { data: response } = await getClubService(queryString);
  
    selectsClub.forEach((select) => {
      if (!response) throw new Error("Não foi possível carregar os clubes");

      select.innerHTML = '<option value="" selected> Selecione o Clube </option>"';
      response.map(({ nome_institucional, id }) => {
        select.innerHTML +=
          '<option value="' + id + '" >' + nome_institucional + "</option>";
      });

      $(select).select2();
    });
  };
}

export const init = () => {
  const clubs = new Clubs();
  const federationSelect = document.querySelectorAll(
    "[data-clubs='federation']"
  );

  federationSelect.forEach((federation) => {
    $(federation).on("select2:select", function (e) {
      clubs.handle(e);
    });
  });
};
