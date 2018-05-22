<?php
	class StudentFunctions extends CI_Controller{

		public function perform( $action = 'login', $searchItem = ''){
			
			if( !isset($this->session->userdata['logged_in']) )
				redirect(base_url().'login');
			else if($action == 'login' || $action == 'regstud' || $action == 'regorg')
			 	$this->redirectToProfile();

			else if($action == 'editStudentProfile')
				$this->editStudentProfile();
			else if($action == 'uploadProfilePicture')
				$this->uploadProfilePicture();
			else if($action == 'uploadForm5')
				$this->uploadForm5();

			else if($action == 'search')
				$this->search();

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
					$error['username'] = $action;
					if ( !$student_id ){
						
						$this->load->view('header'); 
						$this->load->view('errors/html/dne_student', $error); 
						if($account_type== 'admin'){
							$this->load->view('admin/changepassword');
						}
						if($account_type== 'org'){
							$this->load->view('org/changepassword');
						} 
						$this->load->view('footer');
					}
					else  {
						$isVerified = $this->StudentModel->isStudentVerified($student_id);
						$isArchived = $this->StudentModel->isStudentArchived($student_id);

						if (!$isVerified || $isArchived){
							$this->load->view('header'); 
							$this->load->view('errors/html/dne_student', $error);
							if($account_type== 'admin'){
							$this->load->view('admin/changepassword');
						}
						if($account_type== 'org'){
							$this->load->view('org/changepassword');
						}  
							$this->load->view('footer');
						}							
						else{	

							$this->loadStudentProfileByOthers($student_id, $account_type);		
							//echo "Since you are an org and an admin, you can view anything that you like. How's that?";	// user is an org or an admin		
						}
					}
				}
				else if($action  == $this->session->userdata['username']){

					if($account_type== 'student')				
						$this->loadStudentProfile();
					
					if($account_type == 'unverifiedStudent'){
						$data['org_email'] = $this->session->userdata['email'];
						//echo  'verify your email using ' .$this->session->userdata['email']. "."; //load view here note: redirect
						$this->load->view('header'); 
						$this->load->view('errors/html/unverified', $data);
						$this->load->view('footer');

					}
				
					if($account_type == 'unactivatedStudent'){
						//echo 'You account is not yet activated. Procced to OSA.'; //load view here note: redirect
						$student_id = $this->session->userdata['user_id'];

						$data2 = $this->StudentModel->getStudentDetails($student_id);
						$this->load->view('header'); 
						$this->load->view('unactivatedstudent', $data2);
						$this->load->view('footer');
					}
				
					if($account_type == 'archivedStudent'){
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

		private function loadStudentProfile(){

			$student_id = $this->session->userdata['user_id'];
			$this->load->model('StudentModel');
			$data = $this->StudentModel->getStudentProfileDetails($student_id);
			$data2 = $this->StudentModel->getStudentDetails($student_id);

			/*echo '<pre>';
			print_r($result);
			echo '</pre>';*/

			$this->load->view('header');
			$this->load->view('student/student.php', $data);
			$this->load->view('footer');
			$this->load->view('student/changepassword');
			$this->load->view('student/search');
			$this->load->view('student/editProfile', $data2);
		}

		private function loadStudentProfileByOthers($student_id, $account_type){
			
			$this->load->model('StudentModel');
			$data = $this->StudentModel->getStudentProfileDetailsByOthers($student_id);

			$this->load->view('header');
			$this->load->view('student/student.php', $data);

			if($account_type == 'org')
				$this->load->view('org/changepassword');
			if($account_type == 'admin')
				$this->load->view('admin/changepassword');
			$this->load->view('footer');
		}

		private function editStudentProfile(){
			$data = $this->input->post('data');
		
			if($data != NULL){
				$student_id = $this->session->userdata['user_id'];

				$profile['course'] = $data['course'];
				$profile['year_level'] = $data['year_level'];
				$profile['sex'] = $data['sex'];
				$profile['birthday'] = $data['birthday'];
				$profile['address'] = $data['address'];
				$profile['contact_num'] = $data['contact_num'];

				$account['up_id'] = $data['up_id'];

				$this->load->model('StudentModel');
				$this->StudentModel->editStudentProfile($student_id, $profile);
				$this->StudentModel->editStudentAccount($student_id, $account);
				echo json_encode(true);
				exit();
			}
			else
				show_404();
		}

		private function uploadProfilePicture(){

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


			if ( ! $this->upload->do_upload('form5')){
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

		private function search(){
			$searchItem = $this->input->post('query');

			if($searchItem != NULL){
				$this->load->model("StudentModel");
				$result = $this->StudentModel->search($searchItem);
				echo json_encode($result);
				exit();
			}
			else
				show_404();
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