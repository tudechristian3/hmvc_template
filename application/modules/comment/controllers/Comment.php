<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller {


	public function __construct(){
		parent::__construct();
	}


	public function index(){	
		$this->load_page('index');
    }


    public function get_comments(){
        $limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');
		$column_order = array('post_id', 'post');
		$join = array();
		$select = "*";
		$where = array("post_status <>" => 0);
		$group = array();
		$list = $this->MY_Model->get_datatables('hmvc_post',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}
	
	public function edit_post(){
		$post_id = $this->input->post('post_id');
		$comment = $this->input->post('comment');

		$set = array(
			'post' => $comment
		);

		$where = array(
			'post_id' => $post_id
		);

		$update = $this->MY_Model->update('hmvc_post', $set, $where);

		echo json_encode($update);
	}

    public function delete(){
        $post_id = $this->input->post('id');
		$where = array( 'post_id' => $post_id );
		$update = $this->MY_Model->delete('hmvc_post', $where);

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
	
	public function insertpost(){

        $post = $this->input->post();

        $users = $this->MY_Model->getRows('hmvc_users');

        foreach($users as $u){
            if($u['username'] == $this->session->userdata('username')){
                $id = $u['user_id'];
            }
        }

		$add = array(
			'fk_user_id' => $id,
			'post' => $post['comment'],
			'post_status' => 1
		);

		$insert = $this->MY_Model->insert('hmvc_post', $add);
		echo json_encode($insert);
	}


	public function add_certificate(){
		$path = $_SERVER['DOCUMENT_ROOT'].'/hmvc/upload/test.pdf';
		$post = $this->input->post();
		$this->load->library('pdf');
		$params['where'] = array(
			'employee_id' => $this->input->post('id')
			
		);
		$data['users'] = $this->MY_Model->getRows('hmvc_employee', $params);
		$employee_id  = $this->input->post('employee_id');
		$certificate = $this->load->view('employee/certificate', $data);
		$html = $this->output->get_output();
		file_put_contents($path , $html);
		// exit();
		//$pdfcreated = date('Y-m-d');
		$this->pdf->loadHtmlFile($html);
		$this->pdf->render();
		$this->pdf->stream("test.pdf", array("Attachment"=>0));
		//$this->pdf->generate($certificate, 'Certificate', true, 'letter', 'landscape');

	}

	public function send_email(){

		
		$reciever_email = $this->input->post('reciever_email');
		$this->email->set_newline("\r\n");
        $this->email->from('prospteam@gmail.com', 'Proweaver Test');
		$this->email->to($reciever_email);
		$message = "Hi ".ucwords($reciever_email).",<br /><br />";
		$message .= "This a test please disregard";
		$message .=  "<br /><br />Regards,";
		$message .=  "<br /><br />Proweaver Testing";
		$this->email->subject('Testing');
		$this->email->message($message);
		$send = $this->email->send();
		echo json_encode($send);

	}


	// public function adduser(){
	// 	if (!empty($this->input->post('id'))) {
	// 		$this->edit_user();
	// 	}else {
	// 		$this->insertuser();
	// 	}
	// }
}

