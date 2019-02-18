    <!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url(); ?>plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <span class="col-orange">Add New Technician</span>               
                </h2>
            </div>
            <div class="body">
                <div class="col-sm-4"> 
                    <div class="row clearfix">
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-">Name</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                          
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea rows="3" class="form-control no-resize auto-growth" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">                            
                            <div class="form-group form-group">
                                <div class="form-line">
                                    <textarea rows="3" class="form-control no-resize auto-growth" placeholder="Work Address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col-sm-4">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Birth Place</label>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Birthday</label>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Phone</label>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Email</label>                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>                
                </div>
                <div class="col-sm-3">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="<?php echo base_url(); ?>images/content/jackie-chan.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo base_url(); ?>images/content/jackie-chan.jpg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row clearfix"></div>
                <div class="col-sm-12">
                    <div class="form-group form-group">
                        <div class="button button-demo">                                  
                            <button type="button" class="btn btn-danger btn waves-effect" id="btnSave" onclick="save()">
                                  <i class="material-icons">save</i>
                                  <span>Save</span>
                            </button>
                            <button type="button" class="btn btn-default btn waves-effect">
                                  <i class="material-icons">cancel</i>
                                  <span>Cancel</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row clearfix"></div>

            </div>
        </div>
    </div>
</div>
          

    <script type="text/javascript">
    var save_method; //for save method string
    
    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('person/ajax_add')?>";
        } else {
            url = "<?php echo site_url('person/ajax_update')?>";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                }

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }
    </script>

    <!-- Light Gallery Plugin Js -->
    <script src="<?php echo base_url(); ?>plugins/light-gallery/js/lightgallery-all.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>js/pages/medias/image-gallery.js"></script>