<?php
	class StudentFunctions extends CI_Controller{

		public function perform( $action = 'login', $searchItem = ''){
			
			if( !isset($this->session->userdata['logged_in']) )
				redirect(base_url().'login');
			else if($action == 'login' || $action == 'regstud' || $action == 'regorg')
			 	$this->redirectToProfile();

			else if($action == 'editStudentProfile')
				$this->editStudentProfile();
			else if($action == 'changePicture')
				$this->changePicture();
			else if($action == 'uploadForm5')
				$this->uploadForm5();

			else if($action == 'search')
				//echo 'here';
				$this->search($searchItem);

			else if($action == 'checkStudentPassword')
				$this->checkStudentPassword();
			else if($action == 'changeStudentPassword')
				$this->changeStudentPassword();
			else{

				$account_type = $this->session->userdata['account_type'];

				if($account_type == 'org' || $account_type == 'admin'){

					$this->load->model('StudentModel');
				//	echo "'".$action."'";
					$student_id = $this->StudentModel->getStudentId($action);

					//print_r($student_id);

					if ( !$student_id )
						echo "This student is imaginary, darlin'! ";
					else				
						echo "Since you are an org and an admin, you can view anything that you like. How's that?";		// user is an org or an admin		
					
				}
				else if($action  == $this->session->userdata['username']){

					if($account_type== 'student')				
						$this->loadStudentProfile();
					
					if($account_type == 'unverifiedStudent')
						echo  'verify your email using ' .$this->session->userdata['email']. "."; //load view here note: redirect
				
					if($account_type == 'unactivatedStudent')
						echo 'You account is not yet activated. Procced to OSA.'; //load view here note: redirect
				
					if($account_type == 'archivedStudent')
						echo 'You account is blocked. Procced to OSA.'; //load view here note: redirect
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

		private function loadStudentProfile(){

			$student_id = $this->session->userdata['user_id'];
			$this->load->model('StudentModel');
			$result = $this->StudentModel->getStudentProfileDetails($student_id);
			$data = $result;
			/*echo '<pre>';
			print_r($data);
			echo '</pre>';*/

			$this->load->view('header');
			$this->load->view('student/student.php', $data);
			$this->load->view('footer');
			//$this->load->view('student/changepassword');
			$this->load->view('student/editProfile');
		}

		private function editStudentProfile(){
			$data = $this->input->post('data');
			$student_id = $this->input->post('student_id');
		
			if($student_id != NULL && $data != NULL){
				$this->load->model('StudentModel');
				$this->StudentModel->editStudentProfile($student_id, $data);
				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function changePicture(){

			$id = $this->session->userdata['user_id'];
			$file_name = md5('studentProfilePic'.$id);

			$config['upload_path'] = './assets/student/profile_pic/';
			$config['allowed_types'] = 'jpg';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '500';
			$config['file_name'] = $file_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('profile_pic')){
	            show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {
                $this->load->model('StudentModel');
				$this->StudentModel->changePicture($id, $file_name.".jpg");  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }
		}

		private function uploadForm5(){

			$id = $this->session->userdata['user_id'];
			$file_name = md5('studentForm5'.$id);

			$config['upload_path'] = './assets/student/form_5/';
			$config['allowed_types'] = 'jpg';
			$config['overwrite'] = TRUE;
			$config['max_size']     = '500';
			$config['file_name'] = $file_name;

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('form_5')){
	            show_404();
                $error = array('msg' => $this->upload->display_errors());
                echo json_encode($error);
                exit();
            }
            else {
                $this->load->model('StudentModel');
				$this->StudentModel->uploadForm5($id, $file_name.".jpg");  
				$data = array('msg' => $this->upload->data());  
				echo json_encode($data);
				exit();     
            }
		}

		private function search($searchItem){
			//echo $searchItem . "'+'";

			$this->load->model("StudentModel");
			$result = $this->StudentModel->search($searchItem);
			echo "Search results for '" .$searchItem. "'";
			echo "<pre>";
			print_r($result);
			echo "</pre>";
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