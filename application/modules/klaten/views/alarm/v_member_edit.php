<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <form id="form_validation_stats" method="POST" action="<?php echo base_url()."storefront/report/AlmCreateMember_edit/".$id."/2"; ?>">
                <div class="header">
                    <h2>
                        Edit Member
                        <button type="submit" class="btn btn-success waves-effect pull-right">Save Changed</button> 
                    </h2>                            
                        
                </div>
                <div class="body">
                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tname" value="<?php echo $nama; ?>" required>
                                    <label class="form-label">Name</label>
                                </div>
                        </div>   
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="thp" value="<?php echo $nohp; ?>" required>
                                <label class="form-label">No. Handpnone</label>
                            </div>
                            <div class="help-info">ex. 081319290000</div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="temail" value="<?php echo $email; ?>" required>
                                <label class="form-label">Email</label>
                            </div>
                            <div class="help-info">ex. john@gmail.com</div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Note</label>
                                <textarea rows="2" class="form-control no-resize auto-growth" placeholder="" name="tnote"><?php echo $noted; ?></textarea>
                            </div>
                        </div>                        
                </div>     
            </form>
        </div>

</div>
</div>