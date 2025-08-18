// dayjs.test.js
import dayjs from "../../libraries/DayJs/dayjs.min.js"; // ou require('./dayjs') se CommonJS

describe("Custom Dayjs Build", () => {
  test("should create a valid date", () => {
    const d = dayjs("2025-08-16");
    expect(d.isValid()).toBe(true);
    expect(d.format("YYYY-MM-DD")).toBe("2025-08-16");
  });

  test("should add and subtract days correctly", () => {
    const d = dayjs("2025-08-16");
    const d2 = d.add(5, "day");
    expect(d2.format("YYYY-MM-DD")).toBe("2025-08-21");

    const d3 = d2.subtract(5, "day");
    expect(d3.format("YYYY-MM-DD")).toBe("2025-08-16");
  });

  test("should calculate diff correctly", () => {
    const d1 = dayjs("2025-08-16");
    const d2 = dayjs("2025-08-18");
    expect(d2.diff(d1, "day")).toBe(2);
  });

  test("should handle clone independently", () => {
    const d = dayjs("2025-08-16");
    const clone = d.clone();
    clone.add(1, "day");
    expect(d.format("YYYY-MM-DD")).toBe("2025-08-16"); // original não mudou
    expect(clone.format("YYYY-MM-DD")).toBe("2025-08-16");
  });

  test("should handle invalid date", () => {
    const invalid = dayjs("invalid");
    expect(invalid.isValid()).toBe(false);
  });
});
