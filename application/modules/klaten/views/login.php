<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="login-box">
        <div class="logo small">
            <a href="javascript:void(0);"><b><small><?php echo strtoupper($site_name); ?></small></b></a>
            
        </div>
    
	<div class="card">
            <div class="body">                
                    <?php if($form->messages()){
                        echo ucfirst($form->messages());                                
                    }
                    else{ 
                        echo "<p class='msg'>Sign in to start your session</p>";
                    }
                     ?>
		<?php echo $form->open(); ?>
						
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo ENVIRONMENT==='development' ? 'webmaster' : ''; ?>" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo ENVIRONMENT==='development' ? 'webmaster' : ''; ?>" required>
                        </div>
                    </div>
                
                    
<!--                    <div class="input-group">
                        <div class="form-line">
                            <?php //echo $form->field_recaptcha(); ?>                            
                        </div>                        
                    </div>-->
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>                        
		<?php echo $form->close(); ?>
            </div>
	</div>
        
</div>