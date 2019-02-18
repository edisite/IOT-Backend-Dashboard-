<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SesDiagram
 *
 * @author edisite
 */
class M_SesDiagram extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    function InstTable($data) {        
        $q = $this->db->insert('sesimasuk_diagram', $data);
        return $q;
    }
    function CheckSession($ticket = '') {
        $sql = "SELECT 	COUNT(*) AS ttl	 FROM sesimasuk_diagram WHERE idMasuk = '".$ticket."' AND dtmOut > NOW()";
        $query = $this->db->query($sql)->result();
        if($query){
            foreach ($query as $v) {
                return $v->ttl;
            }        
        }else{
            return false;
        }
    }
}
