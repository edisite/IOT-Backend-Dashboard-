
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Download Backup CSV
                </h2>
            </div>
            <div class="box-body">
                    <?php /* Backup button */ ?>

                    <?php /* List out stored versions */ ?>
                    <table class="table table-striped">
                            <tbody>
                                    <?php 
                                    
                                    if($backup_sql_files):
                                    foreach ($backup_sql_files as $file): 
                                        $bytes = filesize(FCPATH.'/dl/'.$file);
                                        if ($bytes >= 1073741824)
                                        {
                                            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                                        }
                                        elseif ($bytes >= 1048576)
                                        {
                                            $bytes = number_format($bytes / 1048576, 2) . ' MB';
                                        }
                                        elseif ($bytes >= 1024)
                                        {
                                            $bytes = number_format($bytes / 1024, 2) . ' KB';
                                        }
                                        elseif ($bytes > 1)
                                        {
                                            $bytes = $bytes . ' bytes';
                                        }
                                        elseif ($bytes == 1)
                                        {
                                            $bytes = $bytes . ' byte';
                                        }
                                        else
                                        {
                                            $bytes = '0 bytes';
                                        }
                                                                        ?>
                                    <tr>                 
                                            
                                            <td>
                                                <a href="<?php echo "../dl/".$file; ?>" class="btn bg-grey"> <?php echo ucfirst($file); ?></a> <label class="">Size : <?php echo $bytes; ?></label>
                                            </td>
                                    </tr>
                                    <?php endforeach; 
                                    endif;
                                    ?>
                            </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>