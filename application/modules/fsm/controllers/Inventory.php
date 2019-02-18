<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inventory
 *
 * @author edisite
 */
class Inventory extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->mPageTitle = "Inventory ";
    }
    public function index() {
        $this->Sparepart();
    }
    public function Sparepart() {
        $this->render('inventory/sparepart_form');
    }
    public function Request() {
        $this->render('inventory/request_form');
    }
}
