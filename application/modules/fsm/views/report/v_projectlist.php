
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Project
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ProjectID</th>
                                            <th>Owner</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php
                                        if($dataproject){
                                            foreach ($dataproject as $v) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $v->projectID; ?></td>
                                                    <td><?php echo $v->pOwner; ?></td>
                                                    <td><?php echo $v->pAddress; ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-default waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               <i class="material-icons">list</i>
                                                                Menu Report
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href='<?php echo base_url(); ?>storefront/report/thingList/<?php echo $v->projectID; ?>' class='bg-danger waves-effect'><i class="material-icons">trending_up</i><span class="icon-name">Model 1</span></a></li>
                                                                <li><a href='<?php echo base_url(); ?>storefront/report/R2sensor/<?php echo $v->projectID; ?>' class='bg-green waves-effect'><i class="material-icons">trending_up</i><span class="icon-name">2Sensor</span></a></li>
                                                                <li><a href='<?php echo base_url(); ?>storefront/report/R4sensor/<?php echo $v->projectID; ?>' class='bg-cyan waves-effect'><i class="material-icons">trending_up</i><span class="icon-name">4sensor</span></a></li>
                                                            </ul>
                                                        </div>
                                                       
                                                    </td>
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
