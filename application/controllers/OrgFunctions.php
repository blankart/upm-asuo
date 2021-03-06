<?php
	class OrgFunctions extends CI_Controller{

		public function perform( $action = 'login'){

			if( !isset($this->session->userdata['logged_in']) )
				redirect(base_url().'login');
			else if($action == 'login' || $action == 'regstud' || $action == 'regorg')
			 		$this->redirecttToProfile();

			else if ($action == 'changeOrgPassword')
				$this->changeOrgPassword();
			else if ($action=='createPost')
				$this->createPost();
			else if ($action == 'editOrgProfile')
				$this->editOrgProfile();
			else if ($action == 'changeLogo')
				$this->changeLogo();
			else if ($action == 'uploadConstitution')
				$this->uploadConstitution();
			else if($action == 'uploadFormB')
				$this->uploadFormB();
			else if($action == 'uploadFormF')
				$this->uploadFormF();
			else if($action == 'uploadFormG')
				$this->uploadFormG();
			else if($action == 'uploadPlans')
				$this->uploadPlans();
			else if($action == 'uploadAll')
				$this->uploadAll();
			else if($action == 'applyToOrg')
				$this->applyToOrg();
			else if ($action == 'rejectMembership')
				$this->rejectMembership();
			else if ($action == 'approveMembership')
				$this->approveMembership();
			else if ($action == 'editMembershipPosition')
				$this->editMembershipPosition();
			else if ($action == 'removeMember')
				$this->removeMember();
					
			else if ($action == 'applyforaccreditation'){
				$this->loadAccreditationHome();
			}
			else if ($action == 'formA'){
				$this->loadFormA();
			}
			else if ($action == 'formB'){
				$this->loadFormB();
			}
			else if ($action == 'formC'){
				$this->loadFormC();
			}
			else if ($action == 'formD'){
				$this->loadFormD();
			}
			else if ($action == 'formE'){
				$this->loadFormE();
			}
			else if ($action == 'formF'){
				$this->loadFormF();
			}
			else if ($action == 'formG'){
				$this->loadFormG();
			}

			else if ($action == 'plans'){
				$this->loadPlans();
			}

			else if ($action == 'submitAll'){
				$this->loadSubmitAll();
			}

			else if ($action == 'saveFormA') {
				$this->saveFormA();
			}
			else if($action == 'viewFormA'){
					if(!isset($_SERVER['HTTP_REFERER'])){
					show_404();

					}
				else{
					$this->viewFormA("preview");
				}
			}
			else if($action == 'viewFormC'){
				if(!isset($_SERVER['HTTP_REFERER'])){
					show_404();

					}
					else{
						$this->viewFormC("preview");
					}
			}
			else if($action == 'viewFormD'){
					if(!isset($_SERVER['HTTP_REFERER'])){
						show_404();
					}
					else{
						$this->viewFormD("preview");
					}
			}
			else if($action == 'viewFormE'){
						if(!isset($_SERVER['HTTP_REFERER'])){
						show_404();
					}
					else{
						$this->viewFormE("preview");
					}
			}
			else{
				$account_type = $this->session->userdata['account_type'];

				if( $account_type == 'student' || $account_type == 'admin'){
					
					 $this->load->model('OrgModel');
					 $org_id = $this->OrgModel->getOrgId($action);
					 $isArchived = $this->OrgModel->isOrgArchived($org_id);
					 $isActivated = $this->OrgModel->isOrgActivated($org_id);
					 $isVerified = $this->OrgModel->isOrgVerified($org_id);

					if ( !$org_id || $isArchived || !$isVerified || ($account_type == 'student' && !$isActivated) ){
						$this->load->view('header'); 
						$this->load->view('errors/html/dne_org');
						if($account_type== 'admin'){
							$this->load->view('admin/changepassword');
						}
						if($account_type== 'student'){
							$this->load->view('student/search');
							$this->load->view('student/changepassword');
						}  
						$this->load->view('footer');
					}
					else{

						if ( $this->session->userdata['account_type'] == 'admin'){
							$data['isAdmin'] = true;
							$data['isOfficer'] = false;
					 		$data['isMember'] = false;
						 	$data['isApplicant'] = false;						 	
						}
						else{
						 	$student_id = $this->session->userdata['user_id'];
						 	$isOfficer = $this->OrgModel->isOfficer($org_id, $student_id);
						 	$isMember = $this->OrgModel->isMember($org_id, $student_id);
						 	$isApplicant = $this->OrgModel->isApplicant($org_id, $student_id);

							$data['isAdmin'] = false;
							$data['isOfficer'] = $isOfficer;
						 	$data['isMember'] = $isMember;
						 	$data['isApplicant'] = $isApplicant;
						}
						//echo "<pre>";
						//print_r($data);
						//echo "</pre>";
						$this->loadOrgProfileByOthers($org_id, $data, $account_type);		
					}
				}
				else if($action == $this->session->userdata['nsacronym']){
					if($account_type == 'org')		
						$this->loadOrgProfile();

					if($account_type == 'unverifiedOrg'){
						$data['org_email'] = $this->session->userdata['email'];

						$this->load->view('header'); 
						$this->load->view('errors/html/unverified', $data); 
						$this->load->view('footer');
					}					
			
					if($account_type == 'unactivatedOrg'){
						//echo 'You account is not yet activated. Procced to OSA.'; //load view here note: redirect
						$this->load->view('header'); 
						$this->load->view('errors/html/unactivated'); 
						$this->load->view('footer');
					}
				
					if($account_type == 'archivedOrg'){
						//echo 'You account is blocked. Procced to OSA.'; //load view here note: redirect

						$this->load->view('header'); 
						$this->load->view('errors/html/blocked'); 
						$this->load->view('footer');
					}
			 	}
				else
					redirect(base_url().'login');
			}
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

		private function loadOrgProfile(){
			$this->refreshAccreditationSession();
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
			$org_data['tally'] = $result ['tally'];
		
			$this->load->view('header');
			$this->load->view('org/org', $data);
			$this->load->view('footer');
			$this->load->view('org/applyforaccreditation');
			$this->load->view('org/createposts');
			$this->load->view('org/editprofile', $org_data);
			$this->load->view('org/changepassword');
		}

		private function loadOrgProfileByOthers($org_id, $data, $account_type){

			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgProfileDetailsByOthers($org_id);

			$result['isAdmin'] = $data['isAdmin'];
			$result['isOfficer'] = $data['isOfficer'];
			$result['isMember'] = $data['isMember'];
			$result['isApplicant'] = $data['isApplicant'];
			$result['org_id'] = $org_id;
			$this->load->view('header');
			$this->load->view('org/org', $result);
			
			if($account_type == 'student'){
				$this->load->view('student/search');	
				$this->load->view('student/changepassword');
			}
			if($account_type == 'admin')
				$this->load->view('admin/changepassword');
			$this->load->view('footer');

		}

		private function checkOrgPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('orgpassword');
		
			if($id != NULL && $password != NULL){
				$this->load->model('OrgModel');
				$result = $this->OrgModel->checkOrgPassword($id, $password);
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function changeOrgPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('neworgpassword');
		
			if($id != NULL && $password != NULL){
				$neworgpassword = password_hash($password, PASSWORD_BCRYPT);
				$this->load->model('OrgModel');
				$this->OrgModel->changeOrgPassword($id, $neworgpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function createPost(){

			$post = $this->input->post('post');

			if($post != NULL){
				$format = 'Y-m-d H:i:s';
				$post['date_posted'] = date($format);

				$this->load->model('OrgModel');
				$result = $this->OrgModel->createPost($post);

				if($result )
					echo json_encode(true);
				else
					echo json_encode(false);

				exit();
			}
			else
				show_404();
		}

		private function editOrgProfile(){
			$data = $this->input->post('data');
			$org_id = $this->input->post('org_id');
			$account_type = $this->session->userdata['account_type'];
		
			if($org_id != NULL && $data != NULL && $account_type == 'org'){
				$this->load->model('OrgModel');
				$this->OrgModel->editOrgProfile($org_id, $data);
				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function changeLogo(){

			$id = $this->session->userdata['user_id'];
			$file_name = md5('orgLogo'.$id);

			$config['upload_path'] = './assets/org/logo/';
			$config['allowed_types'] = 'jpg';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '500';
			$config['file_name'] = $file_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('logo')){
	            show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {
                $this->load->model('OrgModel');
				$this->OrgModel->changeLogo($id, $file_name.".jpg");  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }
		}

		private function uploadConstitution(){
			$id = $this->session->userdata['user_id'];
			$file_name = md5('orgConstitution'.$id);

			$config['upload_path'] = './assets/org/constitution/';
			$config['allowed_types'] = 'pdf';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '1000';
			$config['file_name'] = $file_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('constitution')){
		        show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {                
                $this->load->model('OrgModel');
				$this->OrgModel->uploadConstitution($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }
		}

		private function uploadFormB(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$this->load->model('OrgModel');
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formB'.$id.'_'.$AY_id);

			$config['upload_path'] = './assets/org/accreditation/form_b';
			$config['allowed_types'] = 'pdf';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '2048';
			$config['file_name'] = $file_name.'.pdf';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('formB')){
		        show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {                
				$this->OrgModel->uploadFormB($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }	
		}

		private function uploadFormF(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$this->load->model('OrgModel');
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formF'.$id.'_'.$AY_id);

			$config['upload_path'] = './assets/org/accreditation/form_f';
			$config['allowed_types'] = 'pdf';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '2048';
			$config['file_name'] = $file_name.'.pdf';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('formF')){//filename sa previous code
		        show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {                
                $this->load->model('OrgModel');
				$this->OrgModel->uploadFormF($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }	
		}

		private function uploadFormG()
		{
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$this->load->model('OrgModel');
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formG'.$id.'_'.$AY_id);

			$config['upload_path'] = './assets/org/accreditation/form_g';
			$config['allowed_types'] = 'pdf';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '2048';
			$config['file_name'] = $file_name.'.pdf';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('formG')){
		        show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {                
				$this->OrgModel->uploadFormG($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }	
		}

		private function uploadPlans()
		{	
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$this->load->model('OrgModel');
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('plans'.$id.'_'.$AY_id);

			$config['upload_path'] = './assets/org/accreditation/plans';
			$config['allowed_types'] = 'pdf';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '2048';
			$config['file_name'] = $file_name.'.pdf';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('plans')){
		        show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {                
                $this->load->model('OrgModel');
				$this->OrgModel->uploadPlans($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }	
		}

		private function uploadAll()
		{
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$data = $this->input->post('source');
			$org_id = $this->session->userdata['user_id'];	
			if($data == 'org')
			{
				$this->viewFormC('save');
				$this->viewFormD('save');
				$this->viewFormE('save');
				$this->load->model('OrgModel');
				$result = $this->OrgModel->submitApplication($org_id);

				echo json_encode($result);
				exit(); 

			}
			else
				show_404();

			
		}

		private function applyToOrg()
		{

			$source = $this->input->post('org_id');			
			$org_id = $source;
			//$org_id = 6;
			if($org_id != NULL)
			{
				$student_id = $this->session->userdata['user_id'];
				$this->load->model('OrgModel');
				$this->OrgModel->applyToOrganization($student_id,$org_id);
				//var_dump($result);
				echo json_encode($org_id);
				exit(); 
			}
			else
			{
				show_404();
			}
		}

		private function rejectMembership(){

			$reason = $this->input->post('reason');
			$student_id = $this->input->post('student_id');
			$account_type = $this->session->userdata['account_type'];

			if($student_id != NULL && $account_type == 'org'){

				$org_id = $this->session->userdata['user_id'];

				$this->load->model('OrgModel');
				$this->OrgModel->rejectMembership($org_id, $student_id);

				$org_name = $this->OrgModel->getOrgName($org_id);
                $up_mail = $this->OrgModel->getStudentUPMail($student_id);
                $this->sendNotification('Organization Membership Rejected', $org_name, $up_mail, $reason);


				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function approveMembership(){

			$student_id = $this->input->post('student_id');
			$account_type = $this->session->userdata['account_type'];

			if($student_id != NULL && $account_type == 'org'){

				$org_id = $this->session->userdata['user_id'];

				$this->load->model('OrgModel');
				$this->OrgModel->approveMembership($org_id, $student_id);

				$org_name = $this->OrgModel->getOrgName($org_id);
                $up_mail = $this->OrgModel->getStudentUPMail($student_id);
                $this->sendNotification('Organization Membership Approved', $org_name, $up_mail, 'None');


				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function editMembershipPosition(){

			$student_id = $this->input->post('student_id');
			$position = $this->input->post('position');
			$account_type = $this->session->userdata['account_type'];

			if($student_id != NULL && $position != NULL && $account_type == 'org'){

				$org_id = $this->session->userdata['user_id'];

				$this->load->model('OrgModel');
				$this->OrgModel->editMembershipPosition($org_id, $student_id, $position);

				$org_name = $this->OrgModel->getOrgName($org_id);
				$up_mail = $this->OrgModel->getStudentUPMail($student_id);
				$this->sendNotification('Change in Membership Position', $org_name, $up_mail, $position);

				echo json_encode($position);
				exit();
			}
			else
				show_404();
		}

		private function removeMember(){

			$student_id = $this->input->post('student_id');
			$reason = $this->input->post('reason');
			$account_type = $this->session->userdata['account_type'];

			if($student_id != NULL && $reason != NULL && $account_type == 'org'){

				$org_id = $this->session->userdata['user_id'];

				$this->load->model('OrgModel');
				$this->OrgModel->removeMember($org_id, $student_id, $reason);

				$org_name = $this->OrgModel->getOrgName($org_id);
				$up_mail = $this->OrgModel->getStudentUPMail($student_id);
				$this->sendNotification('Membership Removal', $org_name, $up_mail, $reason);

				echo json_encode($org_name.' '.$up_mail);
				exit();
			}
			else
				show_404();
		}

		private function sendNotification($type, $org_name, $up_mail, $other_info){

			if($type == 'Membership Removal'){
                $reason = $other_info;
                $message = '<html><body>';
                $message .= '<p> Notification from ASUO:</p>';
                $message .= '<p>Your membership from '. $org_name.' has been removed.</p>';
                $message .= "<p>The reason indicated was '".$reason."'.</p>";
			    $message .= '<p>For more details, please communicate with your organization.</p>';
			    $message .= '<p>ASUO Administrator</p>';
			    $message .= '</body></html>';
            }

            if($type == 'Change in Membership Position'){
                $position = $other_info;
                $message = '<html><body>';
                $message .= '<p> Notification from ASUO:</p>';
                $message .= '<p>Your membership position in '. $org_name.' has been changed.</p>';
                $message .= "<p>Your new position is now '".$position."'.</p>";
                $message .= '<p>For more details, please communicate with your organization.</p>';
                $message .= '<p>ASUO Administrator</p>';
                $message .= '</body></html>';
             }

            if($type == 'Organization Membership Approved'){
                $message = '<html><body>';
                $message .= '<p> Notification from ASUO:</p>';
                $message .= '<p>Your organization membership application in '. $org_name.' has been approved.</p>';
                $message .= '<p>For more details, please contact ' .$org_name. '.</p>';
                $message .= '<p>ASUO Administrator</p>';
                $message .= '</body></html>';
             }

             if($type == 'Organization Membership Rejected'){
				$reason = $other_info;
                $message = '<html><body>';
                $message .= '<p> Notification from ASUO:</p>';
				$message .= '<p>Your organization membership application in '. $org_name.' has been rejected.</p>';
				$message .= "<p>The reason indicated was '".$reason."'.</p>";
                $message .= '<p>For more details, please contact ' .$org_name. '.</p>';
                $message .= '<p>ASUO Administrator</p>';
                $message .= '</body></html>';
             }

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
			    $this->email->from($up_mail, 'ASUO Team');

			    $this->email->to($up_mail);
			    $this->email->subject($type);

			    $this->email->message($message);
			
				if ($this->email->send()){
				      $result['success'] = 'Yes';
				}
				else{
				    $result['success'] = 'No';
				    $result['error'] = $this->email->print_debugger(array('headers'));
				   }
		}


//-------------------------------FORMS FOR ACCREDITATION---------------------------------------


		private function refreshAccreditationSession(){
			$this->load->model('SystemModel');
			$period = $this->SystemModel->getAccreditationPeriod();

			$format = 'Y-m-d H:i:s';

			if($period != false){
				$today = date($format);
				$start = date( $period['start_date'] );
				$end = date( $period['end_date'] );

				if( $today > $start && $today < $end )
					$this->session->userdata['open_accreditation'] = true;
				else{
					$this->session->userdata['open_accreditation'] = false;
					$this->SystemModel->closeAccreditation();
				}
			}
			else
				$this->session->userdata['open_accreditation'] = false;
		}

		//saving data from form a accreditation
		private function saveFormA()
		{
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');
			 
			$form_details = $this->input->post('data');
			$org_id = $this->session->userdata['user_id']; 
			//var_dump("org id ".$org_id);
			$this->load->model('OrgModel');
			$temp = $this->OrgModel->insertFormAdetails($form_details,$org_id);
			//INSERT INTO DB
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formA'.$id.'_'.$AY_id);

			$this->OrgModel->uploadFormA($id, $file_name);
			$this->viewFormA("save");
			//var_dump($temp);
			redirect(base_url().'org/formB');
		}

		private function loadAccreditationHome(){

			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);

			$period = $this->OrgModel->getAccreditationPeriod();
			
			if($period != false)
				$org_data['end_date'] = $period['end_date'];
			else
				$org_data['end_date'] = false;
		
			//var_dump($org_data);
			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/applyforaccreditation', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}

		private function loadFormA()
		{	
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$result = $this->OrgModel->input_formA_details($org_id);
			$org_data = $this->OrgModel->getOrgDetails($org_id);
			//var_dump($data);
			
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$result['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);

			$result['org_name'] = $org_data['org_name'];
			$result['org_category'] = $org_data['org_category'];
			$result['description'] = $org_data['description'];
			$result['objectives'] = $org_data['objectives'];
			$result['org_status'] = $org_data['org_status'];
			//var_dump($result);
			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formA', $result);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}
		
		private function loadFormB(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetailsForm($org_id);
			$org_data = $this->OrgModel->getOrgDetails($org_id);
			
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);


			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formB', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}
		private function loadFormC(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetailsForm($org_id);
			$org_data = $this->OrgModel->getOrgDetails($org_id);
		
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);

			$org_data['tally'] = $this->OrgModel->getOrgTally($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formC', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}

		private function loadFormD(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');

			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);		

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formD', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}

		private function loadFormE(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetailsForm($org_id);

			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);		

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formE', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}

		private function loadFormF(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');

			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_accred_status = $this->OrgModel->getOrgStatus($org_id, $AY_id);		

			if($org_accred_status == 'old'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formF');
				$this->load->view('org/changepassword');
				$this->load->view('footer');
			}
			else
				redirect(base_url().'login');
		}

		private function loadFormG(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_accred_status = $this->OrgModel->getOrgStatus($org_id, $AY_id);

			if($org_accred_status == 'old'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formG');
				$this->load->view('org/changepassword');
				$this->load->view('footer');
			}
			else
				redirect(base_url().'login');
		}

		private function loadPlans(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');

			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$org_data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);			

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/plans', $org_data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');
		}

		function loadSubmitAll(){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');

			$data = $this->OrgModel->getForms($org_id);
			
			$AY_id = $this->OrgModel->getAcademicYear();
			$this->OrgModel->initAccred($org_id, $AY_id);
			$data['org_accred_status'] = $this->OrgModel->getOrgStatus($org_id, $AY_id);		

			//var_dump($data);
			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/submitAll', $data);
			$this->load->view('org/changepassword');
			$this->load->view('footer');			
		}


		private function viewFormA($type)
		{
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

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

			
			// set font
			$pdf->SetFont('Helvetica', '', 12);
			$pdf->AddPage();

			$org_id = $this->session->userdata['user_id'];
			$this->load->model('OrgModel');

			$result = $this->OrgModel->getFormAdetails($org_id);
			//var_dump($result);
			$addtlresult = $this->OrgModel->getDBformA($org_id);
			//var_dump($addtlresult);
			// add a page
			$tally = $result['tally']['male_first'] + $result['tally']['female_first'] +$result['tally']['male_second'] +$result['tally']['female_second'] +$result['tally']['male_third'] +$result['tally']['female_third'] +$result['tally']['male_fourth'] +$result['tally']['female_fourth'] +$result['tally']['male_masteral'] +$result['tally']['female_masteral'] +$result['tally']['male_doctoral'] +$result['tally']['female_doctoral'];
			////$pdf->AddPage();
			//var_dump($tally);

			//$name = 'UP Society of Computer Scientists';
			// WALA PANG POSITION/DESIGNATION

			$html= '<p align="right"><b>Date filed:</b>'.Date('M d, Y').'</p><br><br>
			<b>Organization Name:</b> '.$result['org_name'].'<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New ['; if($result['formA']['stay']=="new") $html.="X"; else $html.="&nbsp;"; $html.=']&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Old ['; if($result['formA']['stay']=="old") $html.="X"; else $html.="&nbsp;"; $html.=']'. ' ' .$result['formA']['experience'].' years in existence<br><br>
			<b>Number of members:</b>'.$tally.'<br><br>	
			<b>Category:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Academic") $html.="X"; else $html.="&nbsp;"; $html.='] Academic&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Cause-oriented") $html.="X"; else $html.="&nbsp;"; $html.='] Cause-oriented&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Cultural") $html.="X"; else $html.="&nbsp;"; $html.='] Cultural<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Fraternity") $html.="X"; else $html.="&nbsp;"; $html.='] Fraternity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Sorority") $html.="X"; else $html.="&nbsp;"; $html.='] Sorority&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Socio-Civic") $html.="X"; else $html.="&nbsp;"; $html.='] Socio-Civic<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ &nbsp;] Sports/Recreation&nbsp;&nbsp;['; if($result['org_category']=="Special Interest") $html.="X"; else $html.="&nbsp;"; $html.='] Special Interest&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['; if($result['org_category']=="Service") $html.="X"; else $html.="&nbsp;"; $html.='] Service<br><br>
			<b>Adviser:</b> '.$result['formA']['adviser'].'<br><br>
			<b>Position/Designation:</b> '.$result['formA']['adviser_position'].'&nbsp;&nbsp;&nbsp;&nbsp;
			<b>College/Unit: </b> '.$result['formA']['adviser_college'].'<br><br>
			<b>Contact Person:</b> '.$result['formA']['contact_person'].'<br><br>
			<b>Position in the Organization</b> '.$result['formA']['contact_position'].'
			<br><br>
			<b>Address:</b> '.$result['formA']['contact_address'].'<br><br>
            <b>Telephone no.:</b> '.$result['formA']['contact_tel'].'&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Mobile no.:</b> '.$result['formA']['contact_mobile'].'
			<br><br>
			<b>Email:</b>'.$result['formA']['contact_email'].'&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Other contact details:</b> '.$result['formA']['contact_other_details'].'
			<br><br>
			<b>Objectives of Organization:</b> '.$result['objectives'].'
			<br><br>
			<b>Brief description of Organization:</b> '.$result['description'].'
			<br>
			<br>
			<br>
			';
			//var_dump($html);
			$pdf->writeHTML($html, true, 0, true, 0);

			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formA'.$id.'_'.$AY_id);
         	//$filelocation = "C:\\xampp\\htdocs\\ASUO\\assets\\org\\accreditation\\form_D";//windows
        	//$fileNL = $filelocation."\\".$file_name;//Windows

        	$varArray = explode("/", $_SERVER['DOCUMENT_ROOT']);
       		$temp = "ASUO\\assets\\org\\accreditation\\form_A\\";
       		$base_directory = implode("\\", $varArray).$temp;
       		


       		if($type == 'preview')
       		{
       			$pdf->Output($base_directory.$file_name.".pdf",'I');
       		}
       		else
       		{
       			if($type == 'save')
       			{
       				$pdf->Output($base_directory.$file_name.".pdf",'F');
       			}
       		}


		}
		
		private function viewFormC($type){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('Form C');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form C: Organization Profile", PDF_HEADER_STRING);
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

			$pdf->addPage();
			
			$org_id = $this->session->userdata['user_id'];
			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgDetails($org_id);	

			$tally = $this->OrgModel->getOrgTally($org_id);

			$html= '
			<p align="right"><b>Date filed:</b>'.date("M d, Y").'</p><br>
			<p align="center"><h3><b>ORGANIZATION PROFILE</b></h3></p>
			<br><br><br>
			<b>Name of Organization: </b>'.$result['org_name'].'<br><br>
			<b>Acronym: </b>'.$result['acronym'].'<br><br>
			<b>Mailing Address: </b>'.$result['mailing_address'].'<br><br>
			<b>E-mail Address:   </b>'.$result['org_email'].'<br><br>
			<b>Website:</b>  http://www.'.$result['org_website'].'
			<br><br>
			<b>Date Established: </b>'.$result['date_established'].'
			<br><br>
			<b>Total Number of Members: </b>'.array_sum($tally).'
			<br><br><br>
			';	

			$tally = $this->OrgModel->getOrgTally($org_id);
			$tbl='<br><table cellspacing="0" cellpadding="1" border="1">
 			   <tr>
        		<td colspan="17"><b><br><p align="center">MEMBERSHIP DISTRIBUTION</p></b><br><p align="center">As of '.date("Y").' - '.(date("Y")+1).'</p></td>
   			   </tr>
   				
   			<tr>
    	<td  colspan="2"></td>
        <td>First Year</td>
        <td colspan="2">Second Year</td>
        <td>Third Year</td>
        <td  colspan="2">Fourth Year</td>
        <td>Fifth Year</td>
        <td>Sixth Year</td>
        <td  colspan="2">Seventh Year</td>
        <td  colspan="2">Masteral Students</td>
        <td  colspan="2">Doctoral Students</td>
        <td>Total</td>
		    </tr>
		    <tr>
		       	<td  colspan="2">Male</td>
			   	<td>'.$tally['male_first'].'</td>    
				<td colspan="2">'.$tally['male_second'].'</td>
				<td>'.$tally['male_third'].'</td>  
				<td colspan="2">'.$tally['male_fourth'].'</td>
				<td>'.$tally['male_fifth'].'</td>
				<td>'.$tally['male_sixth'].'</td>
				<td colspan="2">'.$tally['male_seventh'].'</td>
				<td colspan="2">'.$tally['male_masteral'].'</td>
				<td colspan="2">'.$tally['male_doctoral'].'</td>   	 
				<td>'.($tally['male_first']+$tally['male_second']+$tally['male_third']+$tally['male_fourth']+$tally['male_fifth']+$tally['male_sixth']+$tally['male_seventh']+$tally['male_masteral']+$tally['male_doctoral']).'</td>     
		    </tr>
		    <tr>
		    	<td colspan="2">Female</td>
			   	<td>'.$tally['female_first'].'</td>    
				<td colspan="2">'.$tally['female_second'].'</td>
				<td>'.$tally['female_third'].'</td>  
				<td colspan="2">'.$tally['female_fourth'].'</td>
				<td>'.$tally['female_fifth'].'</td>
				<td>'.$tally['female_sixth'].'</td>
				<td colspan="2">'.$tally['female_seventh'].'</td>
				<td colspan="2">'.$tally['female_masteral'].'</td>
				<td colspan="2">'.$tally['female_doctoral'].'</td>   	 
				<td>'.($tally['female_first']+$tally['female_second']+$tally['female_third']+$tally['female_fourth']+$tally['female_fifth']+$tally['female_sixth']+$tally['female_seventh']+$tally['female_masteral']+$tally['female_doctoral']).'</td>     
		    </tr>
		    <tr>
		    	<td  colspan="2">Total</td>
		       <td>'.($tally['male_first']+$tally['female_first']).'</td>
		       <td colspan="2">'.($tally['male_second']+$tally['female_second']).'</td>
		       <td>'.($tally['male_third']+$tally['female_third']).'</td>
		       <td colspan="2">'.($tally['male_fourth']+$tally['female_fourth']).'</td>
		       <td>'.($tally['male_fifth']+$tally['female_fifth']).'</td>
		       <td>'.($tally['male_sixth']+$tally['female_sixth']).'</td>
		       <td colspan="2">'.($tally['male_seventh']+$tally['female_seventh']).'</td>
		       <td colspan="2">'.($tally['male_masteral']+$tally['female_masteral']).'</td>
		       <td colspan="2">'.($tally['male_doctoral']+$tally['female_doctoral']).'</td>
		       <td>'.array_sum($tally).'</td>
		    </tr>

			</table>

			<br><br>	
		 	';
		 	$ans= ($result['incSEC']==1 ? 'Yes' : 'No');
		 	$year = ($result['incSEC']==1 ? $result['sec_years']: ' ') ; 
		 	$text2='
				<b>Is your organization incorporated with the Securities and Exchange Commission (SEC)? If yes, when? </b>'.$ans.', for '.$year.' years.
				<br>

			';

			$text3 = '<b>Is your organization incorporated with the Securities and Exchange Commission (SEC)? If yes, when?</b>'.$ans.'
				<br>';
			$line = ($result['incSEC']== 1 ? $text2 : $text3);			
		 


			$pdf->writeHTML($html, true, 0, true, 0);
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($line, true, 0, true, 0);

			//$pdf->Output('formc.pdf', 'I');
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formC'.$id.'_'.$AY_id);
         	$filelocation = "C:\\xampp\\htdocs\\ASUO\\assets\\org\\accreditation\\form_C";//windows
        	$fileNL = $filelocation."\\".$file_name;//Windows

        	$varArray = explode("/", $_SERVER['DOCUMENT_ROOT']);
       		$temp = "ASUO\\assets\\org\\accreditation\\form_C\\";
       		$base_directory = implode("\\", $varArray).$temp;

       		//INSERT INTO DB
       		$this->load->model('OrgModel');
			$this->OrgModel->uploadFormC($id, $file_name);

       		if($type == 'preview')
       		{
       			$pdf->Output($base_directory.$file_name.".pdf",'I');
       		}
       		else
       		{
       			if($type == 'save')
       			{
       				$pdf->Output($base_directory.$file_name.".pdf",'F');
       			}
       		}
			
		}

		private function viewFormD($type){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');


			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('Form D');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form D: Officers' Profile", PDF_HEADER_STRING);

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
			$org_id = $this->session->userdata['user_id'];
			// set font
			$pdf->SetFont('Helvetica', '', 12);
			//$pdf->AddPage();
			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgOfficer($org_id);	
			//var_dump($result);
			$temp = "";
			for($i=0;$i<sizeof($result);$i++)
			{
					if(($i % 3) == 0 || $i == 0)
				{
					$pdf->AddPage();
					$year = date("Y");
					$temp = '<br><p align="right"><b><u>'.$result[$i]['org_name'].'</u></b><br>
					<b>Name of Organization</b></p><br>
					<h3 align="center"><b>LIST OF OFFICERS</b></h3>

					<h4 align="center">AY '.$year.' - '.($year+1).'</h4>';
				}

				$samplehtml = $temp.' 
			<table>
  			<tr>
   	 			<td colspan = "2"><b>Name:</b> '.$result[$i]['first_name'].' '.$result[$i]['middle_name'].' '.$result[$i]['last_name'].'</td>
   	 			<td> </td>
   	 			<td> </td>
    			<td rowspan="5"><img src="'.base_url().'/assets/student/profile_pic/'.$result[$i]['profile_pic'].'" width="80" height="80" align="right"></td>
  			</tr>
  			<tr>
    			<td colspan = "2"><b>Position:</b> '.$result[$i]['position'].'</td>
    			<td colspan="2.5"><b>Year/Course:</b> '.$result[$i]['year_level'].' '.$result[$i]['course'].'</td>
  			</tr>
  			<tr>
    			<td colspan="3"><b>Address:</b> '.$result[$i]['address'].'</td>
  			</tr>
  			<tr>
    			<td colspan="2"><b>Phone:</b> '.$result[$i]['contact_num'].'</td>
    			<td colspan="3"><b>Email:</b> '.$result[$i]['up_mail'].'</td>
  			</tr>
  			<tr>
    			<td colspan = "4"><b>Other Contact Details:</b> </td>
  			</tr>
		</table> 
				';
				$temp = "";
				$pdf->writeHTML($samplehtml, true, 0, true, 0);
			}
			
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formD'.$id.'_'.$AY_id);
         	//$filelocation = "C:\\xampp\\htdocs\\ASUO\\assets\\org\\accreditation\\form_D";//windows
        	//$fileNL = $filelocation."\\".$file_name;//Windows

        	$varArray = explode("/", $_SERVER['DOCUMENT_ROOT']);
       		$temp = "ASUO\\assets\\org\\accreditation\\form_D\\";
       		$base_directory = implode("\\", $varArray).$temp;
       		
       		//INSERT INTO DB
       		$this->load->model('OrgModel');
			$this->OrgModel->uploadFormD($id, $file_name);

       		if($type == 'preview')
       		{
       			$pdf->Output($base_directory.$file_name.".pdf",'I');
       		}
       		else
       		{
       			if($type == 'save')
       			{
       				$pdf->Output($base_directory.$file_name.".pdf",'F');
       			}
       		}
			//$pdf->Output('example_003.pdf', 'I');


		}

		public function viewFormE($type){
			$this->refreshAccreditationSession();
			if(!$this->session->userdata['open_accreditation'])
				redirect(base_url().'login');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('Form E');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form E: Members' Profile", PDF_HEADER_STRING);

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
			$org_id = $this->session->userdata['user_id'];
			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgMembers($org_id);	
			//var_dump($result);
			$temp = "";
			$samplehtml = "";
			// add a page
			for($i=0;$i<sizeof($result);$i++)
			{

				if($i % 2 == 0 || $i == 0)
				{
					$pdf->AddPage();
					$year = date("Y");
					$temp = '<br><p align="right"><b><u>'.$result[$i]['org_name'].'</u></b><br>
					<b>Name of Organization</b></p><br>
					<h3 align="center"><b>LIST OF MEMBERS</b></h3>
					<h5 align="center">AY '.$year.' - '.($year+1).'</h5>';
				}
				$samplehtml = $temp.'
			<br><br><br><br><br><br><br><br><br>
			<table>
  			<tr>
   	 			<td><b>Name:</b></td>
   	 			<td colspan = "2" style ="">'.$result[$i]['first_name'].' '.$result[$i]['middle_name'].' '.$result[$i]['last_name'].'</td>
   	 			<td> </td>
    			<td rowspan="5"><img src="'.base_url().'assets/student/profile_pic/'.$result[$i]['profile_pic'].'" width="80" height="100" align="right"></td>
  			</tr>
  			<tr>
    			<td><b>Year:</b> '.$result[$i]['year_level'].'</td>
    			<td colspan = "3"><b>Course:</b>'.$result[$i]['course'].'</td>
  			</tr>
  			<tr>
    			<td colspan="3"><b>Address:</b> '.$result[$i]['address'].'</td>
  			</tr>
  			<tr>
    			<td colspan="2"><b>Phone:</b> '.$result[$i]['contact_num'].'</td>
    			<td colspan="2"><b>Email:</b> '.$result[$i]['up_mail'].'</td>
  			</tr>
  			<tr>
  			<br> 
  				<td colspan="5" rowspan="5"><img src="'.base_url().'assets/student/form_5/'.$result[$i]['form5'].'" width="350" height="180" align="center"></td>
  				<td colspan="5" rowspan="5"> Form5</td>
  			</tr>
		</table> 
		';
				$temp = "";
			//	
				$pdf->writeHTML($samplehtml, true, 0, true, 0);
			}
		
			
			//var_dump($samplehtml);
			$id = $this->session->userdata['user_id'];
			$AY_id = $this->OrgModel->getAcademicYear();
			$file_name = md5('formE'.$id.'_'.$AY_id);
         	//$filelocation = "C:\\xampp\\htdocs\\ASUO\\assets\\org\\accreditation\\form_D";//windows
        	//$fileNL = $filelocation."\\".$file_name;//Windows

        	$varArray = explode("/", $_SERVER['DOCUMENT_ROOT']);
       		$temp = "ASUO\\assets\\org\\accreditation\\form_E\\";
       		$base_directory = implode("\\", $varArray).$temp;
       		
       		//INSERT INTO DB
       		$this->load->model('OrgModel');
			$this->OrgModel->uploadFormE($id, $file_name);

       		if($type == 'preview')
       		{
       			$pdf->Output($base_directory.$file_name.".pdf",'I');
       		}
       		else
       		{
       			if($type == 'save')
       			{
       				$pdf->Output($base_directory.$file_name.".pdf",'F');
       			}
       		}		
		}
	}
?>