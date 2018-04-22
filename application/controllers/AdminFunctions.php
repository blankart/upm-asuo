<?php
	class AdminFunctions extends CI_Controller{

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
			else if ($action == 'searchStudents')
				$this->searchStudents();
			else if ($action == 'validateStudentAccount')
				$this->validateStudentAccount();
			else if ($action == 'activateOrgAccount')
				$this->activateOrgAccount();
			else if ($action == 'searchOrganizations')
				$this->searchOrganizations();
			else if ($action == 'viewStudentInfo')
				$this->viewStudentInfo();
			else if ($action == 'viewOrgInfo')
				$this->viewOrgInfo();
			else if ($action == 'searchAllStudents')
				$this->searchAllStudents();
			else if ($action == 'searchAllOrganizations')
				$this->searchAllOrganizations();
			else if ($action == 'changeStudPassword')
				$this->changeStudPassword();
			else if ($action == 'blockStudentAccount')
				$this->blockStudentAccount();
			else if ($action == 'blockOrgAccount')
				$this->blockOrgAccount();
			else if ($action == 'unblockStudentAccount')
				$this->unblockStudentAccount();
			else if ($action == 'unblockOrgAccount')
				$this->unblockOrgAccount();
			else if ($action == 'changeOrgPassword')
				$this->changeOrgPassword();
			else if ($action == 'changeAdminPassword')
				$this->changeAdminPassword();
			else if ($action == 'checkAdminPassword')
				$this->checkAdminPassword();
			else if ($action == 'sendNoticeSearch')
				$this->sendNoticeSearch();
			else if ($action == 'sendNotice')
				$this->sendNotice();
			else if ($action == 'sendNoticeToAll')
				$this->sendNoticeToAll();
			else if ($action == 'viewAllNotices')
				$this->viewAllNotices();
			else if ($action == 'viewMessageDetails')
				$this->viewMessageDetails();
			//
			else if($action == 'searchAccredApp')
				$this->searchAccredApp();
			else if($action == 'accreditOrg')
				$this->accreditOrg();
			else if($action == 'rejectOrg')
				$this->rejectOrg();
			//

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
			if($this->session->userdata['account_type'] == 'student')
			 	redirect(base_url()."student/".$this->session->userdata['username']);

			if($this->session->userdata['account_type'] == 'org')
				redirect(base_url()."org/".$this->session->userdata['acronym']);

	 		if($this->session->userdata['account_type'] == 'admin')
	 			redirect(base_url()."admin/".$this->session->userdata['username']);
		}

		private function loadAdminPanel(){
			$this->load->view('header');
			$this->load->view('admin');
			$this->load->view('footer');
			$this->load->view("admin/activateorgact.php");
            $this->load->view("admin/validatestudact.php");
            $this->load->view("admin/sendnotice.php");
            $this->load->view("admin/viewaccreditapp.php");
            $this->load->view("admin/viewallnotices.php");
            $this->load->view("admin/viewallorg.php");
            $this->load->view("admin/viewallstudents.php");
            $this->load->view("admin/changepassword.php");
		}

		//
		private function searchAccredApp(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAccredApp($query);	

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();				
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

		private function searchStudents(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchStudents($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
		}

		private function searchAllStudents(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAllStudents($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
		}

		private function searchAllOrganizations(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchAllOrganizations($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
		}

		private function sendNoticeSearch(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->sendNoticeSearch($query);

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
		}

		private function viewAllNotices(){
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->viewAllNotices();

				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
		}


		private function searchOrganizations(){
			$query = $this->input->post('query');
				$this->load->model('AdminModel');
				$result = array();
				$profiles = $this->AdminModel->searchOrganizations($query);
				foreach ($profiles as $profile)
					array_push($result, $profile);

				header('Content-type: application/json');
				echo json_encode($result);
				exit();
			
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

		private function viewMessageDetails(){
			$id = $this->input->post('id');

			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->viewMessageDetails($id);
				echo json_encode($result[0]);
				exit();
			}
			else
				show_404();
		}

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

		private function changeStudPassword()
		{
			$id = $this->input->post('id');
			$newstudpassword = $this->input->post('newstudpassword');


			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->changeStudPassword($id, $newstudpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function changeOrgPassword()
		{
			$id = $this->input->post('id');
			$neworgpassword = $this->input->post('neworgpassword');


			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->changeOrgPassword($id, $neworgpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function changeAdminPassword()
		{
			$id = $this->input->post('id');
			$newadminpassword = $this->input->post('newadminpassword');


			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->changeAdminPassword($id, $newadminpassword);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

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

		private function sendNotice(){
			$id = $this->input->post('id');
			$noticeTitle = $this->input->post('noticeTitle');
			$noticeMessage = $this->input->post('noticeMessage');
			$noticeDate = $this->input->post('noticeDate');

			if($id != NULL){
				$this->load->model('AdminModel');
				$this->AdminModel->sendNotice($id ,$noticeTitle, $noticeMessage, $noticeDate);
				echo json_encode('true');
				exit();
			}
			else
				show_404();
		}

		private function sendNoticeToAll(){
			$noticeTitle = $this->input->post('noticeTitle');
			$noticeMessage = $this->input->post('noticeMessage');
			$noticeDate = $this->input->post('noticeDate');

			
				$this->load->model('AdminModel');
				$this->AdminModel->sendNoticeToAll($noticeTitle, $noticeMessage, $noticeDate);
				echo json_encode('true');
				exit();
		}

		private function checkAdminPassword(){
			$adminpassword = $this->input->post('adminpassword');
			$id = $this->input->post('id');
			if($id != NULL){
				$this->load->model('AdminModel');
				$result = $this->AdminModel->checkAdminPassword($id, $adminpassword);
			}
			else
				show_404();
			if ($result) echo json_encode('true');
			else echo json_encode('false');

		}
	}
?>
