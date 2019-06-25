    <style>
        .tabBlock
        {
            background-color:#57574f;
            border:solid 0px #FFA54F;
            border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;
            max-width:200px;
            width:100%;
            overflow:hidden;
            display:block;
        }
        .clock
        {
            vertical-align:middle;
            font-family:Orbitron;
            font-size:40px;
            font-weight:normal;
            color:#FFF;
            padding:0 10px;
        }
        .clocklg 
        {
            vertical-align:middle; 
            font-family:Orbitron;
            font-size:20px;
            font-weight:normal;
            color:#FFF;
        }
    </style>      
<div class="container-fluid">
            <!-- Multi Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <form id="form_advanced_validation" method="GET" action="">
                         <div class="form-group form-float">
                              <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="SensorList">
                                            <option value="">-- Please select Sensor List--</option>
                                            <?php
                                            
                                                if($listsensor){
                                                    foreach ($listsensor as $v) {
                                                        echo "<option value='".$v->sensorID."'>".str_replace('(?)', '(Σ)',$v->sensorName)."</option>";
                                                    }
                                                }
                                            ?>                                           
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="form-line">
                                        <input type="text" class="form-control" name="dtmsensor" value="<?php echo date('Y-m-d'); ?>" />
                                        <label class="form-label">Pilih Date</label>
                                </div>
                                    <div class="help-info">YYYY-MM-DD format</div>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit" name="btnsubmit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Select -->
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">                 
                        <div class="body">
                          <div id="LiveChart" style="min-width: 310px; height: 300px; margin: 0 auto"></div>			 
			  <p id="test"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="body">
                          <!--Q<div id="LiveChart" style="min-width: 310px; height: 200px; margin: 0 auto"></div>-->
			  <div id="SpeedoMeter" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>
			  <p id="test"></p>
                          
                        </div>
                    </div>
                </div>  
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="body"  onload="digitized();">
                          <div style="background-color:#F3F3F3;
					max-width:220px;width:100%;margin:0 auto;padding:20px;">

					<table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
						<tr><td class="clock" id="dc"></td>  <!-- THE DIGITAL CLOCK. -->
							<td>
								<table cellpadding="0" cellspacing="0" border="0">
								
									<!-- HOUR IN 'AM' AND 'PM'. -->
									<tr><td class="clocklg" id="dc_hour"></td></tr>

									<!-- SHOWING SECONDS. -->
									<tr><td class="clocklg" id="dc_second"></td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
                        </div>
                    </div>
                </div>  
            </div>
             <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">                            
                          <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
             </div>
            

<!-- START API LIVE SENSOR DATA -->
<script type="text/javascript">
var http,postdata,JsonRes,IsiJson,y;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

Highcharts.chart('LiveChart', {
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

						http.open("POST", "http://122.129.112.169/portal/isat/AdminIOT2/api/iot/SensorData2", true);

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
                }, 2000);
            }
        }
    },
    title: {
        text: 'Realtime'
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

Highcharts.chart('SpeedoMeter', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Speedometer'
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 200,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },
        title: {
            text: 'km/h'
        },
        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }, {
            from: 120,
            to: 160,
            color: '#DDDF0D' // yellow
        }, {
            from: 160,
            to: 200,
            color: '#DF5353' // red
        }]
    },

    series: [{
        name: 'Speed',
        data: [80],
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

},
// Add some life
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
<!-- END API LIVE SENSOR DATA -->



<!-- START API MAPS -->
<script>
    <?php
        $json_decode = json_decode($gps_sensor);    
    ?>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $json_decode->lat;?>, lng: <?php echo $json_decode->long;?>},
          zoom: 18
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Location.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfFd3Upe3NBTELCmRFIX536-AzeqmksV8&callback=initMap"
    async defer>
        </script>
<!-- END API MAPS -->

<!-- START API LEVEL METER -->
<script type="text/javascript">
	setInterval(function(){ 
		
		var http = new XMLHttpRequest();
		var X,data_val,data_date_time;
		var postdata= "sensor_id=343&date=2018-08-06"; //Probably need the escape method for values here, like you did

		http.open("POST", "http://122.129.112.169/portal/isat/AdminIOT2/api/iot/SensorDataPeriodik", true);

		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", postdata.length);
		http.setRequestHeader("x-api-key","cahbagusanggakey")

		http.onreadystatechange = function() {//Call a function when the state changes.
		   if(http.readyState == 4 && http.status == 200) {
		   		var JsonRes = http.responseText;
		   		var IsiJson = JSON.parse(JsonRes);
		   		X=IsiJson.data.length;


		   		data_val="["+data_val+"]";
		   		data_date_time="["+data_date_time+"]";

		   		document.getElementById('dc').innerHTML=IsiJson.data[X-1].ds_val;
		   		//document.getElementById('hasil').innerHTML="Hasil Asli = "+JsonRes;
		      	document.getElementById('dc_hour').innerHTML=IsiJson.data[X-1].ds_satuan;
		      	//document.getElementById('y').innerHTML="Hasil y = "+IsiJson.y;
		   }
		}
		http.send(postdata);

	 }, 3000);
	</script>
<!-- END API LEVEL METER -->

<!-- START API BAR -->
<script type="text/javascript">
	
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: [<?php echo $data_date_sensorname; ?>]
    },
    xAxis: {
        categories: [<?php echo $data_date_time; ?>]
    },
    yAxis: [{
        min: 0,
        title: {
            text: 'Employees'
        }
    }, {
        title: {
            text: 'Profit (millions)'
        },
        opposite: true
    }],
    legend: {
        shadow: false
    },
    tooltip: {
        shared: true
    },
    plotOptions: {
        column: {
            grouping: false,
            shadow: false,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Sensor1',
        color: 'rgba(165,170,217,1)',
        data: [<?php echo $data_val; ?>],
        pointPadding: 0.3,
        pointPlacement: -0.2
    }, {
        name: 'Sensor2',
        color: 'rgba(126,86,134,.9)',
        data: [<?php echo $data_val2; ?>],
        pointPadding: 0.4,
        pointPlacement: -0.2 
    }]
});
</script>
<!-- END API BAR -->

<!-- START API PERIODIK LINE -->
    <script type="text/javascript">
		Highcharts.chart('ContainerLine', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'PDAM Semarang'
  },
  subtitle: {
    text: 'Sensor Periodik /Date'
  },
  xAxis: {
    categories: [<?php echo $data_date_time; ?>]
  },
  yAxis: {
    title: {
      text: 'Value'
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
    name: 'Sensor',
    data: [<?php echo $data_val; ?>]
  }]
});
</script>
<!-- END API PERIODIK LINE -->

<!-- START API MAPS -->
<script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $json_decode->lat;?>, lng: <?php echo $json_decode->long;?>},
          zoom: 18
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Location' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4cz3jSxDikBo5f4VGcA8faejudvZhk64&callback=initMap">
    </script>
<!-- END API MAPS -->
	
<!-- START API 2 SENSOR -->
	<script type="text/javascript">
	Highcharts.chart('Api2Sensor', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Average fruit consumption during one week'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: [<?php echo $data_date_time; ?>],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Fruit units'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' units'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Sensor1',
        data: [<?php echo $data_val; ?>]
    }, {
        name: 'Sensor2',
        data: [<?php echo $data_val2; ?>]
    }]
});
</script>
<!-- END API 2 SENSOR -->

