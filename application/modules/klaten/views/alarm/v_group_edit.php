<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <form id="form_validation_stats" method="POST" action="<?php echo base_url()."storefront/report/Alm_group_edit/".$id."/2"; ?>">
                <div class="header">
                    <h2>
                        Edit Groups
                        <button type="submit" class="btn btn-success waves-effect pull-right">Save Changed</button> 
                    </h2>                                                 
                </div>
                <div class="body">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="tname" value="<?php echo $nama; ?>" maxlength="20" minlength="5" required>
                            <label class="form-label">Group Nama</label>
                            <div class="help-info">Min. 5, Max. 20 characters</div>
                        </div>
                    </div>          
                    <div class="form-group form-float">
                        <p><strong>Status</strong></p>
                        <select class="form-control show-tick" name="status">
                            <?php
                                if($status == "active"){                                    
                                    ?>
                                    <option selected="selected" value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="active">Active</option>
                                    <option value="inactive" selected="selected" >Inactive</option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </div>          
                </div>     
            </form>
        </div>

</div>
</div>