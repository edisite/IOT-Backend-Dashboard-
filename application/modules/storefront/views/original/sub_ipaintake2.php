
<!--    <div class="container-fluid">-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>FT INTAKE2</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20 0px; font-weight: bold">
                <table class="tabBlock">
                    <tr>
                      <td class="clock" id="ds_val8">0</td>
                      <td class="clocklg" id="ds_satuan8">l/s</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>FT INTAKE2 (Σ)</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20px;">
                <table class="tabBlock">
                  <tr>
                    <td class="clock" id="ds_val9">0</td>
                    <td class="clocklg" id="ds_satuan9">m³</td>
                  </tr>
                </table>
            </div>
        </div>

    </div>
</div>         
        
<div class="row clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3 style="font-weight: bold" id="html_id">PI 201</h3>
            </div>
            <div style="max-width:140px; width:100%; margin:0 padding:20px;">
                <table class="tabBlock" align="left" cellspacing="0" cellpadding="0" border="0">
                  <tr>
                    <!-- <td class="clock" id="ds_val4"></td> -->
                      <img id="ds_val10" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/idle.png">
                  </tr>
                </table>
              </div>
        </div>            
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3 style="font-weight: bold" id="html_id">PI 202</h3>
            </div>
            <div style="max-width:140px; width:100%; margin:0 padding:20px;">
                <table class="tabBlock" align="left" cellspacing="0" cellpadding="0" border="0">
                  <tr>
                      <img id="ds_val11" style="width:100%;" src = "http://122.129.112.169/agus/Office/images/idle.png">
                  </tr>
                </table>
              </div>
        </div>            

    </div>
</div>

<!-- INTAKE IPA 2 -->
<script type="text/javascript">

function dataIoT() {

  var http = new XMLHttpRequest();
  // var data_val,data_date_time;
  // var postdata2= "sensor_id="+sensor_id; 
  var postdata="sensor_id[]=48638&sensor_id[]=17749&sensor_id[]=26912&sensor_id[]=89365";


  var jsonSensor ='{"daftar":[{"nomor_sensor":"48638","html_id":"ds_val8"},{"nomor_sensor":"17749","html_id":"ds_val9"},{"nomor_sensor":"26912","html_id":"ds_val10"},{"nomor_sensor":"89365","html_id":"ds_val11"}]}';


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
