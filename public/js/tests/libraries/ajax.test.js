import { HTTP_STATUS } from "../../constants/http";
import { ajax } from "../../libraries/Ajax";

const fetch = require("node-fetch");
global.fetch = fetch;

describe("LIBRARY - Ajax:", () => {
  const path = "sandbox/users";
  test(`Test at method GET in LIbrary Ajax`, async () => {
    const url = `http://127.0.0.1:3000/api/${path}`;

    const response = await ajax.get(url);

    expect(response.status).toBe(HTTP_STATUS.OK);
    expect(Array.isArray(response.data)).toBeTruthy();
  });
});
