<?php
	class StudentModel extends CI_Model{

		// VIEW STUDENT PROFILE  FUNCTIONS
		public function getStudentProfileDetails($student_id){
			$result['profile']= $this->getStudentDetails($student_id);
			$result['orgs'] = $this->getStudentOrgs($student_id);
			$result['orgposts'] = $this->getStudentOrgPosts($student_id);
			$result['applications'] = $this->getStudentOrgApplications($student_id);

			return $result;
		}

		public function getStudentProfileDetailsByOthers($student_id){
			$result['profile']= $this->getStudentDetails($student_id);
			$result['orgs'] = $this->getStudentOrgs($student_id);

			return $result;
		}

		public function getStudentDetails($student_id){
			$condition = "sa.student_id = sp.student_id AND sp.student_id = " .$student_id;

			$this->db->select("sp.*, sa.up_id, sa.username, sa.up_mail");
			$this->db->from("studentprofile sp, studentaccount sa");
			$this->db->where($condition);
			$student_details = $this->db->get();

			return $student_details->result_array()[0];
		}


		private function getStudentOrgs($student_id){
			$condition = "om.student_id = ".$student_id." AND om.org_id = op.org_id AND om.org_id = oa.org_id AND om.isRemoved = 0 AND oa.archived = 0";

			$this->db->select("op.org_id, op.org_name, op.acronym, om.position, op.org_logo, oa.org_email");
			$this->db->from("orgmember om, organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$this->db->order_by("op.org_name");
			$orgs = $this->db->get();

			return $orgs->result_array();
		}

		private function getStudentOrgPosts($student_id){
			$condition = "om.student_id = ".$student_id." AND om.isRemoved = 0";

			$this->db->select("om.org_id, om.position");
			$this->db->from("orgmember om");
			$this->db->where($condition);
			$this->db->order_by("om.org_id");
			$orgs = $this->db->get();

			$orgIDs = $orgs->result_array();

			$orgposts = array();
			foreach ($orgIDs as $orgID){
				$posts = $this->getOrgPosts($orgID['org_id'], $orgID['position']);

				if (!empty($posts)){
					foreach($posts as $post)
						array_push($orgposts, $post);
				}
			}

 			if(!empty($orgposts)){
				foreach($orgposts as $c=>$key) 
			        $date_posted[] = $key['date_posted'];
			    
				array_multisort($date_posted, SORT_DESC, $orgposts);
			}
			
			return $orgposts;
		}

		private function getOrgPosts($org_id, $position = 'Member'){
			$condition = "oa.org_id = op.org_id AND opt.org_id = op.org_id AND opt.org_id = ".$org_id." AND opt.archived = 0 AND oa.archived = 0";

			if($position == 'Member')
				$condition .= " AND opt.privacy <> 'Officers'";
		
			$this->db->select("op.org_name, op.acronym, op.org_logo, opt.*");
			$this->db->from("orgpost opt, organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$this->db->order_by("opt.date_posted");
			$orgposts = $this->db->get();

			return $orgposts->result_array();
		}

		private function getStudentOrgApplications($student_id){
			$condition = "op.org_id = oa.org_id  AND oap.student_id = ".$student_id." AND  oap.org_id = op.org_id AND oap.status ='Pending' AND oa.archived = 0";
			
			$this->db->select("op.org_id, op.org_name, op.acronym, op.org_logo");
			$this->db->from("orgapplication oap, organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$applications = $this->db->get();

			return $applications->result_array();
		}
		// end of VIEW STUDENT PROFILE FUNCTIONS

		//EDIT PROFILE FUNCTION
		public function editStudentProfile($id, $changes){
			$condition = 'student_id = ' .$id. ' AND student_id = '.$id;

			$this->db->where($condition);
			$this->db->update('studentprofile', $changes);
		}

		public function changePicture($id, $picturename){
			$condition = 'student_id = ' .$id. ' AND student_id = '.$id;

			$changes = array(
            	'profile_pic'=> $picturename
       		);

       		$this->db->where($condition);
       		$this->db->update('studentprofile', $changes);
		}

		public function uploadForm5($id, $file_name){
			$condition = 'student_id = ' .$id. ' AND student_id = ' .$id;

			$changes = array(
				'form5' => $file_name
			);

			$this->db->where($condition);
			$this->db->update("studentprofile", $changes);
		}
		// end of EDIT PROFILE FUNCTIONS

		// SEARCH FUNCTIONS
		public function search($searchItem){
			$condition = "(op.org_name LIKE '%" .$searchItem. "%' OR op.acronym LIKE '%" .$searchItem. "%' OR oa.org_email LIKE '%" .$searchItem. "%') AND op.org_id = oa.org_id AND oa.archived = 0  AND oa.isVerified = 1  AND oa.isActivated = 1 ";

			$this->db->select("op.org_id, op.org_name, op.acronym, oa.org_email, op.org_category, op.description, op.org_logo");
			$this->db->distinct();
			$this->db->from("organizationprofile op, organizationaccount oa");
			$this->db->where($condition);
			$query = $this->db->get();
			return $query->result_array();
		}
		// end of SEARCH FUNCTIONS

		//CHANGE PASSWORD FUNCTIONS
		public function checkStudentPassword($id, $orgpassword){
			$condition = "student_id = " .$id. " AND password = '" .$orgpassword. "'";

			$this->db->select('student_id');
			$this->db->from('studentaccount');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
			else 
				return false;
		}

		public function changeStudentPassword($id, $newstudentpassword){
			$condition = "student_id = " .$id. " AND student_id = " .$id;

			$changes = array(
				'password' => $newstudentpassword
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);		
		}
		//end of CHANGE PASSWORD FUNCTIONS

		// ORG-VIEWS-STUDENT FUNCTIONS
		public function getStudentId($input){
			$condition = "username = '" .$input. "' AND username = '" .$input. "'";

			$this->db->select('student_id');
			$this->db->from('studentaccount');
			$this->db->where($condition);
			$query = $this->db->get();
			
			if ($query->num_rows() == 1)
				return $query->result_array()[0]['student_id'];
			else 
				return false;
		}
		// end of ORG-VIEWS-STUDENT FUNCTIONS
	}
?>
