            <!-- Multi Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="<?php echo base_url(); ?>storefront/report/MultiSensorRealtime_Display">
                                
                                <div class="form-group show-tick">
                                    <label class="form-label">List Sensor:</label>
                                    <div class="form-line">                                        
                                        <select class="form-control show-tick" name="myselect[]">                                
                                        <?php echo $select_output; ?>
                                        </select>
                                    </div>
                                </div>
<!--                                <div class="form-group form-float">
                                    <label class="form-label">Display With:</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="jenischart">
                                            <option value="line" selected="">Line Chart</option>
                                            <option value="gauge">Gauge Chart</option>
                                        </select>
                                    </div>                                    
                                </div>                               -->
                                <button class="btn btn-info waves-effect" type="submit">Search...</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Select -->

           