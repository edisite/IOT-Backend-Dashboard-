
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Create Alarm
                </h2>

            </div>
            <div class="body">
                <form id="form_advanced_validation" method="POST" action="<?php echo base_url();?>storefront/report/Alm_alarmSave">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">                                            
                                <input type="text" class="form-control" value="" placeholder="" name="tname" />
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="form-group form-float">
                            <label class="form-label">Group Member</label>
                                <select class="form-control show-tick" data-live-search="true" name="tgroup">
                                    <?php 
                                        if($select_outputg){
                                            echo $select_outputg;
                                        }

                                    ?>
                                </select>                                   
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group form-float">
                            <label class="form-label">List Sensor</label>
                            <div class="form-line">
                                <select class="form-control show-float" data-live-search="true" name="sensor">
                                    <?php 
                                        if($select_output){
                                            echo $select_output;
                                        }

                                    ?>
                                </select>
                            </div>                                    
                        </div>
                     </div>
                    <div class="col-sm-3">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select class="form-control show-float" name="type">
                                    <option value="">-- Please select --</option>
                                    <option value="min">MIN</option>
                                    <option value="equal">EQUAL</option>
                                    <option value="max">MAX</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-float">
                            <div class="form-line">                                            
                                <input type="text" class="form-control" value="" placeholder="" name="tvalue" />
                                <label class="form-label">Input Values</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-float">
                                <label class="form-label">Alarm sent again every:</label>
                            <div class="form-line">
                                <select class="form-control show-float" name="tinternal">
                                    <option value="1">1 Menit</option>
                                    <option value="5">5 Menit</option>
                                    <option value="10">10 Menit</option>
                                    <option value="60">1 Jam</option>
                                    <option value="120">2 Jam</option>
                                    <option value="300">5 Jam</option>
                                    <option value="1440">1 Hari</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                               <button class="btn btn-primary waves-effect pull-left" type="submit" name="btnsubmit" id="btnsubmit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Alarm
                </h2>                
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Tipe</th>
                                <th>Value</th>
                                <th>Date</th>
                                <th>SensorID</th>
                                <th>Sensor Name</th>
                                <th>Group ID</th>
                                <th>Group</th>
                                <th>Act</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if($alarm_list):
                                foreach ($alarm_list as $v) {
                                    ?>
                                        <tr>
                                            <td><?php echo $v->idalarm;?></td>   
                                            <td><?php echo $v->name;?></td>   
                                            <td><?php echo $v->type;?></td>   
                                            <td><?php echo $v->value;?></td>   
                                            <td><?php echo $v->dtm;?></td>   
                                            <td><?php echo $v->sensorID;?></td>   
                                            <td><?php echo $v->sensorName;?></td>   
                                            <td><?php echo $v->idgroup;?></td>   
                                            <td><?php echo $v->name;?></td>   
                                            <td class="button-demo pull-right">                                            
                                                <a class="btn btn-sm btn-warning waves-effect" href="<?php echo base_url().'storefront/report/Alm_settlist_del/'.$v->idalarm; ?>" title="Delete"><i class="material-icons edit-icon"></i>Delete</a>
                                            </td>   
                                        </tr>
                                    <?php
                                }
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Examples -->