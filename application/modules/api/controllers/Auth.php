<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author edisite
 */
class Auth extends API_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->library(array('ion_auth'));
		$this->lang->load('auth');
    }
    public function Login_post() {
	$username      = $this->input->post('identity') ?: '';
        $uniqcode      = $this->input->post('password') ?: '';             

        if (empty($username) || empty($uniqcode) || strlen($username) > 15 || strlen($uniqcode) > 20)
        {
                $res = array(
                    'status' => '1',
                    'msg'   => 'parameter invalid',
                    'agentid'     => '',
                    'username'    => '',
                    'fullname'    => ''
                );
                $this->response($res);
        }
        
        //$this->load->model('Api_ion_auth');
        $resdata = $this->ion_auth->login_api($username,$uniqcode,false);
        if($resdata){  
           
        }  else {
            $res = array(
                    'status' => '2',
                    'msg'   => 'user not registered',
                    'agentid'       => '',
                    'username'      => '',
                    'fullname'          => ''
                );
            $this->response($res);
           
        }         
        
        $res_admin  = $this->Miot->AdminByUsername($username);
        if($res_admin){
            foreach ($res_admin as $val) {
                $ou_agentid     = $val->id;
                $ou_username    = $val->username;
                $ou_name        = trim(ucfirst($val->first_name.' '.$val->last_name));
                $ou_status      = $val->active;
            }
        }else{
            $res = array(
                    'status'        => '2',
                    'msg'           => 'user not registered',
                    'agentid'       => '',
                    'username'      => '',
                    'fullname'      => ''
                );
            $this->response($res);
        }
        
        if(trim($ou_status) == 0){
            $res = array(
                    'status'        => '3',
                    'msg'           => 'user inactive',
                    'agentid'       => '',
                    'username'      => '',
                    'fullname'          => ''
                );
             $this->response($res);
        }        
        $res = array(
                'status'        => '0',
                'msg'           => 'succesfully',
                'agentid'       => $ou_agentid,
                'username'      => $ou_username,
                'fullname'      => $ou_name
            );
        $this->response($res);
    }
}
