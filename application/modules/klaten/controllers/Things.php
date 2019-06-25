<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Things
 *
 * @author edisite
 */
class Things extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $data = $this->Miot->Thing();
        $this->mViewData['datathing'] = $data;
        $this->mPageTitle = 'Thing List';
        $this->render('project/v_thinglist');
    }
}
