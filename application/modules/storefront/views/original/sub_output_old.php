<table width="500" border="0" style="border-spacing: 10px 30px;margin-left: 40px">
  <tbody>
    <tr>
      <td width="10%"><center>
        <p style="font-weight: bold">FT OUTPUT IPA3</p>
        <div style="width: 240px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val21">0</td>
              <td class="clocklg" id="ds_satuan21">l/s</td>
            </tr>
          </table>
        </div>
      </center></td>
      <td width="10%"><center>
        <p style="font-weight: bold">FT OUTPUT IPA3 (Σ)</p>
        <div style="width: 240px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val22">0</td>
              <td class="clocklg" id="ds_satuan22">m³</td>
            </tr>
          </table>
        </div>
      </center></td>
      
    </tr>
    <tr>
       <td width="100%"><center>
        <p style="font-weight: bold">LT RESERVOAR 1</p>
        <div style="max-width: 240px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val23">0</td>
              <td class="clocklg" id="ds_satuan23">M</td>
            </tr>
          </table>
        </div>
      </center></td>
      <td width="100%"><center>
        <p style="font-weight: bold">LT RESERVOAR 2</p>
        <div style="max-width: 240px; margin:0 padding:20px;">
          <table class="tabBlock" align="center" cellspacing="0" cellpadding="0" border="0">
            <tr>
              <td class="clock" id="ds_val24">0</td>
              <td class="clocklg" id="ds_satuan24">M</td>
            </tr>
          </table>
        </div>
      </center></td> 
    </tr>
  </tbody>
    </table> 
    

<!-- OUTPUT -->
<script type="text/javascript">

function dataIoT() {

  var http = new XMLHttpRequest();
  // var data_val,data_date_time;
  // var postdata2= "sensor_id="+sensor_id; 
  var postdata="sensor_id[]=37653&sensor_id[]=60569&sensor_id[]=28136&sensor_id[]=20250";


  var jsonSensor ='{"daftar":[{"nomor_sensor":"37653","html_id":"ds_val21"},{"nomor_sensor":"60569","html_id":"ds_val22"},{"nomor_sensor":"28136","html_id":"ds_val23"},{"nomor_sensor":"20250","html_id":"ds_val24"}]}';


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

            document.getElementById(isiHTMLid).innerHTML=isiValElementVal;

            // if (isiType=="string")
            //   {
            //       if(isiValElementVal=='0')
            //       {
            //         document.getElementById(isiHTMLid).src="http://122.129.112.169/agus/Office/images/off.png";
            //       }
            //       else
            //       {
            //         document.getElementById(isiHTMLid).src = "http://122.129.112.169/agus/Office/images/on.png";
            //       }

                    
            
            
            
            //   }
            // else
            //   {
            //     document.getElementById(isiHTMLid).innerHTML=isiValElementVal;
            //   }
            

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
<!-- END OUTPUT -->
