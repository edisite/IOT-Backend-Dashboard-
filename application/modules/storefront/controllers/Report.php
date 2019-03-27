<?php
define('APILOCAL', 'http://localhost/dashboard/api/');
//define('APILOCAL', 'https://pdam.iot-integrasi.com/dashboard/api/');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report
 *
 * @author edisite
 */
class Report extends Admin_Controller {
    //put your code here
    
    private $getitem ='';
    private $totalval           = 0;
    private $dataproduction     = array();
    public function __construct() {
        parent::__construct();
    }
    public function Chart() {
        $this->mPageTitle = 'Report';
        $this->render('report/vChart');
        
    }
    //tampilkan semua project
    public function index(){
//            $data = $this->Miot->Project();
//            $this->mViewData['dataproject'] = $data;
//            $this->mPageTitle = 'Project List';
//            $this->render('report/v_projectlist');
        //$this->Things();
                
	}
    public function Things() {
        $crud = $this->generate_crud('things'); 
        //$crud->set_theme('datatables');
        $crud->columns('thingID','tName','tDateInstallation'); 
        $crud->display_as('thingID', 'Thing ID');
        $crud->display_as('tName', 'Name');
        $crud->display_as('tDateInstallation', 'Date');
        //$crud->where('projectID', $thingId);
        $crud->add_action('Device', '', base_url().'storefront/project/sensorlist/','ui-button-icon-primary ui-icon ui-icon-plus');
        $crud->unset_add();
        //$crud->unset_edit();
        //$crud->unset_export();
        $crud->unset_print();
        $crud->unset_delete();
        $this->mPageTitle = 'Thing List';
        $this->render_crud();  
        
    }
    public function R4sensor() {        
        $htmloutput = '';
        $getdatalist = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
                $htmloutput .= "<optgroup label='".$getname."'>";
                    $getdatasensor = $this->Miot->SensorByThingStype($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            //$getsensorname =  $sid->sensorName;
                            $getsensorname =  str_replace('(?)', '(Σ)',$sid->sensorName);
                            $htmloutput .= "<option value='".$getsensorid."'>".$getsensorname."</option>";
                        }
                    }                        
                $htmloutput .= "</optgroup>";

            }
        }
        else{
            $htmloutput .= "<optgroup label='sensor'>                                   
                            </optgroup>";
        }
        $this->mViewData['select_output'] = $htmloutput;

        $this->mPageTitle = 'Free Report';
        $this->render('report/f_thinglist');
    }
    public function R4sensorDisplay() {
        $getitem        = $this->input->post('myselect') ?: '';
        $getdtm         = $this->input->post('dtmsensor') ?: date('Y-m-d');
        $getjenis       = $this->input->post('jenischart') ?: 'line';
       // $getprojectid   = $this->input->post('projectid') ?: '';
        $divscrip       = '';
        $script         = '';
        if(empty($getitem)){
            redirect('storefront/Report/R4sensor/');
        }
        if(empty($getdtm)){
            redirect('storefront/Report/R4sensor/');
        }
        if(empty($getjenis)){
            redirect('storefront/Report/R4sensor/');
        }

        if(count($getitem)> 0){
            $resdata = '';
            
            for($im=0; $im < count($getitem); $im++){
                
                    $resdata = $this->HttpPostDataPeriodik($getitem[$im], $getdtm);
                    
                    if($resdata){ 
                        $json_decode = json_decode($resdata);
                        if($json_decode->status == 0){
                            for ($i=0;$i<count($json_decode->data);$i++)
                            { 
                                if ($i==0){
                                        $data_val= round($json_decode->data[$i]->ds_val,2);
                                        $data_date_time="'".$json_decode->data[$i]->ds_hour.' '.''."'";
                                }else{
                                        $data_val =$data_val.','.round($json_decode->data[$i]->ds_val);
                                        $data_date_time =$data_date_time.','."'".$json_decode->data[$i]->ds_hour.' '.''."'";
                                }
                            }
                                $divscrip .="<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                        <div class='card'>
                                        <div class='body'>
                                        <div id='ContainerLine".$im."' style='height: 400px;'></div>
                                        </div>
                                        </div>
                                        </div>";
                                $script .="<script type='text/javascript'>
                                        Highcharts.chart('ContainerLine".$im."', {
                                        chart: {
                                          type: '".$getjenis."'
                                        },
                                        title: {
                                          text: '".str_replace('(?)', '(Σ)',$json_decode->ds_sensorname)."'
                                        },
                                        subtitle: {
                                          text: 'SATUAN : ".$json_decode->data[0]->ds_satuan."'
                                        },
                                        xAxis: {
                                          categories: [" .$data_date_time. "]
                                        },
                                        yAxis: { 
                                          title: {
                                            text: 'Value'
                                          }
                                        },
                                        plotOptions: {
                                          line: {
                                            dataLabels: {
                                              enabled: true
                                            },
                                            enableMouseTracking: false
                                          }
                                        },
                                        series: [{
                                          name: [],
                                          data: [".$data_val."]
                                        }]
                                      });
                                      </script>";
                                
                        }



                    }

            }

        }
        $this->mViewData['script_output'] = $script;
        $this->mViewData['tanggal'] = $getdtm;
        $this->mViewData['object']  = $getitem;
        $this->mViewData['div_output']  = $divscrip;

        $this->mPageTitle = 'Free Report';
        $this->render('report/v_4display');

    }
    public function ThingList($projectID = '') {

        $datathing = $this->Miot->Thing();
        // display view
        $this->mViewData['crud_output'] = $datathing;
        //$this->mViewData['crud_upline'] = $getthing;

        $this->mPageTitle = 'Report Model 1';
        $this->render('report/v_thinglist1');
                
        //$this->render_crud();                   
    }
    public function Sensorlist($thingId = '') {
        if(empty($thingId)){
            redirect(base_url().'storefront/report/ListAll');
        }
        
        $getdata =  $this->Miot->SensorByThing($thingId);        
        $this->mViewData['listsensor'] = $getdata;
        $this->mViewData['gps_sensor'] = $this->HttpPost('342');
        $this->render('report/v_sensorlist');
        
    }
    public function HttpPost($sensor_id = '') {
            $url=APILOCAL."api/iot/SensorGPS";
            $postfield="sensor_id=$sensor_id";
            $length = strlen($postfield);
            $header=array('Content-type:application/x-www-form-urlencoded',
                                            'x-api-key:cahbagusanggakey',
                                            'Content-Length:'.$length
                                            );

            $CH = curl_init();
            curl_setopt($CH, CURLOPT_URL, $url);
            curl_setopt($CH, CURLOPT_HEADER, 0);
            curl_setopt($CH, CURLOPT_HTTPHEADER, $header);
            curl_setopt($CH, CURLOPT_POST, 1);
            curl_setopt($CH, CURLOPT_POSTFIELDS, $postfield);
            curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
            $responseText=curl_exec($CH);
            return $responseText;	
    }
    public function HttpPostDataPeriodik($sensorid = '', $date = '') {
        $url=APILOCAL."iot/SensorDataPeriodik";
        $postfield="sensor_id=$sensorid&date=$date";
        $length = strlen($postfield);
        $header=array('Content-type:application/x-www-form-urlencoded',
                                        'x-api-key:cahbagusanggakey',
                                        'Content-Length:'.$length
                                        ); 

        $CH = curl_init();
        curl_setopt($CH, CURLOPT_URL, $url);
        curl_setopt($CH, CURLOPT_HEADER, 0);
        curl_setopt($CH, CURLOPT_HTTPHEADER, $header);
        curl_setopt($CH, CURLOPT_POST, 1);
        curl_setopt($CH, CURLOPT_POSTFIELDS, $postfield);
        curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
        //$request = curl_getinfo($CH);
        $responseText=curl_exec($CH);
        return $responseText;
    }    
    public function R2sensor() {
        
        $htmloutput = '';
        $script_output  = '';
        $getdatalist = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
               
                    $getdatasensor = $this->Miot->SensorByThingStype($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            $getsensorname =  str_replace('(?)', '(Σ)',$sid->sensorName);
                            $htmloutput .= "<option value='".$getsensorid."'>[".$getsensorid."]".$getsensorname."</option>";
                        }
                    }                        

            }
        }
        
            $getitem        = $this->input->get('myselect') ?: '';
            $getdtm         = $this->input->get('dtmsensor') ?: date('Y-m-d');
            $getjenis       = $this->input->get('jenischart') ?: 'bar';
            $getprojectid   = $this->input->get('projectid') ?: '';
            
            if(is_array($getitem)){
            $resdata = '';
           
            $getsensorid1 = $getitem[0] ?: '';
            $getsensorid2 = $getitem[1] ?: '';
            
            $resdata = $this->Http2Device($getsensorid1,$getsensorid2, $getdtm);
           
            if($resdata){ 
                $json_decode = json_decode($resdata);
                if($json_decode->status == 0){
                    for ($i=0;$i<count($json_decode->data_sensor1);$i++)
                    {
                            if ($i==0){
                                    $data_val=$json_decode->data_sensor1[$i]->ds_val;
                                    $data_sensor1=$json_decode->data_sensor1[$i]->ds_sensorname;
                                    $data_date_time="'".$json_decode->data_sensor1[$i]->ds_hour.' '.''."'";	
                            }else{
                                    $data_val =$data_val.','.$json_decode->data_sensor1[$i]->ds_val;
                                    $data_date_time =$data_date_time.','."'".$json_decode->data_sensor1[$i]->ds_hour.' '.''."'";
                            }
                    }

                    for ($i=0;$i<count($json_decode->data_sensor2);$i++)
                    {
                            if ($i==0){
                                    $data_val2=$json_decode->data_sensor2[$i]->ds_val;	
                                    $data_sensor2=$json_decode->data_sensor2[$i]->ds_sensorname;
                            }else{
                                    $data_val2 =$data_val2.','.$json_decode->data_sensor2[$i]->ds_val;
                            }
                    }
                    
                    $data_sensor1 = str_replace('(?)', '(Σ)',$data_sensor1);
                    $data_sensor2 = str_replace('(?)', '(Σ)',$data_sensor2);
                    $script_output = "<script type='text/javascript'>
                            Highcharts.chart('Line2Sensor', {
                                chart: {
                                    type: 'areaspline'
                                },
                                title: {
                                    text: '".$data_sensor1." & ".$data_sensor2."'
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'left',
                                    verticalAlign: 'top',
                                    x: 150,
                                    y: 100,
                                    floating: true,
                                    borderWidth: 1,
                                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                                },
                                xAxis: {
                                    categories: [".$data_date_time."],
                                    plotBands: [{ // visualize the weekend
                                        from: 4.5,
                                        to: 6.5,
                                        color: '#ffffff'
                                    }]
                                },
                                yAxis: {
                                    title: {
                                        text: 'Value'
                                    }
                                },
                                tooltip: {
                                    shared: true,
                                    valueSuffix: ' units'
                                },
                                credits: {
                                    enabled: false
                                },
                                plotOptions: {
                                    areaspline: {
                                        fillOpacity: 0.5
                                    }
                                },
                                series: [{
                                    name: '".$data_sensor1."',
                                    data: [".$data_val."]
                                }, {
                                    name: '".$data_sensor2."',
                                    data: [".$data_val2."]
                                }]
                            });

                            Highcharts.chart('Bar2Sensor', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: '".$data_sensor1." & ".$data_sensor2."'
                                },
                                xAxis: {
                                    categories: [".$data_date_time."]
                                },
                                yAxis: [{
                                    min: 0,
                                    title: {
                                        text: 'Value'
                                    }
                                }, {
                                    title: {
                                        text: ' '
                                    },
                                    opposite: true
                                }],
                                legend: {
                                    shadow: false
                                },
                                tooltip: {
                                    shared: true
                                },
                                plotOptions: {
                                    column: {
                                        grouping: false,
                                        shadow: false,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: '".$data_sensor1."',
                                    color: '#009999',
                                    data: [".$data_val."],
                                    pointPadding: 0.3,
                                    pointPlacement: -0.2
                                }, {
                                    name: '".$data_sensor2."',
                                    color: '#66ccff',
                                    data: [".$data_val2."],
                                    pointPadding: 0.4,
                                    pointPlacement: -0.2 
                                }]
                            });
                            </script>";
                }
            }

                
            
        }
        $this->mViewData['select_output'] = $htmloutput;
        $this->mViewData['script_output'] = $script_output;
        //$this->mViewData['projectid'] = $projectID;
        $this->mPageTitle = 'Report 2 Sensor';
        $this->render('report/f_2thinglist');
    }
    public function Http2Device($sensorid1= '',$sensorid2 = '',$tanggal = '') {

        $url=APILOCAL."iot/SensorData2device";
        $postfield="sensor_id=".$sensorid1."&date=".$tanggal."&sensor_id2=".$sensorid2;
        $length = strlen($postfield);
        $header=array('Content-type:application/x-www-form-urlencoded',
                                        'x-api-key:cahbagusanggakey',
                                        'Content-Length:'.$length
                                        );

        $CH = curl_init();
        curl_setopt($CH, CURLOPT_URL, $url);
        curl_setopt($CH, CURLOPT_HEADER, 0);
        curl_setopt($CH, CURLOPT_HTTPHEADER, $header);
        curl_setopt($CH, CURLOPT_POST, 1);
        curl_setopt($CH, CURLOPT_POSTFIELDS, $postfield);
        curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
        //$request = curl_getinfo($CH);
        $responseText=curl_exec($CH);
        return $responseText;
    }
    public function DeviceSearch() {
        $getdate1   = date('Y-m-d');
        $getdate2   = date('Y-m-d');
        $getsensor  = '';
        $getvalue   = '';
        $gettype    = '';
        $selected   = '';
        $selectedequal   = '';
        $selectedmin   = '';
        $selectedmax   = '';
        
        $htmloutput = '';
        $getdata = '';
        $getdatalist = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
                
                $htmloutput .="<optgroup label='".$getname."'>";
                    $getdatasensor = $this->Miot->SensorByThing($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            $getsensorname =  str_replace('(?)', '(Σ)',$sid->sensorName);                                                     
                            $htmloutput .= "<option value='".$getsensorid."' ".$selected.">[".$getsensorid."]".$getsensorname."</option>";
                        }
                    }           
                $htmloutput .="</optgroup>";
            }
        }

        if(count($this->input->post())> 0){
            $getdate1   = $this->input->post('datetimes1') ?: '';
            $getdate2   = $this->input->post('datetimes2') ?: '';
            $getsensor  = $this->input->post('sensor') ?: '';
            $gettype    = $this->input->post('type') ?: '';
            $getvalue   = $this->input->post('tvalue') ?: '';

            if($gettype == "min") {
                $selectedmin  = "selected";
            }
            if($gettype == "max") {
                $selectedmax  = "selected";
            }
            if($gettype == "equal") {
                $selectedequal  = "selected";
            }
            
            
            $getdata = $this->Miot->SersorDataJoinSearch($getsensor,$gettype,$getdate1,$getdate2,$getvalue);
        }
        
        $this->mViewData['setdate1']    = $getdate1;
        $this->mViewData['setdate2']    = $getdate2;
        $this->mViewData['setsensor']   = $getsensor;
        $this->mViewData['settype']     = $gettype;
        $this->mViewData['settype_min']     = $selectedmin;
        $this->mViewData['settype_max']     = $selectedmax;
        $this->mViewData['settype_equal']     = $selectedequal;
        $this->mViewData['setvalue']    = $getvalue;
        
        $this->mViewData['select_output']   = $htmloutput;
        $this->mViewData['data_output']     = $getdata;
        $this->render('report/f_SensorSearch');
    }
    public function Setalarm() {
        $htmloutput = '';
        $getdata = '';
        $htmloutputg ='';
      
        
        
        $getdatalist = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
//                    $htmloutput .="<optgroup label='".$getname."'>";
                    $getdatasensor = $this->Miot->SensorByThing($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            $getsensorname =  str_replace('(?)', '(Σ)',$sid->sensorName);
                            $htmloutput .= "<option value='".$getsensorid."'>[".$getsensorid."]".$getsensorname."</option>";
                        }
                    }           
//                     $htmloutput .="</optgroup>";

            }
        }
        $getdatagroup = $this->Miot->Al_Grup();

        if($getdatagroup){
            foreach ($getdatagroup as $g) {
                $gthings  = $g->id;
                $gname    = $g->name;
                $htmloutputg .= "<option value='".$gthings."'> [".$gthings."] ".$gname."</option>";

            }
        }
        $getalarmlist = $this->Miot->Al_Alarm_joinlist();     

        $this->mViewData['select_output'] = $htmloutput;
        $this->mViewData['select_outputg'] = $htmloutputg;
        $this->mViewData['alarm_list'] = $getalarmlist;
        $this->mPageTitle = 'Setting Alarm';
        $this->render('alarm/f_alarm');
    }
    public function AlmCreateGroup() {        
        $data = $this->Miot->Al_Grup();
        $this->mPageTitle = 'Alarm Setting';
        $this->mViewData['datagroup'] = $data;
        $this->render('alarm/v_group');        
    }
    public function AlmCreateMember() {
        $data = $this->Miot->Al_Member();
        $this->mPageTitle = 'Alarm Member';
        $this->mViewData['datagroup'] = $data;
        $this->render('alarm/v_member');               
    }    
    public function AlmCreateMember_del($id = '') {
        $this->Miot->Al_member_del($id);       
        redirect(base_url().'storefront/report/AlmCreateMember/');
    }
    public function AlmCreateMember_edit($id,$level= '1') {
        $data = $this->Miot->Al_Member_byId($id);
        if($level == '2') // edit
        {
            $tnama      = $this->input->post('tname') ?: '';        
            $thp        = $this->input->post('thp') ?: '';        
            $temail     = $this->input->post('temail') ?: '';        
            $tnote      = $this->input->post('tnote') ?: '';        
            $arr        = array('membername' => $tnama, 'nohp' => $thp,'email' => $temail,'noted' => $tnote,'joindate' => date('Y-m-d H:i:s'));        
            $this->Miot->Al_member_upd($id,$arr);
            //echo "<span class='label label-info'>your message has been submitted .. Thanks you</span>";
            redirect(base_url().'storefront/report/AlmCreateMember');
            
        }else{
            foreach ($data as $v) {
                $this->mViewData['id'] = $v->idmember;
                $this->mViewData['nama'] = $v->membername;
                $this->mViewData['nohp'] = $v->nohp;
                $this->mViewData['email'] = $v->email;
                $this->mViewData['noted'] = $v->noted;
            }
            $this->mPageTitle = 'Alarm Member';
            $this->mViewData['datagroup'] = $data;
            $this->render('alarm/v_member_edit');
            
            
        }
                
        
    }
    public function SettAlarm($group) {
        $data = $this->Miot->Al_ListGroupMember($group);     
        $grouplist = $this->Miot->Al_group_byId($group);     
        $this->mViewData['datagroup']   = $data;
        $this->mViewData['dataid']      = $group;
        $this->mViewData['groupid']     = $grouplist;
        $this->render('alarm/v_alm_group_add_member_new');
    }
    public function AlmGroupSave() {
        $data = $this->input->post('tname') ?: '';        
        $arr = array('name' => $data, 'dtm_create' => date('Y-m-d H:i:s'));        
        $this->Miot->Inst('al_group',$arr);
        echo "<span class='label label-info'>your message has been submitted .. Thanks you</span>";
        redirect(base_url().'storefront/report/AlmCreateGroup');
    }
    public function AlmMemberSave() {
        $tnama      = $this->input->post('tname') ?: '';        
        $thp        = $this->input->post('thp') ?: '';        
        $temail     = $this->input->post('temail') ?: '';        
        $tnote      = $this->input->post('tnote') ?: '';        
        $arr        = array('membername' => $tnama, 'nohp' => $thp,'email' => $temail,'noted' => $tnote,'joindate' => date('Y-m-d H:i:s'));        
        $this->Miot->Inst('al_member',$arr);
        //echo "<span class='label label-info'>your message has been submitted .. Thanks you</span>";
        redirect(base_url().'storefront/report/AlmCreateMember');
    }
    public function AlmGroupMemberSave() {
        $group_source = $this->input->post('groupname');
        $check = $this->input->post('check'); 
        if($this->input->post('check')) {
            $this->Miot->Al_Del_GroupMember_byGroupId($group_source);
            foreach ($check as $data){
                $datains      = array('group_id' => $group_source, 'member_id' => $data, 'joindtm' => date('Y-m-d H:i:s'), 'updtm'=> date('Y-m-d H:i:s'));
                $this->Miot->Inst('al_group_member',$datains);
            }        
            
        }  
        redirect(base_url().'storefront/report/SettAlarm/'.$group_source);
        
        
    }
    public function Alm_Group_del($id) {
        $this->Miot->Al_group_del($id);
        redirect(base_url().'storefront/report/AlmCreateGroup');
    }
    public function Alm_settlist_del($id) {
        $this->Miot->Al_Alarm_del($id);
        redirect(base_url().'storefront/report/setalarm');
    }
    public function Alm_Group_edit($id,$level= '1') {
        $data = $this->Miot->Al_group_byId($id);
        if($level == '2') // edit
        {
            $tnama      = $this->input->post('tname') ?: '';        
            $tstatus        = $this->input->post('status') ?: '';               
            $arr        = array('name' => $tnama, 'status' => $tstatus);        
            $this->Miot->Al_Group_upd($id,$arr);
            //echo "<span class='label label-info'>your message has been submitted .. Thanks you</span>";
            redirect(base_url().'storefront/report/AlmCreateGroup');
            
        }else{
            foreach ($data as $v) {
                $this->mViewData['id'] = $v->id;
                $this->mViewData['nama'] = $v->name;
                $this->mViewData['status'] = $v->status;

            }
            $this->mPageTitle = 'Group';
            $this->mViewData['datagroup'] = $data;
            $this->render('alarm/v_group_edit');
            
            
        }
                
        
    }
    public function Alm_AlarmSave() {
        if(count($this->input->post())> 0){
            $getname    = $this->input->post('tname') ?: '';
            $getsensor  = $this->input->post('sensor') ?: '';
            $gettype    = $this->input->post('type') ?: '';
            $getvalue   = $this->input->post('tvalue') ?: '';
            $getgroup   = $this->input->post('tgroup') ?: '';
            $gettinternal   = $this->input->post('tinternal') ?: '';
            //`name`, `sensorid`, `type`, `value`, `datecreate` 
            $arr = array('name' =>$getname,
                'sensorid'  => $getsensor,
                'type'      => $gettype,
                'value'     => $getvalue,
                'algroupid' => $getgroup,
                'settimer_internal' => $gettinternal,
                'last_sent'=> date('Y-m-d H:i:s'),
                'datecreate'=> date('Y-m-d H:i:s'));
            $this->Miot->Inst('al_alarm',$arr);           
        }
        redirect(base_url().'storefront/report/Setalarm');
    }
    public function Multidate() {
        $htmloutput         = '';
        $getdata            = '';
        $script_output      = '';
        $data_satuan        = '';
        $data_val           = '';
        $data_min           = '';
        $data_max           = '';
        $data_sensor        = '';
        $data_date_time     = '';
        $getsensor          = '';       
        
        $getdate1   = date('Y-m-d');
        $getdate2   = date('Y-m-d');

        if(count($this->input->post())> 0){
            $getdate1   = $this->input->post('datetimes1') ?: '';
            $getdate2   = $this->input->post('datetimes2') ?: '';
            $getsensor  = $this->input->post('sensor') ?: '';
            
            $getdata = $this->Miot->SersorDataJoinSearch($getsensor,'',$getdate1,$getdate2,'');
            
            //print_r($getdata);
            $i = 0;
            foreach ($getdata as $v) {
                $data_sensor = $v->ds_sensorname ?: '';
                $data_sensor =  str_replace('(?)', '(Σ)',$data_sensor);
                $data_satuan = $v->ds_satuan;

                if ($i==1){
                    $data_val       = $v->ds_val;
                    $data_min       = $v->ds_valmin;
                    $data_max       = $v->ds_valmax;
                    $data_date_time = $v->ds_time;     
                }else{
                    $data_val       = $data_val.','.round($v->ds_val,2);
                    $data_min       = $data_min.','.round($v->ds_valmin,2);
                    $data_max       = $data_max.','.round($v->ds_valmax,2);
                    $data_date_time = $data_date_time.','.$v->ds_time;                
                }
                $this->totalval   = $this->totalval + $v->ds_val;
                $i++;
            }

            $script_output = "
                <script type='text/javascript'>
                Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: '".$data_sensor."'
                },
                subtitle: {
                    text: 'PDAM SEMARANG'
                },
                xAxis: {
                    categories: [".$data_date_time."]
                },
                yAxis: {
                    title: {
                        text: '".$data_satuan."'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'MIN',
                    data: [".$data_min."]
                }, {
                    name: 'AVG',
                    data: [".$data_val."]
                },{
                    name: 'MAX',
                    data: [".$data_max."]
                }
                ]
            });
            </script>
            ";    
            // production
            
            if($data_satuan == "l/s"){            

                $ridsecond  = $this->totalval * $this->s_datediff('s', $getdate1, $getdate2);
                $ridminute  = $this->totalval * $this->s_datediff('i', $getdate1, $getdate2);

                $ridday     = $this->totalval * $this->s_datediff('d', $getdate1, $getdate2);
                $day        = $this->dateDifference($getdate1, $getdate2, "%d");
                if(empty($this->totalval) || empty($i)){
                    $avg    = 0;
                }else{
                    $avg = $this->totalval / $i;
                }
                $second = 0;
                $second += (($day * 24 ) * 60) * 60;
                
                $totalproduction    = $avg * $second;
                $kubik              = $totalproduction / 1000;
                $this->dataproduction[] = array(
                    'psecond'   => round($totalproduction, 2),
                    'pday'      => $day,
                    'kubik'      => round($kubik, 2),
                );
            }
           
        }
        $getdatalist        = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
                    $htmloutput .="<optgroup label='".$getname."'>";
                    $getdatasensor = $this->Miot->SensorByThing($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            //$getsensorname =  $sid->sensorName;
                            $getsensorname =  str_replace('(?)', '(Σ)',$sid->sensorName);
                            if($getsensor == $getsensorid):
                                $htmloutput .= "<option value='".$getsensorid."' selected>[".$getsensorid."]".$getsensorname."</option>";
                                
                                else:
                                $htmloutput .= "<option value='".$getsensorid."'>[".$getsensorid."]".$getsensorname."</option>";
                            endif;
                        }
                    }           
                     $htmloutput .="</optgroup>";

            }
        }
        
        
        $this->mViewData['date_from']       = $getdate1;
        $this->mViewData['date_to']         = $getdate2;        
        $this->mViewData['sensorid']        = $getsensor;
        $this->mViewData['sensorname']      = $data_sensor;
        $this->mViewData['data_production'] = $this->dataproduction;
        
        
        $this->mViewData['select_output']   = $htmloutput;
        $this->mViewData['data_output']     = $getdata;
        $this->mViewData['script_output']   = $script_output;
        $this->mPageTitle = 'Production';
        $this->render('report/f_model2date');
    }
    public function MultiSensorRealtime() {
        $htmloutput = '';
        $getdatalist = $this->Miot->Thing();
        if($getdatalist){
            foreach ($getdatalist as $v) {
                $getthings  = $v->thingID;
                $getname    = $v->tName;
                $htmloutput .= "<optgroup label='".$getname."'>";
                    $getdatasensor = $this->Miot->SensorByThingStype($getthings);
                    if($getdatasensor){
                        foreach ($getdatasensor as $sid) {                                                      
                            $getsensorid = $sid->sensorID;
                            $getsensorname =  $sid->sensorName;
                            $getsensorname =  str_replace('(?)', '(Σ)',$getsensorname);
                            $htmloutput .= "<option value='".$getsensorid."'>".$getsensorname."</option>";
                        }
                    }                        
                $htmloutput .= "</optgroup>";

            }
        }
        else{
            $htmloutput .= "<optgroup label='sensor'>                                   
                            </optgroup>";
        }
        $this->mViewData['select_output'] = $htmloutput;

        $this->mPageTitle = 'Realtime Multi Sensor';
        $this->render('report/f_multi_sensor_realtime');
        
    }
    public function MultiSensorRealtime_Display() {
        $getitem        = $this->input->post('myselect') ?: '';
        $getdtm         = $this->input->post('dtmsensor') ?: date('Y-m-d');
        $getjenis       = $this->input->post('jenischart') ?: 'line';
       // $getprojectid   = $this->input->post('projectid') ?: '';
        $divscrip       = '';
        $script         = '';
        if(empty($getitem)){
            redirect('storefront/Report/MultiSensorRealtime/');
        }
        if(empty($getdtm)){
            redirect('storefront/Report/MultiSensorRealtime/');
        }
        if(empty($getjenis)){
            redirect('storefront/Report/MultiSensorRealtime/');
        }

        if(count($getitem)> 0){
            $resdata = '';
            $script .="<script type='text/javascript'>
                var http,postdata,JsonRes,IsiJson,y;

                Highcharts.setOptions({
                    global: {
                        useUTC: false
                    }
                });
                ";
            for($im=0; $im < count($getitem); $im++){  
                $sensorname     = '';
                $getdata = $this->Miot->SensorByID($getitem[$im]);
                foreach($getdata as $vda){
                    $sensorname =  str_replace('(?)', '(Σ)',$vda->sensorName);
 
                }
                
                $empat = 10 + $im - 5;
                if($getjenis == "line"){
                    $divscrip .="<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                            <div class='card'>
                            <div class='body'>
                            <div id='containergauge".$im."' style='min-width: 100; height: 280px; margin: 1'></div>
                            </div>
                            </div>
                            </div>";

                    $script .="Highcharts.chart('containergauge".$im."', {
                    chart: {
                        type: 'spline',
                        animation: Highcharts.svg, // don't animate in old IE
                        marginRight: 10,
                        events: {
                            load: function () {

                    // set up the updating of the chart each second
                    var series = this.series[0];
                    setInterval(function () {
                        var x = (new Date()).getTime(), // current time
                            //y = Math.random();
                            http = new XMLHttpRequest();
                            postdata='sensor_id=".$getitem[$im]."'; //Probably need the escape method for values here, like you did

                            http.open('POST', 'https://pdam.iot-integrasi.com/dashboard/api/iot/SensorDataSingle', true);

                            //Send the proper header information along with the request
                            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            http.setRequestHeader('Content-length', postdata.length);
                            http.setRequestHeader('x-api-key','cahbagusanggakey')
                            http.onreadystatechange = function() {//Call a function when the state changes.
                               if(http.readyState == 4 && http.status == 200) {
                                            JsonRes = http.responseText;
                                            IsiJson = JSON.parse(JsonRes);
                                            x = IsiJson.ds_date;
                                            y = IsiJson.ds_val;
                                            ds_senname = IsiJson.ds_sensorname;
                                    }
                            }
                            http.send(postdata);
                                            series.addPoint([x, y], true, true);
                                        }, ".$empat."000);
                                    }
                                }
                            },
                            title: {
                                text: '".$sensorname."'
                            },
                            xAxis: {
                                type: 'datetime',
                                tickPixelInterval: 150,
                                maxZoom: 20 * 1000
                            },
                            yAxis: {
                                title: {
                                    text: 'Value'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                formatter: function () {
                                    return '<b>' + this.series.name + '</b><br/>' +
                                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                                        Highcharts.numberFormat(this.y, 2);
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            exporting: {
                                enabled: false
                            },
                            series: [{
                                name: '".$sensorname."',
                                data: (function () {
                                    // generate an array of random data
                                    var data = [],
                                        time = (new Date()).getTime(),
                                        i;

                                    for (i = -19; i <= 0; i += 1) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 0
                                        });
                                    }
                                    return data;
                                }())
                            }]
                        });
                        ";
                }
                else{
                    //gauge
                    $divscrip .="<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                            <div class='card'>
                            <div class='body'>
                            <div id='container".$im."' style='min-width: 100px; max-width: 400px; height: 230px; margin: 0 auto'></div>
                            </div>
                            </div>
                            </div>";

                    $script .="Highcharts.chart('container".$im."', {
                        
  chart: {
    type: 'gauge',
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false
  },

  title: {
    text: '".$sensorname."'
  },

  pane: {
    startAngle: -150,
    endAngle: 150,
    background: [{
      backgroundColor: {
        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
        stops: [
          [0, '#FFF'],
          [1, '#333']
        ]
      },
      borderWidth: 0,
      outerRadius: '109%'
    }, {
      backgroundColor: {
        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
        stops: [
          [0, '#333'],
          [1, '#FFF']
        ]
      },
      borderWidth: 1,
      outerRadius: '107%'
    }, {
      // default background
    }, {
      backgroundColor: '#DDD',
      borderWidth: 0,
      outerRadius: '105%',
      innerRadius: '103%'
    }]
  },

  // the value axis
  yAxis: {
    min: 0,
    max: 700,

    minorTickInterval: 'auto',
    minorTickWidth: 1,
    minorTickLength: 10,
    minorTickPosition: 'inside',
    minorTickColor: '#666',

    tickPixelInterval: 30,
    tickWidth: 2,
    tickPosition: 'inside',
    tickLength: 10,
    tickColor: '#666',
    labels: {
      step: 2,
      rotation: 'auto'
    },
    title: {
      text: 'l/s'
    },
    plotBands: [{
      from: 0,
      to: 300,
      color: '#55BF3B' // green
    }, {
      from: 300,
      to: 500,
      color: '#DDDF0D' // yellow
    }, {
      from: 500,
      to: 700,
      color: '#DF5353' // red
    }]
  },

  series: [{
    name: 'Speed',
    data: [80],
    tooltip: {
      valueSuffix: ' l/s'
    }
  }]

},
// Add some life
function (chart) {
  if (!chart.renderer.forExport) {
    setInterval(function () {
      var point = chart.series[0].points[0],
        newVal,
        //inc = Math.round((Math.random() - 0.5) * 20);
        http = new XMLHttpRequest();
		postdata= 'sensor_id=".$getitem[$im]."'; //Probably need the escape method for values here, like you did

		http.open('POST', 'https://pdam.iot-integrasi.com/dasboard/api/iot/SensorDataSingle', true);
		//Send the proper header information along with the request
//                http.setRequestHeader('Content-type', 'application/json');              
		http.setRequestHeader('x-api-key','cahbagusanggakey')

		http.onreadystatechange = function() {//Call a function when the state changes.
		   if(http.readyState == 4 && http.status == 200) {
		   		JsonRes = http.responseText;
		   		IsiJson = JSON.parse(JsonRes);
		   		//xVal = IsiJson.x;
		   		newVal = IsiJson.ds_val;
		   		point.update(newVal);
		   	}
		}
		http.send(postdata);

    }, 10000);
  }
});
                        ";
                    //end gauge
                }
        }
        $script .= "</script>";

        }
        $this->mViewData['script_output'] = $script;
        $this->mViewData['div_output']  = $divscrip;

        $this->mPageTitle = 'Realtime Multi Sensor';
        $this->render('report/v_Multidisplay_realtime');

    }
    protected function s_datediff( $str_interval, $dt_menor, $dt_maior, $relative=false){

       if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
       if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

        $diff = date_diff( $dt_menor, $dt_maior, ! $relative);
       
       switch( $str_interval){
           case "y": 
               $total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
           case "m":
               $total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
               break;
           case "d":
               $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
               break;
           case "h": 
               $total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
               break;
           case "i": 
               $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
               break;
           case "s": 
               $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
               break;
          }
       if( $diff->invert)
               return -1 * $total;
       else    return $total;   
    }
    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $date_2 = date('Y-m-d', strtotime($date_2 .' +1 day'));
        $myDateTime = DateTime::createFromFormat('Y-m-d', $date_1);
        $date_1 = $myDateTime->format('Y-m-d H:i:s');
        $myDateTime2 = DateTime::createFromFormat('Y-m-d', $date_2);
        $date_2 = $myDateTime2->format('Y-m-d H:i:s');        
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }
    public function Recon($task = '') {

        $getdate1   = date('Y-m-d');        
        $htmloutput = '';
        $getdata = '';
        if($task == "save"){
            if(count($this->input->post())> 0){
                $getdate1   = $this->input->post('datetimes1') ?: ''; 
                if(empty($getdate1)){
                    refresh();
                }else{     
                    $row = $this->Crot->CronjobsListByDate($getdate1);                
                    if(!$row){
                        $arr = array(
                            'requestdate'   => $getdate1,
                            'status'        => 'waiting',
                            'userid'        => $this->session->userdata('user_id')
                        );
                        $this->Miot->Inst('report_recon_cronjobs',$arr);
                    }
                }
            }   
            //redirect(base_url().'storefront/report/recon');
        }elseif($task == "del"){
            $id = $this->input->get('_id') ?: '';
            $dtime = $this->input->get('_dtime') ?: '';
            if(strlen($id) < 6){
                $this->Crot->CronjobsDelByID($id);
            }
            //redirect(base_url().'storefront/report/recon');
        }
        
        $getdata = $this->Crot->CronjobsList();
        $this->mViewData['setdate1']    = $getdate1;
        $this->mViewData['data_output']     = $getdata;
        $this->mPageTitle   = "Report Recon";
        $this->render('report/f_recon');
    }
    
}
