        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                
                                
                                <a href="<?php echo base_url();?>storefront/Project" class="btn btn-default waves-effect m-r-20 pull-left">Go Back</a>
                                
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
                                                    <td><?php echo $v->sensorName; ?></td>
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
   