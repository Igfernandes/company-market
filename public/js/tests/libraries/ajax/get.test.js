import { HTTP_STATUS } from "@constants/http";
import { ajax } from "@libraries/Ajax";
import { mutate } from "@libraries/Ajax/libs/mutate";
import cookies from "@helpers/cookies";

jest.mock("@helpers/cookies", () => ({
  get: jest.fn(),
  set: jest.fn(),
}));

global.fetch = jest.fn();

describe("LIBRARY - Ajax:", () => {
  const path = "users";
  const baseUrl = `http://127.0.0.1:3000/api/${path}`;
  const defaultStatus = HTTP_STATUS.OK;

  const mockFetch = (data, url = baseUrl, status = defaultStatus) => {
    global.fetch.mockResolvedValueOnce({
      json: async () => data,
      status,
      url,
    });
  };

  beforeEach(() => {
    jest.clearAllMocks();
  });

  test("GET sem query params", async () => {
    mockFetch([{ id: 1 }]);

    const response = await ajax.get(baseUrl);

    expect(response.status).toBe(defaultStatus);
    expect(Array.isArray(response.data)).toBeTruthy();
    expect(global.fetch).toHaveBeenCalledTimes(1);
  });

  test("GET com query params (filtrando por CPF)", async () => {
    const USER_CPF = "123.456.789-00";
    const mockData = [{ id: 1, cpf: USER_CPF }];

    mockFetch(mockData, `${baseUrl}/?cpf=${USER_CPF}`);

    const response = await ajax.get(baseUrl, { cpf: USER_CPF });

    expect(response.status).toBe(defaultStatus);
    expect(response.data).toHaveLength(1);
  });

  test("POST sem payload", async () => {
    mockFetch([{ id: 1 }]);

    const response = await ajax.post(baseUrl);

    expect(response.status).toBe(defaultStatus);
    expect(Array.isArray(response.data)).toBeTruthy();
  });

  test("GET usando cache de cookies", async () => {
    cookies.get.mockReturnValueOnce({ data: [{ id: 99 }] });

    const response = await ajax.get(baseUrl);

    expect(response).toEqual({
      data: [{ id: 99 }],
      status: defaultStatus,
      url: baseUrl,
    });
    expect(global.fetch).not.toHaveBeenCalled();
  });

  test("POST com payload", async () => {
    const payload = { name: "João" };
    mockFetch([payload]);

    await ajax.post(baseUrl, payload);

    expect(global.fetch).toHaveBeenCalledWith(
      baseUrl,
      expect.objectContaining({
        method: "POST",
        body: payload,
      })
    );
  });

  test("custom() com método padrão POST", async () => {
    const payload = { test: true };
    mockFetch([payload]);

    const response = await ajax.custom(baseUrl, payload);

    expect(response.status).toBe(defaultStatus);
    expect(global.fetch).toHaveBeenCalledWith(
      baseUrl,
      expect.objectContaining({
        method: "POST",
        body: JSON.stringify(payload),
      })
    );
  });

  test("custom() com método PUT", async () => {
    const payload = { id: 1 };
    const options = { method: "PUT" };
    mockFetch([payload]);

    await ajax.custom(baseUrl, payload, options);

    expect(global.fetch).toHaveBeenCalledWith(
      baseUrl,
      expect.objectContaining({ method: "PUT" })
    );
  });

  test("mutate() não grava cookies se método não for GET", async () => {
    const responseMock = { json: async () => [{ id: 1 }], status: defaultStatus, url: baseUrl };

    await mutate({ method: "POST", urlFetched: baseUrl, queryKey: "key" }, responseMock);

    expect(cookies.set).not.toHaveBeenCalled();
  });
});
