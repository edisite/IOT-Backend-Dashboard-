<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
 <style>
        #map{
        background: #ccc;
        height: 600px;
        width: 800px;
        margin: auto;
      }

      .marker-desc{
        width: 300px;
        min-height: 40px;
        text-align: justify;
        color: #333;
        font-size: 14px;
      }

      .button-map{
        background: #333;
        color: #fff;
        border: 1px solid #333;
        border-radius: 20px;
        padding: 10px 30px;
        margin-bottom: 20px;
      }

      .button-map:hover{
        cursor: pointer;
        background: #fff;
        color: #333;
        transition: all 0.5s;
      }
    </style>
    <?php echo $map['js']; ?>

       <!-- Bar Chart -->
<div class="row clearfix">
           <div class="col-sm-4">
                <div class="card">        
                    <div class="body">                                        
                         <div class="form-group form-float">
                             <div class="form-line">
                                 <select class="form-control show-tick">
                                     <option value=""> -Select -</option>
                                     <option value="">Agus Rahmat</option>
                                     <option value="">Bayu Ariesta</option>
                                     <option value="">Tri Admojo</option>
                                     <option value="">Bagas</option>
                                     <option value="">Kurniawan</option>
                                 </select>                            
                             </div>
                         </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
           </div>
            <div class="col-sm-4">
                <div class="card"> 
                   <div class="body">                                                   
                           <div id="container"></div>
                   </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="body">                                                   
                            <div id="container2"></div>
                    </div>
                </div>               
           </div>           
       <!-- #END# Bar Chart -->
</div>
<div class="row clearfix">
        <!-- Pie Chart -->
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="card">
               <div class="header">
                   <h2>On Field Real-time Monitoring</h2>
               </div>
               <div class="body">
                   <?php echo $map['html']; ?>
               </div>
           </div>
       </div>
</div>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Technician.'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            'Area (square km): <b>{point.y}</b><br/>' +
            'Population density (people per square km): <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        data: [{
            name: 'Cuti',
            y: 505370,
            z: 92.9
        }, {
            name: 'Masuk',
            y: 357022,
            z: 235.6
        }]
    }]
});

Highcharts.chart('container2', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Technician.'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            'Area (square km): <b>{point.y}</b><br/>' +
            'Population density (people per square km): <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        data: [{
            name: 'Assignment',
            y: 5,
            z: 2.9
        }, {
            name: 'Standby',
            y: 10,
            z: 2.6
        },{
            name: 'On-Duty',
            y: 20,
            z: 2.6
        }]
    }]
});

</script>