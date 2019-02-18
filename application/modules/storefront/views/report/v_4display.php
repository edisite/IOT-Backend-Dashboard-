<div class="row clearfix">
    <div class="col-sm-12">
    <div class="card">
        <div class="body">
            <form id="form_advanced_validation" method="POST" action="<?php echo base_url(); ?>storefront/report/R4sensorDisplay">
            <div class="row clearfix">
                    <div class="col-sm-5">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="datepicker form-control" name="dtmsensor" value="<?php echo $tanggal; ?>" readonly="" />
                            </div>
                            <span class="input-group-addon">
                                <button class="btn bg-blue-grey waves-effect" type="submit"><i class="material-icons">search</i>Choose Another Date</button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-7 button pull-right">
                            <a href="<?php echo base_url().'storefront/report/R4sensor';?>" class="btn bg-brown btn-sm pull-right waves-effect"><i class="material-icons">undo</i> Back to menu</a>
                    </div>
            </div>                    

            <?php
                if(count($object)> 0){
                    for($im=0; $im < count($object); $im++){
                        echo '<input type="hidden" name="myselect[]" value="'.$object[$im].'">';
                    }
                }
            ?>            
        </form> 
        </div>
    </div>
    </div>
</div>
    <div class="divider"></div>
<div class="row clearfix">
<?php if($div_output){ 
    echo $div_output; 
}else{
    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body">
                <div class="alert alert-warning">
                    <strong>Sorry! </strong> Data Not Found. Please choose another date.
                </div>                
            </div>
        </div>

    <?php
}
?>              
</div>

<!-- START API PERIODIK LINE -->
<?php
if($script_output){
    echo $script_output;
}
?>
<!-- END API PERIODIK LINE -->
