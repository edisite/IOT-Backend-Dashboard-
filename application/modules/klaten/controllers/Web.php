<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Web
 *
 * @author edisite
 */
class Web extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index() {  
        $this->mPageTitle = "Logger Display";
        $this->render('original/loggergroup');
    }
}