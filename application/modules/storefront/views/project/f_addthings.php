 <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Form Project</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" onsubmit="return checkCheckBoxes(this)">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pOwner" required>
                                        <label class="form-label">Owner Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <select class="form-control show-tick" name="pCity">
                                        <option value="">-- Please select City--</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Semarang">Semarang</option>
                                    </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pAddress" required>
                                        <label class="form-label">Address</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pPic" required>
                                        <label class="form-label">PIC</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pContact" required>
                                        <label class="form-label">Contact Point</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">     
                                    <label class="form-label">Location</label>
                                     <div id="gmap_basic_example" class="gmap"></div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="pNote" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Note</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div>
                                <button id="myButton" class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            
            <script src="<?php echo base_url(); ?>js/pages/maps/google.js"></script>
                    <!-- Google Maps API Js -->
            <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>

            <!-- GMaps PLugin Js -->
            <script src="<?php echo base_url(); ?>plugins/gmaps/gmaps.js"></script>
                
            <script type="text/javascript" language="JavaScript">
            <!--
            function checkCheckBoxes(theForm) {
                if (
                theForm.checkbox.checked == false) 
                {
                    alert ('You didn\'t choose any of the checkboxes!, Please Confirm!!!!!');
                    return false;
                } else {    
                    $('#myButton').button('enabled');
                    return true;

                }
            }
            //-->
            </script> 