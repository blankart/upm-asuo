<?php
	class AdminFunctions extends CI_Controller{

		public function perform( $action = 'login'){

			if( !isset($this->session->userdata['logged_in']) )
				redirect(base_url().'login');
			else if($action == 'login' || $action == 'regstud' || $action == 'regorg')
			 	$this->redirectToProfile();


			else if ($action == 'sendStudentNotice')
				$this->sendStudentNotice();
			else if ($action == 'searchStudents')
				$this->searchStudents();
			else if ($action == 'viewStudentInfo')
				$this->viewStudentInfo();
			else if ($action == 'validateStudentAccount')
				$this->validateStudentAccount();
			else if ($action == 'rejectStudent')
				$this->rejectStudent();

			else if ($action == 'searchOrganizations')
				$this->searchOrganizations();
			else if ($action == 'viewOrgInfo')
				$this->viewOrgInfo();
			else if ($action == 'activateOrgAccount')
				$this->activateOrgAccount();

			else if ($action == 'searchAllStudents')
				$this->searchAllStudents();
			else if ($action == 'changeStudPassword')
				$this->changeStudPassword();
			else if ($action == 'blockStudentAccount')
				$this->blockStudentAccount();
			else if ($action == 'unblockStudentAccount')
				$this->unblockStudentAccount();

			else if ($action == 'searchAllOrganizations')
				$this->searchAllOrganizations();
			else if ($action == 'changeOrgPassword')
				$this->changeOrgPassword();
			else if ($action == 'blockOrgAccount')
				$this->blockOrgAccount();
			else if ($action == 'unblockOrgAccount')
				$this->unblockOrgAccount();
			else if ($action == 'changeLoginNotice')
				$this->changeLoginNotice();

			//
			else if($action == 'viewDocuments')
				$this->viewDocuments();
			else if($action == 'searchAccredApp')
				$this->searchAccredApp();
			else if($action == 'accreditOrg')
				$this->accreditOrg();
			else if($action == 'rejectOrg')
				$this->rejectOrg();
			//

			else if($action == 'openAccreditationPeriod')
				$this->openAccreditationPeriod();
			
			else if ($action == 'sendNoticeSearch')
				$this->sendNoticeSearch();
			else if ($action == 'sendNotice')
				$this->sendNotice();

			else if ($action == 'viewAllNotices')
				$this->viewAllNotices();
			else if ($action == 'viewMessageDetails')
				$this->viewMessageDetails();
			
			else if ($action == 'checkAdminPassword')
				$this->checkAdminPassword();
			else if ($action == 'changeAdminPassword')
				$this->changeAdminPassword();

			else
				if($this->session->userdata['account_type'] == 'admin')
					if($action  == $this->session->userdata['username'])
						$this->loadAdminPanel();
					else
			 			 show_404(); //pwede din customized page
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

		private function loadAdminPanel(){
			$this->load->view('header');
			$this->load->view('admin');
			$this->load->view("admin/activateorgact.php");
            $this->load->view("admin/validatestudact.php");
            $this->load->view("admin/sendnotice.php");
            $this->load->view("admin/viewaccreditapp.php");
            $this->load->view("admin/viewallnotices.php");
            $this->load->view("admin/viewallorg.php");
            $this->load->view("admin/viewallstudents.php");
            $this->load->view("admin/changepassword.php");
              $this->load->view("admin/openaccreditperiod.php");
              $this->load->view("admin/changeloginnotice.php");
			$this->load->view('footer');
		}

		private function sendStudentNotice(){
			$student_id = $this->input->post('student_id');
			$message = $this->input->post('message');

			if($student_id != NULL && $message != NULL){

				$admin_id = $this->session->userdata['user_id'];

				$data['admin_id'] = $admin_id;
				$data['student_id'] = $student_id;
				$data['content'] = $message;
				$format = 'Y-m-d H:i:s';
				$data['date_posted'] = date($format);

				$this->load->model('AdminModel');
				$this->AdminModel->sendStudentNotice($data);
				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function searchStudents(){
			$query = $this->input->post('query');
			$source = $this->input->post('source');

			if($source == "admin"){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchStudents($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function validateStudentAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->validateStudentAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function rejectStudent()
		{
			$student_id = $this->input->post('student_id');			
			//$org_id = $source;
			//$org_id = 6;
			if($student_id != NULL)
			{
				//$student_id = $this->session->userdata['user_id'];
				$this->load->model('AdminModel');
				$this->AdminModel->rejectStud($student_id);
				//var_dump($result);
				echo json_encode("true");
				exit(); 
			}
			else
			{
				show_404();
			}
		}

		private function searchOrganizations(){
			$query = $this->input->post('query');
			$source = $this->input->post('source');

			if($source == "admin"){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchOrganizations($query);
				foreach ($profiles as $profile)
					array_push($result, $profile);

					header('Content-type: application/json');
					echo json_encode($result);
					exit();
			}
			else 
				show_404();
		}

		private function activateOrgAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->activateOrgAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function searchAllStudents(){
			$query = $this->input->post('query');
			$source = $this->input->post('source');

			if($source == "admin"){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAllStudents($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}	

		private function viewStudentInfo(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->viewStudentInfo($id);
				echo json_encode($result[0]);
				exit();
			}
			else
				show_404();
		}

		/*private function changeStudPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('newstudpassword');
		
			if($id != NULL && $password != NULL){
				$newstudpassword = md5($password);
				$this->load->model('AdminModel');
				$this->AdminModel->changeStudPassword($id, $newstudpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}*/

		private function blockStudentAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->blockStudentAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function unblockStudentAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->unblockStudentAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function searchAllOrganizations(){
			$query = $this->input->post('query');
			$source = $this->input->post('source');

			if($source == "admin"){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAllOrganizations($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}
		/*
		private function changeOrgPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('neworgpassword');

			if($id != NULL && $password != NULL){
				$neworgpassword = md5($password);
				$this->load->model('AdminModel');
				$this->AdminModel->changeOrgPassword($id, $neworgpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}*/
		
		private function viewOrgInfo(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->viewOrgInfo($id);
				echo json_encode($result[0]);
				exit();
			}
			else
				show_404();
		}

		private function blockOrgAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->blockOrgAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function unblockOrgAccount(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->unblockOrgAccount($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function changeLoginNotice(){

			$notice = $this->input->post('data');

			if($notice != NULL){
				$admin_id = $this->session->userdata['user_id'];
				$notice['admin_id'] = $admin_id;
				$format = 'Y-m-d H:i:s';
				$notice['date_posted'] = date($format);

				$this->load->model('AdminModel');
				$this->AdminModel->changeLoginNotice($notice);
				echo json_encode($notice);
				exit();
			}
			else show_404();	
		}

		//

		private function viewDocuments(){

			$org_id = $this->input->post('org_id');
			
			
			if($org_id != NULL){


				$this->load->model('AdminModel');
				$documents = $this->AdminModel->getAccreditationDocuments($org_id);

				/*echo "<pre>";
				print_r($documents);
				echo "</pre>";*/
				
				if($documents){
					echo json_encode($documents);
					exit();
				}
				else{
					echo json_encode(false);
					exit();
				}
			}
			else
				show_404();
		}

		private function searchAccredApp(){
			$query =  $this->input->post('query');
			$source = $this->input->post('source');

			if($source == 'admin'){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAccredApp($query);	

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();	
			}
			else 
				show_404();			
		}

		private function accreditOrg(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->accreditOrg($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function rejectOrg(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->rejectOrg($id);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}
		//

		private function openAccreditationPeriod(){

			$period = $this->input->post('period');

			if($period != NULL){

				$admin_id = $this->session->userdata['user_id'];				
				$data['admin_id'] = $admin_id;

				

				$format = 'Y-m-d H:i:s';
				$time = strtotime($period['start_date']);

				$data['start_date'] = date($format, $time);

				$time = strtotime($period['end_date']);
				$data['end_date'] =  date($format, $time);
				$data['status'] = 'Opened';

				$this->load->model('AdminModel');
				$this->AdminModel->openAccreditationPeriod($data);
				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function sendNoticeSearch(){
			$query = $this->input->post('query');
			$source = $this->input->post('source');

			if($source == 'admin'){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->sendNoticeSearch($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function sendNotice(){
			$notice = $this->input->post('notice');

			if($notice != NULL){

				$orgIds = $notice['orgIds'];

				$data['sender'] = $this->session->userdata['user_id'];
				$data['title'] = $notice['title'];
				$data['content'] = $notice['content'];
				$format = 'Y-m-d H:i:s';
				$data['date_posted'] = date($format);
				$data['archived'] = 0;

				$this->load->model('AdminModel');

				$notice_ID = $this->AdminModel->createNotice($data);
				
				$recipient['notice_ID'] = $notice_ID;

				foreach($orgIds as $orgId){
					$recipient['org_id'] = $orgId;
					$this->AdminModel->insertRecipient($recipient);
				}

				echo json_encode(true);
				exit();
			}
			else
				show_404();
			
		}

		private function viewAllNotices(){
			$source = $this->input->post('source');
			$id = $this->input->post('id');

			if($id != NULL && $source == 'admin'){
				$this->load->model('AdminModel');
				$profiles = $this->AdminModel->viewAllNotices($id);

				$result = array();
				foreach ($profiles as $profile)
					array_push($result, $profile);
			
				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function viewMessageDetails(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->viewMessageDetails($id);
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function deleteNotice(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->deleteNotice($id);
				echo json_encode($result[0]);
				exit();
			}
			else
				show_404();	
		}

		private function checkAdminPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('adminpassword');
		
			if($id != NULL && $password != NULL){
				
				$this->load->model('AdminModel');
				$result = $this->AdminModel->checkAdminPassword($id, $password);
				echo json_encode($result);
				exit();
			}
			else
				show_404();
		}

		private function changeAdminPassword(){
			$id = $this->input->post('id');
			$password = $this->input->post('newadminpassword');
		
			if($id != NULL && $password != NULL){
				$newadminpassword = password_hash($password, PASSWORD_BCRYPT);
				$this->load->model('AdminModel');
				$this->AdminModel->changeAdminPassword($id, $newadminpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}
	}
?>
