
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Setting Alarm
                </h2>

            </div>
            <div class="body">
                <form id="form_advanced_validation" method="POST" action="">
                    <div class="row clearfix">
                     <div class="col-sm-6">
                        <div class="form-group form-float">
                            <label class="form-label">List Group</label>
                            <div class="form-line">                                
                                    <select class="form-control show-float" name="type">
                                    <?php 
                                        if($datagroup){
                                            echo "<option value=''>-- Please select --</option>";
                                            foreach ($datagroup as $v) {
                                                echo "<option value='".$v->id."'>".$v->name."</option>";
                                            }
                                        }else{
                                            echo "<option value='' selected>-- Please select --</option>";
                                        }

                                    ?>
                                </select>
                            </div>                                    
                        </div>
                     </div>
                    <div class="col-sm-6">
                        <div class="form-group form-float">
                            <label class="form-label">List Alarm</label>
                            <div class="form-line">
                                    <select class="form-control show-float" name="type">
                                    <?php 
                                        if($dataalarm){
                                            echo "<option value=''>-- Please select --</option>";
                                            foreach ($dataalarm as $v) {
                                                echo "<option value='".$v->id."'>".$v->name."</option>";
                                            }
                                        }else{
                                            echo "<option value='' selected>-- Please select --</option>";
                                        }

                                    ?>
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
