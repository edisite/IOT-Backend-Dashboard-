<?php  
$dataPoints = array();
    $y = 5;
//    for($i = 0; $i < 10; $i++){
//            $y += rand(-1, 1) * 0.1; 
//            array_push($dataPoints, array("x" => $i, "y" => $y));
//    }
    
//    $data = file_get_contents("http://122.129.112.169/portal/isat/appgw_cp/iot/getdata");
//    if($data){
        $i = 0;
        //$datas = json_decode($data,true);
        //foreach ($datas as $v) {
            //$t = $v['temperature'];
            //$h = $v->humidity;
            
            array_push($dataPoints, array("x" => $i, "y" => 2));
            //$i++;
        //}
//        $i++;
//        
//    }
 
?>



    <script>
        window.onload = function() {

//var dps = []; // dataPoints
var dps = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
var chart = new CanvasJS.Chart("chartContainer", {
	title :{
		text: "Dynamic Data"
	},
	axisY: {
		includeZero: false
	},      
	data: [{
		type: "line",
		dataPoints: dps
	}]
});

        var xVal = 0;
        //var yVal = dps[dps.length - 1].y; 
        var yVal = dps[dps.length - 1].y; 
        var updateInterval = 1000;
        var dataLength = 20; // number of dataPoints visible at any point

        var updateChart = function (count) {

                count = count || 1;

                for (var j = 0; j < count; j++) {
                        yVal = yVal +  Math.round(5 + Math.random() *(-5-5));
                        dps.push({
                                x: xVal,
                                y: yVal
                        });
                        xVal++;
            }

                if (dps.length > dataLength) {
                        dps.shift();
                }

                chart.render();
        };

        updateChart(dataLength);
        setInterval(function(){updateChart()}, updateInterval);

        }
    </script>
   


            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  
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
                             <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
             
            </div>