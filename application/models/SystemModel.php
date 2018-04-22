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
				return $this->getProfileDetails($student_id);
			}
			else 
				return false;
		}

		private function loginOrg($credentials){
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
		public function getProfileDetails($student_id){
				$condition = "sp.student_id = " . $student_id ." AND sa.student_id = " . $student_id;

				$this->db->select('sp.*, sa.username, sa.up_mail');
				$this->db->from('StudentProfile sp, StudentAccount sa');
				$this->db->where($condition);
				$student_profile = $this->db->get();

				$result = $student_profile->result_array()[0];
				$result['account_type'] = 'student'; 
				return  $result;
		}
	}
?>
