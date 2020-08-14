

var pie = document.getElementById("pieChart").getContext('2d');
var myChart = new Chart(pie, {
    type: 'pie',
    data: {
        labels: labelPie,
        datasets: [
            {
                data: datapie,
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 0, 0, 1)'],
                backgroundColor: Bgcolor,
            }
        ]
    },
    options: {
        title: {
            display: false,
        },
        legend: {
            position: "left",
            align: "start"
        },
        maintainAspectRatio: false,
        hover: {mode: null},
    }
});



var ctx = document.getElementById("startCharts").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: MesesTotal,
            datasets: [{
                label: 'Mês',
                backgroundColor: 'rgb(134, 208, 142)',
                borderColor: 'rgb(100, 100, 192)',
                data: MesesData,
            }]
        },options: {
            title: {
                display: false,
                text: "Colors election"
            },
            legend: {
                position: "top",
                align: "end"
            },
            maintainAspectRatio: false,
            animation: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
           
        },
      
    });





        var chts2 = document.getElementById("charts-Week").getContext('2d');
        var myChart = new Chart(chts2, {
            type: 'bar',
            data: {
                labels: diasLabelArray,
                datasets: [{
                    label: 'Semana',
                    data: diasTotal,
                    backgroundColor: bg2,
                    borderColor: border2,
                }],
            }, options: {
                onHover: null,
                tooltips: {
                    enabled: true
                },
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 2,
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}},
                        }
                    }],
                    xAxes: [
                        {
                            stacked: true
                        }
                    ],
                },
               

            },
           
        });






        var chts3 = document.getElementById("charts-day").getContext('2d');
        var myChart = new Chart(chts3, {
            type: 'bar',
            data: {
                labels: current_Day_name,
                datasets: [{
                    label: "Dia",
                    data: current_Day,
                    backgroundColor: bg1,
                    borderColor: border1,
                }],
            }, options: {
                onHover: null,
                tooltips: {
                    enabled: true
                },
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 2,
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}},
                        }
                    }],
                    xAxes: [
                        {
                            stacked: true
                        }
                    ],
                },
               

            },
           
        });


