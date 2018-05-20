<?php
	class OrgFunctions extends CI_Controller{

		public function perform( $action = 'login'){

			if( !isset($this->session->userdata['logged_in']) )
				redirect(base_url().'login');
			else if($action == 'login' || $action == 'regstud' || $action == 'regorg')
			 		$this->redirectToProfile();

			else if ($action == 'checkOrgPassword')
				$this->checkOrgPassword();
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

				//lalagay tong mga to sa private function pagkakuha ng details
				$this->generateFormA();
				//$this->loadFormA();

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

			else if ($action == 'saveFormA') {
				$this->saveFormA();
			}
			else if($action == 'viewFormA'){
				$this->viewFormA();
			}
			else if($action == 'viewFormC'){
				$this->viewFormC();
			}
			else if($action == 'viewFormD'){
				$this->viewFormD();
			}
			else if($action == 'viewFormE'){
				$this->viewFormE();
			}
			else if($action == 'viewFormF'){
				$this->viewFormF();
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
			$this->load->view('footer');
			if($account_type == 'student'){	
				$this->load->view('student/changepassword');
				$this->load->view('student/search');
			}
			if($account_type == 'admin')
				$this->load->view('admin/changepassword');


		}

		private function checkOrgPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('orgpassword');
		
			if($id != NULL && $password != NULL){
				$orgpassword = md5($password);
				$this->load->model('OrgModel');
				$result = $this->OrgModel->checkOrgPassword($id, $orgpassword);
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
				$neworgpassword = md5 ($password);
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
			$config['file_name'] = $file_name.'.pdf';

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
			$id = $this->session->userdata['user_id'];
			$file_name = md5('formB'.$id);

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
                $this->load->model('OrgModel');
				$this->OrgModel->uploadFormB($id, $file_name);  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }	
		}

		private function uploadFormF(){
			$id = $this->session->userdata['user_id'];
			$file_name = md5('formF'.$id);

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

			$student_id = $this->input->post('student_id');
			$account_type = $this->session->userdata['account_type'];

			if($student_id != NULL && $account_type == 'org'){

				$org_id = $this->session->userdata['user_id'];

				$this->load->model('OrgModel');
				$this->OrgModel->rejectMembership($org_id, $student_id);

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
				$this->sendChangePositionNotification($org_name, $up_mail, $position);

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
				$this->sendRemoveMembershipNotification($org_name, $up_mail, $reason);

				echo json_encode($org_name.' '.$up_mail);
				exit();
			}
			else
				show_404();
		}

		private function sendRemoveMembershipNotification($org_name, $up_mail, $reason){
		
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
			    $this->email->subject('Membership Removal');

			    $message = '<html><body>';
			    $message .= '<p> Notification from ASUO:</p>';
			    $message .= '<p>Your membership from '. $org_name.' has been removed.</p>';
			    $message .= "<p>The reason indicated was '".$reason."'.</p>";
			    $message .= '<p>For more details, please communicate with your organization.</p>';
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
		}

		private function sendChangePositionNotification($org_name, $up_mail, $position){
		
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
			    $this->email->subject('Change in Membership Position');

			    $message = '<html><body>';
			    $message .= '<p> Notification from ASUO:</p>';
			    $message .= '<p>Your membership position in '. $org_name.' has been changed.</p>';
			    $message .= "<p>Your new position is now '".$position."'.</p>";
			    $message .= '<p>For more details, please communicate with your organization.</p>';
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
		}




//-------------------------------FORMS FOR ACCREDITATION---------------------------------------
		private function generateFormA()
		{	
			//get org id
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			
			//get user input form a details
			$result = $this->OrgModel->input_formA_details($org_id);
			
			//get predefined form a details
			$pre_def_details = $this->OrgModel->getOrgDetails($org_id);
				
			$result['org_name'] = $pre_def_details['org_name'];
			$result['org_category'] = $pre_def_details['org_category'];
			$result['description'] = $pre_def_details['description'];
			$result['objectives'] = $pre_def_details['objectives'];
			$result['org_status'] = $pre_def_details['org_status'];
			//var_dump($result);
			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formA', $result);
			$this->load->view('footer');



		}

		//saving data from form a accreditation
		private function saveFormA()
		{
			 
			$form_details = $this->input->post('data');
			$org_id = $this->session->userdata['user_id']; 
			//var_dump("org id ".$org_id);
			$this->load->model('OrgModel');
			$temp = $this->OrgModel->insertFormAdetails($form_details,$org_id);
			//var_dump($temp);
			redirect(base_url().'org/formA');
		}

		private function loadAccreditationHome(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/applyforaccreditation', $data);
			$this->load->view('footer');
		}
		
		private function loadFormB(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formB', $data);
			$this->load->view('footer');
		}
		private function loadFormC(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);
			
			$data['tally'] = $this->OrgModel->getOrgTally($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formC', $data);
			$this->load->view('footer');
		}

		private function loadFormD(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formD', $data);
			$this->load->view('footer');
		}

		private function loadFormE(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formE', $data);
			$this->load->view('footer');
		}

		private function loadFormF(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formF', $data);
			$this->load->view('footer');
		}

		private function loadFormG(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formG', $data);
			$this->load->view('footer');
		}

		private function loadPlans(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/plans', $data);
			$this->load->view('footer');
		}


		private function viewFormA()
		{

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

			$org_id = $this->session->userdata['user_id'];
			// set font
			$pdf->SetFont('Helvetica', '', 12);
			$pdf->AddPage();
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
			$html= '<p align="right"><b>Date filed:</b>'.date("M d, Y").'</p><br>
			<b>Organization Name:</b>'.$result['org_name'].'<br>
			<b>Number of members:</b>'.$tally.'<br>	
			<b>Category:</b>'.$result['org_category'].'<br>
			<b>Adviser:</b><br>
			<b>Position/Designation:</b>&nbsp;&nbsp;&nbsp;&nbsp;<br><b>College/Unit: </b><br>
			<b>Contact Person:</b><br>
			<b>Position in the Organization</b>
			<br>
			<b>Address:</b>
			<br>
			<b>Telephone no.:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile no.:</b>
			<br>
			<b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Other contact details:</b>
			<br>
			<b>Objectives of Organization:</b>'.$result['objectives'].'
			<br>
			<b>Brief description of Organization:</b>'.$result['description'].'
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
			var_dump($html);
			//$pdf->writeHTML($html, true, 0, true, 0);
			//$pdf->Output('example_003.pdf', 'I');


		}
		
		private function viewFormC(){
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

			$pdf->Output('formc.pdf', 'I');
		}

		private function viewFormD(){
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
			
			$pdf->Output('example_003.pdf', 'I');
			//$pdf->Output('example_003.pdf', 'I');


		}

		public function viewFormE(){
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
			$pdf->Output('example_003.pdf', 'I');			
		}

		private function viewFormF(){
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('Form F');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form F: Financial Report", PDF_HEADER_STRING);

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
			$year = date("Y");
			$text='
				<b><p align="center">Financial Statement</p></b><br>
				<p align="center">AY '.$year.' - '.($year+1).'</p>
				<br>
				<b>Starting Cash Balance:</b> 
				<br>
				<b>Add:</b>
				<br>
				<br>
				<b>Details</b> &nbsp; <b>Amount</b>
				<br>

				<b>Total Amount Available for Disbursement…………………..………. </b> &nbsp;&nbsp;
				<br>

				<b>Less:</b><br>
				<b>Disbursement Details</b> &nbsp; <b>Amount</b>
				<br>

				<b>Cash balance as of:</b> &nbsp;&nbsp;&nbsp; <b>Php</b>

				<p align="center"><B>Finance Officer:</B><br>

				</p>

				<br>
				<br>
				<b>Audited by:</b> &nbsp;&nbsp;&nbsp; <b>Attested by:</b><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Adviser:</b>


			';

			$pdf->writeHTML($text, true, 0, true, 0);
			$pdf->Output('example_003.pdf', 'I');
			//$pdf->Output('example_003.pdf', 'I');
		}


	}
?>