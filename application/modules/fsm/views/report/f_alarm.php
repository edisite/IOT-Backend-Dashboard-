
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
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">                                            
                                <input type="text" class="form-control" value="" placeholder="" name="tname" />
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-12">
                        <div class="form-group form-float">
                            <label class="form-label">List Sensor</label>
                            <div class="form-line">

                                <select class="form-control show-float" name="sensor">
                                    <?php 
                                        if($select_output){
                                            echo $select_output;
                                        }

                                    ?>
                                </select>
                            </div>                                    
                        </div>
                     </div>
                    <div class="col-sm-12">
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line focused">
                                <input type="text" class="form-control" value="" placeholder="" name="tvalue" />
                                <label class="form-label">Input Values</label>
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
