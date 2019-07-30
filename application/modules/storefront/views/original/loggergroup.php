<style>
	.tabBlock
	{
		background-color:#57574f;
		border:solid 0px #FFA54F;
		border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;
		/*max-width:100% !important;*/
		width:100%;
		/*overflow:hidden;*/
		display:block;x1
	}
	.clock
	{
		vertical-align:middle;
		font-family:Helvetica;
		font-size:40px;
		font-weight:normal;
		color:#FFF;
		padding:0 10px;
	}
	.clocklg 
	{
		vertical-align:middle; 
		font-family:Helvetica;
		font-size:20px;
		font-weight:normal;
		color:#FFF;
	}
    
/*    h2 
    {
        position:relative;
        left:50px;
        font-family:Orbitron;
        border-bottom: double;
        padding-top: 20px;
        padding-bottom: 20px;
        width: 500px;
    
        
    }*/
   
</style>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Logger Display                                
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right tab-col-orange" role="tablist">
                                <li role="presentation" class="active"><a href="#ipaintake1" data-toggle="tab">IPA INTAKE 1</a></li>
                                <li role="presentation"><a href="#ipaintake2" data-toggle="tab">IPA INTAKE 2</a></li>
                                <li role="presentation"><a href="#ipaintake3" data-toggle="tab">IPA INTAKE 3</a></li>
                                <li role="presentation"><a href="#ipaintake4" data-toggle="tab">IPA INTAKE 4</a></li>
                                <li role="presentation"><a href="#transport" data-toggle="tab">TRANSPORT</a></li>
                                <li role="presentation"><a href="#output" data-toggle="tab">OUTPUT</a></li>
                                <li role="presentation"><a href="#totalizer" data-toggle="tab">TOTALIZER</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="ipaintake1">
                                    <?php
                                        $this->load->view('original/sub_ipaintake1');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="ipaintake2">
                                    <?php
                                        $this->load->view('original/sub_ipaintake2');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="ipaintake3">
                                    <?php
                                        $this->load->view('original/sub_ipaintake3');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade tab-col-brown" id="ipaintake4">
                                    <?php
                                        $this->load->view('original/sub_ipaintake4');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade tab-col-orange" id="transport">
                                    <?php
                                        $this->load->view('original/sub_transport');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade tab-col-orange" id="output">
                                    <?php
                                        $this->load->view('original/sub_output');
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade tab-col-orange" id="totalizer">
                                    <?php
                                        $this->load->view('original/totalizer');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Example Tab -->