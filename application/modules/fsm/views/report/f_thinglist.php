        <div class="container-fluid">
            <!-- Multi Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               PILIH 4 SENSOR
                            </h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="<?php echo base_url(); ?>storefront/report/R4sensorDisplay">
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Pilih Sensor</label>
                                    <div class="form-line">
                                        
                                        <select id="optgroup" class="ms" multiple="multiple" name="myselect[]">                                
                                        <?php echo $select_output; ?>
                                        </select>
                                    </div>
                                </div>
<br>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" name="dtmsensor" value="<?php echo date('Y-m-d'); ?>" />
                                        <label class="form-label">Pilih Date</label>
                                    </div>
                                    <div class="help-info">YYYY-MM-DD format</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="jenischart">
                                            <option value="">-- Please select --</option>
                                            <option value="line">Line Chart</option>
                                            <option value="column">Bar Chart</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <input type="hidden" name="projectid" value="<?php echo $projectid; ?>">
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Select -->

        </div>

