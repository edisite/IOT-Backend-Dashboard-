
            <div class="row clearfix">
                <!-- Default Example -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                Group 
                                <small>halaman untuk tambah member</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="header bg-teal">
                                    <label>
                                    Non Member    
                                    </label>
                                </div>
                                <div class="dd">
                                    <ol class="dd-list">
                                       <?php
                                        if($datagroup){

                                            foreach ($datagroup as $v) {
                                                ?>
                                                    <li class="dd-item" data-id="<?php echo $v->id; ?>">
                                                        <div class="dd-handle"><?php echo $v->name; ?></div>
                                                    </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="header bg-deep-orange">
                                    <label>
                                    Member    
                                    </label>
                                    </div>
                                    <div class="dd">
                                        <ol class="dd-list">                                        
                                            <?php
                                            if($datagroup){

                                                foreach ($datagroup as $v) {
                                                    ?>
                                                        <li class="dd-item" data-id="<?php echo $v->id; ?>">
                                                            <div class="dd-handle"><?php echo $v->name; ?></div>
                                                        </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ol>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                
                <!-- #END# Default Example -->
            </div>
            <!-- Draggable Handles -->