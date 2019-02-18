
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "<?php echo $dataname; ?>"
	},
	axisY: {
		title: "Range"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  
                    <div class="card">
                        <div class="header">
                           
                            <div class="row clearfix">
                                
                                <div class="col-xs-12 col-sm-2">   
                                     <h2>
                                        <a href="<?php echo base_url(); ?>storefront/project/sensorlist/<?php echo $thingcode; ?>" class="btn btn-block waves-effect m-r-20 pull-left">Go Back</a> 
                                    </h2>
                                </div>
                                <div class="col-xs-12 col-sm-10 align-right">
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