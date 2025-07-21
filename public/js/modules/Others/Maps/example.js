import { Ajax } from "../../main/Ajax/_ajax.js";

const Map = function () {
    this.map = document.querySelector("#world-map-markers");
    this.index = document.querySelector("[data-mapbrasil='index']")
    this.Endetoken = '76669798a750779d683e0d0b5adcfd3e'
    this.content = document.querySelector("[data-mapbrasil='content']")
    this.information = new Array();

    this.CaptureValue = () => {
        let ajax = new Ajax();
        const struct = new Array();

        setTimeout(() => {
            for (let path of this.map.querySelectorAll("svg path")) {
                path.onclick = async () => {
                    let regiao = await ajax.get(`/api/endereco/estados/${path.dataset.id}`, '', this.Endetoken);

                    if (!this.information[path.dataset.id]) {

                        this.information[path.dataset.id] = await ajax.get(`/api/painel/index/${path.dataset.id}`);
                        if (this.information[path.dataset.id].indexOf("<api>")) {
                            this.information[path.dataset.id] = JSON.parse(this.information[path.dataset.id].split("<api>")[1].split("</api>")[0]);

                            this.Situation(this.information[path.dataset.id].situation);
                            this.Bonus(this.information[path.dataset.id].bonus);
                            this.Month(this.information[path.dataset.id].Month);
                            this.Controll(this.information[path.dataset.id].situation)
                        }
                    } else {

                        this.Situation(this.information[path.dataset.id].situation);
                        this.Bonus(this.information[path.dataset.id].bonus);
                        this.Month(this.information[path.dataset.id].Month);
                        this.Controll(this.information[path.dataset.id].situation)
                    }

                    this.index.innerText = regiao.Estado;


                }
            }
        }, 10);
    }

    this.Controll = ($ct) => {
        let $group = document.querySelectorAll("[data-mapabrasil='circle'] .float-right")

        $group[0].innerHTML = $ct.federacao.tot
        $group[1].innerHTML = $ct.clube.tot
        $group[2].innerHTML = $ct.atleta.tot

        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Federacao',
                'Clube',
                'Atleta',
            ],
            datasets: [
                {
                    data: [$ct.federacao.tot, $ct.clube.tot, $ct.atleta.tot],
                    backgroundColor: ['#00c0ef', '#00a65a', '#f39c12']
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

    }

    this.Situation = ($st) => {
        let $groups = document.querySelectorAll("[data-mapabrasil='situation']")

        /**
         * @federação
         */
        $groups[0].querySelector(".float-right").innerHTML = `<b>${$st.federacao.dfr}</b>/${$st.federacao.tot}`;
        $groups[0].querySelector(".progress-bar").style = `width: ${$st.federacao.perc}%`;

        /**
         * @clube
         */
        $groups[1].querySelector(".float-right").innerHTML = `<b>${$st.clube.dfr}</b>/${$st.clube.tot}`;
        $groups[1].querySelector(".progress-bar").style = `width: ${$st.clube.perc}%`;

        /**
         * @atleta
         */
        $groups[2].querySelector(".float-right").innerHTML = `<b>${$st.atleta.dfr}</b>/${$st.atleta.tot}`;
        $groups[2].querySelector(".progress-bar").style = `width: ${$st.atleta.perc}%`;
    }

    this.Month = ($mt) => {

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d')


        console.log($mt)

        let data = new Date();
        var month = new Array();
        if (data.getMonth() < 6) {
            month = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho']
        } else {
            month = ['Julho', 'Agosto', 'Setembro', 'Outubro', 'Dezembro']
        }

        let atleta = $mt.atleta ? JSON.parse($mt.atleta) : [0, 0, 0, 0, 0, 0];
        let clube = $mt.clube ? JSON.parse($mt.clube) : [0, 0, 0, 0, 0, 0];
        let federacao = $mt.federacao ? JSON.parse($mt.federacao) : [0, 0, 0, 0, 0, 0];
        let objsChart = new Array();

        objsChart.push({
            label: 'Atletas',
            backgroundColor: 'rgb(255 255 255 / 58%)',
            borderColor: 'rgba(60, 119, 48, 64%)',
            pointRadius: false,
            pointColor: 'rgba(60, 119, 48, 64%)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60, 119, 48, 64%)',
            data: atleta
        });

        if (federacao != false) {
            objsChart.push({
                label: 'Federacao',
                backgroundColor: 'rgb(255 255 255 / 58%)',
                borderColor: 'rgb(0 78 127 / 42%)',
                pointRadius: false,
                pointColor: 'rgb(0 78 127 / 42%)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgb(0 78 127 / 42%)',
                data: federacao
            })
        }
        if (clube != false) {
            objsChart.push({
                label: 'Clubes',
                backgroundColor: 'rgb(255 255 255 / 58%)',
                borderColor: 'rgb(255 193 7 / 42%)',
                pointRadius: false,
                pointColor: 'rgb(255 193 7 / 42%)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgb(255 193 7 / 42%)',
                data: clube
            })
        }

        var salesChartData = {
            labels: month,
            datasets: objsChart
        }


        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })


    }

    this.Bonus = ($bn) => {
        let $groups = document.querySelectorAll("[data-mapabrasil='bonus']")

        /**
         * @federação
         */
        if ($bn.federacao && $bn.federacao.bonus < 0) {
            $groups[0].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-down"></i>'
            $groups[0].querySelector(".description-percentage").classList.remove("text-success")
            $groups[0].querySelector(".description-percentage").classList.add("text-danger")
        } else if ($bn.federacao) {
            $groups[0].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-up"></i>'
            $groups[0].querySelector(".description-percentage").classList.add("text-success")
            $groups[0].querySelector(".description-percentage").classList.remove("text-danger")
        } else {
            $groups[0].querySelector(".description-percentage").innerHTML = " "
            $bn.federacao = 0
        }

        $groups[0].querySelector(".description-percentage").innerHTML += $bn.federacao + "%"

        /**
         * @clube
         */

        if ($bn.clube && $bn.clube < 0) {
            $groups[1].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-down"></i>'
            $groups[1].querySelector(".description-percentage").classList.remove("text-success")
            $groups[1].querySelector(".description-percentage").classList.add("text-danger")
        } else if ($bn.clube) {
            $groups[1].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-up"></i>'
            $groups[1].querySelector(".description-percentage").classList.add("text-success")
            $groups[1].querySelector(".description-percentage").classList.remove("text-danger")
        } else {
            $groups[1].querySelector(".description-percentage").innerHTML = ""
            $bn.clube = 0
        }
        $groups[1].querySelector(".description-percentage").innerHTML += $bn.clube + "%";

        /**
         * @atleta
         */
        if ($bn.atleta && $bn.atleta < 0) {
            $groups[2].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-down"></i>'
            $groups[2].querySelector(".description-percentage").classList.remove("text-success")
            $groups[2].querySelector(".description-percentage").classList.add("text-danger")
        } else if ($bn.atleta) {
            $groups[2].querySelector(".description-percentage").innerHTML = '<i class="fas fa-caret-up"></i>'
            $groups[2].querySelector(".description-percentage").classList.add("text-success")
            $groups[2].querySelector(".description-percentage").classList.remove("text-danger")
        } else {
            $groups[2].querySelector(".description-percentage").innerHTML = ""
            $bn.atleta = 0
        }
        $groups[2].querySelector(".description-percentage").innerHTML += $bn.atleta + "%";
    }
}


let cmd = new Map();

document.addEventListener("DOMContentLoaded", () => {
    if (cmd.map) {
        cmd.CaptureValue();
    }
})


export {
    Map
}