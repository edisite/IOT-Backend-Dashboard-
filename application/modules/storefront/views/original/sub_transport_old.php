<table width="500px" border="0" style="border-spacing: 50px 30px; left: 50px">
  <tbody>
    <tr>
      <td width="10%"><center>
        <p style="font-weight: bold">FT TRANSPORT</p>
        <div style="width: 220px; margin:0 padding:20px; font-weight: bold">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val25">0</td>
              <td class="clocklg" id="ds_satuan25">l/s</td>
            </tr>
          </table>
        </div>
      </center></td>
      <td width="10%"><center>
        <p style="font-weight: bold">FT TRANSPORT (Σ)</p>
        <div style="width: 220px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val26">0</td>
              <td class="clocklg" id="ds_satuan26">m³</td>
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
        <p id="html_id" style="font-weight: bold">PT 101</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="left" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val4"></td> -->
			  <img id="ds_val27" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
			 </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">PT 102</p>
        <div style="max-width:140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val5"></td> -->
			  <img id="ds_val28" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
            </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">PT 103</p>
        <div style="max-width: 140px; width:100%; margin:0 padding:20px;">
          <table class="tabBlock" align="right" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <!-- <td class="clock" id="ds_val6"></td> -->
			  <img id="ds_val29" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/on.png">
            </tr>
          </table>
        </div>
      </center></td>
	 </tr>
  </tbody>
</table>
    

<!-- TRANSPORT -->
<script type="text/javascript">

function dataIoT() {

  var http = new XMLHttpRequest();
  // var data_val,data_date_time;
  // var postdata2= "sensor_id="+sensor_id; 
  var postdata="sensor_id[]=22224&sensor_id[]=39756&sensor_id[]=50112&sensor_id[]=52229&sensor_id[]=17497";


  var jsonSensor ='{"daftar":[{"nomor_sensor":"22224","html_id":"ds_val25"},{"nomor_sensor":"39756","html_id":"ds_val26"},{"nomor_sensor":"50112","html_id":"ds_val27"},{"nomor_sensor":"52229","html_id":"ds_val28"},{"nomor_sensor":"17497","html_id":"ds_val29"}]}';


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
<!-- END TRANSPORT -->
