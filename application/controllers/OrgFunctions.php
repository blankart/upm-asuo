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
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formG');
				$this->load->view('footer');
			}
			else if($action == 'viewFormA')
				$this->viewFormA();
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

					if ( !$org_id )
						echo "That org does not exist, darlin'! ";
					else{

						if ( $this->session->userdata['account_type'] == 'admin')
					 		$isAdmin = true;
						else{
							$isAdmin = false;
						 	$student_id = $this->session->userdata['user_id'];
						 	$isMember = $this->OrgModel->isMember($org_id, $student_id);
						}

						if ($isAdmin)
							echo "All hail the almighty admin! We present you with everything!"; //user is an admin
						else if($isMember)
							echo "Since you are a member, feel priviliged. Don't take it for granted ;)"; //user is a member
						else
						 	echo 'You can only view limited stuff, puny human. HA-HA';		// user is not a member of the org		
					}
				}
				else if($action == $this->session->userdata['nsacronym']){
					if($account_type == 'org')		
						$this->loadOrgProfile();

					if($account_type == 'unverifiedOrg')
						echo 'verify your email using ' .$this->session->userdata['email']. "."; //load view here note: redirect
			
					if($account_type == 'unactivatedOrg')
						echo 'You account is not yet activated. Procced to OSA.'; //load view here note: redirect
				
					if($account_type == 'archivedOrg')
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
		
			if($org_id != NULL && $data != NULL){
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

		private function loadAccreditationHome(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/applyforaccreditation', $data);
			$this->load->view('footer');
		}

		private function loadFormA(){
			$org_id = $this->session->userdata['user_id'];

			$this->load->model('OrgModel');
			$data = $this->OrgModel->getOrgDetails($org_id);

			$this->load->view('header');
			$this->load->view('org/applyforaccreditation/formA', $data);
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

		private function viewFormA(){


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



			// add a page
			$pdf->AddPage();

			//$name = 'UP Society of Computer Scientists';
			// set some text to print
			$html= '<p align="right"><b>Date filed:</b>'.date("M d, Y").'</p><br>
			<b>Organization Name:</b><br>
			<b>Number of members:</b><br>	
			<b>Category:</b><br>
			<b>Position/Designation:   </b>&nbsp;&nbsp;&nbsp;&nbsp;<b>College/Unit</b><br>
			<b>Contact Person:</b>
			<b>Position in the Organization</b>
			<br>
			<b>Address</b>
			<br>
			<b>Telephone no.:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile no.:</b>
			<br>
			<b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Other contact details:</b>
			<br>
			<b>Objectives of Organization:</b>
			<br>
			<b>Brief description of Organization:</b>
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
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('example_003.pdf', 'I');


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

			$html= '<p align="right"><b>Date filed:</b></p><br>
			<b>Organization Name:</b><br>
			<b>Number of members:</b><br>	
			<b>Category:</b><br>
			<b>Position/Designation:   </b>&nbsp;&nbsp;&nbsp;&nbsp;<b>College/Unit</b><br>
			<b>Contact Person:</b>
			<b>Position in the Organization</b>
			<br>
			<b>Address</b>
			<br>
			<b>Telephone no.:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile no.:</b>
			<br>
			<b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Other contact details:</b>
			<br>
			<b>Objectives of Organization:</b>
			<br>
			<b>Brief description of Organization:</b>
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

			// add a page
			$pdf->AddPage();
			//$pdf->AddPage();
			$pdf->Output('example_003.pdf', 'I');
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



			// add a page
			$pdf->AddPage();
			//$pdf->AddPage();
			$text ='
				<p align="center"><b><h3>Organization Profile</h3></b></p>
				<b>Name of Organization:</b><br>
				<b>Acronym:</b><br>
				<b>Mailing Address:</b><br>
				<b>E-mail Address:</b><br>
				<b>Website: </b><br>
				<b>Date Established:</b><br>
				<b>Total Number of Members:</b><br>

				<table>

				</table>
			';
			$pdf->writeHTML($text, true, 0, true, 0);
			$pdf->Output('example_003.pdf', 'I');
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