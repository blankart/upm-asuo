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
			else if($action == 'checkStudentPassword')
				$this->checkStudentPassword();
			else if($action == 'changeStudentPassword')
				$this->changeStudentPassword();
			else
				if($this->session->userdata['account_type'] == 'student'){
					if($action  == $this->session->userdata['username'])
						$this->loadStudentProfile();
					else
			 			 show_404(); //pwede din customizedpage
				}
				else if($this->session->userdata['account_type'] == 'unverifiedStudent'){
					echo  'verify your email using ' .$this->session->userdata['email']. "."; //load view here note: redirect
				}
				else if($this->session->userdata['account_type'] == 'unactivatedStudent'){
					echo 'You account is not yet activated. Procced to OSA.'; //load view here note: redirect
				}
				else if($this->session->userdata['account_type'] == 'archivedStudent'){
					echo 'You account is blocked. Procced to OSA.'; //load view here note: redirect
				}
				else
					redirect(base_url().'login');
		}

		private function redirectToProfile(){
			$account_type = $this->session->userdata['account_type'];
			
			if($account_type == 'student' || $account_type == 'unverifiedStudent' || $account_type == 'unactivatedStudent' || $account_type == 'archivedStudent' )
			 	redirect(base_url()."student/".$this->session->userdata['username']);
			
			if($account_type == 'org' || $account_type == 'unverifiedOrg' || $account_type == 'unactivatedOrg' || $account_type == 'archivedOrg' )
				redirect(base_url()."org/".$this->session->userdata['nsacronym']);
	 		
	 		if($account_type == 'admin')
	 			redirect(base_url()."admin/".$this->session->userdata['username']);
		}

		private function loadStudentProfile(){
			$this->load->view('header');
			$this->load->view('student/student.php');
			$this->load->view('footer');
			$this->load->view('student/changepassword');
		}

		private function checkStudentPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('studentpassword');
		
			if($id != NULL && $password != NULL){
				$studentpassword = md5($password);
				$this->load->model('StudentModel');
				$result = $this->StudentModel->checkStudentPassword($id, $studentpassword);
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function changeStudentPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('newstudentpassword');
		
			if($id != NULL && $password != NULL){
				$newstudentpassword = md5 ($password);
				$this->load->model('StudentModel');
				$this->StudentModel->changeStudentPassword($id, $newstudentpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}
	}			
?>