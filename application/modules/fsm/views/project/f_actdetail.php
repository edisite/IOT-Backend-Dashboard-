            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">  
                        <div class="header">
                            <h2>
                                <?php if($fowner): echo $fowner; endif; ?>
                                <small>Project Owner</small>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">home</i> PROFIL
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#maps_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">room</i> LOCATION MAPS
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">code</i> ACCESS KEYS ID
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">settings</i> SETTINGS
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
<!--                                    <b>Home Content</b>-->
                                    <p>
                                       
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                   <tr>
                                       <th scope="row">Project ID</th>
                                        <td><?php if($fproject): echo $fproject; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">Owner Name</th>
                                        <td><?php if($fowner): echo $fowner; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><?php if($faddress): echo $faddress; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">PIC</th>
                                        <td><?php if($fpic): echo $fpic; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">Contact</th>
                                        <td><?php if($fcontact): echo $fcontact; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">Project Create</th>
                                        <td><?php if($projectdate): echo $projectdate; endif; ?></td>                                        
                                    </tr>                                    
                                    <tr>
                                        <th scope="row">Note</th>
                                        <td><?php if($fnote): echo $fnote; endif; ?></td>                                        
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="maps_with_icon_title">
                                    <b>Location MAPS</b>
                                    <p id="gmap_markers" class="gmap">
                                        
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <b>Access KEYS</b>
                                    <p>
                                        form access kye
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <b>Settings Content</b>
                                    <p>
                                        setting page
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->
            
        
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php
                                        if($crud_output){
                                            foreach ($crud_output as $v) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $v->thingID; ?></td>
                                                    <td><?php echo $v->projectID; ?></td>
                                                    <td><?php echo $v->tDateInstallation; ?></td>
                                                    <td><a href='<?php echo base_url(); ?>storefront/project/sensorlist/<?php echo $v->thingID; ?>' class="btn bg-teal btn-block waves-effect">Choose</a></td>
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
                    <input type="hidden" name="projectcode" value="<?php echo $projectcode; ?>" id="projectcode">
                    </form>

            </div>
        </div>
         
        <script src="<?php echo base_url(); ?>js/pages/ui/modals.js"></script>


        <script src="<?php echo base_url(); ?>js/pages/maps/google.js"></script>
        <!-- Google Maps API Js -->
        <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>

        <!-- GMaps PLugin Js -->
        <script src="<?php echo base_url(); ?>plugins/gmaps/gmaps.js"></script>
