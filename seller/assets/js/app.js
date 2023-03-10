$('.mobile-menu').on("click", function () {
    $(".sidebar-nav").css("left", "0");
    $(".backdrop").css("display", "block");

})
$('.backdrop').on("click", function () {
    $(".sidebar-nav").css("left", "-280px");
    $(this).css("display", "none")
})


// ======================chart radial
var options = {
    series: [80, 55],
    chart: {
        height: 300,
        type: 'radialBar',

    },
    fill: {
        colors: ['#DF4308', '#FFA17D']
    },

    plotOptions: {
        radialBar: {

            hollow: {
                size: '75%',

            },

            track: {
                background: '#2C2C2C',
                strokeWidth: '20px',
            },
        }
    },
    responsive: [
        {
            breakpoint: 1200,
            options: {
                chart: {
                    height: 220,
                }
            },

        },
        {
            breakpoint: 767,
            options: {
                chart: {
                    height: 300,
                }
            },

        },
        {
            breakpoint: 500,
            options: {
                chart: {
                    height: 180,
                    type: 'radialBar',
                }
            },

        }
    ]
    //   labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

var chart = new ApexCharts(document.querySelector("#chart2"), options);
chart.render();

//   ==============================================chart column
var options = {
    series: [{
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
    },
    {

        data: [13, 23, 20, 8, 13, 13, 23, 20, 27]
    },],
    chart: {
        type: 'bar',
        height: 300,
        stacked: true,
        showBorder: '0',

    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '20%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: false,
        width: 0,
        colors: ['transparent']

    },

    xaxis: {
        categories: ['S', 'M', 'T', 'W', 'T', 'F', 'S', 'S'],
    },
    legend: {
        show: false
    },
    toolbar: {
        show: false
    },
   grid:{
    show:true,
    xaxis:{
        lines: {
            show: false
        }
    },
    yaxis: {
        lines: {
            show: true,
        }
    },
   },
    fill: {
        colors: ['#DF4308', '#FFA17D']
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + " thousands"
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart-col"), options);
chart.render();
var chart = new ApexCharts(document.querySelector("#chart-col2"), options);
chart.render();