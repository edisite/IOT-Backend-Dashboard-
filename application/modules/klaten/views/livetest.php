<div class="row">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class='card'>
            <div class='body'>
                <div id='container' style='min-width: 100; height: 280px; margin: 1'></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script>
var chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
function requestData() {
        $.ajax({
                http = new XMLHttpRequest();
                            postdata='sensor_id=67611'; //Probably need the escape method for values here, like you did

                            http.open('POST', 'https://pdam.iot-integrasi.com/dashboard/api/iot/SensorDataSingle', true);

                            //Send the proper header information along with the request
                            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            http.setRequestHeader('Content-length', postdata.length);
                            http.setRequestHeader('x-api-key','cahbagusanggakey')
                            http.onreadystatechange = function() {//Call a function when the state changes.
                               if(http.readyState == 4 && http.status == 200) {
                                            JsonRes = http.responseText;
                                            IsiJson = JSON.parse(JsonRes);
                                            //xVal = IsiJson.x;
                                            y = IsiJson.ds_val; 
                                    }
                            }
                            http.send(postdata);
                                            series.addPoint([x, y], true, true);
                                            chart.series[0].addPoint(eval(point), true, true)
                                        }, 10000);
                                    }
                                }
                            },
                url: 'live-server-data.php', 
                success: function(point) {
                        var series = chart.series[0],
                                shift = series.data.length > 20; // shift if the series is longer than 20

                        // add the point
                        chart.series[0].addPoint(eval(point), true, shift);

                        // call it again after one second
                        setTimeout(requestData, 1000);	
                },
                cache: false
        });
}
$(document).ready(function() {
        chart = new Highcharts.Chart({
                chart: {
                        renderTo: 'container',
                        defaultSeriesType: 'spline',
                        events: {
                                load: requestData
                        }
                },
                title: {
                        text: 'Live random data'
                },
                xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150,
                        maxZoom: 20 * 1000
                },
                yAxis: {
                        minPadding: 0.2,
                        maxPadding: 0.2,
                        title: {
                                text: 'Value',
                                margin: 80
                        }
                },
                series: [{
                        name: 'Random data',
                        data: []
                }]
        });		
});
</script>

