document.addEventListener("DOMContentLoaded", () => {
  const graphics = document.querySelectorAll("[data-graphic-traffic]");

  Array.from(graphics).forEach((graphic) => {
    const { numbers, color } = graphic.dataset;

    const numbersFiltered = numbers.replace("[numbers]: ", "");

    if (!numbers) return;

    const graphicColor = color.replace("[graphicColor]: ", "") ?? "#00c292";
    $(graphic).sparkline(numbersFiltered.split(","), {
      type: "line",
      width: "100%",
      height: "50",
      lineColor: graphicColor,
      fillColor: graphicColor,
      maxSpotColor: graphicColor,
      highlightLineColor: "rgba(0, 0, 0, 0.2)",
      highlightSpotColor: graphicColor,
    });
  });
});
