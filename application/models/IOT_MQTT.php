<?php
define('db_mqtt', 'pdam_semarang');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IOT_MQTT
 *
 * @author edi_s
 */
class IOT_MQTT  extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function Queue() {
        $sql ="SELECT * FROM ".db_mqtt.".mqttrx WHERE sts = 0 or sts is null LIMIT 50";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    public function Upd($where = '') { 
        if(empty($where)){
            return false;
        }
        $data = array(
               'sts' => '1',
               'deskripsi' => 'device not found'
            );
	$list = implode(',', $where);
        $this->db->where_in('id', $where);
        $qry = $this->db->update(db_mqtt.".mqttrx", $data); 
        return $qry;
        
    }
    public function Del($where = '') {
        if(empty($where)){
            return false;
        }
	//$list = implode(',', $where);
        $this->db->where_in('id', $where);        
        $qry = $this->db->delete(db_mqtt.".mqttrx");
        return $qry;
    }
    
}
