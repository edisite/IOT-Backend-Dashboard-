
            <!-- Striped Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Group Name : 
                                <?php
                                    if($groupid):
                                        foreach ($groupid as $g){
                                            echo $g->name ?: '';
                                        }
                                        
                                    endif;
                                
                                ?>
                                
                                <a href="<?php echo base_url();?>storefront/Report/AlmCreateGroup" class="btn btn-default waves-effect m-r-20 pull-right">Go Back</a>
                                <small>Untuk tambah dan edit member dalam group</small>
                            </h2>
                        </div>
                        <form method="POST" action="<?php echo base_url();?>storefront/report/AlmGroupMemberSave">
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width='3px'>#</th>
                                        <th width='7px'>Checklist</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if($datagroup):
                                        foreach ($datagroup as $v) {                                       
                                        
                                            switch ($v->joinsts):
                                                case 1:
                                                    $chck = "checked";
                                                    $valcheck = "1";
                                                break;
                                                default :
                                                    $chck = "";
                                                    $valcheck = "0";
                                            endswitch;
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $no; ?></td>
                                            <td class="demo-checkbox">
                                                <input type="checkbox" id="<?php echo $v->idmember; ?>" name="check[]" value="<?php echo $v->idmember; ?>" class="chk-col-red" <?php echo $chck; ?> />
                                                <label for="<?php echo $v->idmember; ?>"></label>
                                            </td>
                                            <td><?php echo $v->membername; ?></td>
                                        </tr>                                    
                                    <?php 
                                        $no ++;
                                        }
                                        endif;
                                    
                                    ?>
                                    <input type="hidden" name="groupname" value="<?php echo $dataid; ?>">
                                    <tr>
                                        <td  class="button-demo"></td>          
                                        <td colspan="2" ><button type="submit" class="btn btn-small bg-red waves-effect">Save</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Striped Rows -->