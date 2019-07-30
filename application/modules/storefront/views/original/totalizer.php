
<!--    <div class="container-fluid">-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                        <h3>FT INTAKE 1(Σ)</h3>
                    </div>
                    <div style="max-width:100%; width:100%; margin:0 padding:20 0px; font-weight: bold">
                        <table class="tabBlock">
                            <tr>
                              <td class="clock" id="ds_val1">0</td>
                              <td class="clocklg" id="ds_satuan1">m³</td>
                            </tr>
                        </table> 
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                        <h3>FT INTAKE 2(Σ)</h3>
                    </div>
                    <div style="max-width:100%; width:100%; margin:0 padding:20px;">
                        <table class="tabBlock">
                          <tr>
                            <td class="clock" id="ds_val2">0</td>
                            <td class="clocklg" id="ds_satuan2">m³</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                            <h3>FT INTAKE 3(Σ)</h3>
                    </div>
                    <div style="background-color:#F3F3F3; max-width:100%; width:100%; margin:0 padding:20px;">
                        <table class="tabBlock">
                          <tr>
                            <td class="clock" id="ds_val3">0</td>
                            <td class="clocklg" id="ds_satuan3">m³</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                            <h3>FT INTAKE 4(Σ)</h3>
                    </div>
                    <div style="background-color:#F3F3F3; max-width:100%; width:100%; margin:0 padding:20px;">
                        <table class="tabBlock">
                          <tr>
                            <td class="clock" id="ds_val4">0</td>
                            <td class="clocklg" id="ds_satuan4">m³</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                            <h3>FT OUTPUT IPA3(Σ)</h3>
                    </div>
                    <div style="background-color:#F3F3F3; max-width:100%; width:100%; margin:0 padding:20px;">
                        <table class="tabBlock">
                          <tr>
                            <td class="clock" id="ds_val5">0</td>
                            <td class="clocklg" id="ds_satuan5">m³</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="text-danger">
                            <h3>FT TRANSPORT(Σ)</h3>
                    </div>
                    <div style="background-color:#F3F3F3; max-width:100%; width:100%; margin:0 padding:20px;">
                        <table class="tabBlock">
                          <tr>
                            <td class="clock" id="ds_val6">0</td>
                            <td class="clocklg" id="ds_satuan6">m³</td>
                          </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>         
        
        <div class="row clearfix"></div>
<!--    </div>-->
<!-- INTAKE IPA 1 -->
<!-- INTAKE IPA 1 -->
<script type="text/javascript">

function dataIoT() {

	var http = new XMLHttpRequest();
	// var data_val,data_date_time;
	// var postdata2= "sensor_id="+sensor_id; 
  var postdata="sensor_id[]=69191&sensor_id[]=43476&sensor_id[]=52491&sensor_id[]=24493&sensor_id[]=86753&sensor_id[]=41979&sensor_id[]=33730&sensor_id[]=34442&sensor_id[]=34441";


  var jsonSensor ='{"daftar":[
  {"nomor_sensor":"69191","html_id":"ds_val1"},
  {"nomor_sensor":"43476","html_id":"ds_val2"},
  {"nomor_sensor":"52491","html_id":"ds_val3"},
  {"nomor_sensor":"24493","html_id":"ds_val4"},
  {"nomor_sensor":"86753","html_id":"ds_val5"},
  {"nomor_sensor":"41979","html_id":"ds_val6"},
  {"nomor_sensor":"33730","html_id":"ds_val7"},
  {"nomor_sensor":"34441","html_id":"ds_val8"},
  {"nomor_sensor":"34442","html_id":"ds_val9"}
  ]}';


	// http.open("POST","https://pdam.iot-integrasi.com/dashboard/api/iot/SensorDataByGroup", true);
	http.open("POST","pdam.iot-integrasi.com/semarang/api/iot/SensorDataByGroup", true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("x-api-key","cahbagusanggakey");

	http.onreadystatechange = function() {
	   if(http.readyState == 4 && http.status == 200) {
			var JsonRes = http.responseText;
			var IsiJson = JSON.parse(JsonRes);
       var IsiValPanjang = IsiJson.data.length;

      // json bikinan dari jsonSensor
      var isiJsonSensor = JSON.parse(jsonSensor);

     

      var i;
      for (var i=0;i<IsiValPanjang;i++)
        {var isiValElementID = IsiJson.data[i].ds_sensorid;
            var isiValElementID = IsiJson.data[i].ds_sensorid;
            var isiValElementName = IsiJson.data[i].ds_sensorname;
            var isiValElementVal = IsiJson.data[i].ds_val;
            var isiType=IsiJson.data[i].ds_type;
           

            var isiHTMLid = isiJsonSensor.daftar[i].html_id;

            if (isiType=="string")
              {
                  if(isiValElementVal=='0')
                  {
                    document.getElementById(isiHTMLid).src="http://122.129.112.169/agus/Office/images/off.png";
                  }
                  else
                  {
                    document.getElementById(isiHTMLid).src = "http://122.129.112.169/agus/Office/images/on.png";
                  }
              }
            else
              {
                document.getElementById(isiHTMLid).innerHTML=isiValElementVal;
              }
           
        
            }
	   }
  
	 }
	 http.send(postdata);
  }
  
  var ulangi=setInterval(dataIoT, 3000);

       




</script>
<!-- END INTAKE IPA 1 -->