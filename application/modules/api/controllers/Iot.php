<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Iot
 *
 * @author edisite
 */
class Iot extends API_Controller{
    //put your code here
    private $status;
    private $sensorid, $data, $totalval;
    protected $arrdata = array();
    protected $arrdata2 = array();
    protected $arrdata3 = array();
    protected $arrdata4 = array();
    protected $subtag = array();
    protected $arr_sub_res = array();
    protected $mastertag = array();
    protected $arrres = array();
    protected $arr_sensorgroup = 
                ['ds_sensorid' => '',
                'ds_sensorname' => '',
                'ds_val' => '',
                'ds_satuan' => '',
                'ds_date' => '',
                'ds_type' => '',
                'ds_time' => ''];
    protected $arr_report_day = 
                ['hour' => '',
                'ds_val' => ''];

    protected $arr_devicesearch = [
        'ds_val'            => '',
        'ds_valmin'         => '',
        'ds_valmax'         => '',
        'ds_satuan'         => '',
        'ds_date'           => '',
        'ds_time'           => '',
    ];
    protected $arrdata_periodik    = [
        'ds_val'        => '',
        'ds_satuan'     => '',
        'ds_date'       => '',                   
        'ds_hour'       => '',                   
    ]; 
    
    protected $dataproduction = [
        'psecond'   => '',
        'pday'      => '',
        'kubik'     => '',
    ];
    
    public function __construct() {
        parent::__construct();
        
    }
    public function Recv_post() {
        $this->Headervalidation();
        $this->data      = $this->input->post('data') ?: '';
        if(empty($this->data)){
            $arr = array(
                'status' => false,
                'error' => 'Value ISEmpty'
            );
            $this->response($arr);
            return;
        }
        
        $arr_inst = array(
            'SensorID' => $this->sensorid, 
            'dsValues' => $this->data,            
            'dsDate' => date('Y-m-d H:i:s')
	);
        $this->Miot->Inst('sensors_data',$arr_inst);
        $arr = array(
                'status' => true,
                'error' => 'OK'
            );
        $this->response($arr); 
        
    }
    protected function Headervalidation() {        
        $token_sensor = $this->input->get_request_header('TOKEN_SENSOR') ?: '';
        if(empty($token_sensor)){
            $arr = array(
                'status' => false,
                'error' => 'Invalid token_sensor'
            );
            $this->response($arr);
            return;
        }
        
        $getdata = $this->Miot->SensorByKeys($token_sensor);
        if($getdata){
            foreach ($getdata as $v) {
                $this->status = $v->sStatus ?: 'inactive';
                $this->sensorid = $v->sensorID ?: '';
            }            
        }
        if($this->status == 'active'){
            return true;
        }elseif($this->status == 'inactive'){
            $arr = array(
                'status' => false,
                'error' => 'Inactive token_sensor'
            );
            $this->response($arr);
            return;
        }else{
            $arr = array(
                'status' => false,
                'error' => 'Invalid token_sensor'
            );
            $this->response($arr);
            return;
        }
        
    }    
    public function Project_get() {
        $getdata = $this->Miot->Project();
        if($getdata){
            foreach ($getdata as $v) {
                $this->arrdata[]    = array('project_id' => $v->projectID,'project_name' => $v->pOwner,
                    'city' => $v->pCity,'contact'=> $v->pContactPoin,'pic' => $v->pPic);
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('project_id' => '','project_name' => '','city' => '','contact'=> '','pic' =>'');
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }        
        $this->response($arr_res);        
    }  
    public function ThingSpot_post() {
        $getproject_id = $this->input->post('project_id') ?: '';        
        if(empty($getproject_id)){
            $this->arrdata[]    = array('thing_id' => '','thing_name' => '');
            $arr_res = array(
                'status' => '2',
                'message' => 'parameter kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $cek_project = $this->Miot->ProjectById($getproject_id);
        if($cek_project === false){
            $this->arrdata[]    = array('thing_id' => '','thing_name' => '');
            $arr_res = array(
                'status' => '3',
                'message' => 'projectid invalid',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $getdatathing = $this->Miot->ThingByProjectId($getproject_id);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array('thing_id' => $v->thingID,'thing_name' => $v->tName);
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('thing_id' => '','thing_name' => '');
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }        
        $this->response($arr_res);       
        
    }
    public function Device_post() {
         $getthing_id = $this->input->post('thing_id') ?: '';
         if(empty($getthing_id)){
            $this->arrdata[]    = array('sensor_id' => '','sensor_name' => '');
            $arr_res = array(
                'status' => '2',
                'message' => 'parameter kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $cek_thing = $this->Miot->ThingByID($getthing_id);
        if($cek_thing === false){
            $this->arrdata[]    = array('sensor_id' => '','sensor_name' => '');
            $arr_res = array(
                'status' => '3',
                'message' => 'thingid invalid',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;   
        }
        
        $getdatathing = $this->Miot->SensorByThing($getthing_id);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array('sensor_id' => $v->sensorID,'sensor_name' => $v->sensorName);
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('sensor_id' => '','sensor_name' => '');
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }        
        $this->response($arr_res);        
        
    }
    //web
    public function SensorData_post() {
        $getsensor_id = $this->input->post('sensor_id') ?: '';
         if(empty($getsensor_id)){
            $this->arrdata[]    = array('menit' => '','svalue' => '');
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $cek_sensor = $this->Miot->SensorByID($getsensor_id);
        if($cek_sensor === false){
            $this->arrdata[]    = array('menit' => '','svalue' => '');
            $arr_res = array(
                'status' => '3',
                'message' => 'sensorid kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;   
        }
        
        $getdatathing = $this->Miot->SensorDataBySensorID($getsensor_id);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array('menit' => $v->mn,'svalue' => abs($v->dsval));
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('menit' => '','svalue' => '');
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }  
        $this->response($arr_res);
    }  
    //angga harus integer
    public function SensorDataValString_post() {
        $getsensor_id = $this->input->post('sensor_id') ?: '';
         if(empty($getsensor_id)){
            $this->arrdata[]    = array('menit' => '0','svalue' => 0);
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $cek_sensor = $this->Miot->SensorByID($getsensor_id);
        if($cek_sensor === false){
            $this->arrdata[]    = array('menit' => '','svalue' => 0);
            $arr_res = array(
                'status' => '3',
                'message' => 'sensorid kosong',
                'data' => $this->arrdata
            );
            $this->response($arr_res);
            return;   
        }
        
        $getdatathing = $this->Miot->SensorDataBySensorID($getsensor_id);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array('menit' => $v->mn,'svalue' => $this->ComaToDot($v->dsval));
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('menit' => '','svalue' => 0);
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }  
        $this->response($arr_res);
    }  
    
    public function SensorData2_post() {
        $c = date('H') * 60;
        $d = date('i');
        $e = $c + $d;
        $f = $e * 60;
        
        $res = $f + date('s');
        $this->arrdata    = array('x' => intval(date('s')),'y' => mt_rand(1, 20));                
            
        $this->response($this->arrdata);
    }
    public function SensorDataSingle_post() {
        $getsensor_id = $this->input->post('sensor_id') ?: '';
         if(empty($getsensor_id)){
            
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid kosong',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'ds_val' => '',
                'ds_satuan' => '',
                'ds_date' => '',
                'ds_type' => '',
                'ds_time' => ''
            );
            $this->response($arr_res);
            return;
        }
        $getdatathing = $this->Miot->SensorDataJoinBySensorID($getsensor_id);
        
        
        if($getdatathing){
            foreach ($getdatathing as $v) {
                //$this->arrdata[]    = array('menit' => $v->mn,'svalue' => abs($v->dsval));
                if(strtolower($v->ds_val) == 'on'){
                    $val = 1;
                }elseif(strtolower($v->ds_val) == 'off'){
                    $val = 0;
                }else{
                    $val = $v->ds_val;
                }
                $arr_res = array(
                    'status' => '0',
                    'message' => 'OK',
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => abs($val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_type' => $v->ds_tipe,
                    'ds_time' => $v->ds_time
                );
            }
            
        }else{            
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'ds_val' => '',
                'ds_satuan' => '',
                'ds_date' => '',
                'ds_time' => ''
            );
        } 
        
        $this->response($arr_res);
    }   
    
    public function SensorDataPeriodik_post() {
        $getsensor_id   = $this->input->post('sensor_id') ?: '';
        $getdate_from   = $this->input->post('date') ?: date('Y-m-d');
        //$getdate_to     = $this->input->post('date_to') ?: date('Y-m-d');
         if(empty($getsensor_id)){ 
            $arr_res = array(
                'status' => '1',
                'message' => 'sensorid kosong',
                'date' => '',
                'ds_sensorname' => '',
                'data' => $this->arrdata_periodik,
                'kapasitas' => $this->dataproduction
            );
            $this->response($arr_res);
        }
        if(empty($getdate_from)){
            $arr_res = array(
                'status' => '2',
                'message' => 'date is kosong',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => $this->arrdata_periodik,
                'kapasitas' => $this->dataproduction
            );
            $this->response($arr_res);
        }
        
        $getdatathing = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id,$getdate_from);
        if($getdatathing){
            $i = 0;
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array(
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_hour' => $v->ds_hour                    
                );
                $this->totalval   = $this->totalval + $v->ds_val;
                $i++;
            }
            if($v->ds_satuan == "l/s"){            
                //$day        = $this->dateDifference($getdate_from, $getdate_from, "%d");
                $day            =  1; // default 1 hari
                if(empty($this->totalval) || empty($i)){
                    $avg    = 0;
                }else{
                    $avg = $this->totalval / $i;
                }
                $second = 0;
                $second += (($day * 24 ) * 60) * 60;                
                $totalproduction    = $avg * $second;
                $kubik              = $totalproduction / 1000;
                $dataprod[] = array(
                    'p_jml_day'  => strval($day)." HARI",
                    'p_liter'    => strval($this->Rp(round($totalproduction, 2)))." L",
                    'p_kubik'    => strval($this->Rp(round($kubik, 2)))." M3",
                );
            }else{
                $dataprod = array(
                    'psecond'   => '',
                    'pday'      => '',
                    'kubik'     => '',
                );
            }
            $arr_res = array(
                'status'        => '0',
                'message'       => 'OK',
                'ds_sensorid'   => $v->ds_sensorid,
                'ds_sensorname' => $v->ds_sensorname,
                'data'          => $this->arrdata,
                'kapasitas'     => $dataprod
            );
            
        }else{   
            $arr_res = array(
                'status' => '3',
                'message' => 'Data Kosong',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => $this->arrdata_periodik,
                'kapasitas' => $this->dataproduction
            );
        }        
        $this->response($arr_res);
    }  
    function Rp($value)
    {
        return number_format($value,0,",",".");
    }
    
    public function SensorDataPerHour_post() {
        $getsensor_id   = $this->input->post('sensor_id') ?: '';
        $getdate_from   = $this->input->post('date_from') ?: date('Y-m-d');
        $getdate_to     = $this->input->post('date_to') ?: date('Y-m-d');
         if(empty($getsensor_id)){
            
            $arr_res = array(
                'status' => '1',
                'message' => 'sensorid kosong',
                'date' => '',
                'ds_sensorname' => '',
                'data' => ''
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getdate_from)){
            
            $arr_res = array(
                'status' => '2',
                'message' => 'date from',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => '',
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getdate_to)){
            
            $arr_res = array(
                'status' => '3',
                'message' => 'date to',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => ''
            );
            $this->response($arr_res);
            return;
        }
        $getdatathing = $this->Miot->SensorDataJoinPerHourBySensorID($getsensor_id,$getdate_from,$getdate_to);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array(
                    'ds_val' => $v->ds_val,
                    'ds_satuan' => $v->ds_satuan,
                    'ds_hour' => $v->ds_hour,
                    
                    );                
            }
            $arr_res = array(
                    'status' => '0',
                    'message' => 'OK',
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'data' => $this->arrdata
                    
                );
            
        }else{            
            $arr_res = array(
                'status' => '4',
                'message' => 'Data Kosong',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => ''
            );
        } 
        
        $this->response($arr_res);
    }  
    
    public function SensorData2device_post() {
        $getsensor_id1       = $this->input->post('sensor_id') ?: '';
        $getsensor_id2      = $this->input->post('sensor_id2') ?: '';
        $getdate_from       = $this->input->post('date') ?: '';
        //$getdate_to         = $this->input->post('date_to') ?: date('Y-m-d');
        //var_dump($_POST)
        if(empty($getsensor_id1)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );            
            $arr_res = array(
                'status' => '1',
                'message' => 'sensorid1 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getsensor_id2)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid 2 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getdate_from)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '3',
                'message' => 'date IS NULL',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        /*if(empty($getdate_to)){
            
            $arr_res = array(
                'status' => '3',
                'message' => 'date to',
                'ds_sensorid' => '',
                'ds_sensorname' => '',
                'data' => ''
            );
            $this->response($arr_res);
            return;
        }*/
        
        $getdatathing = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id1,$getdate_from);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,                    
                    'ds_hour' => $v->ds_hour                    
                    );                
            }         
        }else{
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '4',
                'message' => 'data sensor 1 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata
            );
            $this->response($arr_res);
            return;
            
        }
        $getdatathing2 = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id2,$getdate_from);
        if($getdatathing2){
            foreach ($getdatathing2 as $v) {
                $this->arrdata2[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_hour' => $v->ds_hour 
                    );                
            }                    
        }
        else{
            $this->arrdata2[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',
                    'ds_hour' => ''
                    );
            $arr_res = array(
                'status' => '5',
                'message' => 'data sensor 2 kosong',
                'data_sensor1' => $this->arrdata2,
                'data_sensor2' => $this->arrdata2
            );
            $this->response($arr_res);
        }
        $arr_res = array(
                    'status' => '0',
                    'message' => 'OK',                    
                    'data_sensor1' => $this->arrdata,
                    'data_sensor2' => $this->arrdata2
                    
                );        
        $this->response($arr_res);
    } 
    public function SensorGPS_post() {
        $getsensor_id   = $this->input->post('sensor_id') ?: '';
         if(empty($getsensor_id)){            
            $arr_res = array(
                'status' => '1',
                'message' => 'sensorid kosong',
                'lat' => '',
                'long' => '',
            );
            $this->response($arr_res);
            return;
        }

        $getdatathing = $this->Miot->SensorByID($getsensor_id);
        if($getdatathing){
            foreach ($getdatathing as $v) {                
                    $gps = $v->sGPS;               
            } 
            list($lat, $long) = explode(',',$gps); 
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'lat' => $lat,
                'long' => $long,
            );
        }else{            
            $arr_res = array(
                'status' => '2',
                'message' => 'data kosong',
                'lat' => '',
                'long' => '',
            );
        }         
        $this->response($arr_res);
    }    
    public function Recv_endreshouser_post() {
        
        $getdata = file_get_contents('php://input');      
        $pardata = json_decode($getdata,true);
        if(empty($pardata)){
            $arrres = array(
                'status' => '01',
                'msg'   => 'parameter incomplete'
            );
            $this->response($arrres);
            return;    
        }
        foreach($pardata as $v){
            $header				=  $v['headergroup'];	
            
            foreach($v['body'][0] as $phv){
                    if($phv){
                            $phgroup =  $phv['group'];
                            foreach($phv['value'] as $phvs){
                                    $phtag	=	trim($phvs['tag']);
                                    $phpv	=	trim($phvs['pv']);
                                    $phpvtime	=       trim($phvs['pvtime']);
                                    $phstatus	=	trim($phvs['status']);

                                    if(count(explode(" ", $this->F($phpv))) == 1){
                                            list($phpv_val) = explode(" ", $this->F($phpv));
                                            $phpv_satuan = "";
                                    }elseif(count(explode(" ", $this->F($phpv))) == 2){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv));
                                    }elseif(count(explode(" ", $this->F($phpv))) >= 3){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv_val));
                                    }else{
                                            $phpv_val = "";
                                            $phpv_satuan = "";	
                                    }
                                   
                                    $gettag = $this->Miot->SensorByName($phtag);
                                    if($gettag){
                                        foreach ($gettag as $v) {
                                            $this->sensorid = $v->sensorID;
                                        }
                                        $this->subtag = array('SensorID' => $this->sensorid,'dsValues' => $phpv_val,'dsDate' => date('Y-m-d H:i:s'),'dsSatuan' => $phpv_satuan);
                                        $this->Miot->Inst('sensors_data', $this->subtag);
                                        $arr_sub_res[$phtag] ='ok';
                                    }else{
                                        $arr_sub_res[$phtag] ='not found';
                                    }
                                     //$this->mastertag[] = array($this->subtag);

                            }
                           
                    }else{
                            $arrres = array(
                                'status' => '02',
                                'msg'   => 'struture incomplete'
                            );
                    }  
            }
        }
            unset($this->phtag);
            unset($phv);
        foreach($pardata as $v){
            $header				=  $v['headergroup'];	
               
            foreach($v['body'][1] as $phv){
                    if($phv){
                            $phgroup =  $phv['group'];
                            foreach($phv['value'] as $phvs){
                                    $phtag	=	trim($phvs['tag']);
                                    $phpv	=	trim($phvs['pv']);
                                    $phpvtime	=       trim($phvs['pvtime']);
                                    $phstatus	=	trim($phvs['status']);

                                    if(count(explode(" ", $this->F($phpv))) == 1){
                                            list($phpv_val) = explode(" ", $this->F($phpv));
                                            $phpv_satuan = "";
                                    }elseif(count(explode(" ", $this->F($phpv))) == 2){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv));
                                    }elseif(count(explode(" ", $this->F($phpv))) >= 3){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv_val));
                                    }else{
                                            $phpv_val = "";
                                            $phpv_satuan = "";	
                                    }
                                   
                                    $gettag = $this->Miot->SensorByName($phtag);
                                    if($gettag){
                                        foreach ($gettag as $v) {
                                            $this->sensorid = $v->sensorID;
                                        }
                                        $this->subtag = array('SensorID' => $this->sensorid,'dsValues' => $phpv_val,'dsDate' => date('Y-m-d H:i:s'),'dsSatuan' => $phpv_satuan);
                                        $this->Miot->Inst('sensors_data', $this->subtag);
                                        $arr_sub_res[$phtag] ='ok';
                                    }else{
                                        $arr_sub_res[$phtag] ='not found';
                                    }

                            }
                            
                    }else{
                            $arrres = array(
                                'status' => '02',
                                'msg'   => 'struture incomplete'
                            );
                    }     
            }
        }
            unset($this->phtag);
            unset($phv);
        foreach($pardata as $v){
            $header				=  $v['headergroup'];	
                      
            foreach($v['body'][2] as $phv){
                    if($phv){
                            $phgroup =  $phv['group'];
                            foreach($phv['value'] as $phvs){
                                    $phtag	=	trim($phvs['tag']);
                                    $phpv	=	trim($phvs['pv']);
                                    $phpvtime	=       trim($phvs['pvtime']);
                                    $phstatus	=	trim($phvs['status']);

                                    if(count(explode(" ", $this->F($phpv))) == 1){
                                            list($phpv_val) = explode(" ", $this->F($phpv));
                                            $phpv_satuan = "";
                                    }elseif(count(explode(" ", $this->F($phpv))) == 2){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv));
                                    }elseif(count(explode(" ", $this->F($phpv))) >= 3){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv_val));
                                    }else{
                                            $phpv_val = "";
                                            $phpv_satuan = "";	
                                    }
                                   
                                    $gettag = $this->Miot->SensorByName($phtag);
                                    if($gettag){
                                        foreach ($gettag as $v) {
                                            $this->sensorid = $v->sensorID;
                                        }
                                        $this->subtag = array('SensorID' => $this->sensorid,'dsValues' => $phpv_val,'dsDate' => date('Y-m-d H:i:s'),'dsSatuan' => $phpv_satuan);
                                        $this->Miot->Inst('sensors_data', $this->subtag);
                                        $arr_sub_res[$phtag] ='ok';
                                    }else{
                                        $arr_sub_res[$phtag] ='not found';
                                    }

                            }
                            //$this->mastertag[] = $this->subtag;
                            //$this->Miot->Inst_batch('sensors_data',$this->subtag);
                    }else{
                            $arrres = array(
                                'status' => '02',
                                'msg'   => 'struture incomplete'
                            );
                    }

                      
            }
        }
            unset($this->phtag);
            unset($phv);
        foreach($pardata as $v){
            $header				=  $v['headergroup'];	
            
            foreach($v['body'][3] as $phv){
                    if($phv){
                            $phgroup =  $phv['group'];
                            foreach($phv['value'] as $phvs){
                                    $phtag	=	trim($phvs['tag']);
                                    $phpv	=	trim($phvs['pv']);
                                    $phpvtime	=       trim($phvs['pvtime']);
                                    $phstatus	=	trim($phvs['status']);

                                    if(count(explode(" ", $this->F($phpv))) == 1){
                                            list($phpv_val) = explode(" ", $this->F($phpv));
                                            $phpv_satuan = "";
                                    }elseif(count(explode(" ", $this->F($phpv))) == 2){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv));
                                    }elseif(count(explode(" ", $this->F($phpv))) >= 3){
                                            list($phpv_val, $phpv_satuan) = explode(" ", $this->F($phpv_val));
                                    }else{
                                            $phpv_val = "";
                                            $phpv_satuan = "";	
                                    }
                                   
                                    $gettag = $this->Miot->SensorByName($phtag);
                                    if($gettag){
                                        foreach ($gettag as $v) {
                                            $this->sensorid = $v->sensorID;
                                        }
                                        $this->subtag = array('SensorID' => $this->sensorid,'dsValues' => $phpv_val,'dsDate' => date('Y-m-d H:i:s'),'dsSatuan' => $phpv_satuan);
                                        $this->Miot->Inst('sensors_data', $this->subtag);
                                        $arr_sub_res[$phtag] ='ok';
                                    }else{
                                        $arr_sub_res[$phtag] ='not found';
                                    }

                            }
                            //$this->mastertag[] = $this->subtag;
                            //$this->Miot->Inst_batch('sensors_data',$this->subtag);
                    }else{
                            $arrres = array(
                                'status' => '02',
                                'msg'   => 'struture incomplete'
                            );
                    }

                      
            }
        }
            unset($this->phtag);
            unset($phv);
            
            
            $arrres[] = $arr_sub_res;

        $this->response($arrres);
    }
    function F($val){
            $remove= array("\n",  "\r\n",  "\r", "   ","\t");
            $val= str_replace($remove, '    ', $val);
            return $val;
    }
    public function SensorData4device_post() {
        $getsensor_id1      = $this->input->post('sensor_id1') ?: '';
        $getsensor_id2      = $this->input->post('sensor_id2') ?: '';
        $getsensor_id3      = $this->input->post('sensor_id3') ?: '';
        $getsensor_id4      = $this->input->post('sensor_id4') ?: '';
        $getdate_from       = $this->input->post('date') ?: date('Y-m-d');
        //$getdate_to         = $this->input->post('date_to') ?: date('Y-m-d');
        //var_dump($_POST)
        if(empty($getsensor_id1)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );            
            $arr_res = array(
                'status' => '1',
                'message' => 'sensorid1 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getsensor_id2)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid2 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getsensor_id3)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '3',
                'message' => 'sensorid3 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getsensor_id4)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '4',
                'message' => 'sensorid 4 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        if(empty($getdate_from)){
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '5',
                'message' => 'date is empty',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
        }
        
        $getdatathing = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id1,$getdate_from);
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $this->arrdata[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,                    
                    'ds_hour' => $v->ds_hour                    
                    );                
            }         
        }else{
            $this->arrdata[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',                    
                    'ds_hour' => ''                    
                    );
            $arr_res = array(
                'status' => '6',
                'message' => 'data sensor 1 kosong',
                'data_sensor1' => $this->arrdata,
                'data_sensor2' => $this->arrdata,
                'data_sensor3' => $this->arrdata,
                'data_sensor4' => $this->arrdata
            );
            $this->response($arr_res);
            return;
            
        }
        $getdatathing2 = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id2,$getdate_from);
        if($getdatathing2){
            foreach ($getdatathing2 as $v) {
                $this->arrdata2[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_hour' => $v->ds_hour 
                    );                
            }                    
        }
        else{
            $this->arrdata2[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',
                    'ds_hour' => ''
                    );
            $arr_res = array(
                'status' => '7',
                'message' => 'data sensor 2 kosong',
                'data_sensor1' => $this->arrdata2,
                'data_sensor2' => $this->arrdata2,
                'data_sensor3' => $this->arrdata2,
                'data_sensor4' => $this->arrdata2
            );
            $this->response($arr_res);
        }
        
        $getdatathing3 = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id3,$getdate_from);
        if($getdatathing3){
            foreach ($getdatathing2 as $v) {
                $this->arrdata3[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_hour' => $v->ds_hour 
                    );                
            }                    
        }
        else{
            $this->arrdata3[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',
                    'ds_hour' => ''
                    );
            $arr_res = array(
                'status' => '8',
                'message' => 'data sensor 2 kosong',
                'data_sensor1' => $this->arrdata3,
                'data_sensor2' => $this->arrdata3,
                'data_sensor3' => $this->arrdata3,
                'data_sensor4' => $this->arrdata3
            );
            $this->response($arr_res);
        }
        
        $getdatathing4 = $this->Miot->SensorDataJoinPeriodikBySensorID($getsensor_id4,$getdate_from);
        if($getdatathing4){
            foreach ($getdatathing4 as $v) {
                $this->arrdata4[]    = array(
                    'ds_sensorid' => $v->ds_sensorid,
                    'ds_sensorname' => $v->ds_sensorname,
                    'ds_val' => $this->ComaToDot($v->ds_val),
                    'ds_satuan' => $v->ds_satuan,
                    'ds_date' => $v->ds_date,
                    'ds_hour' => $v->ds_hour 
                    );                
            }                    
        }
        else{
            $this->arrdata4[]    = array(
                    'ds_sensorid' => '',
                    'ds_sensorname' => '',
                    'ds_val' => '',
                    'ds_satuan' => '',
                    'ds_date' => '',
                    'ds_hour' => ''
                    );
            $arr_res = array(
                'status' => '9',
                'message' => 'data sensor 4 kosong',
                'data_sensor1' => $this->arrdata4,
                'data_sensor2' => $this->arrdata4,
                'data_sensor3' => $this->arrdata4,
                'data_sensor4' => $this->arrdata4,
            );
            $this->response($arr_res);
        }
        
        $arr_res = array(
                    'status' => '0',
                    'message' => 'OK',                    
                    'data_sensor1' => $this->arrdata,
                    'data_sensor2' => $this->arrdata2,
                    'data_sensor3' => $this->arrdata3,
                    'data_sensor4' => $this->arrdata4
                    
                );        
        $this->response($arr_res);
    } 
    function ComaToDot($val) {
        return str_replace(',', '.', $val);
    }
    
    public function SensorDataByGroup_post() {
        $getitem = $this->input->post('sensor_id') ?: '';
        $arr_data_res       = array();
        if (empty($getitem))
        {       
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid kosong',
                'data'    => $this->arr_sensorgroup
            );
            
            $this->response($arr_res);
        }

        if(count($getitem)> 0){
            
            $resdata = '';            
            for($im=0; $im < count($getitem); $im++){
                
                $resdata = $this->Miot->SensorDataJoinBySensorID($getitem[$im]);
                if($resdata){
                    foreach ($resdata as $v) {
                        //$this->arrdata[]    = array('menit' => $v->mn,'svalue' => abs($v->dsval));
                        if(strtolower($v->ds_val) == 'on'){
                            $val = 1;
                        }elseif(strtolower($v->ds_val) == 'off'){
                            $val = 0;
                        }else{
                            $val = $v->ds_val;
                        }
                        $arr_data_res[] = array(                                        
                                                'ds_sensorid' => $v->ds_sensorid,
                                                'ds_sensorname' => $v->ds_sensorname,
                                                'ds_val' => abs($val),
                                                'ds_satuan' => $v->ds_satuan,
                                                'ds_date' => $v->ds_date,
                                                'ds_type' => $v->ds_tipe,
                                                'ds_time' => $v->ds_time
                                            );
                    }
                }else{
                    $arr_data_res[] = array(                                        
                        'ds_sensorid' => $getitem[$im],
                        'ds_sensorname' => '',
                        'ds_val' => '',
                        'ds_satuan' => '',
                        'ds_date' => '',
                        'ds_type' => '',
                        'ds_time' => ''
                    );
                }
            }
                $arr_res = array(
                    'status'    => '0',
                    'message'   => 'OK',
                    'data'      => $arr_data_res,
                );
        }   
        else{            
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data'    => $this->arr_sensorgroup
            );
        } 
        
        $this->response($arr_res);
    }
    
    public function SensorGroup_post() {
        
        $getgroup = $this->Miot->SensorGroup();
        if($getgroup){
            foreach ($getgroup as $group) {
                $group_id   = $group->sg_id;
                $groupname  = $group->sg_name;
                $arrsg[]    = array('groupid' => $group_id,'groupname'=>$groupname,'data'=>  $this->SensorGroupMemberByGroupid($group_id));
            } 
            $arrres     = array('status' => "OK", 'listsensor' => $arrsg);
        }else{
            $arrres     = array('status' => "NOK", 'listsensor' => array('groupid' => '','groupname'=>'','data'=>  array('sensorID'=> '','sensorName'=> '','sensorType'=>'')));
        } 
        $this->response($arrres);
    }
    protected function SensorGroupMemberByGroupid($groupid) {
        $sensorgm = $this->Miot->SensorGroupMember($groupid);
        $arr_sgm = array();
        if($sensorgm){
            foreach ($sensorgm as $sgm) {
                $arr_sgm[] = array('sensorID' => $sgm->sensorID,'sensorName' => $sgm->SensorName,'sensorType' => $sgm->sType);
            }
        }else{
            $arr_sgm[] = array('sensorID' => '','sensorName' => '','sensorType' => '');
        }
        return $arr_sgm;
    }
    public function ReportSensorPerDay_post() {
        $getitem = $this->input->post('sensor_id') ?: '';
        $tanggal = $this->input->post('tanggal') ?: '';
        
        $arr_data_res       = array();
        if (empty($getitem))
        {       
            $arr_res = array(
                'status' => '2',
                'message' => 'sensorid kosong',
                'data'    => array(
                            'sensorid'  => '',
                            'data'      => $this->arr_report_day)
            );
            
            $this->response($arr_res);
        }

        if(count($getitem)> 0){
            
            $resdata = '';            
            for($im=0; $im < count($getitem); $im++){
                $arr_item[] = array(
                    'sensorid'  => $getitem[$im],
                    'data'      => $this->ReportPerDay($getitem[$im], $tanggal)
                );
                
            }
                $arr_res = array(
                    'status'    => '0',
                    'message'   => 'OK',
                    'data'      => $arr_item,
                );
        }   
        else{            
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data'    => array(
                            'sensorid'  => '',
                            'data'      => $this->arr_report_day)
            );
        } 
        
        $this->response($arr_res);
    }    
    protected function ReportPerDay($sensor_id,$tanggal) {
        $resdata = $this->Miot->ReportSensorPerHours($sensor_id, $tanggal);
        if($resdata){
            foreach ($resdata as $v) {

                $arr_data_res[] = array(                                        
                                        'hour' => $v->hours,
                                        'val' => abs($v->vale)
                                    );
            }
        }else{
            $arr_data_res[] = $this->arr_report_day;
        }
        return $arr_data_res;
    }
    
    public function DataSensorGroup_post() {
        $getgroup   = $this->input->post('groupid') ?: '';        
        if(empty($getgroup)){
            $arr_res = array(
                'status' => '2',
                'message' => 'groupid kosong',
                'data'    => $this->arr_sensorgroup
            );            
            $this->response($arr_res);
        }        
        $sensorgm = $this->Miot->SensorGroupMember($getgroup);
        $resdata = '';
        if($sensorgm){
            foreach ($sensorgm as $sgm) {
                
                $resdata = $this->Miot->SensorDataJoinBySensorID($sgm->sensorID);
                if($resdata){
                    foreach ($resdata as $v) {
                        //$this->arrdata[]    = array('menit' => $v->mn,'svalue' => abs($v->dsval));
                        if(strtolower($v->ds_val) == 'on'){
                            $val = 1;
                        }elseif(strtolower($v->ds_val) == 'off'){
                            $val = 0;
                        }else{
                            $val = $v->ds_val;
                        }
                        $arr_data_res[] = array(                                        
                                                'ds_sensorid' => $v->ds_sensorid,
                                                'ds_sensorname' => $v->ds_sensorname,
                                                'ds_val' => abs($val),
                                                'ds_satuan' => $v->ds_satuan,
                                                'ds_date' => $v->ds_date,
                                                'ds_type' => $v->ds_tipe,
                                                'ds_time' => $v->ds_time
                                            );
                    }
                }else{
                    $arr_data_res[] = array(                                        
                        'ds_sensorid' => $sgm->sensorID,
                        'ds_sensorname' => '',
                        'ds_val' => '',
                        'ds_satuan' => '',
                        'ds_date' => '',
                        'ds_type' => '',
                        'ds_time' => ''
                    );
                }

            }
            $arr_res = array(
                    'status'    => '0',
                    'message'   => 'OK',
                    'data'      => $arr_data_res,
                );
        }else{
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data'    => $this->arr_sensorgroup
            );
        }
        $this->response($arr_res);
    }
    public function SensorList_post() {
        $getdatathing = $this->Miot->Sensor();
        if($getdatathing){
            foreach ($getdatathing as $v) {
                $getsensorname =  str_replace('(?)', '(Σ)',$v->sensorName);
                $this->arrdata[]    = array('sensor_id' => $v->sensorID,'sensor_name' => $getsensorname);
            }
            $arr_res = array(
                'status' => '0',
                'message' => 'OK',
                'data' => $this->arrdata
            );
        }else{
            $this->arrdata[]    = array('sensor_id' => '','sensor_name' => '');
            $arr_res = array(
                'status' => '1',
                'message' => 'Data Kosong',
                'data' => $this->arrdata
            );
        }        
        $this->response($arr_res);        
    }
    public function DeviceSearch_post() {
            $getdate1   = $this->input->post('date_from') ?: '';
            $getdate2   = $this->input->post('date_to') ?: '';
            $getsensor  = $this->input->post('sensor') ?: '';
            $gettype    = $this->input->post('type') ?: '';
            $getvalue   = $this->input->post('tvalue') ?: '';

            if(empty($getdate1)){
                 $arres  = array('errorcode'=>'101','msg'=>'date_from invalid','data'=>$this->arr_devicesearch);
                 $this->response($arres);
            }
            if(empty($getdate2)){
                 $arres  = array('errorcode'=>'102','msg'=>'date_to invalid','data'=>$this->arr_devicesearch);
                 $this->response($arres);
            }
            if(empty($getsensor)){
                 $arres  = array('errorcode'=>'103','msg'=>'sensor invalid','data'=>$this->arr_devicesearch);
                 $this->response($arres);
            }
            if(empty($gettype)){
                 $arres  = array('errorcode'=>'104','msg'=>'type invalid','data'=>$this->arr_devicesearch);
                 $this->response($arres);
            }
            if(empty($getvalue)){
                 $arres  = array('errorcode'=>'105','msg'=>'tvalue invalid','data'=>$this->arr_devicesearch);
                 $this->response($arres);
            }
            
            $arrpas     = array();
            $getdata = $this->Miot->SersorDataJoinSearch($getsensor,$gettype,$getdate1,$getdate2,$getvalue);
            if($getdata){
                foreach ($getdata as $v) {                    
                    $arrpas[]   = array(
                            'ds_val'            => $v->ds_val,
                            'ds_valmin'         => $v->ds_valmin,
                            'ds_valmax'         => $v->ds_valmax,
                            'ds_satuan'         => $v->ds_satuan,
                            'ds_date'           => $v->ds_date,
                            'ds_time'           => $v->ds_time,
                    );
                }
                $arres  = array(
                    'errorcode' => '100',
                    'msg'       => 'ok',
                    'data'  => $arrpas
                );
            }else{
                
                $arres  = array(
                    'errorcode' => '106',
                    'msg'       => 'data not found',
                    'data'  => $this->arr_devicesearch
                );
            }
            $this->response($arres);
    }
    protected function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
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
    public function Alarm_info_get() {
        $arr    = array();
        $getdata = $this->Miot->Al_queue_app();
        if($getdata):
            foreach ($getdata as $v) {
                $arr[] = array(
                    'sensorid'  => $v->sensorid,
                    'sensorname'  => $v->sensorName,
                    'dtm_alern_start'   => $v->timebegin,
                    'dtm_alern_lastdtm' => $v->timelast,
                    'alern_info'    => $v->keterangan,
                );
            }
            $res = array(
                'status' => 'ok',
                'message' => 'ok',
                'data'  => $arr
            );
            $this->response($res);
        else:
            $arr[] = array(
                    'sensorid'          => '',
                    'sensorname'        => '',
                    'dtm_alern_start'   => '',
                    'dtm_alern_lastdtm' => '',
                    'alern_info'        => '',
                );
            $res = array(
                'status' => 'nok',
                'message' => 'data not found',
                'data'  => $arr
            );
            $this->response($res);
        endif;
    }
    public function Alarm_off_max50_get() {
        
        $arr    = array();
        $getdata = $this->Miot->Al_report_anomali();
        if($getdata):
            foreach ($getdata as $v) {
                if($v->sType == "string" && strtolower($v->dsValues) == "off"){                  
                    $arr[] = array(
                        'sensorid'  => $v->SensorID,
                        'sensorname'  => str_replace('(?)', '(Σ)',$v->sensorName),
                        'dtm'   => $v->dsDate,
                        'value' => strtoupper($v->dsValues),
                    );
                }
                elseif($v->sType == "number"){
                    if($v->SensorID == "28136" || $v->SensorID == "20250"){
                        if(intval($v->dsValues) == 0){
                            $arr[] = array(
                                'sensorid'  => $v->SensorID,
                                'sensorname'  => str_replace('(?)', '(Σ)',$v->sensorName),
                                'dtm'   => $v->dsDate,
                                'value' => $v->dsValues,
                            );
                        }
                    }                        
                    else{
                        if(intval($v->dsValues) <= 50){
                            $arr[] = array(
                                'sensorid'  => $v->SensorID,
                                'sensorname'  => str_replace('(?)', '(Σ)',$v->sensorName),
                                'dtm'   => $v->dsDate,
                                'value' => $v->dsValues,
                            );
                        }
                    }
                }                
            }
            if(count($arr) == 0){
                $arr[] = array(
                    'sensorid'          => '',
                    'sensorname'        => '',
                    'dtm'   => '',
                    'value'        => '',
                );
            }
            $res = array(
                    'status' => 'ok',
                    'message' => 'ok',
                    'data'  => $arr
                );
            $this->response($res);
        else:
            $arr[] = array(
                    'sensorid'          => '',
                    'sensorname'        => '',
                    'dtm'   => '',
                    'value'        => '',
                );
            $res = array(
                'status' => 'nok',
                'message' => 'data not found',
                'data'  => $arr
            );
            $this->response($res);
        endif;
    }
}
