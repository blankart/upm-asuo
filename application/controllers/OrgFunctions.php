<?php
	class OrgFunctions extends CI_Controller{

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
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/applyforaccreditation');
				$this->load->view('footer');
			}
			else if ($action == 'formA'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formA');
				$this->load->view('footer');
			}
			else if ($action == 'formB'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formB');
				$this->load->view('footer');
			}
			else if ($action == 'formC'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formC');
				$this->load->view('footer');
			}
			else if ($action == 'formD'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formD');
				$this->load->view('footer');
			}
			else if ($action == 'formE'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formE');
				$this->load->view('footer');
			}
			else if ($action == 'formF'){
				$this->load->view('header');
				$this->load->view('org/applyforaccreditation/formF');
				$this->load->view('footer');
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
			else
				if($this->session->userdata['account_type'] == 'org')
					if($action  == $this->session->userdata['nsacronym'])					
						$this->loadOrgProfile();
					else
			 			show_404();
				else
					redirect(base_url().'login');
		}

		private function redirectToProfile(){
			if($this->session->userdata['account_type'] == 'student')
			 	redirect(base_url()."student/".$this->session->userdata['username']);
			
			if($this->session->userdata['account_type'] == 'org')
				redirect(base_url()."org/".$this->session->userdata['nsacronym']);
	 		
	 		if($this->session->userdata['account_type'] == 'admin')
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

			  	$config['upload_path'] = './assets/';
				$config['allowed_types'] = 'jpg|JPG';
				$config['max_size']     = '500';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';

                $this->upload->initialize($config);


			 if ( ! $this->upload->do_upload('logo')){

			 	  echo "<pre>";
                print_r($this->upload->data());
                echo "</pre>";
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                       
                }
 
		}

		private function uploadConstitution(){
			$config['upload_path'] = './assets/org/constitution/';
			$config['allowed_types'] = 'pdf';
			$config['max_size']     = '100';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('constitution')){

			 	echo "<pre>";
                print_r($this->upload->data());
                echo "</pre>";
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
            }
            else {
            	echo "<pre>";
                print_r($this->upload->data());
                echo "</pre>";
                $data = array('upload_data' => $this->upload->data());          
            }
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

			// set font
			$pdf->SetFont('Helvetica', '', 12);
			//$pdf->AddPage();
			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgOfficer();	
			//var_dump($result);
			$temp = "";

			for($i=0;$i<sizeof($result);$i++)
			{
				if($result[$i]['isRemoved'] == 0 && $result[$i]['position'] != 'Member')
				{
					if(($i % 3) == 0 || $i == 0)
					{
						$pdf->AddPage();
					$temp = '<br><p align="right"><b><u>'.$result[$i]['org_name'].'</u></b><br>
					<b>Name of Organization</b></p><br>
					<h3 align="center"><b>LIST OF OFFICERS</b></h3>
					<h5 align="center">AY 2017-2018</h5>';
					}
				$samplehtml = $temp.' 
			<table>
  			<tr>
   	 			<td colspan = "2"><b>Name:</b> '.$result[$i]['first_name'].' '.$result[$i]['middle_name'].' '.$result[$i]['last_name'].'</td>
   	 			<td> </td>
   	 			<td> </td>
    			<td rowspan="5"><img src="'.K_PATH_PROFILE_PIC.'/assets/student/profile_pic/'.$result[$i]['profile_pic'].'" width="80" height="100" align="right"></td>
  			</tr>
  			<tr>
    			<td colspan = "2"><b>Position:</b> '.$result[$i]['position'].'</td>
    			<td colspan="2.5"><b>Year/Course:</b> '.$result[$i]['year_level'].' '.$result[$i]['course'].'</td>
  			</tr>
  			<tr>
    			<td colspan="3"><b>Address:</b> '.$result[$i]['up_mail'].'</td>
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

				
				
			}
			
			$pdf->Output('example_003.pdf', 'I');
			//$pdf->Output('example_003.pdf', 'I');


		}

		private function viewFormE(){
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

			$this->load->model('OrgModel');
			$result = $this->OrgModel->getOrgMembers();	
			//var_dump($result);
			$temp = "";
			// add a page
			for($i=0;$i<sizeof($result);$i++)
			{
				if($result[$i]['isRemoved'] == 0)
				{
					if(($i+1 % 2) == 0 || $i == 0)
				{
					$pdf->AddPage();
					$temp = '<br><p align="right"><b><u>'.$result[$i]['org_name'].'</u></b><br>
					<b>Name of Organization</b></p><br>
					<h3 align="center"><b>LIST OF MEMBERS</b></h3>
					<h5 align="center">AY 2017-2018</h5>';
				}
				$samplehtml = $temp.'
			<table>
  			<tr>
   	 			<td><b>Name:</b></td>
   	 			<td colspan = "2" style ="">'.$result[$i]['first_name'].' '.$result[$i]['middle_name'].' '.$result[$i]['last_name'].'</td>
   	 			<td> </td>
    			<td rowspan="5"><img src="'.K_PATH_PROFILE_PIC.'/assets/student/profile_pic/'.$result[$i]['profile_pic'].'" width="80" height="100" align="right"></td>
  			</tr>
  			<tr>
    			<td><b>Year:</b> '.$result[$i]['year_level'].'</td>
    			<td colspan = "3"><b>Course:</b>'.$result[$i]['course'].'</td>
  			</tr>
  			<tr>
    			<td colspan="3"><b>Address:</b> '.$result[$i]['up_mail'].'</td>
  			</tr>
  			<tr>
    			<td colspan="2"><b>Phone:</b> '.$result[$i]['contact_num'].'</td>
    			<td colspan="2"><b>Email:</b> '.$result[$i]['up_mail'].'</td>
  			</tr>
  			<tr>
  			<br> 
  				<td colspan="5" rowspan="5"><img src="'.K_PATH_PROFILE_PIC.'/assets/student/form_5/'.$result[$i]['form5'].'" width="350" height="200" align="center"></td>
  			</tr>
		</table> 
				';
				$temp = "";
				$pdf->writeHTML($samplehtml, true, 0, true, 0);
				}	
			}
			
	
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

			$pdf->Output('example_003.pdf', 'I');
			//$pdf->Output('example_003.pdf', 'I');
		}


	}
?>