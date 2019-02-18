<table width="500px" border="0" style="border-spacing: 50px 30px;">
  <tbody>
    <tr>
      <td width="100%"><center>
        <p style="font-weight: bold">FT INTAKE2</p>
        <div style="width:260px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val8">0</td>
              <td class="clocklg" id="ds_satuan8">l/s</td>
            </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">FT INTAKE2 (Σ)</p>
        <div style="width:260px;  margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val9">0</td>
              <td class="clocklg" id="ds_satuan9">m³</td>
            </tr>
          </table>
        </div>
      </center></td>
	</tr>
	<tr>
      <td width="100%"><center>
        <p style="font-weight: bold">PI 201</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="right" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val10"></td> -->
			  <img id="ds_val10" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
            </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">PI 202</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="left" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val11"></td> -->
			  <img id="ds_val11" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
              </tr>
            </table>
          </div>
      </center></td>
	</tr>
  </tbody>
</table>
<!-- INTAKE IPA 2 -->
<script type="text/javascript">

function dataIoT() {

  var http = new XMLHttpRequest();
  // var data_val,data_date_time;
  // var postdata2= "sensor_id="+sensor_id; 
  var postdata="sensor_id[]=48638&sensor_id[]=17749&sensor_id[]=26912&sensor_id[]=89365";


  var jsonSensor ='{"daftar":[{"nomor_sensor":"48638","html_id":"ds_val8"},{"nomor_sensor":"17749","html_id":"ds_val9"},{"nomor_sensor":"26912","html_id":"ds_val10"},{"nomor_sensor":"89365","html_id":"ds_val11"}]}';


  http.open("POST","https://pdam.iot-integrasi.com/dashboard/api/iot/SensorDataByGroup", true);
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
            

           // if (isiType == "string")
           //      {
           //              if (isiVal == '0') 
           //                  {
           //                      document.getElementById(isiID).src = "http://122.129.112.169/agus/Office/images/off.png";
           //                  }else
           //                  {
           //                      document.getElementById(isiID).src = "http://122.129.112.169/agus/Office/images/on.png";
           //                  }  
           //      }
           
           //  else
           //      {
           //              document.getElementById(html_id).innerHTML=isiVal;
           //      }
            
        
      }
     }
  
   }
   http.send(postdata);
  }
  
  var ulangi=setInterval(dataIoT, 3000);

    


</script>
<!-- END INTAKE IPA 2 -->
