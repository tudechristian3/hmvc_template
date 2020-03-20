<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index(){
		$params = array(
			'where' => array(
				'fk_user_id' => $this->session->userdata('user_id'),
			)
		);
		
		$data['count_user'] = $this->MY_Model->getRows('hmvc_product','','count');
		$data['count_post'] = $this->MY_Model->getRows('hmvc_post',$params,'count');
		$this->load_page('index', $data);		
	}
}
?>

