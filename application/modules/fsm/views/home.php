
        <div class="container-fluid">
            <div class="block-header">
                <small>Ticket By Status</small>
            </div>  
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-pink">input</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Work Orders</div>
                            <div class="number">350</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-pink">play_arrow</i>
                        </div>
                        <div class="content">
                            <div class="text">Open</div>
                            <div class="number">150</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-pink">autorenew</i>
                        </div>
                        <div class="content">
                            <div class="text">In Progress</div>
                            <div class="number">90</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-pink">not_interested</i>
                        </div>
                        <div class="content">
                            <div class="text">Close</div>
                            <div class="number">100</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-pink">pause_circle_outline</i>
                        </div>
                        <div class="content">
                            <div class="text">Hold</div>
                            <div class="number">10</div>
                        </div>
                    </div>
                </div>
               
            </div>
            <!-- #END# Widgets -->
             <div class="row clearfix">
                 <!-- Pie Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Ticket Base On Priority</h2>
                        </div>
                        <div class="body">
                            <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Pie Chart -->
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Number Of tickets</h2>                            
                        </div>
                        <div class="body">
                            <div id="container_bar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
             <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Average Solving Time</h2>
                        </div>
                        <div class="body">
                            <div id="container_line" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
             <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Average Response Problem</h2>
                        </div>
                        <div class="body">
                            <div id="container_line2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->

                
            </div>
        </div>



<script>

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Ticket Base On Priority'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Ticket',
        colorByPoint: true,
        data: [{
            name: 'Urgent',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'High',
            y: 11.84
        }, {
            name: 'Medium',
            y: 10.85
        }, {
            name: 'Low',
            y: 8.67
        }]
    }]
});


Highcharts.chart('container_bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Number of tickets'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'week1',
            'week2',
            'week3',
            'week4',
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Values'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'new Ticket',
        data: [49.9, 71.5, 106.4, 129.2]

    }, {
        name: 'Open',
        data: [83.6, 78.8, 98.5, 93.4]

    }, {
        name: 'Close',
        data: [48.9, 38.8, 39.3, 41.4]

    }]
});


Highcharts.chart('container_line', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Avg. Solving Time'
    },
    subtitle: {
        text: 'Agustus-2018'
    },
    xAxis: {
        categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
    },
    yAxis: {
        title: {
            text: ''
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Incident',
        data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, {
        name: 'Request',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    },{
        name: 'Task',
        data: [6.9, 5.2, 4.7, 2.5, 5.9, 20.2, 17.0, 10.6, 14.2, 12.3, 8.6, 9.8]
    }]
});

Highcharts.chart('container_line2', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Avg. Response Problem'
    },
    subtitle: {
        text: 'Agustus-2018'
    },
    xAxis: {
        categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
    },
    yAxis: {
        title: {
            text: ''
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'High',
        data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 3.2, 2.5, 23.3, 18.3, 13.9, 9.6]
    }, {
        name: 'Medium',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    },{
        name: 'Low',
        data: [1.9, 5.2, 4.7, 2.5, 8.9, 2.2, 17.0, 5.6, 6.2, 18.3, 8.6, 9.8]
    }]
});

</script>