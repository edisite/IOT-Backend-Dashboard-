        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                THING
                               
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
                                                    <td><?php echo $v->tName; ?></td>
                                                    <td><?php echo $v->tDateInstallation; ?></td>
                                                    <td><a href='<?php echo base_url(); ?>storefront/report/sensorlist/<?php echo $v->thingID; ?>' class="btn bg-teal btn-block waves-effect"><i class="material-icons">trending_up</i>Report</a></td>
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
   