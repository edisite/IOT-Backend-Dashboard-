
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
                                                    <td><a href='<?php echo base_url(); ?>storefront/project/actDetail/<?php echo $v->projectID; ?>' class="btn bg-teal btn-block waves-effect">Choose</a></td>
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
