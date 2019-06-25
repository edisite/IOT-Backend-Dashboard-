<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Form Search
                </h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" method="POST" action="">
                    <div class="demo-masked-input">
                        <div class="clearfix">
                            <div class="col-md-6">
                                <b>Begin Date</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">                               
                                        <input type="text" id="datetimepicker1" name="datetimes1" class="datepicker form-control" value="<?php echo $date_from; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>End Date</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" id="datetimepicker2" name="datetimes2" class="datepicker form-control" value="<?php echo $date_to; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">    
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">List Sensor</label>
                                    <div class="form-line">
                                        <select class="form-control show-float" name="sensor">
                                            <?php
                                            if ($select_output) {
                                                echo $select_output;
                                            }
                                            ?>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button class="btn btn-primary waves-effect pull-left" type="submit" name="btnsubmit" id="btnsubmit">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="divider"></div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">                
                <div class="row clearfix">                    
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="header bg-brown">
                            <h2>
                                Report Chart
                            </h2>
                        </div>
                        <div class='card'>
                            <div class='body'>
                                <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row clearfix">
                    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
                        <div class="alert bg-grey">
                            <i class="material-icons">list</i>
                            <strong>Table List</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>SensorID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Values Min</th>
                                        <th>Values Rata-Rata</th>
                                        <th>Values Max</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_output) {
                                        foreach ($data_output as $v) {
                                            ?>
                                            <tr>
                                                <td><?php echo $v->ds_sensorid; ?></td>
                                                <td><?php echo $data_sensor2 = str_replace('(?)', '(Σ)', $v->ds_sensorname); ?></td>
                                                <td><?php echo $v->ds_date; ?></td>
                                                <td><?php echo $v->ds_time; ?></td>
                                                <td><?php echo round($v->ds_valmin, 2); ?></td>
                                                <td><?php echo round($v->ds_val, 2); ?></td>
                                                <td><?php echo round($v->ds_valmax, 2); ?></td>
                                                <td><?php echo $v->ds_satuan; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan='8' align='center'>No Record</td></tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    if ($data_production) {
                        foreach ($data_production as $p) {
                            $totalpsecond = $p['psecond'] ? : 0;
                            $totalpday = $p['pday'] ? : 0;
                            $totalkubik = $p['kubik'] ? : 0;
                        }
                   
                    ?>
                    <div class='col-lg-5 col-md-5 col-sm-5 col-xs-12'>
                        <div class="alert bg-teal darken-2">
                            <i class="material-icons">timelapse</i>
                            <strong>Report Production</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th>SensorID</th>
                                        <td><?php echo $sensorid; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sensor Name</th>
                                        <td><?php echo $data_sensor2 = str_replace('(?)', '(Σ)', $sensorname); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td><?php echo $date_from; ?></td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td><?php echo $date_to; ?></td>
                                    </tr>                          
                                    <tr>
                                        <th>Day</th>
                                        <td><label><strong><?php echo $totalpday; ?> Day</strong></label></td>
                                    </tr>                            
                                    <tr>
                                        <th rowspan="2">Total Production</th>
                                        <td><button class="btn btn-danger btn-lg btn-block pull-left"><strong><?php echo number_format($totalpsecond, 2, ',', '.'); ?></strong><span class="pull-right">L</span></button></td>
                                    </tr>                            
                                    <tr>
                                        <td><button class="btn btn-warning btn-lg btn-block pull-left"><strong><?php echo number_format($totalkubik, 2, ',', '.'); ?></strong> <span class="pull-right">M3</span></button></td>
                                    </tr>                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        }
                        else{
                            ?>
                                 <div class='col-lg-5 col-md-5 col-sm-5 col-xs-12'>
                        <div class="alert bg-teal darken-2">
                            <i class="material-icons">timelapse</i>
                            <strong>Report Production</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <td class="align-center">This sensor is not supported to calculate productions</td>       
                                    </tr>
                                </thead>
                            </table>
                        </div>

                            <?php

                        }
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
if ($script_output) {
    echo $script_output;
}
?>

