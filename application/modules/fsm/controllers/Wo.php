<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wo
 *
 * @author edisite
 */
class Wo extends Admin_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->mPageTitle = 'Work Order';
        $this->load->model('M_fsm_Category');
        $this->load->model('M_fsm_workorder');
    }
    public function index() {
        $query = $this->M_fsm_Category->ListData();

        $this->mViewData['category_data'] = $query;
        $this->render('wo/add_order_form');
    }
    public function ListOrder() {
        
        $this->render('wo/list_view');
    }
    public function QueryOrder() {
        $this->render('wo/query_view');
    }
    function loadData_category_select(){
            $param = $this->input->get('q');
            if ($param!=NULL) {
                    $param = $this->input->get('q');
            } else {
                    $param = "";
            }
            $query = $this->M_fsm_Category->ListData($param);
            $response['items'] = array();
            if ($query) {
                    foreach ($query as $val) {
                            $response['items'][] = array(
                                    'id'	=> $val->ct_id,
                                    'text'	=> $val->ct_name
                            );
                    }
                    $response['status'] = '200';
            }

            echo json_encode($response);
    }
    public function wo_add() {
        $data = array('wo_orderid'          => date('Ymd').mt_rand(100, 999),
                    'wo_ordername'          => $this->input->post('tname'),
                    'wo_deskripsi'          => $this->input->post('tdescription'),
                    'wo_setpriority'        => $this->input->post('rpriority'),
                    'wo_setcategory'        => $this->input->post('rcategory'),
                    'wo_tolocation'         => $this->input->post('tlocation'),
                    'wo_tocustomer'         => $this->input->post('tcustomer'),
                    'wo_category'           => $this->input->post('tcategory'),
                    'wo_date'               => $this->input->post('tdate'),
                    'wo_time'               => $this->input->post('ttime'),
                    'wo_status'             => 'New',
                    'wo_dtm_create'         => date('Y-m-d H:i:s'),
                    'wo_user_create'        => $this->session->userdata('username'),
                    );
        $insert = $this->M_fsm_workorder->save($data);
        echo json_encode(array("status" => TRUE));
    }
}
