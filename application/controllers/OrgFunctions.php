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

			$this->load->view('header');
			$this->load->view('org/org', $data);
			$this->load->view('org/applyforaccreditation');
			$this->load->view('org/createposts');
			$this->load->view('org/editprofile');
			$this->load->view('footer');
		}

		private function viewFormA(){
			$pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'STATEMENT', true, 'UTF-8', false);
			$pdf->SetTitle($this->session->userdata['org_name']. ' | Form A: Accreditation Application');
			$pdf->SetHeaderMargin(30);
			$pdf->SetTopMargin(20);
			$pdf->setFooterMargin(20);
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');

			$pdf->AddPage();

			$pdf->Write(5, 'Some sample text');
			$pdf->Output('My-File-Name.pdf', 'I'); 
		}
	}
?>