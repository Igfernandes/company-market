import {
  getUrlBase,
  redirect,
  getQueryParams,
  getFormDataToJson,
} from "../../helpers/route.js";

describe("HELPER - Route:", () => {
  describe("getUrlBase", () => {
    it("deve retornar a parte da URL após 'public'", () => {
      expect(getUrlBase("http://localhost/public/images/test.png")).toBe(
        "/images/test.png"
      );
    });

    it("deve retornar undefined se 'public' não existir na URL", () => {
      expect(getUrlBase("http://localhost/images/test.png")).toBeUndefined();
    });
  });

  describe("getQueryParams", () => {
    it("deve retornar query string a partir de um objeto", () => {
      const query = getQueryParams({ foo: "123", bar: "abc" });
      expect(query).toBe("foo=123&bar=abc&");
    });

    it("deve retornar string vazia para objeto vazio", () => {
      expect(getQueryParams({})).toBe("");
    });
  });

  describe("getFormDataToJson", () => {
    it("deve converter FormData em objeto simples", () => {
      const fd = new FormData();
      fd.append("name", "Igor");
      fd.append("age", "30");

      expect(getFormDataToJson(fd)).toEqual({
        name: "Igor",
        age: "30",
      });
    });

    it("deve converter chaves duplicadas em array", () => {
      const fd = new FormData();
      fd.append("color", "red");
      fd.append("color", "blue");

      expect(getFormDataToJson(fd)).toEqual({
        color: ["red", "blue"],
      });
    });
  });
});
