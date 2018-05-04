<?php
	class OrgModel extends CI_Model{

		public function getOrgProfileDetails($org_id){

			$result['profile']= $this->getOrgDetails($org_id);
			$result['announcements'] = $this->getAnnouncements($org_id);
			$result['members']= $this->getMembers($org_id);
			$result['posts']= $this->getOrgPosts($org_id);
			$result['orgapps'] = $this->getOrgApplications($org_id);
			$result['tally'] = $this->getOrgTally($org_id);

			return $result;
		}
		public function getOrgOfficer()
		{
			$condition = "om.org_id = op.org_id AND om.student_id = sp.student_id AND om.student_id = sa.student_id";
			$this->db->select("op.*, sp.*, om.*,sa.*");
			$this->db->from("organizationprofile op, studentprofile sp, orgmember om, studentaccount sa");
			$this->db->where($condition);
			$org_details = $this->db->get();
			
			return $org_details->result_array();			
		}

		private function getOrgDetails($org_id){
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

		private function getMembers($org_id){
			$condition = "om.org_id = " .$org_id. " AND om.student_id = sa.student_id AND sa.student_id = sp.student_id AND om.isRemoved = 0";

			$this->db->select("sp.*, sa.up_mail, om.position");
			$this->db->from("orgmember om, studentaccount sa, studentprofile sp");
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

			$this->db->select("oap.*, op.org_name, sp.first_name, sp.middle_name, sp.last_name");
			$this->db->from("orgapplication oap, organizationprofile op, studentprofile sp");
			$this->db->where($condition);
			$orgapps = $this->db->get();
			return $orgapps->result_array();
		}

		private function getOrgTally($org_id){
			$tally['male_first'] = $this->getTally($org_id, 'Male', 1);
			$tally['female_first'] = $this->getTally($org_id, 'Female', 1);

			$tally['male_second'] = $this->getTally($org_id, 'Male', 2);
			$tally['female_second'] = $this->getTally($org_id, 'Female', 2);

			$tally['male_third'] = $this->getTally($org_id, 'Male', 3);
			$tally['female_third'] = $this->getTally($org_id, 'Female', 3);

			$tally['male_fourth'] = $this->getTally($org_id, 'Male', 4);
			$tally['female_fourth'] = $this->getTally($org_id, 'Female', 4);

			$tally['male_masteral'] = 0;
			$tally['female_masteral'] = 0;

			$tally['male_doctoral'] = 0;
			$tally['female_doctoral'] = 0;
			
			return $tally;
		}

		private function getTally($org_id, $sex, $year){
				$condition = "om.org_id  = " .$org_id. " AND om.student_id = sp.student_id AND om.isRemoved = 0 AND sp.sex = '".$sex."' AND sp.year_level = ". $year. "";

				$this->db->select('sp.student_id');
				$this->db->from('orgmember om, studentprofile sp');
				$this->db->where($condition);
				$result = $this->db->get();
				return $result->num_rows();
		}

		public function editOrgProfile($id, $changes){
			$condition = 'org_id = ' .$id. ' AND org_id = '.$id;

			$this->db->where($condition);
			$this->db->update('organizationprofile', $changes);
		}

		public function checkOrgPassword($id, $orgpassword){
			$condition = "org_id = " .$id. " AND password = '" .$orgpassword. "'";

			$this->db->select('*');
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
	}
?>