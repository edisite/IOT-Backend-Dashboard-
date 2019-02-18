<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CronIot
 *
 * @author edi_s
 */
class CronIot extends API_Controller {
    //put your code here
    private $sensorid;
    protected $arr_ok   = array();
    protected $arr_nok  = array();
    protected $subtag   = array();
    private $gtipe      = '';
    private $gvalue     = '';
    private $gsmstype, $gapptype     = '';
    
    public function __construct() {
        parent::__construct();
        $this->load->model('IOT_MQTT');
        
    }
    public function Sysnc_get() {
        $getdata = $this->IOT_MQTT->Queue();
        if($getdata){
            foreach ($getdata as $v) {
                $phid           =	$v->id;
                $phtag          =	$v->device;
                $phpv_val	=	$v->value;
                $phpv_satuan	=	$v->satuan;
                $phtanggal	=	$v->tanggal;
                if(empty($phid) || empty($phtag)){                    
                }else{
                    $gettag = $this->Miot->SensorByName($phtag);
                    if($gettag){
                        foreach ($gettag as $v) {
                            $this->sensorid = $v->sensorID;
                        }
//                        $phpv_val           = str_replace("F", "", $phpv_val);
                        $this->subtag       = array('SensorID' => $this->sensorid,'dsValues' => $phpv_val,'dsDate' => $phtanggal,'dsInst' => date('Y-m-d H:i:s'),'dsSatuan' => $phpv_satuan);
                        $this->Miot->Inst('sensors_data', $this->subtag);
                        $this->SentAlarm($this->sensorid,$phpv_val);
                        $this->arr_ok[]     = $phid;
                    }else{
                        $this->arr_nok[]    = $phid;
                    }                      
                }
                $this->IOT_MQTT->Upd($this->arr_nok);
                $this->IOT_MQTT->Del($this->arr_ok);
                $arrres = array('status' => '00','msg' => 'OK','data_ok' => $this->arr_ok,'nok' => $this->arr_nok);
            }
            
        }else{
            $arrres = array(
                'status' => '01',
                'msg'   => 'parameter incomplete'
            );
            
        }      
        $this->response($arrres);
    }
    function F($val){
            $remove= array("\n",  "\r\n",  "\r", "   ","\t");
            $val= str_replace($remove, '    ', $val);
            return $val;
    }
    protected function SentAlarm($sensorid = '', $val = '') {
        if(empty($sensorid)){
            return false;
        }
        if(empty($val)){
            return false;
        }
        $getalarm = $this->Miot->Al_alarm_bySensorID($sensorid);
        if($getalarm){
            foreach ($getalarm as $v) {
                $this->gtipe      = $v->type;
                $this->gvalue     = $v->value;
                $this->gtimer     = $v->settimer_internal;
                $this->glsent     = $v->last_sent;
                $this->gsmstype    = $v->sms_type;
                $this->gapptype    = $v->app_type;
                
                $getsms = $this->InstAlarm($this->gtipe, $this->gvalue,$sensorid, $val);
                $rstatus    = $getsms->status ?: '0';
                $rssms      = $getsms['sms'] ?: 'NULL';
                $rsapp      = $getsms['app'] ?: 'NULL';
                
                if(empty($this->glsent)){
                }else{                
                    //get menit 
                    $getmenit = $this->Miot->GetMinutes($this->glsent);
                    if($getmenit <= $this->gtimer){   
                    }else{
                        //                        
                        if($this->gsmstype == "1"){
                            $arr_inst = array(
                                    'sensorid'  =>  $sensorid, 
                                    'groupid'   =>  $v->algroupid, 
                                    'settimer'  =>  $this->gtimer, 
                                    'lastsent'  =>  $this->glsent, 
                                    'sms'       =>  $rssms, 
                                    'sts'       =>  "OK", 
                                    'idalarm'   =>  $v->id
                                );
                            $this->Miot->Al_upd_alarm($v->id);
                            $this->Miot->Inst('al_queue_sms', $arr_inst);
                        }
                    }                
                }
                if($this->gapptype == "1"){
                    if($this->Miot->Al_queue_app_by_sensorid($sensorid)){
                        $arr_inst_app = array(                                
                                'keterangan'    => $rsapp, 
                                'timelast'      => date('Y-m-d H:i:s'),
                            );                    
                        $this->Miot->Al_queue_app_upd_sensorid($sensorid, $arr_inst_app);
                    }else{
                        $arr_inst_app = array(
                                'sensorid'      =>  $sensorid, 
                                'groupid'       =>  $v->algroupid, 
                                'keterangan'    =>  $rsapp, 
                                'sts'           =>  "OK", 
                                'idalarm'       =>  $v->id,
                                'timebegin'     =>  date('Y-m-d H:i:s'),
                                'timelast'      =>  date('Y-m-d H:i:s'),
                            );                    
                        $this->Miot->Inst('al_queue_app', $arr_inst_app);
                    }
                }  
            }
        }
        return true;
    }  
    protected function InstAlarm($gtype = '', $gvalue = '', $sensorid = '', $val= '') {
        $status = "";
        $this->gtipe        = $gtype;
        $this->gvalue       = $gvalue;
        
        if($this->gtipe == "min"){
            if($val < $this->gvalue){
                $status ="OK";
                foreach($this->Miot->SensorByID($sensorid) as $sensorget){
                    $sensorname = $sensorget->sensorName;
                }
                $sms    = "PDAM-ALARM (".date('YmdHis').") Sensor :(".$sensorname.") telah melewati batas MINIMAL :".$this->gvalue. ". Nilai sekarang :".$val;
                $app    = "Sensor :(".$sensorname.") telah melewati batas MINIMAL :".$this->gvalue. ". Nilai sekarang :".$val;           
            }
        }
        if($this->gtipe == "max"){
            if($val > $this->gvalue){
                $status ="OK";
                foreach($this->Miot->SensorByID($sensorid) as $sensorget){
                    $sensorname = $sensorget->sensorName;
                }
                $sms = "PDAM-ALARM (".date('Ymd His').") Sensor :(".$sensorname.") telah melewati batas MAXIMAL :".$this->gvalue. ". Nilai sekarang :.".$val;
                $app    = "Sensor :(".$sensorname.") telah melewati batas MAXIMAL :".$this->gvalue. ". Nilai sekarang :.".$val;
            }
        }
        if($this->gtipe == "equal"){
            if($this->gvalue == $val){
                $status = "OK";
                foreach($this->Miot->SensorByID($sensorid) as $sensorget){
                    $sensorname = $sensorget->sensorName;
                }
                $sms = "PDAM-ALARM (".date('YmdHis').") Sensor :(".$sensorname.") EQUAL :".$this->gvalue. ". Nilai sekarang :.".$val;
                $app    ="Sensor :(".$sensorname.") EQUAL :".$this->gvalue. ". Nilai sekarang :.".$val;
            }
        }  
        $arr = array('status' => $status,'sms' => $sms, 'app' => $app);        
        return $arr;       
    }
    public function SMSSent_get() {
        
        $getdata = $this->Miot->Al_QueueSMS();
        if($getdata){
            foreach($getdata as $qsms){
                $groupid    = $qsms->groupid;
                $groupsms   = $qsms->sms;
                $this->SMSSent_member($groupid, $groupsms);
                $this->arr_nok[] = $qsms->idqueue;
                
            }
            $this->Miot->Al_QueueSMS_del($this->arr_nok);
        }    
        echo "OK";

    }
    protected function SMSSent_member($groupid,$sms) {
        $member = $this->Miot->Al_ListGroupMember($groupid);
        if($member){
            foreach ($member as $v) {
                
                $this->HttpGet($v->nohp,$sms);
            }
        }
        return true;
    }
    protected function HttpGet($msisdn,$sms){
        $ch = curl_init();
        $header=array('Content-type:application/x-www-form-urlencoded',
            'Content-length:'. strlen($sms),
            'x-api-key:WXpKV2VWbFlVbWhZTTFKd1lUSldNRmd5YkdzPQ=='
            );
        $qry_str = "msisdn=".$msisdn."&sms=".urlencode($sms)."&sendertype=0";
        curl_setopt($ch, CURLOPT_URL, 'http://10.1.1.83/portal/isat/appgw_cp/api/otp_sentsms?'. $qry_str);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $ok = curl_exec($ch);
        curl_close($ch);
        return $ok;        
    }
    
    protected function ReportPerDayNumber($set) {
        $arr    = array();
        if(empty($set)){
            return false;
        }
        $data   = $this->Crot->RunAll($set);
        if($data){
            $this->Crot->DelReportHourByDate($set);
            foreach ($data as $v) {
                $arr[] = array(
                    'SensorID'  => $v->sid,
                    'dsVal_avg' => $v->avgx,
                    'dsVal_min' => $v->minx,
                    'dsVal_max' => $v->masx,
                    'dsDate'    => $v->dtm,
                    'dsHour'    => $v->hourse,
                    'dsInst'    => date('Y-m-d H:i:s'),
                    'dsSatuan'  => $v->dsSatuan,
                );               
            }
            $this->Crot->Insertbatch_report_hourse($arr);
            //echo json_encode(array('sts' => 'ok'));
            return true;
        }else{
            //echo json_encode(array('sts' => 'nok'));
            return false;
        }
    }
    protected function ReportPerDayString($set) {
        if(empty($set)){
            return false;
        }
        $sensorlist = $this->Crot->RunAllString($set);
        if($sensorlist){
            foreach ($data as $v) {
                $valussensor = $v->dsValues;
                if(strtolower($valussensor) == "on"){
                    $parsingvalue = 1;
                }else{
                    $parsingvalue = 0;
                }
                $arr[] = array(
                    'SensorID'  => $v->sid,
                    'dsVal_avg' => $parsingvalue,
                    'dsVal_min' => $parsingvalue,
                    'dsVal_max' => $parsingvalue,
                    'dsDate'    => $v->dtm,
                    'dsHour'    => $v->hourse,
                    'dsInst'    => date('Y-m-d H:i:s'),
                    'dsSatuan'  => $v->dsSatuan,
                );               
            }
            $this->Crot->Insertbatch_report_hourse($arr);
            return true;
        }else{
            //$arr_ok[]   = array('sts'=>'data not found');
            return false;
        }        
    }
    public function ReportPerHourNumber_post() {
        $setdate    =   date('Y-m-d');
        $settime    =   date('H');
        
        //get sensor
        $sensorlist = $this->Crot->GetSensor();
        if($sensorlist){
            foreach ($sensorlist as $v) {
                $vsensorid      = $v->sensorID;              
        
                $data   = $this->ExecPerHour($vsensorid,$setdate,$settime);
                if($data){
                    $arr_ok[] = $data;
                }else{
                    $arr_ok[] = array('sensorid' =>$vsensorid, 'sts' => 'nok');
                }                
            }
        }else{
            $arr_ok[]   = array('sts'=>'data not found');
        }
        $this->response($arr_ok);
    }
    protected function ExecPerHour($sensorid = '',$dtm = '',$time = '') {
        $getdatasensor = $this->Crot->RunHourBySensorid($sensorid,$dtm,$time);
//        return $getdatasensor;
        if($getdatasensor){
            foreach ($getdatasensor as $v) {
                $arr = array(
                    'SensorID'  => $sensorid,
                    'dsVal_avg' => $v->avgx ?: 0,
                    'dsVal_min' => $v->minx ?: 0,
                    'dsVal_max' => $v->masx ?: 0,
                    'dsDate'    => $dtm,
                    'dsHour'    => $time,
                    'dsInst'    => date('Y-m-d H:i:s'),
                    'dsSatuan'  => $v->dsSatuan ?: "-",
                );               
            }
            $cekhour = $this->Crot->CekReportHour($sensorid,$dtm,$time);
            if($cekhour){
                $where = array('SensorID = ' => $sensorid,'dsDate = ' => $dtm, 'dsHour = ' => $time);
                $this->Crot->UpdateReport($arr,$where);
            }else{
                $this->Crot->InsertReport($arr);
            }
            return array('sensorid' => $sensorid,'sts' => 'ok');
        }else{
            return array('sensorid' => $sensorid,'sts' => 'nok');
        }
    }
    public function ReportPerHourString_post() {
        $setdate    =   date('Y-m-d');
        $settime    =   date('H');
        
        //get sensor
        $sensorlist = $this->Crot->GetSensor('string');
        if($sensorlist){
            foreach ($sensorlist as $v) {
                $vsensorid      = $v->sensorID;              
        
                $data   = $this->ExecPerHour_string($vsensorid,$setdate,$settime);
                if($data){
                    $arr_ok[] = $data;
                }else{
                    $arr_ok[] = array('sensorid' =>$vsensorid, 'sts' => 'nok');
                }                
            }
        }else{
            $arr_ok[]   = array('sts'=>'data not found');
        }
        $this->response($arr_ok);
    }
    protected function ExecPerHour_string($sensorid = '',$dtm = '',$time = '') {
        $getdatasensor = $this->Crot->RunHourBySensorid_string($sensorid,$dtm,$time);
//        return $getdatasensor;
        if($getdatasensor){
            foreach ($getdatasensor as $v) {
                $valussensor = $v->dsValues;
                if(strtolower($valussensor) == "on"){
                    $parsingvalue = 1;
                }else{
                    $parsingvalue = 0;
                }
                $arr = array(
                    'SensorID'  => $sensorid,
                    'dsVal_avg' => $parsingvalue ?: 0,
                    'dsVal_min' => $parsingvalue ?: 0,
                    'dsVal_max' => $parsingvalue ?: 0,
                    'dsDate'    => $dtm,
                    'dsHour'    => $time,
                    'dsInst'    => date('Y-m-d H:i:s'),
                    'dsSatuan'  => $v->dsSatuan ?: "-",
                );               
            }
            $cekhour = $this->Crot->CekReportHour($sensorid,$dtm,$time);
            if($cekhour){
                $where = array('SensorID = ' => $sensorid,'dsDate = ' => $dtm, 'dsHour = ' => $time);
                $this->Crot->UpdateReport($arr,$where);
            }else{
                $this->Crot->InsertReport($arr);
            }
            return array('sensorid' => $sensorid,'sts' => 'ok');
        }else{
            return array('sensorid' => $sensorid,'sts' => 'nok');
        }
    }
    public function BackupRawData_post() {
        $data = $this->Miot->SesorDataDel();
        echo $data;
    }
    public function CronRecon_post() {
        $data = $this->Crot->CronjobsListByStatus('waiting');
        if($data){
            foreach ($data as $v) {
                $jamterbang     = $v->requestdate;
                $idterbang      = $v->id;
                //cekdulu data sourcenya ya
                if($this->Crot->CronjobsCek($jamterbang) > 0){
                    //eh ternyata masih ada
                    $resnumber = $this->ReportPerDayNumber($jamterbang);
                    $resstring = $this->ReportPerDayString($jamterbang);            
                    
                    $this->Crot->UpdCronStatus($idterbang,'done','process finish');
                    
                }else{
                    $this->Crot->UpdCronStatus($idterbang,'failed','Data Source not Found');
                }
                //ga ono langsung kon muleh
            }
        }
    }
}
