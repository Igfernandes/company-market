import { HTTP_STATUS } from "@constants/http";
import { ajax } from "@libraries/Ajax/index.js";


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

  test("POST sem payload", async () => {
    mockFetch([{ id: 1 }]);

    const response = await ajax.post(baseUrl);

    expect(response.status).toBe(defaultStatus);
    expect(Array.isArray(response.data)).toBeTruthy();
  })

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
});
