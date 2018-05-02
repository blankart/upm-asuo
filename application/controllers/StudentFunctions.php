<?php
	class StudentFunctions extends CI_Controller{

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
			else if($action == 'change_password')
				$this->load->view('changepassword');
			else
				if($this->session->userdata['account_type'] == 'student')
					if($action  == $this->session->userdata['username'])
						$this->loadStudentProfile();
					else
			 			 show_404(); //pwede din customizedpage
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

		private function loadStudentProfile(){
			$this->load->view('header');
			$this->load->view('student/student.php');
			$this->load->view('footer');
		}
	}			
?>