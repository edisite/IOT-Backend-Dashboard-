<?php echo $form->messages(); ?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Change Password</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
			<div class="body">
				<?php echo $form->open(); ?>
					<table class="table table-bordered">
						<tr>
							<th style="width:120px">Username: </th>
							<td><?php echo $target->username; ?></td>
						</tr>
						<tr>
							<th>First Name: </th>
							<td><?php echo $target->first_name; ?></td>
						</tr>
						<tr>
							<th>Last Name: </th>
							<td><?php echo $target->last_name; ?></td>
						</tr>
						<tr>
							<th>Email: </th>
							<td><?php echo $target->email; ?></td>
						</tr>
					</table>
                                        <label for="New Password">New Password</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="email_address" class="form-control" placeholder="" name="new_password">
                                            </div>
                                        </div>
                                        <label for="password">Retype Password</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password" class="form-control" placeholder="" name="retype_password">
                                            </div>
                                        </div>
					<?php echo $form->bs3_submit(); ?>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>