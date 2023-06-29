/*
 Template Name: Urora - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File:Dashboard init js
 */

!function($) {
    "use strict";

    var Dashboard = function() {};
    
     //creates Bar chart
     Dashboard.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            gridLineColor: '#eef0f2',
            barSizeRatio: 0.4,
            resize: true,
            hideHover: 'auto',
            barColors: lineColors,
            fillOpacity: 0.1,
            grid: false,
            axes: false,
        });
    },

    //creates area chart
    Dashboard.prototype.createAreaChart = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 3,
            lineWidth: 2,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            resize: true,
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            lineColors: lineColors,
            fillOpacity: 0.1,
            xLabelMargin: 10,
            yLabelMargin: 10,
            pointSize: 3
        });
    },
   
    

    Dashboard.prototype.init = function () {
       
       //creating bar chart
       var $barData = [
        {y: 'January', a: 100, b: 90},
        {y: 'February', a: 75, b: 65},
        {y: 'March', a: 50, b: 40},
        {y: 'April', a: 75, b: 65},
        {y: 'May', a: 50, b: 40},
        {y: 'June', a: 75, b: 65},
        {y: 'July', a: 100, b: 90},
        {y: 'August', a: 90, b: 75}
    ];
    this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b'], ['$', 'Sales'], ['#009688 ', '#3f51b5']);

        //creating area chart
        var $areaData = [
            {y: '2011', a: 10, b: 10},
            {y: '2012', a: 30, b: 35},
            {y: '2013', a: 10, b: 25},
            {y: '2014', a: 55, b: 45},
            {y: '2015', a: 20, b: 20},
            {y: '2016', a: 40, b: 35},
            {y: '2017', a: 10, b: 25},
            {y: '2018', a: 25, b: 20}
        ];
        this.createAreaChart('morris-area-chart', 0, 0, $areaData, 'y', ['a', 'b'], ['Laptops A','Iphones B' ], ['#009688 ', '#3f51b5']);



    //Animating a Donut with Svg.animate

    var chart = new Chartist.Pie('#animating-donut', {
        series: [20, 20, 40, 20],
        labels: [1, 2, 3, 4]
    }, {
        donut: true,
        showLabel: false,
        donutWidth: 30,
        plugins: [
        Chartist.plugins.tooltip()
        ]
    });
    
    chart.on('draw', function(data) {
        if(data.type === 'slice') {
        // Get the total path length in order to use for dash array animation
        var pathLength = data.element._node.getTotalLength();
    
        // Set a dasharray that matches the path length as prerequisite to animate dashoffset
        data.element.attr({
            'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
        });
    
        // Create animation definition while also assigning an ID to the animation for later sync usage
        var animationDefinition = {
            'stroke-dashoffset': {
            id: 'anim' + data.index,
            dur: 1000,
            from: -pathLength + 'px',
            to:  '0px',
            easing: Chartist.Svg.Easing.easeOutQuint,
            // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
            fill: 'freeze'
            }
        };
    
        // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
        if(data.index !== 0) {
            animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
        }
    
        // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us
        data.element.attr({
            'stroke-dashoffset': -pathLength + 'px'
        });
    
        // We can't use guided mode as the animations need to rely on setting begin manually
        // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
        data.element.animate(animationDefinition, false);
        }
    });
    
    // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
    chart.on('created', function() {
        if(window.__anim21278907124) {
        clearTimeout(window.__anim21278907124);
        window.__anim21278907124 = null;
        }
        window.__anim21278907124 = setTimeout(chart.update.bind(chart), 10000);
    });

     //map

     $('#world-map-markers').vectorMap({
        map : 'world_mill_en',
        scaleColors : ['#ffb430', '#ffb430'],
        normalizeFunction : 'polynomial',
        hoverOpacity : 0.7,
        hoverColor : false,
        regionStyle : {
            initial : {
                fill : '#3f51b5'
            }
        },
        markerStyle: {
            initial: {
                r: 9,
                'fill': '#ffb430',
                'fill-opacity': 0.9,
                'stroke': '#fff',
                'stroke-width' : 7,
                'stroke-opacity': 0.4
            },

            hover: {
                'stroke': '#fff',
                'fill-opacity': 1,
                'stroke-width': 1.5
            }
        },
        backgroundColor : 'transparent',
        markers : [ {
            latLng : [61.52, 105.31],
            name : 'Russia'
        }, {
            latLng : [-25.27, 133.77],
            name : 'Australia'
        }, {
            latLng : [3.2, 73.22],
            name : 'Maldives'
        }, {
            latLng : [20.59, 78.96],
            name : 'India'
        }, {
            latLng : [12.05, -61.75],
            name : 'Grenada'
        }, {
            latLng : [51.43, 5.97],
            name : 'America'
        }, {
            latLng : [35.86, 104.19],
            name : 'China'
        }, {
            latLng : [-4.61, 55.45],
            name : 'Seychelles'
        },  {
            latLng : [39.52, -87.12],
            name : 'Brazil'
        }, {
            latLng : [1.35, 103.86],
            name : 'Singapore'
        }, {
            latLng : [56.13, -106.34],
            name : 'Dominica'
        }, {
            latLng : [26.02, 50.55],
            name : 'Bahrain',
            scaleColors : '#d878e8'
        }]
    });
  
    vanillaCalendar.init({
        disablePastDays: true
        });
   // Using data attributes
    $( ".data-attributes span" ).peity( "donut" );

    $(".bar").peity("bar", {
        width: '200',
        height: '50'
    })

    $(".live-tile, .flip-list").not(".exclude").liveTile();
            
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    },
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard

}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard.init()
}(window.jQuery);

