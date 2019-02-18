        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>    
                                LIST TECHNICIAN
                                <button class="btn bg-teal btn-sm waves-effect m-r-20 pull-right" onclick="add_technician()">Add New Technician</button>
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
                                            <th>BirthPlace</th>
                                            <th>BirthDay</th>
                                            <th>HP</th>
                                            <th>Address</th>
                                            <th>Work Address</th>
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
        "destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        "ajax": {
            "url": site_url + 'fsm/master/Technician_list',
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
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
    $('.modal-title').text('Add Technician'); // Set Title to Bootstrap modal title
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
        url = site_url + 'fsm/master/Technician_add';
    } else {
        url = site_url + 'fsm/master/Technician_update';
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
             console.log('Submission was successful.');
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
                        <div class="col-sm-4"> 
                            <div class="row clearfix">
                                <div class="col-sm-12">                       
                                    <div class="form-group form-float">
                                        <div class="form-line">                                    
                                            <input type="text" class="form-control" placeholder="" name="tname" maxlength="30" required/>
                                            <label class="form-label">Name</label>                                        
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-sm-12">                          
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="3" class="form-control no-resize auto-growth"  name="taddress" placeholder="Address" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">                            
                                    <div class="form-group form-group">
                                        <div class="form-line">
                                            <textarea rows="3" class="form-control no-resize auto-growth" name="twork_address" placeholder="Work Address" required></textarea>
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
                                            <input type="text" class="form-control" name="tplace" placeholder="" required/>
                                            <label class="form-label">Birth Place</label>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="tbirthday" placeholder="" required/>
                                            <label class="form-label">Birthday</label>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tphone" placeholder="" required />
                                            <label class="form-label">Phone</label>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="temail" placeholder="" required/>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary waves-effect">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>                    
                </form>

            </div>
        </div>