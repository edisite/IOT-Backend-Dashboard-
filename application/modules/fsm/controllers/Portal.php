<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portal
 *
 * @author edisite
 */
class Portal extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->mPageTitle = "CUSTOMER PORTAL";
    }
    public function index() {
        $this->Ticket_add();
    }
    public function Ticket_add() {
        $this->render('portal/ticket_form');        
    }
    public function Ticket_list() {
        $this->render('portal/ticket_list');
    }
}
