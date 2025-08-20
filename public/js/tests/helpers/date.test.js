import { isMonthValid, isDayValid } from "../../helpers/date.js";

describe("isMonthValid", () => {
  test("retorna true para meses válidos (1 a 12)", () => {
    expect(isMonthValid(1)).toBe(true);
    expect(isMonthValid(6)).toBe(true);
    expect(isMonthValid(12)).toBe(true);
  });

  test("retorna false para meses inválidos", () => {
    expect(isMonthValid(0)).toBe(false);
    expect(isMonthValid(-3)).toBe(false);
    expect(isMonthValid(13)).toBe(false);
    expect(isMonthValid(100)).toBe(false);
  });

  test("retorna false para valores não numéricos ou string", () => {
    expect(isMonthValid(null)).toBe(false);
    expect(isMonthValid(undefined)).toBe(false);
  });
});

describe("isDayValid", () => {
  test("retorna true para dias válidos (1 a 31)", () => {
    expect(isDayValid(1)).toBe(true);
    expect(isDayValid(15)).toBe(true);
    expect(isDayValid(31)).toBe(true);
  });

  test("retorna false para dias inválidos", () => {
    expect(isDayValid(0)).toBe(false);
    expect(isDayValid(-10)).toBe(false);
    expect(isDayValid(32)).toBe(false);
    expect(isDayValid(100)).toBe(false);
  });

  test("retorna false para valores não numéricos ou string", () => {
    expect(isDayValid(null)).toBe(false);
    expect(isDayValid(undefined)).toBe(false);
  });
});
