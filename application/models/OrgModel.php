<?php
	class OrgModel extends CI_Model{

		//VIEW PROFILE FUNCTIONS
		public function getOrgProfileDetails($org_id){

			$result['profile']= $this->getOrgDetails($org_id);
			$result['announcements'] = $this->getAnnouncements($org_id);
			$result['members']= $this->getMembers($org_id);
			$result['posts']= $this->getOrgPosts($org_id);
			$result['orgapps'] = $this->getOrgApplications($org_id);
			$result['tally'] = $this->getOrgTally($org_id);

			return $result;
		}

		//viewed by admin
		public function getOrgProfileDetailsByOthers($org_id){
			$result['profile']= $this->getOrgDetails($org_id);
			$result['members']= $this->getMembers($org_id);
			$result['posts']= $this->getOrgPosts($org_id);

			return $result;
		}

		public function getOrgDetails($org_id){
			$condition = "oa.org_id = op.org_id AND op.org_id = " .$org_id;

			$this->db->select("op.*, oa.org_status, oa.org_email");
			$this->db->from("organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$org_details = $this->db->get();

			return $org_details->result_array()[0];
		}

		private function getAnnouncements($org_id){
			$condition = "r.org_id = " .$org_id. " AND a.notice_ID = r.notice_ID AND op.org_id = r.org_id AND a.sender = ad.admin_id AND a.archived = 0";

			$this->db->select("a.*, ad.username, ad.admin_name, op.org_name");
			$this->db->from("announcement a, organizationprofile op, recipient r, admin ad");
			$this->db->order_by('a.notice_id', 'DESC');
			$this->db->where($condition);
			$query = $this->db->get();

			$results = $query->result_array();
			$announcements = array();

			foreach($results as $result){
				$result['content'] = nl2br( $result['content'] );
				array_push($announcements, $result);
			}

			return $announcements;
		}

		public function getMembers($org_id){
			$condition = "op.org_id = om. org_id AND om.org_id = " .$org_id. " AND om.student_id = sa.student_id AND sa.student_id = sp.student_id AND om.isRemoved = 0 AND sa.archived = 0";

			$this->db->select("sp.*, op.org_name, op.acronym, sa.up_mail, sa.username, om.position");
			$this->db->from("orgmember om, organizationprofile op, studentaccount sa, studentprofile sp");
			$this->db->where($condition);
			$this->db->order_by("sp.last_name");
			$members = $this->db->get();

			return $members->result_array();
		}

		private function getOrgPosts($org_id){
			$condition = "opt.org_id = " .$org_id. " AND op.org_id = ".$org_id. " AND opt.archived = 0";

			$this->db->select("opt.*, op.org_name");
			$this->db->from("orgpost opt, organizationprofile op");
			$this->db->where($condition);
			$this->db->order_by('opt.post_id', 'DESC');
			$query = $this->db->get();

			$results = $query->result_array();
			$posts = array();

			foreach($results as $result){
				$result['content'] = nl2br( $result['content'] );
				array_push($posts, $result);
			}

			return $posts;
		}

		private function getOrgApplications($org_id){
			$condition = "oap.student_id = sp.student_id AND oap.student_id = sa.student_id AND op.org_id = oap.org_id AND oap.org_id = ".$org_id. " AND oap.status = 'Pending' AND sa.archived = 0";

			$this->db->select("oap.*, op.org_name, op.acronym, sa.username, sp.first_name, sp.middle_name, sp.last_name, sp.profile_pic, op.org_logo");
			$this->db->from("orgapplication oap, organizationprofile op, studentprofile sp, studentaccount sa");
			$this->db->order_by('sp.last_name');
			$this->db->where($condition);
			$orgapps = $this->db->get();
			return $orgapps->result_array();
		}

		public function getOrgTally($org_id){
			$tally['male_first'] = $this->getTally($org_id, 'Male', '1st Year');
			$tally['female_first'] = $this->getTally($org_id, 'Female', '1st Year');

			$tally['male_second'] = $this->getTally($org_id, 'Male', '2nd Year');
			$tally['female_second'] = $this->getTally($org_id, 'Female', '2nd Year');

			$tally['male_third'] = $this->getTally($org_id, 'Male', '3rd Year');
			$tally['female_third'] = $this->getTally($org_id, 'Female', '3rd Year');

			$tally['male_fourth'] = $this->getTally($org_id, 'Male', '4th Year');
			$tally['female_fourth'] = $this->getTally($org_id, 'Female', '4th Year');

			$tally['male_fifth'] = $this->getTally($org_id, 'Male', '5th Year');
			$tally['female_fifth'] = $this->getTally($org_id, 'Female', '5th Year');

			$tally['male_sixth'] = $this->getTally($org_id, 'Male', '6th Year');
			$tally['female_sixth'] = $this->getTally($org_id, 'Female', '6th Year');

			$tally['male_seventh'] = $this->getTally($org_id, 'Male', '7th Year');
			$tally['female_seventh'] = $this->getTally($org_id, 'Female', '7th Year');

			$tally['male_masteral'] = $this->getTally($org_id, 'Male', 'Masteral');
			$tally['female_masteral'] = $this->getTally($org_id, 'Female', 'Masteral');

			$tally['male_doctoral'] = $this->getTally($org_id, 'Male', 'Doctoral');
			$tally['female_doctoral'] = $this->getTally($org_id, 'Female', 'Doctoral');
			
			return $tally;
		}

		public function getTally($org_id, $sex, $year){
				$condition = "om.org_id  = " .$org_id. " AND om.student_id = sp.student_id AND om.student_id = sa.student_id AND om.isRemoved = 0 AND sp.sex = '".$sex."' AND sp.year_level = '". $year. "' AND sa.archived = 0";

				$this->db->select('sp.student_id');
				$this->db->from('orgmember om, studentprofile sp, studentaccount sa');
				$this->db->where($condition);
				$result = $this->db->get();
				return $result->num_rows();
		}
		//end of VIEW PROFILE FUNCTIONS

		//MEMBERSHIP-RELATED FUNCTIONS
		public function approveMembership($org_id, $student_id){
			//tables: orgmember, orgapplication

			$condition = 'org_id = ' .$org_id. ' AND student_id = ' .$student_id ;

			$changes = array(
				'status' => 'Approved'
			);

			$this->db->where($condition);
			$this->db->update('orgapplication', $changes);
			
			//insert
			$data = array(
				'org_id' => $org_id,
				'student_id' => $student_id,
				'position' => 'Member',
				'isRemoved' => 0
			);

			$this->db->insert('orgmember', $data);
		}

		public function applyToOrganization($student_id,$org_id)
		{
			$toInsert['student_id'] = $student_id;
			$toInsert['org_id'] = $org_id;
			$toInsert['status'] = "Pending";
			$this->db->insert('orgapplication',$toInsert);
			//return "success";
		}

		public function rejectMembership($org_id, $student_id){
			//tables: orgapplicaton

			$condition = 'org_id = ' .$org_id. ' AND student_id = ' .$student_id ;

			$changes = array(
				'status' => 'Rejected'
			);

			$this->db->where($condition);
			$this->db->update('orgapplication', $changes);			
		}

		public function editMembershipPosition($org_id, $student_id, $position){
			//tables: orgmember

			$condition = 'org_id = ' .$org_id. ' AND student_id = ' .$student_id ;
		
			$changes = array(
				'position' => $position
			);

			$this->db->where($condition);
			$this->db->update('orgmember', $changes);	
			
		}

		public function removeMember($org_id, $student_id, $reason){
			//tables: org member, change reason

			$condition = 'org_id = ' .$org_id. ' AND student_id = ' .$student_id. ' AND isRemoved = 0';
		
			$changes = array(
				'isRemoved' => 1,
				'removal_reason' => $reason
			);

			$this->db->where($condition);
			$this->db->update('orgmember', $changes);	
		}

		public function getOrgName($org_id){

			$condition = 'org_id = ' .$org_id. ' AND org_id = ' .$org_id;

			$this->db->select('org_name');
			$this->db->from('organizationprofile');
			$this->db->where($condition);
			$query = $this->db->get();
	
			if($query->num_rows() == 1)
				return $query->result_array()[0]['org_name'];
			else
				return false;		
		}

		public function getStudentUPMail($student_id){

			$condition = 'student_id = ' .$student_id. ' AND student_id = ' .$student_id;

			$this->db->select('up_mail');
			$this->db->from('studentaccount');
			$this->db->where($condition);
			$query = $this->db->get();
	
			if($query->num_rows() == 1)
				return $query->result_array()[0]['up_mail'];
			else
				return false;		
		}

		public function getApplicationStatus($org_id, $student_id)
		{
			//tables: orgapplication
			//return: status
		}
		//end of MEMBERSHIP-RELATED FUNCTIONS

		//EDIT PROFILE FUNCTIONS
		public function editOrgProfile($id, $changes){
			$condition = 'org_id = ' .$id. ' AND org_id = '.$id;

			$this->db->where($condition);
			$this->db->update('organizationprofile', $changes);
		}

		public function changeLogo($id, $logo_name){
			$condition = 'org_id = ' .$id. ' AND org_id = '.$id;

			$changes = array(
            	'org_logo'=> $logo_name
       		);

       		$this->db->where($condition);
       		$this->db->update('organizationprofile', $changes);
		}

		public function uploadConstitution($id, $file_name){
			$condition = 'org_id = ' .$id. ' AND org_id = ' .$id;

			$changes = array(
				'constitution' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("organizationprofile", $changes);
		}
		//end of EDIT PROFILE FUNCTIONS

		//ORG ACCREDITATION FUNCTIONS
		public function getOrgOfficer($org_id)
		{
			$condition = "om.org_id = ".$org_id." AND om.org_id = op.org_id AND om.student_id = sp.student_id AND om.student_id = sa.student_id AND om.isRemoved = 0 AND om.position <> 'Member' AND sa.archived = 0";
			$this->db->select("op.org_name, sp.*, om.*,sa.up_mail");
			$this->db->from("organizationprofile op, studentprofile sp, orgmember om, studentaccount sa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			
			return $org_details->result_array();			
		}

		public function getOrgMembers($org_id)
		{
			$condition = "om.org_id = ".$org_id." AND om.org_id = op.org_id AND om.student_id = sp.student_id AND om.student_id = sa.student_id AND om.isRemoved = 0 AND sa.archived = 0";
			$this->db->select("op.org_name, sp.*, om.*,sa.up_mail");
			$this->db->from("organizationprofile op, studentprofile sp, orgmember om, studentaccount sa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			
			return $org_details->result_array();			
		}

		public function getDBformA($org_id)
		{
			$condition = "aa.org_id = ".$org_id." AND aa.app_id = fa.app_id";
			$this->db->select("fa.*");
			$this->db->from("form_a_details fa, accreditationapplication aa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			if($org_details->num_rows() == 0)
			{
				$result['adviser'] = "";
				$result['adviser_position'] = "";
				$result['adviser_college'] = "";
				$result['contact_person'] = "";
				$result['contact_position'] = "";
				$result['contact_email'] = "";
				$result['contact_address'] = "";
				$result['contact_tel'] = "";
				$result['contact_mobile'] = "";
				$result['contact_other_details'] = "";
				return $result;
			}
			else
			{
				return $org_details->result_array()[0];
			}
			//
		}

		public function getFormAdetails($org_id)
		{

			$data = $this->getOrgDetails($org_id);
			$data['formA'] = $this->getDBformA($org_id);
			$data['tally'] = $this->getOrgTally($org_id);

			return $data;
		}
		//form accreditation
		public function insertFormAdetails($data,$org_id)
		{
			//checker
			//return $data;

			//check if form_a_details has value
			$condition = "fa.app_id = aa.app_id AND aa.org_id = ".$org_id." AND aa.app_id = ".$data['app_id'];
			$this->db->select("fa.*,aa.*");
			$this->db->from("accreditationapplication aa,form_a_details fa");
			$this->db->where($condition);
			$faDetails = $this->db->get();

			//checker
			//return $faDetails->result_array();

			//if form_a_details is empty
			if($faDetails->num_rows() == 0)
			{
				$this->db->insert('form_a_details', $data);
				return "insert success";
			}
			else //else if not empty
			{
				$condition = "app_id = ".$data['app_id'];
				$this->db->where($condition);
				$this->db->update('form_a_details', $data);
				return "update success";
			}

			//return $org_details->result_array()[0];
			//

		}

		public function initAccred($org_id)
		{
			$condition = "org_id = ".$org_id;
			$this->db->select("*");
			$this->db->from("accreditationapplication");
			$this->db->where($condition);
			$aaDetails = $this->db->get();

			if($aaDetails->num_rows() == 0)
			{

				$aaInsert['org_id'] = $org_id;
				$aaInsert['app_status'] = "No Submission";
				$aaInsert['form_A'] = "No Submission";
				$aaInsert['form_B'] = "No Submission";
				$aaInsert['form_C'] = "No Submission";
				$aaInsert['form_D'] = "No Submission";
				$aaInsert['form_E'] = "No Submission";
				$aaInsert['form_F'] = "No Submission";
				$aaInsert['form_G'] = "No Submission";
				$aaInsert['plans'] = "No Submission";
				$this->db->insert('accreditationapplication', $aaInsert);
				/*
				$condition = "org_id = ".$org_id;
				$this->db->select("app_id");
				$this->db->from("accreditationapplication");
				$this->db->where($condition);
				$aaApp_id = $this->db->get();			

				//set user input details to blank
				$result['stay'] = "new";
				$result['app_id'] = $aaApp_id;
				$result['experience'] = "0";
				$result['adviser'] = "";
				$result['adviser_position'] = "";
				$result['adviser_college'] = "";
				$result['contact_person'] = "";
				$result['contact_position'] = "";
				$result['contact_email'] = "";
				$result['contact_address'] = "";
				$result['contact_tel'] = "";
				$result['contact_mobile'] = "";
				$result['contact_other_details'] = "";
				return $result;
				*/
			}

		}

		public function input_formA_details($org_id)
		{
			/*
			//check if has history of application
			$condition = "org_id = ".$org_id;
			$this->db->select("*");
			$this->db->from("accreditationapplication");
			$this->db->where($condition);
			$aaDetails = $this->db->get();

			//if accreditation application is empty
			//if($aaDetails->num_rows() == 0)
			//{
			
				$aaInsert['org_id'] = $org_id;
				$aaInsert['app_status'] = "Pending";
				$aaInsert['form_A'] = "No Submission";
				$aaInsert['form_B'] = "No Submission";
				$aaInsert['form_C'] = "No Submission";
				$aaInsert['form_D'] = "No Submission";
				$aaInsert['form_E'] = "No Submission";
				$aaInsert['form_F'] = "No Submission";
				$aaInsert['form_G'] = "No Submission";
				$aaInsert['plans'] = "No Submission";
				$this->db->insert('accreditationapplication', $aaInsert);
				
				//get app_id from accreditationapplication
				$condition = "org_id = ".$org_id;
				$this->db->select("app_id");
				$this->db->from("accreditationapplication");
				$this->db->where($condition);
				$aaApp_id = $this->db->get();			

				//set user input details to blank
				$result['stay'] = "new";
				$result['app_id'] = $aaApp_id;
				$result['experience'] = "0";
				$result['adviser'] = "";
				$result['adviser_position'] = "";
				$result['adviser_college'] = "";
				$result['contact_person'] = "";
				$result['contact_position'] = "";
				$result['contact_email'] = "";
				$result['contact_address'] = "";
				$result['contact_tel'] = "";
				$result['contact_mobile'] = "";
				$result['contact_other_details'] = "";
				return $result;
			*/
			//}
			//accreditation application is not empty
			//else
			//{
				//get app_id from accreditationapplication
				$condition = "org_id = ".$org_id;
				$this->db->select("app_id");
				$this->db->from("accreditationapplication");
				$this->db->where($condition);
				$aaApp_id = $this->db->get();			

				//check if form_a_details is empty for checking of history application
				$condition = "aa.org_id = ".$org_id." AND aa.app_id = fa.app_id";
				$this->db->select("fa.*");
				$this->db->from("accreditationapplication aa,form_a_details fa");
				$this->db->where($condition);
				$faDetails = $this->db->get();
				//if form_a_details value is empty
				if($faDetails->num_rows() == 0)
				{
					//user input details set to blank
						$result['stay'] = "new";
						$result['app_id'] = $aaApp_id->result_array()[0]['app_id'];
						$result['experience'] = "0";
						$result['adviser'] = "";
						$result['adviser_position'] = "";
						$result['adviser_college'] = "";
						$result['contact_person'] = "";
						$result['contact_position'] = "";
						$result['contact_email'] = "";
						$result['contact_address'] = "";
						$result['contact_tel'] = "";
						$result['contact_mobile'] = "";
						$result['contact_other_details'] = "";
						return $result;
				}
				else //form_a_details value is not empty
				{
					return $faDetails->result_array()[0];		
				}
				

			//}

		}

		public function uploadFormA($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_A' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}
		public function uploadFormB($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_B' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}
		public function uploadFormC($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_C' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}
		public function uploadFormD($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_D' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}
		public function uploadFormE($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_E' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}

		public function uploadFormF($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_F' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);	
		}

		public function uploadFormG($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'form_G' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}

		public function uploadPlans($id, $file_name){
			$condition = 'org_id = ' .$id;

			$changes = array(
				'plans' => $file_name.'.pdf'
			);

			$this->db->where($condition);
			$this->db->update("accreditationapplication", $changes);
		}

		public function getForms($org_id){

			$condition = "op.org_id = aa.org_id AND aa.org_id =". $org_id;

			$this->db->select('aa.*, op.constitution');
			$this->db->from('accreditationapplication aa, organizationprofile op');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1)
				return $query->result_array()[0];
			else
				return false;
		}
		//end of ORG ACCREDITATION FUNCTIONS
//---------------------------------------------END OF ORG ACCREDITATION FUNCTIONS -----------------------------
		//CREATE POST FUNCTION
		public function createPost($post){
			$this->db->insert('orgpost', $post);
			return $this->db->insert_id();
		}
		//end of CREATE POST FUNCTION

		//CHANGE PASSWORD FUNCTIONS
		public function checkOrgPassword($id, $orgpassword){

			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$this->db->select('*');
			$this->db->from('organizationaccount');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->num_rows() == 1){
				$password = $query->result_array()[0]['password'];
				return password_verify($orgpassword, $password);
			}
			else 
				return false;
		}

		public function changeOrgPassword($id, $neworgpassword){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'password' => $neworgpassword
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);		
		}
		//end of CHANGE PASSWORD FUNCTIONS


		// STUDENT-VIEWS-ORG FUNCTIONS

		public function isOrgArchived($org_id){

			$condition = "org_id = " .$org_id. " AND archived = 1";

			$this->db->select('org_id');
			$this->db->from('organizationaccount');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;	
		}

		public function isOrgVerified($org_id){

			$condition = "org_id = " .$org_id. " AND isVerified = 1";

			$this->db->select('org_id');
			$this->db->from('organizationaccount');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;	
		}

		public function isOrgActivated($org_id){

			$condition = "org_id = " .$org_id. " AND isActivated = 1";

			$this->db->select('org_id');
			$this->db->from('organizationaccount');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;	
		}

		public function getOrgId($input){
			$this->db->select('org_id, acronym');
			$this->db->from('OrganizationProfile');
			$query = $this->db->get();
			$acronyms = $query->result_array();
			
			foreach ($acronyms as $acronym) {

				$nsacronym = str_replace(' ', '', $acronym['acronym']);
				$nsinput  = str_replace(' ', '', $input);

				if(strtolower($nsacronym) == strtolower($nsinput))
					return $acronym['org_id'];
			}

			return false;
		}

		public function isMember($org_id, $student_id){
			$condition = "org_id = " .$org_id. " AND student_id = " .$student_id. " AND position = 'Member' AND isRemoved = 0";

			$this->db->select('org_id');
			$this->db->from('orgmember');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;
		}

		public function isOfficer($org_id, $student_id){
			$condition = "org_id = " .$org_id. " AND student_id = " .$student_id. " AND position <> 'Member' AND isRemoved = 0";

			$this->db->select('org_id');
			$this->db->from('orgmember');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;
		}

		public function isApplicant($org_id, $student_id){
			$condition = "org_id = " .$org_id. " AND student_id = " .$student_id. " AND status = 'Pending'";

			$this->db->select('org_id');
			$this->db->from('orgapplication');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;
		}
		// end of STUDENT-VIEWS-ORG FUNCTIONS
	}
?>