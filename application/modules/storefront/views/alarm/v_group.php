        
<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Group
                       <button type="button" class="btn btn-default waves-effect m-r-20 pull-right" data-toggle="modal" data-target="#largeModal">ADD NEW</button>

                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Group Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Partisipan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                if($datagroup){
                                    foreach ($datagroup as $v) {
                                        ?>
                                        <tr>
                                            <td><?php echo $v->id; ?></td>
                                            <td><?php echo $v->name; ?></td>
                                            <td><?php echo $v->status; ?></td>
                                            <td><?php echo $v->dtm_create; ?></td>                                                    
                                            <td><?php echo $this->Miot->Al_GroupMemberCountByGroupId($v->id); ?></td>                                                    
                                            <td class="button-demo pull-right">
                                                <a class="btn btn-sm bg-blue btn-link waves-effect" href="<?php echo base_url().'storefront/report/SettAlarm/'.$v->id; ?>"><i class="material-icons add"></i> New Member</a>
                                                <a class="btn btn-sm bg-brown btn-link waves-effect" href="<?php echo base_url().'storefront/report/Alm_Group_edit/'.$v->id; ?>/1" title="Edit"><i class="material-icons edit-icon"></i> Edit</a>
                                                <a class="btn btn-sm bg-red btn-link waves-effect" href="<?php echo base_url().'storefront/report/Alm_Group_del/'.$v->id; ?>" title="Delete"><i class="material-icons edit-icon"></i> Delete</a>

                                            </td>                                                    
                                        </tr>
                                        <?php
                                    }

                                }else{  
                                    ?>
                                        <tr><td colspan='3' align='center'>No Record</td></tr>
                                        <?php
                                }

                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <!--Large Size--> 
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form_advanced_validation" method="post" action="<?php echo base_url();?>storefront/report/AlmGroupSave">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Form Group</h4>
            </div>
            <div class="modal-body">

                <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="tname" maxlength="20" minlength="5" required>
                            <label class="form-label">Group Nama</label>
                            <div class="help-info">Min. 5, Max. 20 characters</div>
                        </div>
                </div>                       
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-link waves-effect">SAVE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>                    
        </form>

    </div>
</div>
         
        <script src="<?php echo base_url(); ?>js/pages/ui/modals.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>
            $(function() {
           //twitter bootstrap script
                   $(".submit").click(function(){
                                   $.ajax({
                                   type: "POST",
                                   url: "<?php echo base_url();?>storefront/report/AlmGroupSave",
                                   data: $('form.form_advanced_validation').serialize(),
                                   success: function(msg){
                                             $("#thanks").html(msg)
                                           $("#form-content").modal('hide');	
                                   },
                                   error: function(){
                                           alert("failure");
                                           }
                                   });
                   });
           });

           function edit_person(id)
           {
               save_method = 'update';
               $('#form')[0].reset(); // reset form on modals
               $('.form-group').removeClass('has-error'); // clear error class
               $('.help-block').empty(); // clear error string

               //Ajax Load data from ajax
               $.ajax({
                   url : "<?php echo site_url('storefront/alarm/ajax_edit/')?>/" + id,
                   type: "GET",
                   dataType: "JSON",
                   success: function(data)
                   {

                       $('[name="id"]').val(data.id);
                       $('[name="firstName"]').val(data.firstName);
                       $('[name="lastName"]').val(data.lastName);
                       $('[name="gender"]').val(data.gender);
                       $('[name="address"]').val(data.address);
                       $('[name="dob"]').datepicker('update',data.dob);
                       $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                       $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
                   url = "<?php echo site_url('storefront/alarm/ajax_add')?>";
               } else {
                   url = "<?php echo site_url('storefront/alarm/ajax_update')?>";
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

           function delete_person(id)
           {
               if(confirm('Are you sure delete this data?'))
               {
                   // ajax delete data to database
                   $.ajax({
                       url : "<?php echo site_url('storefront/report/Alm_Del_Group')?>/"+id,
                       type: "GET",
                       dataType: "JSON",
                       success: function(data)
                       {
                           //if success reload ajax table
                           $('#modal_form').modal('hide');
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

