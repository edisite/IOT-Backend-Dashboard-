        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Member
                               <button type="button" class="btn btn-default waves-effect m-r-20 pull-right" data-toggle="modal" data-target="#largeModal">ADD NEW</button>
                            
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Member Name</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Tanggal</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php
                                        if($datagroup){
                                            foreach ($datagroup as $v) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $v->idmember; ?></td>
                                                    <td><?php echo $v->membername; ?></td>
                                                    <td><?php echo $v->nohp; ?></td>                                                    
                                                    <td><?php echo $v->email; ?></td>                                                    
                                                    <td><?php echo $v->joindate; ?></td>                                                    
                                                    <td><?php echo $v->noted; ?></td>                                                    
                                                    <td>
                                                        <a href='<?php echo base_url(); ?>storefront/report/sensorlist1/<?php echo $v->idmember; ?>'><i class="material-icons">delete</i></a>
                                                        <a href='<?php echo base_url(); ?>storefront/report/sensorlist1/<?php echo $v->idmember; ?>'><i class="material-icons">edit</i></a>
                                                        <a href='<?php echo base_url(); ?>storefront/report/sensorlist1/<?php echo $v->idmember; ?>'><i class="material-icons">pageview</i></a>
                                                    </td>                                                  
                                                </tr>
                                                <?php
                                            }
                                            
                                        }else{
                                            ?>
                                                <tr><td colspan='3' align='center'>No Record</td></tr>
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
                <form id="myModal" method="POST" action="<?php echo base_url();?>storefront/report/AlmGroupSave/">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Form Group</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tname" required>
                                    <label class="form-label">Group Nama</label>
                                </div>
                                <div class="help-info"></div>
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

   