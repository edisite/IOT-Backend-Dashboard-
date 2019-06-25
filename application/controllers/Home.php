<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_SesDiagram');
    }

    public function index()
    {
            //$this->render('home', 'full_width');
        redirect(base_url().'storefront2');
    }
    public function Xdbeuxb1737vshendj() {
        $Date1 = date('Y-m-d H:i:s');
        $random = date('dHis').random_string('alnum', 16);
        $data = array(
            'idMasuk'   => $random,
            'dtmIn'     => date('Y-m-d H:i:s'),
            'dtmOut'    => date('Y-m-d H:i:s', strtotime($Date1 . " + 2 day")),
            'notes'     => 'baru',
        );
        $this->load->model('M_SesDiagram');
        $this->M_SesDiagram->InstTable($data);
        $urldirect = "http://pdam.iot-integrasi.com/diagram/index.php?ticketid=".$random;
        redirect($urldirect);
    }
    public function CheckStatus($kodeapi = '') {
        if(empty($kodeapi)){
            echo "NOK";
            return;
        }
        if(strlen($kodeapi) > 35){
            echo "NOK";
            return;
        }
        if(strlen($kodeapi) < 10){
            echo "NOK";
            return;
        }
        $this->load->model('M_SesDiagram');
        $d = $this->M_SesDiagram->CheckSession($kodeapi);
        if($d > 0) {
            echo "OK";
        }else{
            echo "NOK";
        }
    }
}
