<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Humidity</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                             <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Humidity</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                                <div id="container_grafik" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                <div id="container2" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
             
            </div>


<?php $teees =  "298392974"; ?>
<script type="text/javascript">
var http,postdata,JsonRes,IsiJson,y;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

Highcharts.chart('container', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
                        //y = Math.random();
                        http = new XMLHttpRequest();
						postdata= "sensor_id=<?php echo $teees; ?>"; //Probably need the escape method for values here, like you did

						http.open("POST", "<?php echo base_url(); ?>api/iot/sensordata2", true);

						//Send the proper header information along with the request
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.setRequestHeader("Content-length", postdata.length);
						http.setRequestHeader("x-api-key","cahbagusanggakey")
						http.onreadystatechange = function() {//Call a function when the state changes.
						   if(http.readyState == 4 && http.status == 200) {
						   		JsonRes = http.responseText;
						   		IsiJson = JSON.parse(JsonRes);
						   		//xVal = IsiJson.x;
						   		y = IsiJson.y;
						   	}
						}
						http.send(postdata);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },
    title: {
        text: 'Live random data'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: 'Value'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: 'Random data',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: 0
                });
            }
            return data;
        }())
    }]
});
</script>


<script type="text/javascript">
var http,postdata,JsonRes,IsiJson,y;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

Highcharts.chart('container_grafik', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
                        //y = Math.random();
                        http = new XMLHttpRequest();
						postdata= "sensor_id=298392974"; //Probably need the escape method for values here, like you did

						http.open("POST", "http://122.129.112.169/portal/isat/AdminIOT2/api/iot/sensordata2", true);

						//Send the proper header information along with the request
						http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						http.setRequestHeader("Content-length", postdata.length);
						http.setRequestHeader("x-api-key","cahbagusanggakey");
						http.onreadystatechange = function() {//Call a function when the state changes.
						   if(http.readyState == 4 && http.status == 200) {
						   		JsonRes = http.responseText;
						   		IsiJson = JSON.parse(JsonRes);
						   		//xVal = IsiJson.x;
						   		y = IsiJson.y;
						   	}
						}
						http.send(postdata);
						document.getElementById('test').innerHTML=y;
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },
    title: {
        text: 'Live random data'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: 'Value'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: 'Random data',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: 0
                });
            }
            return data;
        }())
    }]
});

function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal;
                //inc = Math.round((Math.random() - 0.5) * 20);

            newVal = y;
            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }

            point.update(newVal);

        }, 3000);
    }
});
</script>