/*
 Template Name: Urora - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Chart js 
 */

!function($) {
    "use strict";

    var ChartJs = function() {};

    ChartJs.prototype.respChart = function(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            switch(type){
                case 'Line':
                    new Chart(ctx, {type: 'line', data: data, options: options});
                    break;
                case 'Doughnut':
                    new Chart(ctx, {type: 'doughnut', data: data, options: options});
                    break;
                case 'Pie':
                    new Chart(ctx, {type: 'pie', data: data, options: options});
                    break;
                case 'Bar':
                    new Chart(ctx, {type: 'bar', data: data, options: options});
                    break;
                case 'Radar':
                    new Chart(ctx, {type: 'radar', data: data, options: options});
                    break;
                case 'PolarArea':
                    new Chart(ctx, {data: data, type: 'polarArea', options: options});
                    break;
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();
    },
    //init
    ChartJs.prototype.init = function() {
        //creating lineChart
        var lineChart = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September","October"],
            datasets: [
                {
                    label: "Sales Analytics",
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(22, 106, 168, 0.50)",
                    borderColor: "#3f51b5",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#3f51b5",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#3f51b5",
                    pointHoverBorderColor: "#3bc9f1",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [40, 60, 30, 70, 30, 55, 40, 55, 30, 80]
                },
                {
                    label: "Monthly Earnings",
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(86, 178, 191, 0.50)",
                    borderColor: "#56b2bf",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#56b2bf",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#56b2bf",
                    pointHoverBorderColor: "#56b2bf",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [80, 25, 60, 30, 60, 35, 85, 25, 92, 36]
                }
            ]
        };

        var lineOpts = {
            scales: {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 20,
                        stepSize: 10
                    }
                }]
            }
        };

        this.respChart($("#lineChart"),'Line',lineChart, lineOpts);

        //donut chart
        var donutChart = {
            labels: [
                "Desktops",
                "Tablets"
            ],
            datasets: [
                {
                    data: [300, 210],
                    backgroundColor: [
                        "#3f51b5",
                        "#56b2bf"
                    ],
                    hoverBackgroundColor: [
                        "#3f51b5",
                        "#56b2bf"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        this.respChart($("#doughnut"),'Doughnut',donutChart);


        //Pie chart
        var pieChart = {
            labels: [
                "Desktops",
                "Tablets"
            ],
            datasets: [
                {
                    data: [300, 180],
                    backgroundColor: [
                        "#fb7374",
                        "#3f51b5"
                    ],
                    hoverBackgroundColor: [
                        "#fb7374",
                        "#3f51b5"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        this.respChart($("#pie"),'Pie',pieChart);


        //barchart
        var barChart = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Sales Analytics",
                    backgroundColor: "rgba(86, 178, 191, 0.68)",
                    borderColor: "#56b2bf",
                    borderWidth: 1,
                    hoverBackgroundColor: "#56b2bf",
                    hoverBorderColor: "#56b2bf",
                    data: [65, 59, 81, 45, 56, 80, 50,20]
                }
            ]
        };
        this.respChart($("#bar"),'Bar',barChart);


        //radar chart
        var radarChart = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [
                {
                    label: "Desktops",
                    backgroundColor: "rgba(228, 86, 65, 0.72)",
                    borderColor: "#e45641",
                    pointBackgroundColor: "#e45641",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#e45641",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    label: "Tablets",
                    backgroundColor: "rgba(63, 81, 181, 0.71)",
                    borderColor: "#3f51b5",
                    pointBackgroundColor: "#3f51b5",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#3f51b5",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]
        };
        this.respChart($("#radar"),'Radar',radarChart);

        //Polar area  chart
        var polarChart = {
            datasets: [{
                data: [
                    11,
                    16,
                    7,
                    18
                ],
                backgroundColor: [
                    "#e45641",
                    "#f1a94e",
                    "#b341a3",
                    "#3f51b5"
                    
                ],
                label: 'My dataset', // for legend
                hoverBorderColor: "#fff"
            }],
            labels: [
                "Series 1",
                "Series 2",
                "Series 3",
                "Series 4"
            ]
        };
        this.respChart($("#polarArea"),'PolarArea',polarChart);
    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);
