        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                THING
                                <button type="button" class="btn btn-default waves-effect m-r-20 pull-right" data-toggle="modal" data-target="#largeModal">ADD NEW</button>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Thing ID </th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Notes</th>                                            
                                            <th>Act</th>                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php
                                        if($datathing){
                                            foreach ($datathing as $v) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $v->thingID; ?></td>
                                                    <td><?php echo $v->tName; ?></td>
                                                    <td><?php echo $v->tDateInstallation; ?></td>
                                                    <td><?php echo $v->tNote; ?></td>
                                                    <td><a href='<?php echo base_url(); ?>storefront/project/SensorList/<?php echo $v->thingID; ?>' class="btn bg-brown waves-effect"><span>Sensor</span></a></td>
                                                    
                                                
                                                </tr>
                                                <?php
                                            }
                                            
                                        }else{
                                            ?>
                                                <tr><td colspan='4' align='center'>No Record</td></tr>
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
                <form id="myModal" method="POST" action="<?php echo base_url();?>storefront/project/thingadd/">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Form Thing</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tname" required>
                                    <label class="form-label">Thing Name</label>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tpic" min="10" max="200" required>
                                    <label class="form-label">PIC</label>
                                </div>
                                <div class="help-info">John Fulan</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tgps" required>
                                    <label class="form-label">GPS</label>
                                </div>
                                <div class="help-info">langtitute, longtitude</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tcontact" required>
                                    <label class="form-label">Contact Point</label>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="tnote" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Note</label>
                                </div>
                                <div class="help-info">Starts with http://, https://, ftp:// etc</div>
                            </div>
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
