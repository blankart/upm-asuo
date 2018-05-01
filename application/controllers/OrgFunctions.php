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
			else if ($action == 'change_password')
				$this->load->view('changepassword');
			else if($action == 'viewFormA')
				$this->viewFormA();
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

			$this->load->view('header');
			$this->load->view('org/org', $data);
			$this->load->view('org/applyforaccreditation');
			$this->load->view('org/createposts');
			$this->load->view('org/editprofile', $org_data);
			$this->load->view('footer');
		}

		private function viewFormA(){
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form A: Accreditation Application", PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
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

// ---------------------------------------------------------

$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form B: Consent of Adviser", PDF_HEADER_STRING);
$pdf->AddPage();

$consent='
<p align="right"><b>Date: </b></p><br><br>
<p align="center"><b>AFFIDAVIT OF CONSENT </b></p><br><br>
<p>I, the undersigned, a full time faculty of _________________________________________ have consented
(college/unit)
to serve as the adviser of _____________________________________ for the Academic Year 2016 to 2017
and will assume full responsibility for the conduct of activities of the organization. I am aware that my consent
is necessary in all of the organization’s activities.</p>
<br>
<br>
<br>
<b>Signature over printed name:</b><br><br>
<b>Department:</b><br><br>
<b>Faculty position and rank:</b><br><br>
<b>Mailing address:</b><br><br>
<b>Telephone number/s:</b><br><br>
<b>Mobile number/s:</b><br><br>
<b>E-mail address</b><br><br>

';
$pdf->writeHTML($consent, true, false, true, false, '');




// ---------------------------------------------------------
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form C: Organization Profile", PDF_HEADER_STRING);
$pdf->AddPage();

$orgProfile ='
<p align="Center"><b>Organization Profile</b></p>
<b>Name of Organization:</b><br>
<b>Acronym:</b><br>
<b>Mailing Address:</b><br>
<b>E-mail Address:</b><br>
<b>Website:</b><br>
<b>Date Established:</b><br>
<b>Total Number of Members:</b><br>
<br>

';

$pdf->writeHTML($orgProfile, true, false, true, false, '');

// ---------------------------------------------------------
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form D: Officer's Profile", PDF_HEADER_STRING);
$pdf->AddPage();

// ---------------------------------------------------------
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form E: Members' Profile", PDF_HEADER_STRING);
$pdf->AddPage();
// ---------------------------------------------------------
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE."\t \t \t \t \t \t  Form F: Financial Report", PDF_HEADER_STRING);
$pdf->AddPage();
// ---------------------------------------------------------
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->SetFont('helvetica', '', 10);

$pdf->AddPage();

$rules='

	<p align="center">
		<h3><b>RULES AND REGULATIONS GOVERNING STUDENT ORGANIZATIONS</b></h3>
		<h4><b>(Please read carefully before signing)</b></h4>
	</p>
	<p>
		1. Only accredited student organizations can schedule activities using UPM facilities.
		<br><br>
2. Every activity using UPM facilities must have an activity permit endorsed by the adviser and approved by the
Director of Student Affairs/OSS/OSR head. Permit to use any UPM facility must be secured three (3) days prior
to the activity.
<br><br>
3. The Director of Student Affairs (for university-based student organizations) or the College Dean/OSS/OSR head
(for college-based organizations) must be informed about the presence of a guest speaker in a symposium,
lecture, forum or conference scheduled by the student organization.
4. The consent of the adviser is required in the organization’s activities, particularly in activities that are scheduled
outside of UPM premises.
<br><br>
5. A letter of information must be submitted to the Director of Student Affairs or the OSS/OSR head if any activity
is cancelled or postponed.
<br><br>
6. The Director of Student Affairs or the OSS/OSR head must be informed of the changes in the set of officers of
the organization or of the amendments in the Constitution and By-Laws of an organization immediately after
these changes are enforced.
<br><br>
7. Ensure the judicious use of UPM facilities such as tambayan and posting boards. The OSA/OSS/OSR can revoke
<br><br>
tambayan and/or posting privileges for any violation of rules.
8. Recruitment of freshmen by fraternities and sororities is strongly prohibited. Violation of this shall subject the
individual member/s or the entire fraternity/sorority to disciplinary sanctions.
<br><br>
9. Student organizations shall not schedule activities during the last week of classes for every semester.
<br><br>
10. Falsification and withholding of pertinent information in the application for accreditation of student
organizations shall mean cancellation of the application and shall subject the officers and members of the
student organization to disciplinary sanctions.

	</p>

';

$pdf->writeHTML($rules, true, false, true, false, '');

$pdf->SetFont('helvetica', '', 10);

$sign='';
//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');



		}
	}
?>