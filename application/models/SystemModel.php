<?php
	class SystemModel extends CI_Model{

		public function createStudentAccount($account_data){
			$this->db->insert('StudentAccount', $account_data);
			return $this->db->insert_id();
	    }

	    public function createStudentProfile($profile_details){
	    	$this->db->insert('StudentProfile', $profile_details);
	    }

		public function login($credentials){
			
			$student = $this->loginStudent($credentials);

			if(!$student){
				$org = $this->loginOrg($credentials);

				if(!$org){

					$admin = $this->loginAdmin($credentials);
					return $admin; //returns false if login unsuccessful
				}
				else
					return $org;
			}else
				return $student;
		}

		private function loginStudent($credentials){	
			$condition = "(username = '" . $credentials['username']. "' OR up_mail = '".$credentials['username']."') 
					AND password = '" . $credentials['password']. "'";

			$this->db->select('student_id');
			$this->db->from('StudentAccount');
			$this->db->where($condition);
			$query = $this->db->get();

			//get student profile details for 'myprofile' view 
			if ($query->num_rows() == 1){
				$student_id = $query->result_array()[0]['student_id'];
				return $this->getStudentSessionDetails($student_id);
			}
			else 
				return false;
		}

		private function loginOrg($credentials){
			$condition = "org_email = '" . $credentials['username']. "' 
					AND password = '" . $credentials['password']. "'";

			$this->db->select('org_id');
			$this->db->from('OrganizationAccount');
			$this->db->where($condition);
			$query = $this->db->get();

			//get org profile details for 'org' view 
			if ($query->num_rows() == 1){
				$org_id = $query->result_array()[0]['org_id'];
				return $this->getOrgSessionDetails($org_id);
			}
			else
				return false;
		}

		private function loginAdmin($credentials){
			$condition = "username = '" . $credentials['username']. "' AND password = '" . $credentials['password']. "'";

			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() == 1){
				$result = $query->result_array()[0];
				$result['account_type'] = 'admin'; 
				return $result;
			}
			else 
				return false;
		}

		/*
		*@func Retrieves student profile details 
		*@return student profile details including 'username'  and up_mail
		*/
		public function getStudentSessionDetails($student_id){
			$condition = "sp.student_id = " . $student_id ." AND sa.student_id = " . $student_id;

			$this->db->select('sp.student_id, sa.first_name, sa.username, sa.up_mail');
			$this->db->from('StudentProfile sp, StudentAccount sa');
			$this->db->where($condition);
			$student_profile = $this->db->get();

			$result = $student_profile->result_array()[0];
			$result['account_type'] = 'student'; 
			return  $result;
		}

		public function getOrgSessionDetails($org_id){
			$condition = "op.org_id = " . $org_id ." AND oa.org_id = " . $org_id;

			$this->db->select('op.org_id, op.org_name, op.acronym, oa.org_email');
			$this->db->from('OrganizationProfile op, OrganizationAccount oa');
			$this->db->where($condition);
			$org_profile = $this->db->get();

			$result = $org_profile->result_array()[0];
			$result['account_type'] = 'org'; 
			return  $result;
		}
	}
?>
