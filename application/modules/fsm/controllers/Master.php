<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master
 *
 * @author edisite
 */
class Master extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->mPageTitle = 'Master Data';
        $this->load->library('Googlemaps');
        $this->load->model('M_fsm_technician');
        $this->load->model('M_data');
        $this->load->model('M_fsm_customer');
        $this->load->helper('url');
    }
    public function index() {
        $this->Customer();                
    }
    public function Customer() {
        /*$name = isset($_SESSION['name']) ?: 'Superadmin';

        $Wiw = $this->M_data->get_lat($name);

        $config['center'] = ''.$Wiw.'';
        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);



        $this->lat = '-6.244815';
        $this->lng = '106.860372';
        $this->name = 'Default';
        $this->address = 'Default';


        $marker['position'] = $this->lat.",".$this->lng;
        $marker['infowindow_content'] = "<p align='center'><b>".$this->name."</b></p>".$this->address;
        $this->googlemaps->add_marker($marker);
        

        
        $circle = array();
        $circle['center'] = ''.$Wiw.'';
        $circle['radius'] = '10000';
        $this->googlemaps->add_circle($circle);
        

        $this->mViewData['map'] = $this->googlemaps->create_map();
        $this->render('masterdata/customer_form');
         
         */
        
        $this->render('masterdata/customer_view');
    }
    public function Technician() {
        $this->render('masterdata/technician_view');
    }
    public function Technician_list() {
        $list = $this->M_fsm_technician->get_datatables();
        $data = array();
        $no = isset($_POST['start']);
        foreach ($list as $t) {
                $no++;
                $row = array();
                $row[] = $t->tc_techid;
                $row[] = $t->tc_techname;
                $row[] = $t->tc_birthplace;
                $row[] = $t->tc_birthday;
                $row[] = $t->tc_handphone;
                $row[] = $t->tc_address;
                $row[] = $t->tc_work_address;
                $row[] = $t->tc_joindate;
 

                //add html for action
                $row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="View" onclick="view_person('."'".$t->tc_techid."'".')"><i class="material-icons">pageview</i></a>
                            <a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_technician('."'".$t->tc_techid."'".')"><i class="material-icons">edit</i></a>
                          <a class="btn btn-sm" href="javascript:void(0)" title="Delete" onclick="delete_person('."'".$t->tc_techid."'".')"><i class="material-icons">delete</i></a>';

                $data[] = $row;
        }

        $output = array(
                                        "draw" => isset($_POST['draw']),
                                        "recordsTotal" => $this->M_fsm_technician->count_all(),
                                        "recordsFiltered" => $this->M_fsm_technician->count_filtered(),
                                        "data" => $data,
                        );
        //output to json format
        echo json_encode($output);
    }
    public function Technician_add() {
        $data = array(
				'tc_techname'       => $this->input->post('tname'),
				'tc_birthplace'     => $this->input->post('tplace'),
				'tc_birthday'       => $this->input->post('tbirthday'),
				'tc_handphone'      => $this->input->post('tphone'),
				'tc_address'        => $this->input->post('taddress'),
				'tc_work_address'   => $this->input->post('twork_address'),
				'tc_joindate'       => date('Y-m-d H:i:s'),
				'tc_upddate'        => date('Y-m-d H:i:s'),
			);
        $insert = $this->M_fsm_technician->save($data);
        echo json_encode(array("status" => TRUE));
    }
    public function Technician_edit($id)
	{
		$data = $this->M_fsm_technician->get_by_id($id);
		echo json_encode($data);
	}
        
    public function Customer_list() {
        $list = $this->M_fsm_customer->get_datatables();
        $data = array();
        $no = isset($_POST['start']);
        foreach ($list as $t) {
                $no++;
                $row = array();
                $row[] = $t->cs_custid;
                $row[] = $t->cs_custname;
                $row[] = $t->cs_address;
                $row[] = $t->cs_handphone;
                $row[] = $t->cs_contactperson;
                $row[] = $t->cs_email;
                $row[] = $t->cs_joindate;
 

                //add html for action
                $row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="View" onclick="view_person('."'".$t->cs_custid."'".')"><i class="material-icons">pageview</i></a>
                            <a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_technician('."'".$t->cs_custid."'".')"><i class="material-icons">edit</i></a>
                          <a class="btn btn-sm" href="javascript:void(0)" title="Delete" onclick="delete_person('."'".$t->cs_custid."'".')"><i class="material-icons">delete</i></a>';

                $data[] = $row;
        }

        $output = array(
                                        "draw" => isset($_POST['draw']),
                                        "recordsTotal" => $this->M_fsm_customer->count_all(),
                                        "recordsFiltered" => $this->M_fsm_customer->count_filtered(),
                                        "data" => $data,
                        );
        //output to json format
        echo json_encode($output);
    }
    public function Customer_add() {
        $data = array(
				'cs_custname'           => $this->input->post('tname'),
				'cs_address'            => $this->input->post('taddress'),
				'cs_handphone'          => $this->input->post('tphone'),
				'cs_contactperson'      => $this->input->post('tphone'),
				'cs_email'              => $this->input->post('temail'),
				'cs_description'        => $this->input->post('tdeskripsi'),
				'cs_joindate'           => date('Y-m-d H:i:s'),
				'cs_upddate'            => date('Y-m-d H:i:s'),
			);
        $insert = $this->M_fsm_customer->save($data);
        echo json_encode(array("status" => TRUE));
    }
}
