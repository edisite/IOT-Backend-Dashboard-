<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCronReport
 *
 * @author edisite
 */
class MCronReport extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function RunAll($dtm) {
        $sql = "SELECT b.SensorID as sid, ROUND(AVG(CAST(dsValues AS DECIMAL(10,2)))) as avgx, ROUND(MIN(CAST(dsValues AS DECIMAL(10,2)))) as minx,ROUND(MAX(CAST(dsValues AS DECIMAL(10,2)))) as masx,date(b.dsDate) as dtm,hour(b.dsDate) as hourse,b.dsSatuan FROM `sensors` a inner join sensors_data b on a.sensorID = b.sensorID and date(b.dsDate) ='".$dtm."' and a.sType = 'number' group by sid,dtm,hourse ORDER BY `dtm` ASC";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    public function RunAllString($dtm) {
        $sql = "SELECT dataSensorID,b.SensorID AS sid,dsValues,DATE(b.dsDate) AS dtm,HOUR(b.dsDate) AS hourse,"
                . "b.dsSatuan FROM `sensors` a INNER JOIN sensors_data b ON a.sensorID = b.sensorID "
                . "AND DATE(b.dsDate) ='".$dtm."' AND a.sType = 'string' GROUP BY sid,dtm,hourse ORDER BY `dtm` ASC";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    function Insertbatch_report_hourse($arr) {
        $q = $this->db->insert_batch('sensors_data_hour', $arr);
        return $q;
    }
    function InsertReport($arr) {
        $q = $this->db->insert('sensors_data_hour', $arr);
        return $q;
    }
    function UpdateReport($arr,$where) {
        $this->db->where($where);
        $q = $this->db->update('sensors_data_hour', $arr);
        return $q;
    }
    function RunByHour($dtm = '' , $hour = '') {
        if(empty($dtm)){
            return false;
        }
        if(empty($hour)){
            return false;
        }
        $sql = "SELECT b.SensorID AS sid, ROUND(AVG(CAST(dsValues AS DECIMAL(10,2)))) AS avgx, 
            ROUND(MIN(CAST(dsValues AS DECIMAL(10,2)))) AS minx,ROUND(MAX(CAST(dsValues AS DECIMAL(10,2)))) AS masx,
            DATE(b.dsDate) AS dtm,HOUR(b.dsDate) AS hourse,b.dsSatuan 
            FROM `sensors` a INNER JOIN sensors_data b ON a.sensorID = b.sensorID 
            AND DATE(b.dsDate) ='".$dtm."' AND HOUR(b.dsDate) = '".$hour."' 
            AND a.sType = 'number' GROUP BY sid ORDER BY `dtm` ASC";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    function GetSensor($type = "number") {
        $this->db->select('sensorID,sensorName,');
        $this->db->where('sType',$type);
        $query = $this->db->get('sensors');
        return $query->result();
    }
    //value fnc number 
    function RunHourBySensorid($sensorid = '',$dtm = '' , $hour = ''){
        $sql = "SELECT SensorID AS sid,ROUND(AVG(CAST(dsValues AS DECIMAL(10,2)))) AS avgx, ROUND(MIN(CAST(dsValues AS DECIMAL(10,2)))) AS minx,
ROUND(MAX(CAST(dsValues AS DECIMAL(10,2)))) AS masx,DATE(dsDate) AS dtm,HOUR(dsDate) AS hourse,dsSatuan 
FROM sensors_data WHERE sensorID = '".$sensorid."' AND DATE(dsDate) ='".$dtm."' AND HOUR(dsDate) = '".$hour."'";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    function CekReportHour($sensorid = '',$dtm = '', $hour = '') {
        $this->db->where('SensorID',$sensorid);
        $this->db->where('dsDate',$dtm);
        $this->db->where('dsHour',$hour);
        $q = $this->db->get('sensors_data_hour');
        return $q->result();
    }
    //value string
    function RunHourBySensorid_string($sensorid = '',$dtm = '' , $hour = '') {
        $sql = "SELECT dataSensorID,SensorID AS sid,dsValues,DATE(dsDate) AS dtm,HOUR(dsDate) AS hourse,"
                . "dsSatuan FROM sensors_data WHERE sensorID = '".$sensorid."' AND DATE(dsDate) ='".$dtm."' "
                . "AND HOUR(dsDate) = '".$hour."' ORDER BY `dataSensorID` DESC LIMIT 1";
        $qry = $this->db->query($sql);
        return $qry->result();
        
    }
    public function DelReportHourByDate($date = '') {
        $this->db->where('dsDate',$date);
        $data = $this->db->delete('sensors_data_hour');
        return $data;
    }
    function CronjobsList() {
        return $this->db->get('report_recon_cronjobs')->result();        
    }
    function CronjobsListByDate($dtm = '') {
        $this->db->where('requestdate',$dtm);
        return $this->db->get('report_recon_cronjobs')->result();        
    }
    function CronjobsListByStatus($status = '') {
        $this->db->where('status',$status);
        return $this->db->get('report_recon_cronjobs')->result();        
    }
    function CronjobsDelByID($id) {
        $this->db->where('id',$id);
        return $this->db->delete('report_recon_cronjobs');                 
    }
    function CronjobsCek($dtm = '') {
        $sql = "SELECT count(*) as t FROM `sensors_data` WHERE date(`dsDate`) = '".$dtm."'";
        $date =  $this->db->query($sql)->result();
        if($date){
            foreach ($date as $v) {
                return $v->t ?: 0;
            }
        }
        return 0;
    }
    public function UpdCronStatus($id = '',$status = '',$msg = '') {
        $this->db->set('keterangan',$msg);
        $this->db->set('status',$status);
        $this->db->where('id',$id);
        return $this->db->update('report_recon_cronjobs');        
    }
   
}
