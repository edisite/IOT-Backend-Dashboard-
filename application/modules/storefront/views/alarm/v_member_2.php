     
<link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' media='screen'>
<link href='https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css' rel='stylesheet' media='screen'>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Member
                   <button type="button" class="btn btn-danger waves-effect m-r-20 pull-right" data-toggle="modal" data-target="#largeModal">ADD NEW</button>

                </h2>
            </div>
            <div class="body">                
                    <!--<table id="mainTable" class="table display">-->
                        <table id="mainTable" class="table table-hover display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Member Name</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Tanggal</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID </th>
                                <th>Member Name</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Tanggal</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                    </table>
            </div>
        </div>
    </div>
</div>


<!--Large Size--> 
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
    <form id="myModal" method="POST" action="<?php echo base_url();?>storefront/report/AlmMemberSave/">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="largeModalLabel">Form Add new member</h4>
        </div>
        <div class="modal-body">

            <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="tname" required>
                        <label class="form-label">Name</label>
                    </div>
            </div>   
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="number" class="form-control" name="thp" required>
                    <label class="form-label">No. Handpnone</label>
                </div>
                <div class="help-info">ex. 081319290000</div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="email" class="form-control" name="temail" required>
                    <label class="form-label">Email</label>
                </div>
                <div class="help-info">ex. john@gmail.com</div>
            </div>

            <div class="form-group form-float">
                
                <div class="form-line">
                    <label class="form-label">Note</label>
                    <textarea rows="1" class="form-control no-resize auto-growth" placeholder="" name="tnote"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect">SAVE</button>
            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
    </div>                    
    </form>

</div>
</div>

<script src="<?php echo base_url(); ?>js/pages/ui/modals.js"></script>
<script src="<?php echo base_url(); ?>js/pages/forms/form-validation.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

<script>
    var editor; // use a global for the submit and return data rendering in the examples
 
    $(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        "ajax": "http://localhost/ci/AdminIOT2/storefront/Report/AlmCreateMember_Load",
        "table": "#mainTable",
        "fields": [ {
                "label": "ID:",
                "name": "idmember"
            }, {
                "label": "Name:",
                "name": "membername"
            }, {
                "label": "Handphone:",
                "name": "nohp"
            }, {
                "label": "Email:",
                "name": "email"
            }, {
                "label": "Tanggal:",
                "name": "joindate",
                "type": "datetime"
            }, {
                "label": "Noted:",
                "name": "noted",
            }
        ]
    } );
 
    // New record
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();
 
        editor.create( {
            title: 'Create new record',
            buttons: 'Add'
        } );
    } );
 
    // Edit record
    $('#mainTable').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
 
        editor.edit( $(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        } );
    } );
 
    // Delete a record
    $('#mainTable').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();
 
        editor.remove( $(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        } );
    } );
 
    $('#mainTable').DataTable( {
        ajax: "http://localhost/ci/AdminIOT2/storefront/Report/AlmCreateMember_Load",
        columns: [
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return data.membername+' '+data.membername;
            } },
            { data: "idmember" },
            { data: "membername" },
            { data: "nohp" },
            { data: "datetime" },
            { data: "email" },
            { data: "noted" },
            
            {
                data: null,
                className: "center",
                defaultContent: '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            }
        ]
    } );
} );
</script>