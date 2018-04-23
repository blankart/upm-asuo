<?php
	class SystemFunctions extends CI_Controller{

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
			else if($action == 'logout')
				$this->logOut();
			else if($action == 'checkLogin')
				$this->checkLogin();
			else
				show_404();

			
		}

		private function redirectToProfile(){
			if($this->session->userdata['account_type'] == 'student')
			 	redirect(base_url()."student/".$this->session->userdata['username']);
			
			if($this->session->userdata['account_type'] == 'org')
				redirect(base_url()."org/".$this->session->userdata['acronym']);
	 		
	 		if($this->session->userdata['account_type'] == 'admin')
	 			redirect(base_url()."admin/".$this->session->userdata['username']);
		}

		private function checkLogin(){
			$credentials = $this->input->post('credentials');

			if($credentials != NULL){
				$credentials['password'] = md5($credentials['password']);

				$this->load->model('SystemModel');
			    $result = $this->SystemModel->login($credentials);

			    if(!$result)
			    	redirect(base_url().'login');
			    else
			    	$this->setSessions($result);
			}
			else 
				show_404();
		}

		//Session variables
		// all: account type, logged_in
		// student: account_id, first_name, username, email
		// org: account id, acronym, email
		// admin:
		private function setSessions($data){

			if($data['account_type'] == 'admin'){
				$details = array(
					'account_type' => 'admin',
	       			'username'  => 'OSA',
	    			'logged_in' => TRUE,
	    			'admin_id' => $data['admin_id']
				);

				$this->session->set_userdata($details);
				redirect(base_url().'admin/'.$details['username']);
			}

			if($data['account_type'] == 'student'){
			   	$details = array(
			   		'account_type' => 'student',
		    		'first_name'  => $data['first_name'],
		   			'username'  => $data['username'],
		    		'email'     => $data['up_mail'],
		    		'logged_in' => TRUE
				);

				$this->session->set_userdata($details);
				redirect(base_url().'student/'.$data['username']);
			}
		}

		public function logOut(){
			$this->session->unset_userdata('logged_in');
			$this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}
	}
?>