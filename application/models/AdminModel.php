<?php
	class AdminModel extends CI_Model{

		public function sendStudentNotice($data){
			$this->db->insert('student_notice', $data);
			return $this->db->insert_id();
		}

		public function searchStudents($string){
			$condition = "sa.student_id = sp.student_id AND sa.isActivated = 0 AND sa.isVerified = 1 AND (sp.last_name LIKE '%".$string."%' OR sp.first_name LIKE '%".$string."%' OR sa.up_id LIKE '%".$string."%') AND sa.archived = 0"; 
			
			$this->db->select('sa.student_id, sa.up_mail, sa.up_id, sp.first_name, sp.last_name, sp.middle_name');
			$this->db->from('studentaccount sa, studentprofile sp');
			$this->db->order_by('sp.last_name');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function viewStudentInfo($id){
			$condition = "sa.student_id = sp.student_id AND sa.student_id = " .$id;

			$this->db->select('sp.*, sa.student_id, sa.username, sa.up_mail, sa.up_id');
			$this->db->from('studentaccount sa, studentprofile sp');
			$this->db->order_by('sa.student_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function validateStudentAccount($id){
			$condition = "student_id = " .$id. " AND student_id = " .$id;

			$changes = array(
				'isActivated' => 1
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function searchOrganizations($string){
			$condition = "oa.org_id = op.org_id AND oa.isActivated = 0 AND oa.isVerified = 1 AND (oa.org_email LIKE '%".$string."%' or op.org_name LIKE '%".$string."%')";
			
			$this->db->select('oa.org_id, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function viewOrgInfo($id){
			$condition = "oa.org_id = op.org_id AND oa.org_id = " .$id;

			$this->db->select('oa.org_id, oa.org_email, op.*');
			$this->db->from('organizationaccount oa, organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function activateOrgAccount($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'isActivated' => 1
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}
		public function rejectStud($student_id)
		{
			$condition = "student_id = ".$student_id;

			$result['archived'] = 1;

			$this->db->where($condition);
			$this->db->update('studentaccount', $result);
			
		}

		public function searchAllStudents($string){
			$condition = "sa.student_id = sp.student_id AND (sp.last_name LIKE '%".$string."%' OR sp.first_name LIKE '%".$string."%' OR sa.up_id LIKE '%".$string."%')"; 
			
			$this->db->select('sa.student_id, sa.up_mail, sa.up_id, sp.first_name, sp.last_name, sp.middle_name, sa.archived');
			$this->db->from('studentaccount sa, studentprofile sp');
			$this->db->order_by('sp.last_name');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}
/*
		public function changeStudPassword($id, $newstudpassword){
			$condition = "student_id = " .$id. " AND student_id = " .$id;

			$changes = array(
				'password' => $newstudpassword
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}*/

		public function blockStudentAccount($id){
			$condition = "student_id = " .$id. " AND student_id = " .$id;

			$changes = array(
				'archived' => 1
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function unblockStudentAccount($id){
			$condition = "student_id = " .$id. " AND student_id = " .$id;

			$changes = array(
				'archived' => 0
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function searchAllOrganizations($string){
			$condition = "oa.org_id = op.org_id AND oa.isActivated = 1 AND (oa.org_email LIKE '%".$string."%' OR op.org_name LIKE '%".$string."%')";
			
			$this->db->select('oa.org_id, oa.org_status, oa.archived, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('op.org_name');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}
		/*
		public function changeOrgPassword($id, $neworgpassword){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'password' => $neworgpassword
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}*/

		public function blockOrgAccount($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'archived' => 1
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function unblockOrgAccount($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'archived' => 0
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function getAccreditationDocuments($org_id){
			$AY_id = $this->getAcademicYear();
			$condition = "aa.org_id = " .$org_id. " AND aa.org_id = op.org_id AND AY_id = " .$AY_id;

			$this->db->select('aa.*, op.*');
			$this->db->from('accreditationapplication aa, organizationprofile op');
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() == 1)
				return $query->result_array()[0];
			else
				return false;
		}

		public function searchAccredApp($string){

			$AY_id = $this->getAcademicYear();

			$condition = "aa.org_id = oa.org_id AND aa.org_id = op.org_id AND aa.app_status <> 'On Progress' AND op.org_name LIKE '%".$string."%' AND AY_id = " .$AY_id. " AND oa.archived = 0";

			$this->db->select('oa.org_id, op.org_name, oa.org_status, aa.app_status');
			$this->db->from('organizationprofile op, organizationaccount oa, accreditationapplication aa');
			$this->db->order_by('op.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array(); 
		}

		public function accreditOrg($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'org_status' => 'Accredited'
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);

			//Accredited
			$AY_id = $this->getAcademicYear();
			$condition = "org_id = " .$id. " AND AY_id = " .$AY_id;
			$changes = array(
				'app_status' => 'Accredited'
			);

			$this->db->where($condition);
			$this->db->update('accreditationapplication', $changes);
		}

		public function rejectOrg($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'org_status' => 'Rejected'
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);

			//reject
			$AY_id = $this->getAcademicYear();
			$condition = "org_id = " .$id. " AND AY_id = " .$AY_id;
			$changes = array(
				'app_status' => 'Unaccredited'
			);

			$this->db->where($condition);
			$this->db->update('accreditationapplication', $changes);
		}

		public function changeLoginNotice($data){
			$this->db->insert('login_notice', $data);
		}
		//


		public function openAccreditationPeriod($period){
			$AY_id = $this->createAcademicYear();

			if($AY_id != false){
				$period['AY_id'] = $AY_id;
				$this->db->insert('accreditation_period', $period);
				return true;
			}
			else
				return false;
		}

		private function createAcademicYear(){

			$year['year_start'] = date('Y');;
			$year['year_end'] = date('Y', strtotime('+1 year'));

			$condition = "year_start = '" .$year['year_start']."' AND year_end = '" .$year['year_end']. "'";
			
			$this->db->select("*");
			$this->db->from("academicyear");
			$this->db->where($condition);
			$query = $this->db->get();

			if($query->num_rows() > 0)
				return false;
			else{
				$this->db->insert('academicyear', $year);
				return $this->db->insert_id();
			}
		}

		public function getAcademicYear(){

			$this->db->select('*');
			$this->db->from('academicyear');
			$this->db->order_by('AY_id', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get();			

			if($query->num_rows() == 1)
				return $query->result_array()[0]['AY_id'];
			else
				return false;
		}

		public function editAccreditationPeriod($data){
			$AY_id = $this->getAcademicYear();

			if($AY_id != false){
				$condition = 'AY_id = ' .$AY_id;

				$this->db->where($condition);
				$this->db->update('accreditation_period', $data);
				return true;
			}
			else
				return false;
		}


		public function getAccreditationPeriod(){
			$condition = "status = 'Opened'";

			$this->db->select('*');
			$this->db->from('accreditation_period');
			$this->db->where($condition);
			$this->db->order_by('period_id', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get();

			if($query->num_rows() ==  1)
				return $query->result_array()[0];
			else
				return false;
		}

		public function sendNoticeSearch($string){
			$condition = "oa.org_id = op.org_id AND oa.isActivated = 1 AND oa.archived = 0 AND (oa.org_email LIKE '%".$string."%' OR op.org_name LIKE '%".$string."%')";
			
			$this->db->select('oa.org_id, oa.org_status, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('op.org_name');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function createNotice($data){
			$this->db->insert('announcement', $data);
			return $this->db->insert_id();
		}

		public function insertRecipient($data){
			$this->db->insert('recipient', $data);
		}

		public function viewAllNotices($id){
			$condition = "a.archived = 0 AND a.archived = 0";

			$this->db->select('a.notice_id, a.title, a.date_posted');
			$this->db->from('announcement a');
			$this->db->order_by('a.date_posted', 'DESC');
			$this->db->where ($condition);
			$query = $this->db->get();
			$announcements = $query->result_array();

			$result = array();
			foreach($announcements as $announcement){
				$announcement['org_name'] = $this->getRecipients($announcement['notice_id']);
				$announcement['date_posted'] = date("g:i:s a | F j, Y", strtotime($announcement['date_posted']));
				array_push($result, $announcement);
			}
			return $result;
		}

		private function getRecipients($id){
			$condition = "r.notice_id = " .$id. " AND r.org_id = op.org_id";

			$this->db->select('op.org_name');
			$this->db->from('recipient r, organizationprofile op');
			$this->db->order_by('op.org_name');
			$this->db->where ($condition);
			$query = $this->db->get();
			$orgnames = $query->result_array();

			$recipients = array();
			foreach ($orgnames as $orgname) 
				array_push($recipients, $orgname['org_name']);
	
			$recipients = implode('<br>', $recipients);
			return $recipients;
		}

		public function viewMessageDetails($id){
			$condition = "notice_id = " .$id. " AND notice_id = " .$id;

			$this->db->select('title, content, date_posted');
			$this->db->from('announcement');
			$this->db->order_by('notice_id');
			$this->db->where ($condition);
			$query = $this->db->get();

			$details = $query->result_array()[0];
			$details['date_posted'] = date("g:i:s a, F j, Y", strtotime($details['date_posted']));
			$details['content'] = nl2br( $details['content'] );
			return $details;
		}

		public function deleteNotice($id){
			$condition = "notice_id = " .$id. " AND notice_id = " .$id;

			$changes = array(
				'archived' => 1
			);

			$this->db->where($condition);
			$this->db->update('announcement', $changes);
		}

		public function checkAdminPassword($id, $adminpassword){
			$condition = "admin_id = " .$id. " AND admin_id = " .$id;

			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->num_rows() == 1){
				$password = $query->result_array()[0]['password'];
				return password_verify($adminpassword, $password);
			}
			else 
				return false;
		}

		public function changeAdminPassword($id, $newadminpassword){
			$condition = "admin_id = " .$id. " AND admin_id = " .$id;

			$changes = array(
				'password' => $newadminpassword
			);

			$this->db->where($condition);
			$this->db->update('admin', $changes);
		}
	}
?>
