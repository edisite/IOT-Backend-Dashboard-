<link href="<?php echo base_url(); ?>plugins/animate-css/animate.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url(); ?>js/pages/ui/notifications.js"></script>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add New Work Order                
                </h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation">
                  <div class="row clearfix">
                    <div class="col-sm-12">                       
                        <div class="form-group form-float">                             
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="" name="tname"/>   
                                <label class="form-label">Title This Work Order <code>(required)</code></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea rows="1" class="form-control no-resize auto-growth" placeholder="" name="tdescription"></textarea>
                                <label class="form-label">Describe this work order</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group form-float">
                            <label class="form-label">Set Priority</label>
                            <div class="form-line demo-radio-button">
                                <input name="group5" type="radio" id="radio_30" name="rpriority" value="none" class="radio-col-red with-gap" checked/>
                                <label for="radio_30">None</label>
                                <input name="group5" type="radio" id="radio_31" name="rpriority" value="low" class="radio-col-red with-gap" checked />
                                <label for="radio_31">Low</label>
                                <input name="group5" type="radio" id="radio_32" name="rpriority" value="medium" class="radio-col-red with-gap" checked/>
                                <label for="radio_32">Medium</label>
                                <input name="group5" type="radio" id="radio_33" name="rpriority" value="high" class="radio-col-red with-gap" checked/>
                                <label for="radio_33">High</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group form-float">
                            <label class="form-label">Set Category</label>
                            <div class="form-line demo-radio-button">
                                    <input name="group5" type="radio" id="radio_40" name="rcategory" value="request" class="radio-col-blue with-gap" checked />
                                    <label for="radio_40">Request</label>
                                    <input name="group5" type="radio" id="radio_41" name="rcategory" value="incident" class="radio-col-blue with-gap" checked/>
                                    <label for="radio_41">Incident</label>
                                    <input name="group5" type="radio" id="radio_42" name="rcategory" value="task" class="radio-col-blue with-gap" checked/>
                                    <label for="radio_42">Task</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">                        
                        <div class="form-group form-float">
                            <div class="form-line">                                 
                                <input type="text" class="form-control" placeholder="" name="tlocation" />   
                                <label class="form-label">Assign to a Location</label>
                            </div>
                        </div>
                    </div>
                      <div class="col-sm-12">                       
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="" name="tcustomer"/>
                                <label class="form-label">Assign To Customer</label>
                            </div>
                        </div>
                    </div>
                      <div class="col-sm-12">                       
                        <div class="form-group form-float">
                            <label class="">Category</label>
                            <div class="form-line">
                     
                                <select  class="form-control show-tick" id="tcategory" name="tcategory">
                                    <option value="" selected>-- Select Category -- </option>
                                    <?php if($category_data){
                                        foreach ($category_data as $v) {
                                            ?>
                                                <option value="<?php echo $v->ct_id;?>"> <?php echo $v->ct_name;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                             <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="datepicker form-control" placeholder="Assign Date" name="tdate">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">access_time</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="timepicker form-control" placeholder="Assign Time" name="ttime">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-lg">
                            <div class="button button-demo">
                                  <button type="button" class="btn btn-info waves-effect pull-right" id="btnSave" onclick="save()">
                                        <i class="material-icons">save</i>
                                        <span>Create Work Order</span>
                                  </button>

                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
            

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    
    $(document).ready(function(){
        $('#tcategory').css('width', '100%');
        selectList_category();
    });
    function selectList_category() {
          $('#tcategory').select2({
            placeholder: 'Pilih Category',
            multiple: false,
            allowClear: true,
            ajax: {
              url: site_url + 'fsm/wo/loadData_category_select',
              dataType: 'json',
              delay: 100,
              cache: true,
              data: function (params) {
                return {
                  q: params.term, // search term
                  page: params.page
                };
              },
              processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                  results: data.items,
                  pagination: {
                    more: (params.page * 30) < data.total_count
                  }
                };
              }
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: FormatResult,
            templateSelection: FormatSelection,
          });
        }
    function getCategory() {
            $.ajax({
                type : "GET",
                url  : site_url + 'fsm/wo/loadData_category_select',
                data : { id : document.getElementById("tcategory").value },
                dataType : "json",
                success:function(data){
//                    $('#tcategory').select2();
//                    $('#tcategory').select2('destroy');
//                    $("#tcategory").empty();
                    // $("#m_gudang_id").append('<option value="" placeholder="Pilih Gudang"></option>');
                    for(var i=0; i<data.items.length;i++){
                        $("#tcategory").append('<option value="'+data.items[i].id+'">'+data.items[i].text+'</option>');
                    }
                    $('#tcategory').select2({placeholder: "Pilih Category"});
                }
            });
        }
    function AddNewRow()
    {
      var table = document.getElementById("product_table");
      var row = table.insertRow(table.rows.length);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);

      cell1.innerHTML = "<input type='text' class='product_text' placeholder ='Type product Name' />"
      cell2.innerHTML = "<input type='text' class='product_text'  placeholder ='Quantity' />"
      cell3.innerHTML = "<input class='product_text' type='button' onClick='AddNewRow()' name='addRow' value='Add'>"
    }
    
    
function save()
{
    //$('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

   
    url = site_url + 'fsm/wo/wo_add';

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_advanced_validation').serialize(),        
        dataType: "JSON",
        success: function(data)
        {
            
            if(data.status) //if success close modal and reload ajax table
            {
                            
            }
  
            //alert('OK'); 
            alert(data.status);
            $("#form_advanced_validation")[0].reset();
            
            //$('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            
         

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

            alert('Error adding');
            
            //$('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

            
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url(); ?>js/pages/ui/notifications.js"></script>
