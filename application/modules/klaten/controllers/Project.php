<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Project extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	//tampilkan semua project
	public function index(){		
                $data = $this->Miot->Project();
                $this->mViewData['datathing'] = $data;
                $this->mPageTitle = 'Project List';
                $this->render('project/v_thinglist');
	}
        //buat project baru
        public function Addnew() {
            
            $this->form_validation->set_rules('pOwner','Owner Name','trim|required');
            $this->form_validation->set_rules('pAddress','Address','trim|required');
            $this->form_validation->set_rules('pPic','PIC','trim|required');
            $this->form_validation->set_rules('pContact','Contact','trim|required');
            $this->form_validation->set_rules('pNote','Note','trim|required');
            if($this->form_validation->run()===FALSE){            
		$this->mPageTitle = 'Add new project';
		$this->render('project/f_addproject');
            }else{
                //pOwner=PT+PLN&pAddress=Jl.+Dewa&pPic=Tri&pContact=081212121&pNote=tes&checkbox=on
                $fowner = $this->input->post('pOwner') ?: '';
                $faddrs = $this->input->post('pAddress') ?: '';
                $fpicow = $this->input->post('pPic') ?: '';
                $fcontc = $this->input->post('pContact') ?: '';
                $fpnote = $this->input->post('pNote') ?: '';
                $fpcity = $this->input->post('pCity') ?: '';
                
                $arrinst = array(
                'projectID'     => mt_rand(1111, 9999), 
                'pOwner'        => $fowner, 
                'pAddress'      => $faddrs, 
                'pGPS'          => '', 
                'pPic'          => $fpicow, 
                'pContactPoin'  => $fcontc, 
                'pNote'         => $fpnote, 
                'pDateStartProject' => date('Y-m-d H:i:s'), 
                'pDtmCreate'    => date('Y-m-d H:i:s'), 
                'pDtmUpdate'    => date('Y-m-d H:i:s'), 
                'pCity'         => $fpcity
                );
                
                $this->Miot->Inst('projects',$arrinst);
                $this->system_message->set_success('Succes');
                redirect(base_url().'storefront/Project/listall');
            }
            
        }
        //tampilkan thing
        public function Things($actioncode = '') {
            if(empty($actioncode)){
                $this->system_message->set_success('Parameter incomplete');
                redirect();
            }
            $getres = $this->Miot->ProjectById($actioncode);
            if($getres){         
                foreach ($getres as $v) {
                    $this->mViewData['fproject'] = $v->projectID;
                    $this->mViewData['fowner'] = $v->pOwner;
                    $this->mViewData['faddress'] = $v->pAddress;
                    $this->mViewData['fpic'] = $v->pPic;
                    $this->mViewData['fcontact'] = $v->pContactPoin;
                    $this->mViewData['fnote'] = $v->pNote;
                    $this->mViewData['projectdate'] = $v->pDateStartProject;
                }                
            }else{
                $this->system_message->set_success('Parameter incomplete');
                redirect();
            }
                
            $datathing = $this->Miot->ThingByProjectId($actioncode);
            // display view
            $this->mViewData['crud_output'] = $datathing;
            //$this->mViewData['crud_upline'] = $getthing;
            

            $this->mViewData['projectcode'] = $actioncode; 
            $this->mPageTitle = 'Project List';
            $this->render('project/f_actdetail');
        }
        public function ThingAdd() {
            //tname=tes&tpic=ts&tgps=ss&tcontact=sss&tnote=sss 
            //projectcode
            
            $tnama          = $this->input->post('tname') ?: '';
            $tpic           = $this->input->post('tpic') ?: '';
            $tgps           = $this->input->post('tgps') ?: '';
            $tcontact       = $this->input->post('tcontact') ?: '';
            $tnote          = $this->input->post('tnote') ?: '';
//            $tprojectcode   = $this->input->post('projectcode') ?: '';
//            if(empty($tprojectcode)){
//                $this->system_message->set_error('ilegal access');
//                redirect(base_url().'storefront/');
//            }
            $arrinst = array(
                'thingID'       => mt_rand(11111, 99991),  
                'tName'         => $tnama, 
                'tGPS'          => $tgps, 
                'tPIC'          => $tpic, 
                'tContactPoint' => $tcontact, 
                'tNote'         => $tnote, 
                'tDateInstallation' => date('Y-m-d H:i:s'), 
                'tDtmCreate'    => date('Y-m-d H:i:s'), 
                'tDtmUpdate'    => date('Y-m-d H:i:s')
                );

                $this->Miot->Inst('things',$arrinst);
                $this->system_message->set_success('Succes');
                redirect(base_url().'storefront/things');            
        }
        public function SensorAdd() {
            //tname=tes&tpic=ts&tgps=ss&tcontact=sss&tnote=sss 
            //projectcode
            
            //tname=pompass&tstatus=Active&tnote=tes
            
            $tnama          = $this->input->post('tname') ?: '';
            $tstatus           = $this->input->post('tstatus') ?: '';
            $tnote          = $this->input->post('tnote') ?: '';
            $tsensor        = $this->input->post('tsensor') ?: '';
            if(empty($tsensor)){
                $this->system_message->set_error('ilegal access');
                redirect(base_url().'storefront/');
            }
            $arrinst = array(
                'sensorID'              => mt_rand(11111, 99991),  
                'sensorName'            => $tnama, 
                'thingID'               => $tsensor, 
                'sNote'                 => $tnote, 
                'sStatus'               => $tstatus, 
                'sNote'                 => $tnote, 
                'sDateInstallation'     => date('Y-m-d H:i:s'), 
                'sDteCreate'            => date('Y-m-d H:i:s'), 
                'sDtmUpdate'            => date('Y-m-d H:i:s')
                );          
                
            

                $this->Miot->Inst('sensors',$arrinst);
                $this->system_message->set_success('Succes');
                redirect(base_url().'storefront/project/SensorList/'.$tsensor);            
        }
        public function SensorList($codething = '') {
                $datathing = $this->Miot->SensorByThing($codething);
                // display view
                $this->mViewData['crud_output'] = $datathing;
                $this->mViewData['codething'] = $codething;
		$this->mPageTitle = 'Device / Sensor List';
		$this->render('project/f_sensorlist');
                
            
        }
        public function SensorChart($sensorCode = '',$codething = '') {
            $arr_chart = array();
            $getdata = $this->Miot->SensorByID($sensorCode);
            if($getdata){
                foreach ($getdata as $v) {
                    $sensorname = $v->sensorName;
                }
                
            }else{
                $sensorname = 'Default';
            }
            
            $ackdata = $this->Miot->SensorDataBySensorIDALL($sensorCode);
            if($ackdata){
                foreach ($ackdata as $v) {
                    $arr_chart[] = array('y' => $v->dsValues,'label' => $v->daktu);
                }             
            }
            $this->mViewData['dataPoints']      = $arr_chart;
            $this->mViewData['dataname']        = $sensorname;
            $this->mViewData['thingcode']      = $codething;
            $this->mPageTitle   = 'Live Chart';
            $this->render('project/f_periodeChart');
        }
        public function Provisioning() {
            $this->mPageTitle   = 'Provisioning';
            $this->render('project/v_provisioning');
        }

        
}


