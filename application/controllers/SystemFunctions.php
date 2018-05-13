<?php
	class SystemFunctions extends CI_Controller{

		public function perform($action = 'login', $type = '', $code = ''){
			

			 if($action == 'login' || $action == 'regstud' || $action == 'regorg'){
			 	if( isset($this->session->userdata['logged_in']) )
			 		$this->redirectToProfile();
				else{
					$this->load->view('header');
					$this->load->view(''.$action);
					$this->load->view('footer');
				}
			}

			else if($action == 'validate_org_email')
				$this->validate_org_email();
			else if($action == 'validate_org_acronym')
				$this->validate_org_acronym();
			else if($action == 'registerOrg')
				$this->registerOrg();

			else if($action == 'validateStudentUPMail')
				$this->validateStudentUPMail();
			else if($action == 'registerStudent')
				$this->registerStudent();

			else if($action == 'verify')
				$this->verify($type, $code);
			else if($action == 'sendVerificationMail')
				$this->sendVerificationMail();

			else if($action == 'checkLogin')
				$this->checkLogin();
			else if($action == 'logout')
				$this->logOut();
			else
				show_404();
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

		private function validate_org_email()
		{
			$org_email = $this->input->post('org_email');
			//$org_email = "thp@yahoo.com";
			if($org_email != NULL)
			{
				$this->load->model('SystemModel');
				$result = $this->SystemModel->validateOrgEmail($org_email);
				//var_dump($result);
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
			else
			{
				show_404();
			}

		}
		private function validate_org_acronym()
		{
			$org_acronym = $this->input->post('org_acronym');
			//$org_acronym = "upsocomsci";
			if($org_acronym != NULL)
			{
				$this->load->model('SystemModel');
				$result = $this->SystemModel->validateOrgAcronym($org_acronym);
				//var_dump($result);
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
			else
			{
				show_404();
			}			
		}

		private function registerOrg()
		{
			$result = $this->input->post('data');

			if($result != NULL){
			
				$account_data = array(
					'org_email' => $result['org_email'],
					'password' => md5($result['password']),
					'org_status' => 'Unaccredited',
					'isVerified' => 0,
					'isActivated'=> 0,
					'archived' => 0
				);

				$this->load->model('SystemModel');
				$org_id = $this->SystemModel->createOrgAccount($account_data);
				//insert profile details to db
				//var_dump($org_id);

				$profile_details = array(
					'org_id' => $org_id,
					'org_name' => $result['org_name'], 
					'acronym' => $result['acronym'], 
					'org_category' => $result['org_category'], 
					'org_college' => $result['org_college'],
					'description' => 'N/A', 
					'objectives' => 'N/A', 
					'org_website' => $result['org_website'], 
					'mailing_address' => $result['mailing_address'], 
					'date_established' => 'N/A', 
					'org_logo' => 'logo_default.jpg',
					'constitution' => 'No uploads yet',
					'incSEC' => 0,
					'sec_years' => 0
				);

				$org_session = $this->SystemModel->createOrgProfile($profile_details);
				$org_session['account_type'] = 'unverifiedOrg';
				$this->setSessions($org_session);
			}
			else
				show_404();
		}

		private function validateStudentUPMail(){
			$up_mail = $this->input->post('up_mail');

			if($up_mail != NULL){

				$this->load->model('SystemModel');
				$result = $this->SystemModel->validateStudentUPMail($up_mail);
				
				if($result)
					echo json_encode(true);
				else
					echo json_encode(false);
				
				exit();
			}
			else
				show_404();
		}

		private function registerStudent(){
			$result = $this->input->post('data');
			
			echo "<pre>";
			print_r($result);
			echo "</pre>";

			if($result != NULL){
				$username = str_replace('@up.edu.ph', '',  (strtolower($result['up_mail']) ) );
				
				$account_data = array(
					'up_mail' =>  ucwords(strtolower( $result['up_mail'] ) ),
					'up_id' => $result['up_id'],
					'username' => $username,
					'password' => md5 ($result['password']),
					'isVerified' => 0,
					'isActivated'=> 0,
					'archived' => 0
				);

			echo "<pre>";
			print_r($account_data);
			echo "</pre>";


				$this->load->model('SystemModel');
				$student_id = $this->SystemModel->createStudentAccount($account_data);

				if($result['sex'] == 'Female')
					$profile_pic = 'default_female.jpg';
				else
					$profile_pic = 'default_male.jpg';

				$profile_details = array(
					'student_id' => $student_id,
					'first_name' => ucwords(strtolower($result['first_name']) ), 
					'middle_name' => ucwords( strtolower($result['middle_name']) ), 
					'last_name' => ucwords ( strtolower($result['last_name']) ), 
					'sex' => $result['sex'],
					'birthday' => $result['birthday'],
					'course' => $result['course'],
					'year_level' => $result['year_level'], 
					'contact_num' =>  $result['contact_num'],
					'address' =>  ucwords( strtolower($result['address']) ),
					'profile_pic' => $profile_pic
				);

				$student_session = $this->SystemModel->createStudentProfile($profile_details);
				$student_session['account_type'] = 'unverifiedStudent';
				$this->setSessions($student_session);
			}
		//	else 
				//show_404();
		}
	
		private function checkLogin(){
			$credentials = $this->input->post('credentials');

			if($credentials != NULL)
			{
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
		// org: org_name, acronym, nsacronym, email
		// admin: username, admin_name
		private function setSessions($data){	

			$account_type = $data['account_type'];

			if($account_type == 'org' || $account_type == 'unverifiedOrg' || $account_type == 'unactivatedOrg' || $account_type == 'archivedOrg'){

				$nsacronym = str_replace(' ', '', $data['acronym']);
			   	$details = array(
			   		'account_type' => $account_type,
			   		'user_id' => $data['org_id'],
			   		'org_name' => $data['org_name'],
		    		'acronym' => $data['acronym'],
		    		'nsacronym' => $nsacronym,
		    		'email'     => $data['org_email'],
		    		'logged_in' => TRUE
				);

			    $this->session->set_userdata($details);
			    redirect(base_url().'org/'.$nsacronym);
			}

			if($account_type == 'student' || $account_type == 'unverifiedStudent' || $account_type == 'unactivatedStudent' || $account_type == 'archivedStudent'){

				$details = array(
			   		'account_type' => $account_type,
			   		'user_id' => $data['student_id'],
		    		'first_name'  => $data['first_name'],
		   			'username'  => $data['username'],
		    		'email'     => $data['up_mail'],
		    		'logged_in' => TRUE
				);

				$this->session->set_userdata($details);
				redirect(base_url().'student/'.$details['username']);
			}

			if($account_type == 'admin'){
				$details = array(
					'account_type' => 'admin',
					'user_id' => $data['admin_id'],
	       			'username'  => $data['username'],
	       			'admin_name'  => $data['admin_name'],
	    			'logged_in' => TRUE	    			
				);

				$this->session->set_userdata($details);
				redirect(base_url().'admin/'.$details['username']);
			}
		}

		private function logOut(){
			$this->session->unset_userdata('logged_in');
			$this->session->sess_destroy();
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}

		private function verify($type, $code){
			echo $type . " " .$code;
		}

		private function sendVerificationMail(){

			//set email library configuration
			$config = array(
				'useragent' => "CodeIgniter",
	        	'mailpath'  => "/usr/bin/sendmail",
				'protocol'  => 'smtp' , 
		        'smtp_host' => 'ssl://smtp.gmail.com' , 
		        'smtp_port' => 465 , 
		        'smtp_user' => 'asuodevelopers@gmail.com' ,
		        'smtp_pass' => 'cmsc128.1',
		        'mailtype'  => 'html', 
		        'charset'   => 'utf-8', 
		        'newline'   => "\r\n",  
		        'wordwrap'  => TRUE 
			);

		    //load email library
		  	$this->email->initialize($config);

		    $email = 'mjfernando@up.edu.ph'; //
		    $activation_code = 'This is my activation code';
		    $link = base_url().'verify/org/this';

		    $this->email->set_mailtype('html');
		    $this->email->from($email, 'ASUO Team');
		    $this->email->to('mjfernando@up.edu.ph');
		    $this->email->subject('Please verify your email address');

		    $message = '<html><body>';
		    $message .= '<p> Thanks for registering on ASUO! Please click the link below ' .$link. ' to verify your email address.</p>';
		    $message .= '<p>Thank you!</p>';
		    $message .= '<p>ASUO Administrator</p>';
		    $message .= '</body></html>';

		    $this->email->message($message);
		
			if ($this->email->send()){
			      $data['success'] = 'Yes';
			}
			else{
			    $data['success'] = 'No';
			    $data['error'] = $this->email->print_debugger(array('headers'));
			   }

			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}
	}
?>