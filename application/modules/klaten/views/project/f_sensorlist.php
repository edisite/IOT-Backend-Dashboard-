        
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <a href="<?php echo base_url();?>storefront/things" class="btn btn-default waves-effect m-r-20 pull-left">Go Back</a>

                    <button type="button" class="btn btn-default waves-effect m-r-20 pull-right" data-toggle="modal" data-target="#largeModal">ADD NEW</button>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Sensor ID </th>
                                <th>Sensor Name</th>
                                <th>Date</th>
                                <th>Satuan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if($crud_output){
                                foreach ($crud_output as $v) {
                                    ?>
                                    <tr>
                                        <td><?php echo $v->sensorID; ?></td>
                                        <td><?php echo str_replace('(?)', '(Σ)',$v->sensorName); ?></td>
                                        <td><?php echo $v->sDateInstallation; ?></td>
                                        <td><?php echo $v->sSatuan; ?></td>
                                        <td><a href='<?php echo base_url(); ?>storefront/project/sensorChart/<?php echo $v->sensorID.'/'.$codething; ?>' class="btn bg-teal btn-block waves-effect"><i class="material-icons">trending_up</i><span>Chart</span></a></td>
                                    </tr>
                                    <?php
                                }

                            }else{
                                ?>
                                    <tr><td colspan='5' align='center'>No Record</td></tr>
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


<!--Large Size--> 
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form id="myModal" method="POST" action="<?php echo base_url();?>storefront/project/sensoradd/">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Form Sensor</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tname" required>
                                    <label class="form-label">Sensor Name</label>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="tstatus">
                                        <option value="active" selected="">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="tnote" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Note</label>
                                </div>
                                <div class="help-info">Starts with http://, https://, ftp:// etc</div>
                            </div>
                        <input type="hidden" class="form-control" name="tsensor" value="<?php echo $codething; ?>" required>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">SAVE</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>                    
                    </form>

            </div>
        </div>
         
        <script src="<?php echo base_url(); ?>js/pages/ui/modals.js"></script>


        <script src="<?php echo base_url(); ?>js/pages/maps/google.js"></script>
        <!-- Google Maps API Js -->
        <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>

        <!-- GMaps PLugin Js -->
        <script src="<?php echo base_url(); ?>plugins/gmaps/gmaps.js"></script>
