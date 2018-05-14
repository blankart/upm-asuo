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
			$this->db->where($condition);
			$announcements = $this->db->get();

			return $announcements->result_array();
		}

		public function getMembers($org_id){
			$condition = "om.org_id = " .$org_id. " AND om.student_id = sa.student_id AND sa.student_id = sp.student_id AND om.isRemoved = 0";

			$this->db->select("sp.*, sa.up_mail, om.position");
			$this->db->from("orgmember om, studentaccount sa, studentprofile sp");
			$this->db->order_by("sp.last_name");
			$this->db->where($condition);
			$members = $this->db->get();

			return $members->result_array();
		}

		private function getOrgPosts($org_id){
			$condition = "opt.org_id = " .$org_id. " AND op.org_id = ".$org_id. " AND opt.archived = 0";

			$this->db->select("opt.*, op.org_name");
			$this->db->from("orgpost opt, organizationprofile op");
			$this->db->where($condition);
			$posts = $this->db->get();
			return $posts->result_array();
		}

		private function getOrgApplications($org_id){
			$condition = "oap.student_id = sp.student_id AND op.org_id = oap.org_id AND oap.org_id = ".$org_id. " AND oap.status <> 'Approved'";

			$this->db->select("oap.*, op.org_name, sp.first_name, sp.middle_name, sp.last_name, sp.profile_pic");
			$this->db->from("orgapplication oap, organizationprofile op, studentprofile sp");
			$this->db->where($condition);
			$orgapps = $this->db->get();
			return $orgapps->result_array();
		}

		public function getOrgTally($org_id){
			$tally['male_first'] = $this->getTally($org_id, 'Male', '1');
			$tally['female_first'] = $this->getTally($org_id, 'Female', '1');

			$tally['male_second'] = $this->getTally($org_id, 'Male', '2');
			$tally['female_second'] = $this->getTally($org_id, 'Female', '2');

			$tally['male_third'] = $this->getTally($org_id, 'Male', '3');
			$tally['female_third'] = $this->getTally($org_id, 'Female', '3');

			$tally['male_fourth'] = $this->getTally($org_id, 'Male', '4');
			$tally['female_fourth'] = $this->getTally($org_id, 'Female', '4');

			$tally['male_fifth'] = $this->getTally($org_id, 'Male', '5');
			$tally['female_fifth'] = $this->getTally($org_id, 'Female', '5');

			$tally['male_sixth'] = $this->getTally($org_id, 'Male', '6');
			$tally['female_sixth'] = $this->getTally($org_id, 'Female', '6');

			$tally['male_seventh'] = $this->getTally($org_id, 'Male', '7');
			$tally['female_seventh'] = $this->getTally($org_id, 'Female', '7');

			$tally['male_masteral'] = $this->getTally($org_id, 'Male', 'Masteral');
			$tally['female_masteral'] = $this->getTally($org_id, 'Female', 'Masteral');

			$tally['male_doctoral'] = $this->getTally($org_id, 'Male', 'Doctoral');
			$tally['female_doctoral'] = $this->getTally($org_id, 'Female', 'Doctoral');
			
			return $tally;
		}

		public function getTally($org_id, $sex, $year){
				$condition = "om.org_id  = " .$org_id. " AND om.student_id = sp.student_id AND om.isRemoved = 0 AND sp.sex = '".$sex."' AND sp.year_level = '". $year. "'";

				$this->db->select('sp.student_id');
				$this->db->from('orgmember om, studentprofile sp');
				$this->db->where($condition);
				$result = $this->db->get();
				return $result->num_rows();
		}
		//end of VIEW PROFILE FUNCTIONS

		//MEMBERSHIP-RELATED FUNCTIONS
		public function approveMembership($org_id, $student_id)
		{
			//tables: orgmember, orgapplication
		}

		public function disapproveMembership($org_id, $student_id)
		{
			//tables: orgmember, orgapplicaton
		}

		public function editMembership($org_id, $student_id, $positon)
		{
			//tables: orgmember
		}

		public function removeMembership($org_id, $student_id)
		{
			//tables: org member
			//note: change position to 'Member' too
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
				'constitution' => $file_name
			);

			$this->db->where($condition);
			$this->db->update("organizationprofile", $changes);
		}
		//end of EDIT PROFILE FUNCTIONS

		//ORG ACCREDITATION FUNCTIONS
		public function getOrgOfficer($org_id)
		{
			$condition = "om.org_id = ".$org_id." AND om.org_id = op.org_id AND om.student_id = sp.student_id AND om.student_id = sa.student_id AND om.isRemoved = 0 AND om.position <> 'Member'";
			$this->db->select("op.org_name, sp.*, om.*,sa.up_mail,");
			$this->db->from("organizationprofile op, studentprofile sp, orgmember om, studentaccount sa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			
			return $org_details->result_array();			
		}

		public function getOrgMembers($org_id)
		{
			$condition = "om.org_id = ".$org_id." AND om.org_id = op.org_id AND om.student_id = sp.student_id AND om.student_id = sa.student_id AND om.isRemoved = 0";
			$this->db->select("op.org_name, sp.*, om.*,sa.up_mail,");
			$this->db->from("organizationprofile op, studentprofile sp, orgmember om, studentaccount sa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			
			return $org_details->result_array();			
		}
		//end of ORG ACCREDITATION FUNCTIONS

		//CREATE POST FUNCTION
		public function createPost($post){
			$this->db->insert('orgpost', $post);
			return $this->db->insert_id();
		}
		//end of CREATE POST FUNCTION

		//CHANGE PASSWORD FUNCTIONS
		public function checkOrgPassword($id, $orgpassword){
			$condition = "org_id = " .$id. " AND password = '" .$orgpassword. "'";

			$this->db->select('org_id');
			$this->db->from('organizationaccount');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
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
			$condition = "org_id = " .$org_id. " AND student_id = " .$student_id. " AND isRemoved = 0";

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
			$condition = "org_id = " .$org_id. " AND student_id = " .$student_id. " AND isRemoved = 0";

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