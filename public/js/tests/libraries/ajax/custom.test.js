import { HTTP_STATUS } from "@constants/http";
import { ajax } from "@libraries/Ajax";

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
});
