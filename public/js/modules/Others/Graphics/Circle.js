import { locations } from "./locations.js";
import * as ChartJs from "../../../libs/Chart/chart.umd.min.js";

export function GraphicCircle() {
  this.execute = () => {
    const { graphic } = locations;
    const pieChartCanvas = $(graphic).get(0).getContext("2d");
    const { labels, counters, colors } = graphic.dataset;

    var pieData = {
      labels: labels.split(","),
      datasets: [
        {
          data: counters.split(","),
          backgroundColor: colors.split(","),
        },
      ],
    };
    var pieOptions = {
      legend: {
        display: false,
      },
    };

    new Chart(pieChartCanvas, {
      type: "doughnut",
      data: pieData,
      options: pieOptions,
    });
  };
}
