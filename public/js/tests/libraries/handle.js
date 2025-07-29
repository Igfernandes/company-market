export async function handleComponentTests(ev) {
  try {
    const btn = ev.currentTarget;
    const url = new URL(window.location.href);
    const component = url.searchParams.get("component");

    const testModule = await import(`../${component}/index.test.js`);

    const isSingle = btn.dataset.single;

    if (isSingle) {
      const testName = document.querySelector("[name='test']").value;

      const callbackTest = testModule.TESTS[testName];

      return callbackTest();
    }

    Object.entries(testModule.TESTS).forEach(([key, callbackTest]) =>
      callbackTest()
    );
  } catch (err) {
    alert(`Erro ao executar testes: ${err.message}`);
  }
}

export function handleSearchComponentsByName(ev) {
  const searchbar = ev.currentTarget;
  const componentTabs = document.querySelectorAll("[data-navbar='component']");

  const valueFilled = searchbar.value.toLocaleLowerCase();

  componentTabs.forEach((element) => {
    const hasComponentValid = element.textContent
      .toLocaleLowerCase()
      .includes(valueFilled);

    if (hasComponentValid) element.classList.remove("d-none");
    else element.classList.add("d-none");
  });
}
