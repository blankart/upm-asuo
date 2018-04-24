<?php
	class OrgModel extends CI_Model{

		public function getOrgProfileDetails($org_id){

			$result['profile']= $this->getOrgDetails($org_id);
			$result['announcements'] = $this->getAnnouncements($org_id);
			$result['members']= $this->getMembers($org_id);
			$result['posts']= $this->getOrgPosts($org_id);
			$result['orgapps'] = $this->getOrgApplications($org_id);

			return $result;
		}

		private function getOrgDetails($org_id){
			$condition = "oa.org_id = op.org_id AND op.org_id = " .$org_id;

			$this->db->select("op.*, oa.org_status");
			$this->db->from("organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$org_details = $this->db->get();

			return $org_details->result_array()[0];
		}

		private function getAnnouncements($org_id){
			$condition = "a.recipient = " .$org_id. " AND a.recipient = op.org_id AND a.sender = ad.admin_id";

			$this->db->select("a.*, ad.username, op.org_name");
			$this->db->from("announcement a, admin ad, organizationprofile op");
			$this->db->where($condition);
			$announcements = $this->db->get();

			return $announcements->result_array();
		}

		private function getMembers($org_id){
			$condition = "om.org_id = " .$org_id. " AND om.student_id = sa.student_id AND sa.student_id = sp.student_id";

			$this->db->select("sp.*, sa.up_mail, om.position");
			$this->db->from("orgmember om, studentaccount sa, studentprofile sp");
			$this->db->where($condition);
			$members = $this->db->get();

			return $members->result_array();
		}


		private function getOrgPosts($org_id){
			$condition = "opt.org_id = " .$org_id. " AND op.org_id = ".$org_id;

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
	}
?>
