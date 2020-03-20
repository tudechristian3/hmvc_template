<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {


	public function __construct(){
		parent::__construct();
	}


	public function index(){	
		$this->load_login('index');
	}


	public function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$params['where'] = array(
			'username' => $username,
		);
		$checkUser = $this->MY_Model->getRows('hmvc_users',$params,'row');
		
		if($checkUser){
			if(password_verify($password,$checkUser->password)){
				if($checkUser->user_type == 1){
					//$this->session->set_userdata((array)$checkUser);
					$this->session->set_userdata('username' , $checkUser->username);
					redirect(base_url('home'));
				} else {
					$data['msg'] = 'Deactivated Account, Please try again';
					$this->load_login('index',$data);
				}
			} else {
				$data['msg'] = 'Invalid password. Please try again';
				$this->load_login('index',$data);
			}
		} else {
			$data['msg'] = 'Invalid Username. Please try again';
			$this->load_login('index',$data);
		}
	}
}
