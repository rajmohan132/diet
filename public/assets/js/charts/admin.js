(function(jQuery) {
  "use strict";
  let lastDate = 0
  let TICKINTERVAL = 864e5;
  let XAXISRANGE = 7776e5;
  const chartFunction = {
      chartDummySearies: (e, t, refData) => {
          let data = refData
          const a = e + TICKINTERVAL;
          lastDate = a;
          for (let n = 0; n < data.length - 50; n++) data[n].x = a - XAXISRANGE - TICKINTERVAL, data[n].y = 0;
          data.push({
              x: a,
              y: Math.floor(Math.random() * (t.max - t.min + 1)) + t.min
          })
          return data
      },
      generateDayWiseTimeSeries(baseval, count, yrange) {
          let i = 0;
          let sales = [];
          while (i < count) {
              let x = baseval;
              let y =
                  Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

              sales.push([x, y]);
              baseval += 86400000;
              i++;
          }
          return sales;
      }
  }
  if (jQuery('#admin-chart-1').length) {
        const options = {
          series: [{
              type: 'column',
              label:'dsdsdsd',
              data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160],
          }, {
              type: 'line',
              curve: 'smooth',
              data: []
          }],
          chart: {
              height: 350,
              type: 'line',
              animations: {
                  enabled: true,
                  easing: 'easeinout',
                  speed: 800,
                  animateGradually: {
                      enabled: false,
                      delay: 150
                  },
                  dynamicAnimation: {
                      enabled: true,
                      speed: 350
                  }
              },
              zoom: {
                  enabled: false,
              },
              toolbar: {
                  show: false
              }
          },
          tooltip: {
            enabled: true,
          },
          stroke: {
              width: [0, 2]
          },
          dataLabels: {
              enabled: true,
              enabledOnsales: [1],
              offsetX: 3.0,
              offsetY: -1.6,
              style: {
                  fontSize: '1px',
                  fontFamily: 'poppins',
                  fontWeight: 'bold',
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    color: '#fff',
                    padding: 10,
                    borderRadius: 10,
                    borderWidth: 0,
                    borderColor: '#fff',
                    opacity: 1,
                  }

          },
          colors: ["#5db162", "#000000"],
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: '16%',
                  endingShape: 'rounded',
                  borderRadius: 5,
              },
          },
          legend: {
              show: false,
              offsetY: -25,
              offsetX: -5
          },
          xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              labels: {
                  minHeight: 20,
                  maxHeight: 20,
              }
          },
          yaxis: {
            labels: {
                minWidth: 20,
                maxWidth: 20,
            }
        },
      };

      const chart = new ApexCharts(document.querySelector("#admin-chart-1"), options);
      chart.render();
  }
 
   
   
   


  
    
})(jQuery)