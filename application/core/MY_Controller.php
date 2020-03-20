<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct(){
		$this->load->model('MY_Model');
		$this->load->config('email');
		$this->load->library('email');
		//$this->load->library('pdf');
		$route = $this->router->fetch_class();
		if($route == 'login'){
			if($this->session->has_userdata('username')){
				redirect(base_url('home'));
			}
		} else {
			if(!$this->session->has_userdata('username')){
				redirect(base_url('login'));
			}
		}
	}

	public function load_page($page, $data = array()){
		$data['users'] = $this->MY_Model->getRows('hmvc_users');
      	$this->load->view('includes/head',$data);
      	$this->load->view('includes/nav',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/footer',$data);
    }
	public function load_certificate($page, $data = array()){
		$data['users'] = $this->MY_Model->getRows('hmvc_users');
      	$this->load->view('includes/head',$data);
      	//$this->load->view('includes/nav',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/footer',$data);
    }
	public function load_login($page, $data = array()){
      	$this->load->view('includes/login_head',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/login_footer',$data);
	}

}
