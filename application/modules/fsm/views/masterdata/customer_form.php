    <!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url(); ?>plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
     <style>
        #map{
        background: #ccc;
        height: 600px;
        width: 800px;
        margin: auto;
      }

      .marker-desc{
        width: 300px;
        min-height: 40px;
        text-align: justify;
        color: #333;
        font-size: 14px;
      }

      .button-map{
        background: #333;
        color: #fff;
        border: 1px solid #333;
        border-radius: 20px;
        padding: 10px 30px;
        margin-bottom: 20px;
      }

      .button-map:hover{
        cursor: pointer;
        background: #fff;
        color: #333;
        transition: all 0.5s;
      }
    </style>
    <?php echo $map['js']; ?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <span class="col-orange">Add new Customer </span>               
                </h2>
            </div>
            <div class="body">
                <div class="col-sm-6"> 
                    <div class="row clearfix">
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">    
                                    <label class="form-label">Business Name (PT) <span class="col-red"> * </span></label>                                        
                                    <input type="text" class="form-control" placeholder="" />
                                    
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Business Address</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Business Phone Number</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" />
                                    <label class="form-label">Contact Person</label>                                        
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
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea rows="3" class="form-control no-resize auto-growth" placeholder="Business Description"></textarea>
                                </div>
                            </div>
                        </div>    

                    </div>              
                </div>

            <div class="col-sm-6">
                
                    <?php echo $map['html']; ?>
               
                
            </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group form-group">
                            <div class="button button-demo">                                  
                                <button type="button" class="btn btn-danger btn waves-effect pull-right">
                                      <i class="material-icons">save</i>
                                      <span>Submit</span>
                                </button>
                                <button type="button" class="btn btn-default btn waves-effect pull-right">
                                      <i class="material-icons">cancel</i>
                                      <span>Cancel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
          

    <script src="<?php echo base_url(); ?>js/pages/maps/google.js"></script>
    <!-- Google Maps API Js -->
    <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>

    <!-- GMaps PLugin Js -->
    <script src="<?php echo base_url(); ?>plugins/gmaps/gmaps.js"></script>