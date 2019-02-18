 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>FT OUTPUT IPA3</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20 0px; font-weight: bold">
                <table class="tabBlock">
                    <tr>
                            <td class="clock" id="ds_val21">0</td>
                            <td class="clocklg" id="ds_satuan21">l/s</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>FT OUTPUT IPA3 (Σ)</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20px;">
                <table class="tabBlock">
                    <tr>
                        <td class="clock" id="ds_val22">0</td>
                        <td class="clocklg" id="ds_satuan22">m³</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>LT RESERVOAR 1</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20px;">
                <table class="tabBlock">
                    <tr>
                        <td class="clock" id="ds_val23">0</td>
                        <td class="clocklg" id="ds_satuan23">M</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="text-danger">
                <h3>LT RESERVOAR 2</h3>
            </div>
            <div style="max-width:100%; width:100%; margin:0 padding:20px;">
                <table class="tabBlock">
                    <tr>
                        <td class="clock" id="ds_val24">0</td>
                        <td class="clocklg" id="ds_satuan24">M</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>         
        




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
        {var isiValElementID        = IsiJson.data[i].ds_sensorid;
            var isiValElementID     = IsiJson.data[i].ds_sensorid;
            var isiValElementName   = IsiJson.data[i].ds_sensorname;
            var isiValElementVal    = IsiJson.data[i].ds_val;
            var isiType             = IsiJson.data[i].ds_type;
           

            var isiHTMLid = isiJsonSensor.daftar[i].html_id;

            document.getElementById(isiHTMLid).innerHTML=isiValElementVal;
      }
     }
  
   }
   http.send(postdata);
  }
  
  var ulangi=setInterval(dataIoT, 3000);

</script>
<!-- END OUTPUT -->
