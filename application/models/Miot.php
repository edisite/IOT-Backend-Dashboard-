<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Miot
 *
 * @author edisite
 */
class Miot extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function Inst($table,$arr = array()) {
        $query = $this->db->insert($table, $arr);
        return $query;       
    }
    public function Inst_batch($table,$arrayint) {
        $query = $this->db->insert_batch($table, $arrayint); 
        return $query; 
    }
    public function Getdata() {
        $sql = "SELECT 	temperature, 	humidity	 
	FROM recv_temperatur WHERE 1 ORDER BY id DESC
	LIMIT 1";
        $query = $this->db->query($sql)->result();
        return $query;
        
    }
    function SensorByKeys($keys = '') {
        if(empty($keys)){
            return FALSE;
        }
        $sql ="SELECT * FROM sensors WHERE sSensorTokenKeys = '".$keys."' LIMIT 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function ProjectById($id = '') {
        $sql = "SELECT * FROM projects WHERE projectID = '".$id."'";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function ThingByProjectId($projectID = '') {
        $sql ="SELECT * FROM things WHERE projectID = '".$projectID."'";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function Thing() {
        $sql ="SELECT * FROM things WHERE 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function Project() {
        $query = $this->db->get('projects');
        return $query->result();   
        //return false;
    }
    function SensorByThing($thingid = '') {
        $sql ="SELECT * FROM sensors WHERE thingID = '".$thingid."' ORDER BY `sensors`.`sensorName` ASC";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SensorByThingStype($thingid = '',$stype = 'number') {
        $sql ="SELECT * FROM sensors WHERE thingID = '".$thingid."' and sType = '".$stype."' ORDER BY `sensors`.`sensorName` ASC";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function ThingByID($thingid = '') {
        $this->db->where('thingID',$thingid);
        $query = $this->db->get('things');
        return $query->result(); 
    }
    function SensorDataBySensorID($sensorID = '') {
        $sql = "SELECT minute(dsDate) as mn,avg(dsValues) as dsval FROM `sensors_data` WHERE `SensorID` ='".$sensorID."' group by mn order by dataSensorID DESC limit 10";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SensorDataBySensorIDALL($sensorID = '') {
        $sql = "SELECT SensorID,dsVal_avg as dsValues,dshour as daktu FROM `sensors_data_hour` WHERE `SensorID` ='".$sensorID."' ORDER BY `daktu` ASC";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    
    function SensorDataJoinBySensorID($sensorID = '') {
        if(empty($sensorID)){
            return false;
        }
        //$sql ="SELECT a.SensorID AS ds_sensorid,b.sensorName AS ds_sensorname,a.dsValues AS ds_val, a.dsSatuan AS ds_satuan,DATE(a.dsDate) AS ds_date,DATE_FORMAT(a.dsDate,'%H:%i:%s') AS ds_time,b.sType as ds_tipe FROM `sensors_data_lastupd` a, sensors b WHERE a.SensorID =  b.sensorID AND a.`SensorID` ='".$sensorID."' ORDER BY dataSensorID DESC LIMIT 1";
        $sql ="SELECT a.SensorID AS ds_sensorid,b.sensorName AS ds_sensorname,a.dsValues AS ds_val, a.dsSatuan AS ds_satuan,DATE(a.dsDate) AS ds_date,DATE_FORMAT(a.dsDate,'%H:%i:%s') AS ds_time,b.sType as ds_tipe FROM `sensors_data_lastupd` a, sensors b WHERE a.SensorID =  b.sensorID AND a.`SensorID` ='".$sensorID."' and  a.dsInst >= DATE_ADD(CURDATE(), INTERVAL - 10 MINUTE) LIMIT 1";
        $query = $this->db->query($sql)->result();
        return $query;   
    }    
    function SensorByID($sensorID ='') {
        $this->db->where('sensorID',$sensorID);
        $query = $this->db->get('sensors');
        return $query->result(); 
    }
    function SensorByName($names = '') {
        if(empty($names)){
            return false;
        }
        $sql = "SELECT * FROM sensors WHERE sStatus = 'active' and ltrim(rtrim(LOWER(sensorName))) = '".trim(strtolower($names))."' limit 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SensorDataJoinPeriodikBySensorID($sensorID ='',$date_from = '') {
        $sql = "SELECT a.SensorID AS ds_sensorid,b.sensorName AS ds_sensorname,a.dsVal_avg AS ds_val,"
                . "a.dsSatuan AS ds_satuan,DATE(a.dsDate) AS ds_date, dsHour AS ds_hour "
                . "FROM `sensors_data_hour` a, sensors b "
                . "WHERE a.SensorID =  b.sensorID AND a.`SensorID` ='".$sensorID."' "
                . "AND DATE(a.dsDate) = '".$date_from."' GROUP BY ds_hour LIMIT 200";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SensorDataJoinPerHourBySensorID($sensorID ='',$date_from = '') {
        $sql = "SELECT a.SensorID AS ds_sensorid,b.sensorName AS ds_sensorname,AVG(a.dsValues) AS ds_val,a.dsSatuan AS ds_satuan, HOUR(dsDate) AS ds_hour "
                . "FROM `sensors_data` a, sensors b WHERE a.SensorID =  b.sensorID AND a.`SensorID` ='".$sensorID."' "
                . "AND DATE(a.dsDate) = '".$date_from."' GROUP BY ds_hour";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SersorDataJoinSearch($sensorid = '',$type = '',$datefrom = '', $dateto = '', $valu = '') {
        $sql = "SELECT a.SensorID AS ds_sensorid,b.sensorName AS ds_sensorname,a.dsVal_avg AS ds_val,a.dsVal_min AS ds_valmin,a.dsVal_max AS ds_valmax, b.sSatuan AS ds_satuan,a.dsDate AS ds_date,a.dsHour AS ds_time "
                . " FROM `sensors_data_hour` a, sensors b WHERE a.SensorID =  b.sensorID "
                . "AND a.`SensorID` ='".$sensorid."' ";
        if(strtolower($type) ==  "min"){                    
            $sql .= "AND a.`dsVal_avg` >='".$valu."' ";
        }elseif(strtolower($type) == "max"){
            $sql .= "AND a.`dsVal_avg` <='".$valu."' ";
        }elseif(strtolower($type) == "equal"){
            $sql .= "AND a.`dsVal_avg` = '".$valu."' ";
        }               
        $sql .= "AND a.dsDate >= '".$datefrom."' "
            . "AND a.dsDate <= '".$dateto."' LIMIT 200";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function Al_Grup() {
        $sql = "SELECT * FROM `al_group` WHERE 1";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    
    function Al_Alarm() {
        $sql = "SELECT * FROM `al_alarm` WHERE 1";
        $query = $this->db->query($sql)->result();
        return $query;        
    }
    function Al_Member() {
        $sql = "SELECT * FROM `al_member` WHERE 1";
        $query = $this->db->query($sql)->result();
        return $query;  
        
    }
    function Al_Member_byId($id = '') {
        $this->db->where('idmember',$id);
        $query = $this->db->get('al_member');
        return $query->result();
    }
    function Al_QueueSMS() {
        $sql = "SELECT * FROM `al_queue_sms` WHERE 1 limit 50";
        $query = $this->db->query($sql)->result();
        return $query;  
        
    }
    function Al_ListGroupMember($group) {
        $sql = "SELECT IF(id IS NULL,0,1)AS joinsts,id,idmember,membername,nohp
                FROM al_group_member
                RIGHT JOIN al_member
                ON al_group_member.member_id=al_member.idmember 
                AND al_group_member.group_id ='".$group."'";
        $query = $this->db->query($sql)->result();
        return $query;  
    }
    function Al_group_byId($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('al_group');
        return $query->result(); 
    }
    function Al_alarm_bySensorID($id) {
        $this->db->where('sensorid',$id);
        $query = $this->db->get('al_alarm');
        return $query->result(); 
    }
    function Al_Del_GroupMember_byGroupId($id) {
        $this->db->where('group_id', $id);
        $query = $this->db->delete('al_group_member');
        return $query; 
    }
    function Al_GroupMemberCountByGroupId($groupid = '') {
        $sql ="SELECT COUNT(*) AS total FROM al_group_member WHERE group_id ='".$groupid."'";
        $query = $this->db->query($sql);
        if($query){
            foreach ($query->result() as $v) {
                if($v->total > 0){
                    return '<span class="badge bg-orange">'.$v->total.'</span>';
                }else{
                    return '<span class="badge bg-teal">0</span>';                      
                }
            }
        }
        else{
            return '<span class="badge bg-teal">0</span>';
        }
    }
    
    function Al_Alarm_joinlist() {
        $sql = "SELECT a.id as idalarm,a.name,a.type,a.value,a.datecreate AS dtm,b.sensorName,b.sensorID,c.id as idgroup,c.name FROM al_alarm a,sensors b,al_group c WHERE a.sensorid = b.sensorID AND a.algroupid = c.id";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    
    function GetMinutes($last_sent) {
        $sql = "SELECT TIMESTAMPDIFF(MINUTE,'".$last_sent."' , now()) AS MIN";
        $query = $this->db->query($sql)->result();
        if($query){
            foreach ($query as $v) {
                if($v->MIN == 0){
                    return false;
                }
                else{
                    return $v->MIN;
                }
            }
        }
        return false;
    }
    function Al_upd_alarm($id) {
        if(empty($id)){
            return false;
        }
        $data = array(
            'last_sent' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('al_alarm', $data);
    }
    function Al_QueueSMS_del($where) {
        $this->db->where_in('idqueue', $where);
        $qry = $this->db->delete("al_queue_sms"); 
        return $qry;
    }
    function ReportSensorPerHours($sensorid = '',$tanggal =  null) {
        $sql ="SELECT AVG(IF(dsValues IS NULL,0,dsValues)) AS vale,hours FROM `sensors_data` RIGHT JOIN sensor_hours ON HOUR(sensors_data.dsDate) = sensor_hours.hours AND sensors_data.SensorID = '".$sensorid."' AND DATE(dsDate) ='".$tanggal."'  GROUP BY hours ORDER BY hours asc";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    function SensorGroup() {
        $query = $this->db->get('sensor_group');
        return $query->result();        
    }    
    function SensorGroupMember($group_id) {
        $sql ="SELECT a.sensorID,SensorName,sType FROM sensor_group_member a INNER JOIN sensors b ON a.sensorID=b.sensorID AND a.sg_id ='".$group_id."'";
        $query = $this->db->query($sql)->result();
        return $query;
        
    }
    //untuk crontab delete raw data
    function SesorDataDel() {
        $sql = "delete FROM `sensors_data` WHERE date(`dsInst`) <= DATE_ADD(CURDATE(), INTERVAL - 5 day)
ORDER BY `sensors_data`.`dataSensorID` ASC";
        $qry = $this->db->query($sql);
        return $qry;
    }
    function Al_member_del($id = '') {
        if(empty($id)){
            return false;
        }
        $this->db->where('idmember', $id);
        $query = $this->db->delete('al_member');
        return $query;
    }
    function Al_group_del($id = '') {
        if(empty($id)){
            return false;
        }
        $this->db->where('id', $id);
        $query = $this->db->delete('al_group');
        return $query;
    }
    function Al_alarm_del($id = '') {
        if(empty($id)){
            return false;
        }
        $this->db->where('id', $id);
        $query = $this->db->delete('al_alarm');
        return $query;
    }
    function Al_member_upd($id, $data) {
        if(empty($id)){
            return false;
        }        
        $datapush = array(
            'joindate' => date('Y-m-d H:i:s')
        );
        //$data1 = array_push($data, $datapush);
        $this->db->where('idmember', $id);
        $this->db->update('al_member', $data);
        return TRUE;
    }
    function Al_group_upd($id, $data) {
        if(empty($id)){
            return false;
        }        
        $datapush = array(
            'joindate' => date('Y-m-d H:i:s')
        );
        //$data1 = array_push($data, $datapush);
        $this->db->where('id', $id);
        $this->db->update('al_group', $data);
        return TRUE;
    }
    public function AdminByUsername($username = '') {
        $this->db->select('id,username, active, first_name, last_name');
        $this->db->where('username',$username);
        return $this->db->get('admin_users')->result();
    }
    public function Sensor() {
        $this->db->where('sStatus','active');
        $this->db->where('sType','number');
        return $this->db->get('sensors')->result();
    }
    function Al_queue_app_by_sensorid($sensorid) {
        $this->db->where('sensorid',$sensorid);
        return $this->db->get('al_queue_app')->result();
    }
    function Al_queue_app_upd_sensorid($id = '', $data = '') {
        if(empty($id)){
            return false;
        }        
        $this->db->where('sensorid', $id);
        return $this->db->update('al_queue_app', $data);
    }
    function Al_queue_app() {
        $sql = "SELECT * FROM `al_queue_app` a, sensors b WHERE a.sensorid = b.sensorID";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    function Al_report_anomali() {
        $sql = "SELECT b.sensorName,b.sType,a.* FROM `sensors_data_lastupd` a, sensors b WHERE a.`SensorID` = b.sensorID";
        $qry = $this->db->query($sql);
        return $qry->result();
    }

    
}
