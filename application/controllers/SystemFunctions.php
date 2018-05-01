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
			else if($action == 'validate_org_email')
				$this->validate_org_email();
			else
				show_404();
		}

		private function redirectToProfile(){
			if($this->session->userdata['account_type'] == 'student')
			 	redirect(base_url()."student/".$this->session->userdata['username']);
			
			if($this->session->userdata['account_type'] == 'org')
				redirect(base_url()."org/".$this->session->userdata['nsacronym']);
	 		
	 		if($this->session->userdata['account_type'] == 'admin')
	 			redirect(base_url()."admin/".$this->session->userdata['username']);
		}

		private function validate_org_email()
		{
			$org_email = $this->input->post('org_email');
			
			if($org_email != NULL)
			{
				$this->load->model('SystemModel');
				$result = $this->SystemModel->validateOrgEmail($org_email);

				if($result)
				{
					echo json_encode(true);
				}
				else
				{
					echo json_encode(false);
				}
				exit();
			}

		}
		private function checkLogin(){
			$credentials = $this->input->post('credentials');

			if($credentials != NULL){
				$credentials['password'] = md5($credentials['password']);

				$this->load->model('SystemModel');
			    $result = $this->SystemModel->login($credentials);

			    if(!$result)
			    	redirect(base_url().'login'); //login Unsuccessful
			    else
			    	$this->setSessions($result);
			}
			else 
				show_404();
		}

		//Session variables
		// all: account type, logged_in, user_id
		// student: first_name, username, email
		// org: name, acronym, email
		// admin:
		private function setSessions($data){

			if($data['account_type'] == 'admin'){
				$details = array(
					'account_type' => 'admin',
					'user_id' => $data['admin_id'],
	       			'username'  => 'OSA',
	    			'logged_in' => TRUE	    			
				);

				$this->session->set_userdata($details);
				redirect(base_url().'admin/'.$details['username']);
			}

			if($data['account_type'] == 'org'){

				$nsacronym = str_replace(' ', '', $data['acronym']);
			   	$details = array(
			   		'account_type' => 'org',
			   		'user_id' => $data['org_id'],
			   		'org_name' => $data['org_name'],
		    		'acronym' => $data['acronym'],
		    		'nsacronym' => $nsacronym,
		    		'email'     => $data['org_mail'],
		    		'logged_in' => TRUE
				);

				$this->session->set_userdata($details);
				redirect(base_url().'org/'.$nsacronym);
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