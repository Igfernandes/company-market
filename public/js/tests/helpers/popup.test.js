/**
 * @jest-environment jsdom
 */

describe("Popup helper", () => {
  beforeEach(() => {
    // Reset DOM antes de cada teste
    document.body.innerHTML = `
      <button data-popup="a">Abrir A</button>
      <button data-popup="b">Abrir B</button>

      <div data-target-popup="a"></div>
      <div data-target-popup="b"></div>
    `;

    // Carrega o helper (simulando import ou require)
    require("../../helpers/popup.js");
  });

  afterEach(() => {
    jest.resetModules(); // Limpa cache do require
  });

  test("abre o popup correto ao clicar", () => {
    const btnA = document.querySelector('[data-popup="a"]');
    const targetA = document.querySelector('[data-target-popup="a"]');

    btnA.click();

    expect(targetA.classList.contains("show")).toBe(true);
  });

  test("fecha outros popups quando um é aberto", () => {
    const btnA = document.querySelector('[data-popup="a"]');
    const btnB = document.querySelector('[data-popup="b"]');
    const targetA = document.querySelector('[data-target-popup="a"]');
    const targetB = document.querySelector('[data-target-popup="b"]');

    btnA.click();
    expect(targetA.classList.contains("show")).toBe(true);
    expect(targetB.classList.contains("show")).toBe(false);

    btnB.click();
    expect(targetA.classList.contains("show")).toBe(false);
    expect(targetB.classList.contains("show")).toBe(true);
  });

  test("fecha popup se clicar nele quando já está aberto", () => {
    const btnA = document.querySelector('[data-popup="a"]');
    const targetA = document.querySelector('[data-target-popup="a"]');

    btnA.click();
    expect(targetA.classList.contains("show")).toBe(true);

    btnA.click();
    expect(targetA.classList.contains("show")).toBe(false);
  });
});
