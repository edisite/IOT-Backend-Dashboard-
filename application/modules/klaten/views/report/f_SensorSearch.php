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
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line" >                                            
                                <input type="text" id="datetimepicker1" name="datetimes1" class="datepicker form-control" value="<?php echo $setdate1; ?>">
                                <label class="form-label">Begin Date</label>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">                                            
                                <input type="text" name="datetimes2" class="datepicker form-control" value="<?php echo $setdate2; ?>" />
                                 <label class="form-label">End Date</label>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="form-group form-float">
                            <label class="form-label">List Sensor</label>
                            <div class="form-line">

                                <select class="form-control show-float" data-live-search="true" name="sensor">
                                    <?php 
                                        if($select_output){
                                            echo $select_output;
                                        }

                                    ?>
                                </select>
                            </div>                                    
                        </div>
                     </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <label class="form-label">Range Spesifikasi</label>
                            <div class="form-line">
                                <select class="form-control show-float" name="type">
                                        <?php 
                                            if($settype == "min"){
                                                
                                            }
                                        ?>
                                    <option value="min" <?php echo $settype_min; ?>>MIN</option>
                                    <option value="equal" <?php echo $settype_equal; ?> >EQUAL</option>
                                    <option value="max" <?php echo $settype_max; ?> >MAX</option>
                                </select>
                            </div>
                        </div>
                    </div>
                     
                    
                    <div class="col-md-4">    
                        <div class="form-group form-float">                    
                            <div class="form-line">
                                <input type="text" name="tvalue" class="form-control" value="<?php echo $setvalue; ?>" />    
                                <label class="form-label">Value</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                               <button class="btn btn-primary waves-effect pull-left" type="submit" name="btnsubmit" id="btnsubmit">Search</button>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Result
                    <small>maximal 200 record</small>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>SensorID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Values</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if($data_output){
                                foreach ($data_output as $v) {
                                    ?>
                                    <tr>
                                        <td><?php echo $v->ds_sensorid; ?></td>
                                        <td><?php echo $v->ds_sensorname; ?></td>
                                        <td><?php echo $v->ds_date; ?></td>
                                        <td><?php echo $v->ds_time; ?></td>
                                        <td><?php echo $v->ds_val; ?></td>
                                        <td><?php echo $v->ds_satuan; ?></td>
                                    </tr>
                                    <?php
                                }

                            }else{
                                ?>
                                    <tr><td colspan='6' align='center'>No Record</td></tr>
                                    <?php
                            }

                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    