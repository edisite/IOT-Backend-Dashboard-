            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>List Order</h2>                           
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-5">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" />
                                            <label class="form-label">Order ID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line ">
                                            <input type="text" class="form-control" placeholder="" />
                                            <label class="form-label">Customer Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-group-lg">
                                        <div class="button button-demo">
                                              <button type="button" class="btn btn-info waves-effect">
                                                    <i class="material-icons">search</i>
                                                    <span>Query</span>
                                              </button>
                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Priority</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Priority</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $cat = array('Incident','Request','Task');
                                        $sts = array('Open','Scheduled','Closed');
                                        $pri = array('Medium','High','Low');
                                        $ppt = array('PT Jaya Cemerlang','PT Mulia','PT Aneka','PT Indomobil','PTSuperban');
                                        
                                        for($i = 1;$i<100;$i++){
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>INC2018<?php echo mt_rand(100, 999); ?></td>
                                                    <td><?php echo random_element($ppt); ?></td>
                                                    <td><?php echo date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days'));; ?></td>
                                                    <td><?php echo random_element($pri); ?></td>
                                                    <td><?php echo random_element($cat); ?></td>
                                                    <td><?php echo random_element($sts); ?></td>
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