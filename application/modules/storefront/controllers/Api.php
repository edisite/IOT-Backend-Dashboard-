<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api
 *
 * @author edisite
 */
class Api extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function SensorData2_get() {
        $this->arrdata[]    = array('x' => date('s'),'y' => mt_rand(1, 20));
        echo json_encode($this->arrdata);
    }
}
