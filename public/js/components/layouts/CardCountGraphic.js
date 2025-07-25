document.addEventListener("DOMContentLoaded", () => {
  const graphics = document.querySelectorAll("[data-count-graphic]");

  Array.from(graphics).forEach((graphic) => {
    const { numbers, color } = graphic.dataset;

    const numbersFiltered = numbers.replace("[numbers]: ", "");

    if (!numbers) return;

    $(graphic).sparkline(numbersFiltered.split(","), {
      type: "bar",
      height: "30",
      barWidth: "4",
      resize: true,
      barSpacing: "5",
      barColor: color.replace("[graphicColor]: ", "") ?? "#00c292",
    });
  });
});
