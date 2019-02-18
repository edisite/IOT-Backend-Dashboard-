
<div class="divider"></div>
<div class="row clearfix">
<?php if($div_output){ 
    echo $div_output; 
}else{
    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body">
                <div class="alert alert-warning">
                    <strong>Maaf!</strong> Data tidak tersedia. Silihkan Pilih tanggal lain

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
