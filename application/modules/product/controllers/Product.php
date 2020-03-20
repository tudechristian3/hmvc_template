<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {


	public function __construct(){
		parent::__construct();
	}


	public function index(){	
		$this->load_page('index');
    }


    public function get_products(){
        $limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');
		$column_order = array('product_id','product_name','product_price','uploaded_file');
		$join = array();
		$select = "*";
		$where = array("status <>" => 0);
		$group = array();
		$list = $this->MY_Model->get_datatables('hmvc_product',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}
	
	public function edit_products(){
		$product_id = $this->input->post('product_id');
		$product_name = $this->input->post('product_name');
        $product_price = $this->input->post('product_price');

		$set = array(
			'product_name' => $product_name,
			'product_price' => $product_price
		);

		$where = array(
			'product_id' => $product_id
		);

		$update = $this->MY_Model->update('hmvc_product', $set, $where);

		echo json_encode($update);
	}

    public function delete(){
        $product_id = $this->input->post('id');
		$where = array( 'product_id' => $product_id );
		$update = $this->MY_Model->delete('hmvc_product', $where);

        echo json_encode($update);
	}
	
	public function deactivate_users(){
		$status = $this->input->post('status');
        $employee_id = $this->input->post('id');
		$where = array( 'employee_id' => $employee_id );
		$data['status'] = $status;
		$update = $this->MY_Model->update('hmvc_employee', $data, $where);

        echo json_encode($update);
	}
	

	public function add_product(){
		// echo "<pre>";
		// print_r($_FILES);
		// exit();
		$dateUploaded = date('Y-m-d');
        $product_name = $this->input->post('product_name');
        $product_price = $this->input->post('product_price');

		if(!is_dir('./upload/'. $dateUploaded)){
			mkdir('./upload/'. $dateUploaded);
		}

        $config['upload_path']          = './upload/'.$dateUploaded;
        $config['allowed_types']        = '*';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imagefile'))
        {
                $error = array('error' => $this->upload->display_errors());

                //$this->load->view('upload_form', $error);
        }
        else
        {
			$data = array(
				'uploaded_file' => $this->upload->data('file_name'),
				'product_name' => $product_name,
				'product_price' => $product_price,
				'date_added' => $dateUploaded,
				'status' => 1
			);

			$insert = $this->MY_Model->insert('hmvc_product', $data);

                
            echo json_encode($insert);


        }
	}


	// public function adduser(){
	// 	if (!empty($this->input->post('id'))) {
	// 		$this->edit_user();
	// 	}else {
	// 		$this->insertuser();
	// 	}
	// }
}

