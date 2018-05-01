<?php
	class OrgFunctions extends CI_Controller{

		public function perform( $action = 'login'){

			if($action == 'login' || $action == 'regstud' || $action == 'regorg'){
				if( isset($this->session->userdata['logged_in']) )
			 		$this->redirectToProfile();
				else{
					$this->load->view('header');
					$this->load->view(''.$action);
					$this->load->view('footer');
				}
			}
			else if ($action == 'change_password')
				$this->load->view('changepassword');
			else if($action == 'viewFormA')
				$this->viewFormA();
			else
				if($this->session->userdata['account_type'] == 'org')
					if($action  == $this->session->userdata['nsacronym'])					
						$this->loadOrgProfile();
					else
			 			show_404();
				else
					redirect(base_url().'login');
		}

		private function redirectToProfile(){
			if($this->session->userdata['account_type'] == 'student')
			 	redirect(base_url()."student/".$this->session->userdata['username']);
			
			if($this->session->userdata['account_type'] == 'org')
				redirect(base_url()."org/".$this->session->userdata['nsacronym']);
	 		
	 		if($this->session->userdata['account_type'] == 'admin')
	 			redirect(base_url()."admin/".$this->session->userdata['username']);	
		}

		private function loadOrgProfile(){
			$org_id = $this->session->userdata['user_id'];
	
			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgProfileDetails($org_id);
			$data = array();

			$data['profile'] = $result ['profile'];
			$data['announcements'] = $result ['announcements'];
			$data['members'] = $result ['members'];
			$data['posts'] = $result ['posts'];
			$data['orgapps'] = $result ['orgapps'];

			$org_data['profile'] = $result ['profile'];

			$this->load->view('header');
			$this->load->view('org/org', $data);
			$this->load->view('org/applyforaccreditation');
			$this->load->view('org/createposts');
			$this->load->view('org/editprofile', $org_data);
			$this->load->view('footer');
		}

		private function viewFormA(){
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('Form A');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form A: Accreditation Application", PDF_HEADER_STRING);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced fonts
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);	

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set font
			$pdf->SetFont('Helvetica', '', 12);



			// add a page
			$pdf->AddPage();

			//$name = 'UP Society of Computer Scientists';
			// set some text to print
			$html= '<p align="right"><b>Date filed:</b></p><br>
			<b>Organization Name:</b><br>
			<b>Number of members:</b><br>	
			<b>Category:</b><br>
			<b>Position/Designation:   </b>&nbsp;&nbsp;&nbsp;&nbsp;<b>College/Unit</b><br>
			<b>Contact Person:</b>
			<b>Position in the Organization</b>
			<br>
			<b>Address</b>
			<br>
			<b>Telephone no.:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile no.:</b>
			<br>
			<b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Other contact details:</b>
			<br>
			<b>Objectives of Organization:</b>
			<br>
			<b>Brief description of Organization:</b>
			<br>
			<br>
			<br>
				<p align="right">___________________________________<br>
				<b>Name of Person Filing the Application</b>
				<br>
				___________________________________<br>
				<b>Position in the Organization</b>
				<br>
				___________________________________<br>
				<b>Signature</b>
				<br>



				</p>
			';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('example_003.pdf', 'I');

		}

		private function viewFormC(){

			
		}

		private function viewFormD(){
			
		}

		private function viewFormE(){
			
		}

		private function viewFormF(){
			
		}


	}
?>