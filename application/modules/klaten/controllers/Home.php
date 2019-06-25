<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{            
            $this->mPageTitle = "Logger Display";
            $this->render('original/loggergroup');
	}
        public function Chart() {
            $this->render('project/f_realchart');
        }
        
        public function Level() {
            $this->render('include/level.html');
            //$this->load->view('include/level.html');
        }
        public function flow() {
            $this->render('include/flowmeter.html');
            //$this->load->view('include/level.html');
        }
        public function pompa() {
            $this->render('include/pompa.html');
            //$this->load->view('include/level.html');
        }
        public function ph() {
            $this->render('include/ph.html');
            //$this->load->view('include/level.html');
        }
        public function livetest() {
            $this->render('livetest');
            
        }
}
