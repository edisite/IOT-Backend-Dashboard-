<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_fsm_Category
 *
 * @author edi_s
 */
class M_fsm_Category extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function ListData($param = '') {
        $sql = "SELECT * FROM fsm_category WHERE 1";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
}
