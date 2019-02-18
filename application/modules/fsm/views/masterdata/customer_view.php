        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>    
                                LIST CUSTOMER
                                <button class="btn bg-teal btn-sm waves-effect m-r-20 pull-right" onclick="add_technician()">Add New Customer</button>
                                <button class="btn bg-teal btn-sm waves-effect m-r-20 pull-right" onclick="reload_table()">Reload</button>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>HP</th>
                                            <th>PIC</th>
                                            <th>Email</th>
                                            <th>Join Date</th>
                                            <th style="width: 125px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


         
<script src="<?php echo base_url(); ?>js/pages/ui/modals.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script type="text/javascript">

var save_method; //for save method string
var table;
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    //datatables
    //
    table = $('#table').DataTable({                 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

//        "paging": true,
//        "lengthChange": true,
//        "searching": true,
//        "ordering": true,
//        "info": true,
//        "autoWidth": true,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url + 'fsm/master/Customer_list',
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": true, //set not orderable
        },
        ],


    }); 
    
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
    table.destroy();            
});
        
        
function add_technician()
{
    save_method = 'add';
    $('#form_advanced_validation')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#largeModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Customer'); // Set Title to Bootstrap modal title
}

function edit_technician(id)
{
    save_method = 'update';
    $('#form_advanced_validation')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : site_url + 'fsm/master/Technician_edit' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

//            $('[name="tname"]').val(data.name);
//            $('[name="tstatus"]').val(data.status);
            $('#largeModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Technician'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
    //$('#table').DataTable().ajax.reload()
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = site_url + 'fsm/master/Customer_add';
    } else {
        url = site_url + 'fsm/master/Customer_update';
    }

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
                $('#largeModal').modal('hide');
                reload_table();
            }
            
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#largeModal').modal('show'); // show bootstrap modal
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('storefront/alarm/group/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#largeModal').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>


         <!--Large Size--> 
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form id="form_advanced_validation">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Form Group</h4>
                    </div>
                    <div class="modal-body">
                <div class="col-sm-6"> 
                    <div class="row clearfix">
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">    
                                    <label class="form-label">Business Name (PT) <span class="col-red"> * </span></label>                                        
                                    <input type="text" class="form-control" placeholder="" name="tname"/>
                                    
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" name="taddress"/>
                                    <label class="form-label">Business Address</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" name="tphone"/>
                                    <label class="form-label">Business Phone Number</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" name="tpic" />
                                    <label class="form-label">Contact Person</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">                                    
                                    <input type="text" class="form-control" placeholder="" name="temail" />
                                    <label class="form-label">Email</label>                                        
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12">                       
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea rows="3" class="form-control no-resize auto-growth" placeholder="Business Description" name="tdeskripsi"></textarea>
                                </div>
                            </div>
                        </div>    

                    </div>              
                </div>


               

                        <div class="row clearfix"></div>                                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary waves-effect"><i class="material-icons">save</i>
                                      <span>Save</span></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="material-icons">cancel</i>
                                      <span>Cancel</span></button>
                    </div>
                </div>                    
                </form>

            </div>
        </div>