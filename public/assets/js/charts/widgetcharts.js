(function (jQuery) {
  "use strict";

//chart-1
if(jQuery('#chart-1').length){
  const options = {
    chart: {
        height: 80,
        type: 'area',
        sparkline: {
            enabled: true
        },
        group: 'sparklines',
  
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.5,
            opacityTo: 0,
        }
    },
  
    series: [{
        name: 'series1sdsdsdsdsdsdsdsdsdsdsd',
        data: [60, 15, 50, 30, 70]
    }, ],
    colors: ['#EA6A12'],
  
    xaxis: {
        type: 'datetime',
        categories: ["2018-08-19T00:00:00", "2018-09-19T01:30:00", "2018-10-19T02:30:00", "2018-11-19T01:30:00", "2018-12-19T01:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
  };
  const chart = new ApexCharts(
      document.querySelector("#chart-1"),
      options
  );
  chart.render();
}

//chart-2


})(jQuery)