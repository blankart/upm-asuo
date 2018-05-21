<?php
	class SystemModel extends CI_Model{

		//REGISTER FUNCTIONS

		// STUDENT
		public function validateStudentUPMail($up_mail){
			$condition = "up_mail = '" . $up_mail."' AND up_mail = '" . $up_mail."'";

			$this->db->select('student_id');
			$this->db->from('studentaccount');
			$this->db->where($condition);
			$query = $this->db->get();

			$result = $query->num_rows();
			if($result == 1)
				return true;
			else
				return false;
		}

		public function createStudentAccount($account_data){
			$this->db->insert('StudentAccount', $account_data);
			return $this->db->insert_id();
	    }

	    public function createStudentProfile($profile_details){
	    	$this->db->insert('StudentProfile', $profile_details);
	    	return $this->getStudentSessionDetails($profile_details['student_id']);
	    }

	    // ORG
		public function validateOrgEmail($org_email)
		{
			$takenByAnotherOrg = $this->checkOrgEmailCollisions($org_email);
			if($takenByAnotherOrg)
				return true;
			else
				return $this->validateStudentUPMail($org_email); //checks if email is taken by student
		}

		private function checkOrgEmailCollisions($org_email){
			$condition = "org_email = '" .$org_email."' AND org_email = '" .$org_email."'";
			$this->db->select('*');
			$this->db->from('OrganizationAccount');
			$this->db->where($condition);
			$emailReturned = $this->db->get();

			$result = $emailReturned->num_rows();
			if($result == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}


		public function validateOrgAcronym($org_acronym)
		{
			if(!$this->checkRestrictedDB($org_acronym))
			{
				if(!$this->checkOrgDB($org_acronym))
				{
					if(!$this->checkStudDB($org_acronym))
					{
						return false;
					}
					else
					{
						return true;
					}
				}
				else
				{
					return true;
					//return $this->checkOrgDB($org_acronym);
				}
			}
			else
			{
				return true;
			}

		}
		public function checkRestrictedDB($org_acronym)
		{

			$condition = "acronym = '" . $org_acronym."'" ;
			$this->db->select('*');
			$this->db->from('restrictedacronym');
			$this->db->where($condition);
			$acronymReturned = $this->db->get();
			$result = $acronymReturned->num_rows();

			if($result == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function checkOrgDB($org_acronym)
		{
			//$condition = "acronym = '". $org_acronym."'";
			$this->db->select('acronym');
			$this->db->from('OrganizationProfile');
			//$this->db->where($condition);
			$acronymReturned = $this->db->get();
			//var_dump($acronymReturned);
			$acronyms = $acronymReturned->result_array();
			
			foreach ($acronyms as $acronym) {
				# code...
				$nsacronym = str_replace(' ', '', $acronym['acronym']);
				$nsorg_acronym  = str_replace(' ', '', $org_acronym);
				if(strtolower($nsorg_acronym) == strtolower($nsacronym))
				{
					return true;
				}
			}

			return false;
		}

		public function checkStudDB($org_acronym)
		{
			$condition = "username = '".$org_acronym."'";
			$this->db->select('*');
			$this->db->from('StudentAccount');
			$this->db->where($condition);
			$acronymReturned = $this->db->get();
			$result = $acronymReturned->num_rows();

			if($result == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

	    public function createOrgAccount($account_data)
	    {
	    	$this->db->insert('OrganizationAccount', $account_data);
	    	return $this->db->insert_id();	
	    }

	    public function createOrgProfile($profile_details)
	    {
	    	$this->db->insert('OrganizationProfile', $profile_details);
	    	return $this->getOrgSessionDetails($profile_details['org_id']);
	    }
	    // end of REGISTER FUNCTIONS

	    // VERIFICATION FUNCTIONS

	    public function getStudentEmail($student_id){

	    	$condition = "student_id =" .$student_id. " AND student_id = " .$student_id; 

	    	$this->db->select('up_mail');
	    	$this->db->from('studentaccount');
	    	$this->db->where($condition);
	    	$query = $this->db->get();

	    	if($query->num_rows() == 1)
	    		return $query->result_array()[0]['up_mail'];
	    	else
	    		return false;

	    }

	    public function getOrgEmail($org_id){

	    	$condition = "org_id =" .$org_id. " AND org_id = " .$org_id; 

	    	$this->db->select('org_email');
	    	$this->db->from('OrganizationAccount');
	    	$this->db->where($condition);
	    	$query = $this->db->get();

	    	if($query->num_rows() == 1)
	    		return $query->result_array()[0]['org_email'];
	    	else
	    		return false;
	    }

		public function createVerificationCode($data){
			$this->db->insert('verificationcode', $data);
			return $this->db->insert_id();	
		}

		public function getVerificationCode($type, $user_id){
			$condition = "type = '" .$type. "' AND user_id = " .$user_id. " AND status = 'Pending'"; 

			$this->db->select('code');
			$this->db->from('verificationcode');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1){
				return $query->result_array()[0]['code'];
			}
			else
				return false;
		}

		public function updateVerificationCode($type, $user_id, $new_code){

			$condition = "type ='" .$type. "' AND user_id = " .$user_id. " AND status = 'Pending'";

			$changes = array(
				'code' => $new_code
			);

			$this->db->where($condition);
			$this->db->update('verificationcode', $changes);
			return $this->db->affected_rows();
		}

		public function verifyStudentAccount($code){

			$condition = "code = '" .$code. "' AND type = 'student' AND status = 'Pending'";

			$this->db->select('user_id, code_id');
			$this->db->from('verificationcode');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1){
				$student_id = $query->result_array()[0]['user_id'];
				$code_id = $query->result_array()[0]['code_id'];
				$this->useVerificationCode($code_id);

				$condition2 = "student_id = " .$student_id. " AND student_id = " .$student_id;

				$changes = array(
					'isVerified' => 1
				);

				$this->db->where($condition2);
				return  $this->db->update('studentaccount', $changes);
			}
			else 
				return false;
		}

		public function verifyOrgAccount($code){

			$condition = "code = '" .$code. "' AND type = 'org' AND status = 'Pending'";

			$this->db->select('user_id, code_id');
			$this->db->from('verificationcode');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1){
				$org_id = $query->result_array()[0]['user_id'];
				$code_id = $query->result_array()[0]['code_id'];
				$this->useVerificationCode($code_id);

				$condition2 = "org_id = " .$org_id. " AND org_id = " .$org_id;

				$changes = array(
					'isVerified' => 1
				);

				$this->db->where($condition2);
				return  $this->db->update('OrganizationAccount', $changes);
			}
			else 
				return false;
		}

		private function useVerificationCode($code_id){
			$condition = "code_id = " .$code_id. " AND code_id = ".$code_id;

			$changes = array(
				'status' => 'Verified'
			);

			$this->db->where($condition);
			$this->db->update('verificationcode', $changes);
		}
		// end of VERIFICATION FUNCTIONS

		// FORGOT PASSWORD FUNCTIONS

		public function updateNewPassword($email, $password){

			$changes = array(
				'password' => $password
			);

			$condition = "up_mail = '" .$email. "' AND up_mail = '" .$email. "'";

			$this->db->select('student_id');
			$this->db->from('studentaccount');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1){
				$this->db->where($condition);
				$this->db->update('studentaccount', $changes);
				return true;
			}
			else{

				$condition = "org_email = '" .$email. "' AND org_email = '" .$email. "'";
				$this->db->select('org_id');
				$this->db->from('OrganizationAccount');
				$this->db->where($condition);
				$query = $this->db->get();

				if($query->num_rows() == 1){
					$this->db->where($condition);
					$this->db->update('OrganizationAccount', $changes);
					return true;
				}
				else
					return false;
			}
		}

		// end of FORGOT PASSWORD FUNCTIONS

	    // LOGIN FUNCTIONS
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

			$condition = "(up_mail = '" . $credentials['username']. "' OR username = '" . $credentials['username']. "') AND ".
			"(up_mail = '" . $credentials['username']. "' OR username = '" . $credentials['username']. "')";

			$this->db->select('student_id, password, isVerified, isActivated, archived');
			$this->db->from('studentaccount');
			$this->db->where($condition);
			$query = $this->db->get();
			
			if(!password_verify($credentials['password'],$query->result_array()[0]['password']))
				return false;

			//get student profile details for 'myprofile' view 
			
			$student_id = $query->result_array()[0]['student_id'];
			$sessionDetails = $this->getStudentSessionDetails($student_id);

			$isActivated = $query->result_array()[0]['isActivated'];
			if($isActivated == 0)
				$sessionDetails['account_type'] = 'unactivatedStudent';

			$isVerified = $query->result_array()[0]['isVerified'];
			if($isVerified == 0)
				$sessionDetails['account_type'] = 'unverifiedStudent';

			$archived = $query->result_array()[0]['archived'];
			if($archived == 1)
				$sessionDetails['account_type'] = 'archivedStudent';

			return $sessionDetails;
		}

		private function loginOrg($credentials){
			$condition = "org_email = '" . $credentials['username']. "' AND org_email = '" . $credentials['username']. "'";

			$this->db->select('org_id, password, isVerified, isActivated, archived');
			$this->db->from('OrganizationAccount');
			$this->db->where($condition);
			$query = $this->db->get();
			
			if(!password_verify($credentials['password'],$query->result_array()[0]['password']))
				return false;
	
			//get org profile details for 'org' view 
	
			$org_id = $query->result_array()[0]['org_id'];
			$sessionDetails = $this->getOrgSessionDetails($org_id);

			$isActivated = $query->result_array()[0]['isActivated'];
			if($isActivated == 0)
				$sessionDetails['account_type'] = 'unactivatedOrg';

			$isVerified = $query->result_array()[0]['isVerified'];
			if($isVerified == 0)
				$sessionDetails['account_type'] = 'unverifiedOrg';

			$archived = $query->result_array()[0]['archived'];
			if($archived == 1)
				$sessionDetails['account_type'] = 'archivedOrg';

			return $sessionDetails;
		}

		private function loginAdmin($credentials){
			
			$condition = "admin_email = '" . $credentials['username']. "'";
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($condition);
			$query = $this->db->get();

			if(password_verify($credentials['password'],$query->result_array()[0]['password'])){
				$result = $query->result_array()[0];
				$result['account_type'] = 'admin'; 
				return $result;
			}
		/*	$condition = "admin_email = '" . $credentials['username']. "' AND password = '" . $credentials['password']. "'";

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
				return false;*/
		}

		/*
		*@func Retrieves student profile details 
		*@return student profile details including 'username'  and up_mail
		*/
		public function getStudentSessionDetails($student_id){
			$condition = "sp.student_id = " . $student_id ." AND sa.student_id = " . $student_id;

			$this->db->select('sp.student_id, sp.first_name, sa.username, sa.up_mail, sp.profile_pic');
			$this->db->from('StudentProfile sp, StudentAccount sa');
			$this->db->where($condition);
			$student_profile = $this->db->get();

			$result = $student_profile->result_array()[0];
			$result['account_type'] = 'student'; 
			return  $result;
		}

		public function getOrgSessionDetails($org_id){
			$condition = "op.org_id = " . $org_id ." AND oa.org_id = " . $org_id;

			$this->db->select('op.org_id, op.org_name, op.acronym, oa.org_email, op.org_logo');
			$this->db->from('OrganizationProfile op, OrganizationAccount oa');
			$this->db->where($condition);
			$org_profile = $this->db->get();

			$result = $org_profile->result_array()[0];
			$result['account_type'] = 'org'; 
			return  $result;
		}
		// end of LOGIN FUNCTIONS
	}
?>
