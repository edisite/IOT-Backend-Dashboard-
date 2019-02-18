<link href="<?php echo base_url(); ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />   
<!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Query Tickets</h2>
                           
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" />
                                            <label class="form-label">Ticket ID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float form-group">
                                        <div class="form-line ">
                                            <input type="text" class="form-control" placeholder="" />
                                            <label class="form-label">Status</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" />
                                            <label class="form-label">Subject</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float form-group">
                                        <div class="form-line ">
                                            <input type="text" class="datepicker form-control" placeholder="">
                                            <label class="form-label">Date</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix js-sweetalert">
                                <div class="col-sm-12">
                                    <div class="form-group form-group">
                                        <div class="button button-demo">
                                              <button type="button" class="btn btn-danger waves-effect pull-right" data-type="ajax-loader">
                                                    <i class="material-icons">search</i>
                                                    <span>Query</span>
                                              </button>
                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning small">
                                <strong>My tickets!</strong>
                            </div>
                            <div class="table-responsive table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tracking ID</th>
                                            <th>Date Openned</th>
                                            <th>Subject</th>
                                            <th>Operator</th>
                                            <th>Last updated</th>
                                            <th></th>
                                            <th>Priority</th>
                                            <th></th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tracking ID</th>
                                            <th>Date Openned</th>
                                            <th>Subject</th>
                                            <th>Operator</th>
                                            <th>Last updated</th>
                                            <th></th>
                                            <th>Priority</th>
                                            <th></th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $cat = array('Incident','Request','Task');
                                        $sts = array('On Progres','Pending','Closed');
                                        $pri = array('Medium','High','Low');
                                        $ppt = array('Peripheral Issue','Software issue','Sales doubt','CRM doubt');
                                        $tch = array('Rudi S','Agusnadi','Haikal','Siska','Joko','Bowo');
                                        for($i = 1;$i<100;$i++){
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo random_string('alnum', 8); ?></td>
                                                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                                    <td><?php echo random_element($ppt); ?></td>
                                                    <td><?php echo random_element($tch); ?></td>
                                                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                                    <td><span class=""><i class="material-icons">call_made</i></span></td>
                                                    <td><?php echo random_element($pri); ?></td>
                                                    <td><span class=""><i class="material-icons">last_page</i></span></td>
                                                    <td><?php echo random_element($cat); ?></td>
                                                    <td><span class=""><i class="material-icons">add_circle</i></span></td>
                                                </tr>
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
            <!-- #END# Basic Examples -->
            
            <script src="<?php echo base_url(); ?>plugins/bootstrap-notify/bootstrap-notify.js"></script>
            <script src="<?php echo base_url(); ?>js/pages/ui/dialogs.js"></script>