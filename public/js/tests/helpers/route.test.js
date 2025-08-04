import { getQueryParams, getUrlBase } from "../../helpers/route.js";

describe("HELPER - Route:", () => {
  test(`Return only path url`, () => {
    const path = "/image/icon.png";
    const originalUrl = `https://teste.com/public${path}`;

    expect(getUrlBase(originalUrl)).toBe(path);
  });

  test(`Return querystring to request GET`, () => {
    const payload = {
      id: 1,
      name: "teste",
    };

    expect(getQueryParams(payload)).toBe("id=1&name=teste&");
  });
});
