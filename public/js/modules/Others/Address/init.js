import { City } from "./City.js";
import { Country } from "./Country.js";
import { State } from "./State.js";
import { locations } from "./locations.js";

export const init = () => {
  const country = new Country();
  const state = new State();
  const city = new City();
  const { cityList, stateList, countryList } = locations;

  countryList.forEach((countryItem) => {
    if (countryItem) country.handle(countryItem);
  });

  stateList.forEach((stateItem) => {
    if (stateItem) state.handle(stateItem);
  });

  cityList.forEach((cityItem) => {
    if (cityItem.dataset.loadAddress)
      city.handle(cityItem, { state: cityItem.dataset.loadAddress });
  });
};
