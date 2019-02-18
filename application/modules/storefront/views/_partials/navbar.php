

    <!-- Top Bar -->
    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href=""><?php echo $site_name; ?></a>
                
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!--<li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>-->
                    <!-- #END# Call Search -->
                    
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <img id="tombol" src="<?php echo base_url();?>images/tombol_on.gif" width="35" height="35">
    <!--                            <i class="material-icons">notifications</i>-->
<!--                                <span class="label-count">Status</span>-->
                            </a>

                            <ul class="dropdown-menu">
                                <li class="footer"><label id="tulisan"><small>Connection and Agent Status will be updated in 60 seconds<small></label></li>
                            </ul>
                        </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    
    <script type="text/javascript">
	function hitHTTP()
	{
		// var url = 'http://localhost/test/jsonAPIrsp.php';
		// var xhr = createCORSRequest('GET', url);
		// xhr.send();
		var xhttp = new XMLHttpRequest();
		// http.setRequestHeader("Content-type", "text/xml");
		//http.setRequestHeader("Accept", "text/json")

		xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    	JsonRes = xhttp.responseText;
			IsiJson = JSON.parse(JsonRes);
			status = IsiJson.status;
			message = IsiJson.message;
			document.getElementById("tulisan").innerHTML="<small>" + status + " : " +message + "</small>";
		

			if (status=="OK")
			{
				document.getElementById("tombol").src="<?php echo base_url();?>images/tombol_on.gif";
			}else{
				document.getElementById("tombol").src="<?php echo base_url();?>images/tombol_off.gif";
			}
	    }
	  };
	  xhttp.open("GET", "http://pdam.iot-integrasi.com/rasp/jsonAPIrsp.php", true);
	  xhttp.send();
	}
	var updateStatus = setInterval(hitHTTP,60000);
</script>