<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author edisite
 */
class Group extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('MGroup');
    }
    public function index() {
        $this->load->helper('url');
        $this->render('alarm/group_view');
    }
    public function ajax_list()
	{
		$list = $this->MGroup->get_datatables();
		$data = array();
		$no = isset($_POST['start']);
		foreach ($list as $group) {
			$no++;
			$row = array();
			$row[] = $group->id;
			$row[] = $group->name;
			$row[] = $group->status;
			$row[] = $group->dtm_create;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary waves-effect" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$group->id."'".')"><i class="material-icons edit-icon"></i> Edit</a>
				  <a class="btn btn-sm btn-danger waves-effect" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$group->id."'".')"><i class="material-icons delete"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
                    "draw" => isset($_POST['draw']),
                    "recordsTotal" => $this->MGroup->count_all(),
                    "recordsFiltered" => $this->MGroup->count_filtered(),
                    "data" => $data,
                );
		//output to json format
		echo json_encode($output);
	}
        public function ajax_edit($id)
	{
		$data = $this->MGroup->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'name' => $this->input->post('tname'),
				'status' => $this->input->post('tstatus'),
			);
		$insert = $this->MGroup->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'name' => $this->input->post('tname'),
				'status' => $this->input->post('tstatus'),
			);
		$this->MGroup->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->MGroup->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
