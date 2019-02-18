<table width="500px" border="0" style="border-spacing: 50px 30px; left: 50px">
  <tbody>
    <tr>
      <td width="10%"><center>
        <p style="font-weight: bold">FT INTAKE4</p>
        <div style="width: 220px; margin:0 padding:20px; font-weight: bold">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val16">0</td>
              <td class="clocklg" id="ds_satuan16">l/s</td>
            </tr>
          </table>
        </div>
      </center></td>
      <td width="10%"><center>
        <p style="font-weight: bold">FT INTAKE4 (Σ)</p>
        <div style="width: 220px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val17">0</td>
              <td class="clocklg" id="ds_satuan17">m³</td>
            </tr>
          </table>
        </div>
      </center></td>
        <td width="100%"><center>
        <p></p>
        <div style="width: 260px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td ></td>
              <td ></td>
            </tr>
          </table>
        </div>
      </center></td>
      </tr>
	 <tr>
      <td width="100%"><center>
        <p id="html_id" style="font-weight: bold">PI 401</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="left" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val4"></td> -->
			  <img id="ds_val18" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
			 </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">PI 402</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val5"></td> -->
			  <img id="ds_val19" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
            </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">PI 403</p>
        <div style="max-width: 140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="right" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val6"></td> -->
			  <img id="ds_val20" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
            </tr>
          </table>
        </div>
      </center></td>
	 </tr>
  </tbody>
</table>
<!-- INTAKE IPA 4 -->
<script type="text/javascript">

function dataIoT() {

	var http = new XMLHttpRequest();
	var data_val,data_date_time;
	var postdata= "sensor_id[]=67611&sensor_id[]=66652&sensor_id[]=64216&sensor_id[]=32562&sensor_id[]=85747";

  var jsonSensor = '{"daftar":[{"nomor_sensor":"67611","html_id":"ds_val16"},{"nomor_sensor":"66652","html_id":"ds_val17"},{"nomor_sensor":"64216","html_id":"ds_val18"},{"nomor_sensor":"64216","html_id":"ds_val19"},{"nomor_sensor":"85747","html_id":"ds_val20"}]}'

	http.open("POST","https://pdam.iot-integrasi.com/dashboard/api/iot/SensorDataByGroup", true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("x-api-key","cahbagusanggakey");

	http.onreadystatechange = function() {
	   if(http.readyState == 4 && http.status == 200) {
        var JsonRes = http.responseText;
        var IsiJson = JSON.parse(JsonRes);
        var isiValPanjang=IsiJson.data.length;

        // json bikinin dari hasil jsonSensor
        var isiJsonSensor = JSON.parse(jsonSensor);
        var i;
        for (i=0;i<isiValPanjang;i++)
        {
            var isiValElementID = IsiJson.data[i].ds_sensorid;
            var isiValElementName = IsiJson.data[i].ds_sensorname;
            var isiValElementVal = IsiJson.data[i].ds_val;
            var isiType=IsiJson.data[i].ds_type;

            var isiHTMLID = isiJsonSensor.daftar[i].html_id;

            if (isiType == "string")
                {
                    
                        if (isiValElementVal == '0') 
                            {

                                document.getElementById(isiHTMLID).src = "http://122.129.112.169/agus/Office/images/off.png";
                            }else
                            {
                                document.getElementById(isiHTMLID).src = "http://122.129.112.169/agus/Office/images/on.png";
                            }  
                }
            else
                {

                    document.getElementById(isiHTMLID).innerHTML=isiValElementVal;
                }

        }  

	    }
	}
	http.send(postdata);
}
       
var ulangi=setInterval(dataIoT, 3000); 
    
</script>
<!-- END INTAKE IPA 4 -->
