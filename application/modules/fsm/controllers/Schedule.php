<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Schedule
 *
 * @author edisite
 */
class Schedule extends Admin_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->mPageTitle = 'Schedule';                
    }
    public function index() {
        //$this->load->view('sch/calender');
        $this->render('sch/calender');
    }
}
