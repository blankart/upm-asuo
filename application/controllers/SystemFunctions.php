<?php
	class SystemFunctions extends CI_Controller{

		public function perform($action = 'login', $type = '', $code = ''){
			

			 if($action == 'login' || $action == 'regstud' || $action == 'regorg' || $action == 'forgot'){
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
			else if($action == 'resendVerificationMail')
				$this->resendVerificationMail();

			else if($action == 'checkLogin')
				$this->checkLogin();
			else if($action == 'resetPassword')
				$this->resetPassword();
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
					'org_email' => strtolower ($result['org_email']),
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
					'org_name' => ucwords( strtolower ( $result['org_name'] )), 
					'acronym' => $result['acronym'], 
					'org_category' => $result['org_category'], 
					'org_college' => $result['org_college'],
					'description' => 'N/A', 
					'objectives' => 'N/A', 
					'org_website' =>  strtolower ($result['org_website']), 
					'mailing_address' => ucwords( strtolower ( $result['mailing_address'] )), 
					'date_established' => 'N/A', 
					'org_logo' => 'logo_default.jpg',
					'constitution' => 'No uploads yet',
					'incSEC' => 0,
					'sec_years' => 0
				);

				//send verification email
				$this->sendVerificationMail('org', $org_id, strtolower( $result['org_email'] ), false);

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
			
			if($result != NULL){

				//uploads form 5
				
				$file_name = md5('studentForm5');

				$config['upload_path'] = './assets/student/form_5/';
				$config['allowed_types'] = 'jpg';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '500';
				$config['file_name'] = $file_name;
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('form5')){
		            show_404();
	                $error = array('msg' => $this->upload->display_errors());
	                echo json_encode($error);
	                exit();
            	}
           		 else {
	            
	         		$username = str_replace('@up.edu.ph', '',  (strtolower($result['up_mail']) ) );
					
					$account_data = array(
						'up_mail' => strtolower( $result['up_mail'] ),
						'up_id' => $result['up_id'],
						'username' => $username,
						'password' => md5 ($result['password']),
						'isVerified' => 0,
						'isActivated'=> 0,
						'archived' => 0
					);

					$this->load->model('SystemModel');
					$student_id = $this->SystemModel->createStudentAccount($account_data);

					$file_name = md5('studentForm5'.$student_id);

					$config['upload_path'] = './assets/student/form_5/';
					$config['allowed_types'] = 'jpg';
					$config['overwrite'] = TRUE;
					$config['max_size'] = '500';
					$config['file_name'] = $file_name;
					$this->upload->initialize($config);

					$this->upload->do_upload('form5');

					if($result['sex'] == 'Female')
						$profile_pic = 'F9DD6FB6CEE7384F39E82CB89C3EDAD1.jpg';
					else
						$profile_pic = '99EFC599E37B8AEE206E208117F95277.jpg';

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

					$this->load->model('StudentModel');
					$this->StudentModel->uploadForm5($student_id, $file_name.".jpg"); 

					//send verification email
					$this->sendVerificationMail('student', $student_id, strtolower( $result['up_mail'] ), false);
					//$this->sendVerificationMail();

					$this->setSessions($student_session);
         			echo json_encode(true);
         			exit();
          		}			
			}
			else
				show_404();
		}
	
		private function checkLogin(){
			$credentials = $this->input->post('credentials');

			if($credentials != NULL)
			{
				//just follow the code in SystemModel/loginAdmin.

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
		    		'logged_in' => TRUE,
		    		'org_logo' => $data['org_logo']
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
		    		'logged_in' => TRUE,
		    		'profilepic' => $data['profile_pic']
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

			$this->load->model('SystemModel');

			//student
			if($type == 't'){
				$result = $this->SystemModel->verifyStudentAccount($code);

				if($result){
					//echo 'Successfully verified your account. try logging in';

					$this->load->view('header');
					$this->load->view('successfulverification');
					$this->load->view('footer');

				}
				else{
					$this->load->view('header');
					$this->load->view('unsuccessfulverification');
					$this->load->view('footer');

				}
			}

			//org
			if($type == 'g'){
				$result = $this->SystemModel->verifyOrgAccount($code);

				if($result){
					//echo 'Successfully verified your account. try logging in';

					$this->load->view('header');
					$this->load->view('successfulverification');
					$this->load->view('footer');

				}
				else{
					$this->load->view('header');
					$this->load->view('unsuccessfulverification');
					$this->load->view('footer');
				}
			}
		}

		private function resetPassword(){
			$email = $this->input->post('email');
			//$email = 'mrfernando@up.edu.ph';

			if($email != NULL){

				$random_string = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, rand(8,8));

				$password = md5($random_string);

				$this->load->model('SystemModel');
				$result = $this->SystemModel->updateNewPassword($email, $password);
				if($result){
					$result2 = $this->sendNewPasswordMail($email, $random_string);

					if($result2)
						echo json_encode(true);
					else
						echo json_encode(false);
				}
				else
					echo json_encode(false);
				

				exit();
			}
			else
				$this->load->view('forgot');

		}

		private function sendNewPasswordMail($email, $password){

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

			    $this->email->set_mailtype('html');
			    $this->email->from($email, 'ASUO Team');

			    $this->email->to($email);
			    $this->email->subject('Request for Account Password Reset');

			    $message = '<html><body>';
			    $message .= '<p>Your new password is now <b>' .$password. '</b>.</p>';
			    $message .= '<p>Thank you!</p>';
			    $message .= '<p>ASUO Administrator</p>';
			    $message .= '</body></html>';

			    $this->email->message($message);
			
				if ($this->email->send()){
				      $result['success'] = 'Yes';
				      return true;
				}
				else{
				    $result['success'] = 'No';
				    $result['error'] = $this->email->print_debugger(array('headers'));
				    return false;
				}
		}


		private function resendVerificationMail(){

			$source = $this->input->post('source');

			if($source == 'student'){

				$account_type = $this->session->userdata['account_type'];
				$user_id = $this->session->userdata['user_id'];

			
				$this->load->model('SystemModel');

				if($account_type == 'unverifiedStudent'){
					$account_type = 'student';
					$email_address  = $this->SystemModel->getStudentEmail($user_id);
				}

				if($account_type == 'unverifiedOrg'){
					$account_type = 'org';
					$email_address  = $this->SystemModel->getOrgEmail($user_id);
				}
		
				$this->sendVerificationMail($account_type, $user_id, $email_address, true);

			
				echo json_encode(true);
				exit();

			}
			else{
				echo json_encode(false);
				exit();
			}
		}

		//private function sendVerificationMail(){
		private function sendVerificationMail($account_type, $user_id, $email_address, $isResend){

			//$account_type = 'org';
			//$user_id = 10;
			//$verificaton_code = md5('orgVerification'.$user_id);

			//$email = 'mjfernando@up.edu.ph'; //input email
			//$link = base_url().'verify/g/'.$verificaton_code;

			$email = $email_address;
			$this->load->model('SystemModel');

			if( $isResend ){
				$code = $this->SystemModel->getVerificationCode($account_type, $user_id);
				$verificaton_code = md5($code);
				$id = $this->SystemModel->updateVerificationCode($account_type, $user_id, $verificaton_code);

				if($account_type == 'student')
		   			$link = base_url().'verify/t/'.$verificaton_code;
			   	if($account_type == 'org')
		   			$link = base_url().'verify/g/'.$verificaton_code;
			}
			
			else{

				if($account_type == 'student'){
			   		$verificaton_code = md5('studentVerification'.$user_id);
			   		$link = base_url().'verify/t/'.$verificaton_code;
		  	 	}
		   	
			   	if($account_type == 'org'){
			   		$verificaton_code = md5('orgVerification'.$user_id);
			   		$link = base_url().'verify/g/'.$verificaton_code;
				}

				$data['type'] = $account_type; 
				$data['user_id'] = $user_id;
				$data['code'] = $verificaton_code;
				$data['status'] = 'Pending';

				
				$id  = $this->SystemModel->createVerificationCode($data);
			}
			
			
			if($id){
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

			    $this->email->set_mailtype('html');
			    $this->email->from($email, 'ASUO Team');

			    $this->email->to($email);
			    $this->email->subject('Please verify your email address');

			    $message = '<html><body>';
			    $message .= '<p> Thanks for registering on ASUO!</p>';
			    $message .= '<p>Please click this link ' .$link. ' to verify your email address.</p>';
			    $message .= '<p>Thank you!</p>';
			    $message .= '<p>ASUO Administrator</p>';
			    $message .= '</body></html>';

			    $this->email->message($message);
			
				if ($this->email->send()){
				      $result['success'] = 'Yes';
				}
				else{
				    $result['success'] = 'No';
				    $result['error'] = $this->email->print_debugger(array('headers'));
				   }

				//echo "<pre>";
				//print_r($result);
				//echo "</pre>";
			}
			else
				echo 'There was a problem creating a verification code. Please try again later.';

		}
	}
?>