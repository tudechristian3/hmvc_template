<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {


	public function __construct(){
		parent::__construct();
	}


	public function index(){	
		$this->load_page('index');
	}


	public function certificate(){	
		$this->load_certificate('employee/certificate');
	}



    public function get_employees(){
        $limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');
		$column_order = array('employee_id','employee_fname','employee_lname','employee_birthdate','employee_age','employee_address');
		$join = array();
		$select = "*";
		$where = array("status <>" => 0);
		$group = array();
		$list = $this->MY_Model->get_datatables('hmvc_employee',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}
	
	public function edit_employee(){
		$employee_id = $this->input->post('employee_id');
		$employee_fname = $this->input->post('fname');
		$employee_lname = $this->input->post('lname');

		$set = array(
			'employee_fname' => $employee_fname,
			'employee_lname' => $employee_lname
		);

		$where = array(
			'employee_id' => $employee_id
		);

		$update = $this->MY_Model->update('hmvc_employee', $set, $where);

		echo json_encode($update);
	}

    public function delete(){
        $employee_id = $this->input->post('id');
		$where = array( 'employee_id' => $employee_id );
		$update = $this->MY_Model->delete('hmvc_employee', $where);

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
	

	public function insertuser(){
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$birthdate = $this->input->post('birthdate');
		$age = $this->input->post('age');
		$gender = $this->input->post('gender');
		$position = $this->input->post('position');
		$address = $this->input->post('address');

		$add = array(
			'employee_fname' => $fname,
			'employee_lname' => $lname,
			'employee_birthdate' => $birthdate,
			'employee_age' => $age,
			'employee_gender' => $gender,
			'employee_position' => $position,
			'employee_address' => $address,
			'status' => 1
		);

		$insert = $this->MY_Model->insert('hmvc_employee', $add);
		echo json_encode($insert);
	}


	public function add_certificate(){
		$post = $this->input->post();
		//$this->load->library('pdf');
		$params['where'] = array(
			'employee_id' => $this->input->post('id')
			
		);
		$data['users'] = $this->MY_Model->getRows('hmvc_employee', $params);
		$employee_id  = $this->input->post('employee_id');
		$certificate = $this->load->view('employee/certificate', $data, TRUE);
		$createPDF = 'upload/certificate'.'.pdf';
		$this->createPDF($createPDF, $certificate);
		redirect($createPDF);
		$html = $this->output->get_output($createPDF);
		file_put_contents($createPDF , $html);
		// // exit();
		// //$pdfcreated = date('Y-m-d');
		// $this->pdf->loadHtml($certificate);
		// $this->pdf->render();
		$this->pdf->stream($createPDF);
		//$this->pdf->generate($certificate, 'Certificate', true, 'letter', 'landscape');

	}


	public function createPDF($fileName,$html){
		ob_start(); 
		// Include the main TCPDF library (search for installation path).
		$this->load->library('Pdf');
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('TechArise');
		$pdf->SetTitle('TechArise');
		$pdf->SetSubject('TechArise');
		$pdf->SetKeywords('TechArise');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);

		// set auto page breaks
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}       

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();       
		ob_end_clean();
		//Close and output PDF document
		$pdf->Output($fileName, 'F');        
	}


	// public function adduser(){
	// 	if (!empty($this->input->post('id'))) {
	// 		$this->edit_user();
	// 	}else {
	// 		$this->insertuser();
	// 	}
	// }
}

