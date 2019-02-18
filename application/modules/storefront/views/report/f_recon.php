
<!--<div class="row clearfix">-->
    <div class="col-lg-5 col-md-12 col-sm-5 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Request Recon Report
                </h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" method="POST" action="<?php echo base_url();?>storefront/report/recon/save">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group form-float">
                            <div class="form-line" >                                            
                                <input type="text" id="datetimepicker1" name="datetimes1" class="datepicker form-control" value="<?php echo $setdate1; ?>">
                                <label class="form-label">Date</label>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group">
                               <button class="btn btn-primary waves-effect pull-right" type="submit" name="btnsubmit" id="btnsubmit">Submit Request</button>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-md-12 col-sm-7 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Request
                    <small>Request Will be processed every 10 minutes</small>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Act</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if($data_output){
                                $no = 1;
                                foreach ($data_output as $v) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $v->requestdate; ?></td>
                                        <td><?php echo $v->status; ?></td>
                                        <td><a href="<?php echo base_url().'storefront/report/recon/del/?_id='.$v->id.'&_dtime='.$v->requestdate; ?>" class="btn btn-danger pull-right">Remove</a></td>
                                    </tr>
                                    <?php
                                    $no++;
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
<!--</div>-->
    