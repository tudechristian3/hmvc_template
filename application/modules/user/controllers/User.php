<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function __construct(){
		parent::__construct();
	}


	public function index(){	
		$this->load_page('index');
    }


    public function get_employees(){
        $limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');
		$column_order = array('user_id','name');
		$join = array();
		$select = "*";
		$where = array("user_type <>" => 1);
		$group = array();
		$list = $this->MY_Model->get_datatables('hmvc_users',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}
	
	public function edit_user(){
		$user_id = $this->input->post('user_id');
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$set = array(
			'name' => $name,
			'username' => $username,
			'password' => $password,
		);

		$where = array(
			'user_id' => $user_id
		);

		$update = $this->MY_Model->update('hmvc_users', $set, $where);

		echo json_encode($update);
	}

    public function delete()
    {
        $user_id = $this->input->post('id');
		$where = array( 'user_id' => $user_id );
		$update = $this->MY_Model->delete('hmvc_users', $where);

        echo json_encode($update);
	}
	
	public function deactivate_users()
    {
		$status = $this->input->post('status');
        $user_id = $this->input->post('id');
		$where = array( 'user_id' => $user_id );
		$data['status'] = $status;
		$update = $this->MY_Model->update('hmvc_users', $data, $where);

        echo json_encode($update);
	}
	

	public function insertuser()
	{
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$add = array(
			'name' => $name,
			'username' => $username,
			'password' => $password,
		);

		$insert = $this->MY_Model->insert('hmvc_users', $add);
		echo json_encode($insert);
	}


	// public function adduser(){
	// 	if (!empty($this->input->post('id'))) {
	// 		$this->edit_user();
	// 	}else {
	// 		$this->insertuser();
	// 	}
	// }
}

