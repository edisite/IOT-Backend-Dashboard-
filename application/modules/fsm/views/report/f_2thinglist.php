<link href="<?php echo base_url(); ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>plugins/waitme/waitMe.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="container-fluid">
            <!-- Multi Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               PILIH 2 SENSOR
                                
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="GET" action="">
                                
                                <div class="form-group form-float">
                                    <div class="form-line">                                        
                                        <select class="form-control show-tick" multiple name="myselect[]">
                                        <optgroup label="Pilih Sensor" data-max-options="2">
                                            <?php echo $select_output; ?>
                                        </optgroup>
                                    </select>                                                                     
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <!--<input type="text" class="form-control" name="dtmsensor" value="<?php echo date('Y-m-d'); ?>" />-->
                                        <input type="text" id="datepicker" class="datepicker form-control" name="dtmsensor" value="<?php echo date('Y-m-d'); ?>" placeholder="">
<!--                                        <label class="form-label">Pilih Date</label>-->
                                    </div>
                                    <div class="help-info">YYYY-MM-DD format</div>
                                </div>
                                <input type="hidden" name="projectid" value="<?php echo $projectid; ?>">
                                <button class="btn btn-primary waves-effect" type="submit" name="btnsubmit" id="btnsubmit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='body'>
                            <div id='Line2Sensor' style='height: 300px;'></div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='body'>
                            <div id='Bar2Sensor' style='height: 300px;'></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<?php
    if($script_output){
        echo $script_output;
    }
?>

<script src="<?php echo base_url(); ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>plugins/momentjs/moment.js"></script>
<script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>