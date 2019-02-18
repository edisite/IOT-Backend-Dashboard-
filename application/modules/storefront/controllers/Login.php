<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');
			/*
                        $response = $this->input->post('g-recaptcha-response') ?: '';
                        
                        $url = 'https://www.google.com/recaptcha/api/siteverify';
                        $data = array(
                                'secret' => '6LcFtHcUAAAAAK1MSK4GA77_uZ6pdxqJlg0ytSr6',
                                'response' => $response
                        );
                        $options = array(
                                'http' => array (
                                        'header' =>    "Content-Type: application/x-www-form-urlencoded\r\n".
                                                       "Content-Length: ".strlen(http_build_query($data))."\r\n".
                                                       "User-Agent:MyAgent/1.0\r\n",
                                        'method' => 'POST',
                                        'content' => http_build_query($data)
                                )
                        );
                        $context  = stream_context_create($options);
                        $verify = file_get_contents($url, false, $context);
                        $captcha_success=json_decode($verify);
                        if(empty($captcha_success)){
                            $this->load->library('system_message');
                            $this->system_message->set_error('Please.. Captcha Guys');                             
                            //refresh();
                        }else{
                            if ($captcha_success->success==false) { 
                                    $this->load->library('system_message');
                                    $this->system_message->set_error('Please.. Captcha Guys');                             
                                    //refresh();
                            } else if ($captcha_success->success==true) {     
                                */
                                if ($this->ion_auth->login($identity, $password, $remember))
                                {
                                        // login succeed
                                        $messages = $this->ion_auth->messages();
                                        $this->system_message->set_success($messages);
                                        redirect($this->mModule);
                                }
                                else
                                {
                                        // login failed
                                        $errors = $this->ion_auth->errors();
                                        $this->system_message->set_error($errors);
                                        refresh();
                                }
                                /*
                            }     //end    
                        }
                                 */
		}		
		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render('login', 'empty');
	}
}
