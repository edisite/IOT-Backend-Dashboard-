        
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>    
                                LIST GROUP
                                <button class="btn bg-teal btn-sm waves-effect m-r-20 pull-right" onclick="add_person()">Add Group</button>
                                <button class="btn bg-danger btn-sm waves-effect m-r-20 pull-right" onclick="reload_table()">Reload</button>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Group Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th style="width: 125px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID </th>
                                            <th>Group Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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

        $(document).ready(function() {

            //datatables
            //
            table = $('#table').DataTable({                 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                
                "paging": true,
//                "lengthChange": true,
//                "searching": true,
//                "ordering": true,
//                "info": true,
//                "autoWidth": true,
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('storefront/alarm/group/ajax_list')?>",
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
            
            table.destroy();            
        });
        
        
function add_person()
{
    save_method = 'add';
    $('#form_advanced_validation')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#largeModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Group'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form_advanced_validation')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('storefront/alarm/group/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="tname"]').val(data.name);
            $('[name="tstatus"]').val(data.status);
            $('#largeModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Group'); // Set title to Bootstrap modal title

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
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('storefront/alarm/group/ajax_add')?>";
    } else {
        url = "<?php echo site_url('storefront/alarm/group/ajax_update')?>";
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

                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tname" maxlength="10" minlength="5" required>
                                    <label class="form-label">Group Nama</label>
                                     <div class="help-info">Min. 5, Max. 20 characters</div>
                                </div>
                                <div class="help-info"></div>
                        </div>                                             
                        <div class="form-group form-float">
                            <label class="form-label">Status</label>
                                <div class="demo-switch">
                                    <div class="switch">
                                        <label>Inactive<input name="tstatus" type="checkbox" checked><span class="lever"></span>Active</label>
                                        
                                    </div>
                                    
                                </div>
                        </div>                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary waves-effect">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>                    
                </form>

            </div>
        </div>