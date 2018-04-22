<?php
	class AdminModel extends CI_Model{
		//
		public function searchAccredApp($string){
			$condition = "aa.org_name LIKE '%".$string."%'";

			$this->db->select('aa.org_id, aa.org_name,');
			$this->db->from('accreditationapps aa');
			$this->db->order_by('aa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
			
		}

		public function accreditOrg($id){
			$condition = "org_id = " .$id;

			$changes = array(
				'org_status' => 'Accredited'
			);

			$this->db->where($condition);
			$this->db->update('accreditationapps', $changes);
		}

		public function rejectOrg($id){
			$condition = "org_id = " .$id;

			$changes = array(
				'org_status' => 'Unaccredited'
			);

			$this->db->where($condition);
			$this->db->update('accreditationapps', $changes);
		}
		//
		
		public function searchStudents($string){
			if ($string == "")
			{
				$condition = "isActivated = 0 AND isVerified = 1";
			}
			else{
				$condition = "isActivated = 0 AND isVerified = 1 AND up_mail LIKE '%".$string."%'";
			}
			$this->db->select('student_id, up_mail, up_id');
			$this->db->from('studentaccount');
			$this->db->order_by('student_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function searchAllStudents($string){
			if ($string == "")
			{
				$condition = "isVerified = 1";
			}
			else{
				$condition = "up_mail LIKE '%".$string."%'";
			}
			$this->db->select('archived, student_id, up_mail, up_id');
			$this->db->from('studentaccount');
			$this->db->order_by('student_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function searchAllOrganizations($string){
			if ($string == "")
			{
				$condition = "oa.org_id = op.org_id AND oa.isVerified = 1";
			}
			else{
				$condition = "oa.org_id = op.org_id AND oa.isVerified = 1 AND oa.org_email LIKE '%".$string."%'";
			}
			$this->db->select('oa.org_id, oa.org_status, oa.archived, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function sendNoticeSearch($string){
			if ($string == "")
			{
				$condition = "oa.org_id = op.org_id AND oa.isVerified = 1 AND oa.isActivated = 1 AND oa.archived = 0";
			}
			else{
				$condition = "oa.org_id = op.org_id AND oa.isVerified = 1 AND oa.isActivated = 1 AND oa.archived = 0 AND oa.org_email LIKE '%".$string."%'";
			}
			$this->db->select('oa.org_id, oa.org_status, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function viewAllNotices(){
			$condition = "op.org_id = a.recipients";
			$this->db->select('a.notice_id, a.title, a.recipients, a.date_posted, op.org_name');
			$this->db->from('announcements a, organizationprofile op');
			$this->db->order_by('a.date_posted','desc');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}


		public function searchOrganizations($string){
			if ($string == "")
			{
				$condition = "oa.org_id = op.org_id AND oa.isActivated = 0 AND oa.isVerified = 1";
			}
			else{
				$condition = "oa.org_id = op.org_id AND oa.isActivated = 0 AND oa.isVerified = 1 AND oa.org_email LIKE '%".$string."%'";
			}
			$this->db->select('oa.org_id, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function validateStudentAccount($id){

			$condition = "student_id = " .$id;

			$changes = array(
				'isActivated' => 1
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function sendNotice($id, $noticeTitle, $noticeMessage, $noticeDate){
			$add = array(
				'title' => $noticeTitle,
				'content' => $noticeMessage,
				'date_posted' => $noticeDate,
				'recipients' => $id
			);

			$this->db->insert('announcements', $add);
		}

		public function sendNoticeToAll($noticeTitle, $noticeMessage, $noticeDate){
			$condition = "isVerified = 1 AND isActivated = 1 AND archived = 0";
			$this->db->select('org_id');
			$this->db->from('organizationaccount');
			$this->db->where($condition);
			$query = $this->db->get();
			foreach ($query->result_array() as $data)
			{
				$add = array(
				'title' => $noticeTitle,
				'content' => $noticeMessage,
				'date_posted' => $noticeDate,
				'recipients' => $data['org_id']
				);

				$this->db->insert('announcements', $add);
			}	
		}

		public function activateOrgAccount($id){

			$condition = "org_id = " .$id;

			$changes = array(
				'isActivated' => 1
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function viewStudentInfo($id){
			$condition = "sa.student_id = sp.student_id AND sa.student_id = " .$id;

			$this->db->select('sa.student_id, sa.up_mail, sa.up_id, sp.first_name, sp.middle_name, sp.last_name, sp.course, sp.contact_num');
			$this->db->from('studentaccount sa, studentprofile sp');
			$this->db->order_by('sa.student_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function viewMessageDetails($id){
			$condition = "notice_id = " .$id;

			$this->db->select('title, content, date_posted');
			$this->db->from('announcements');
			$this->db->order_by('notice_id');
			$this->db->where ($condition);
			$query = $this->db->get();
			return  $query->result_array();
		}

		public function viewOrgInfo($id){
			$condition = "oa.org_id = op.org_id AND oa.org_id = " .$id;

			$this->db->select('oa.org_id, op.org_name, op.acronym, op.org_category, op.description, op.objectives, op.org_website, op.mailing_address, op.date_established');
			$this->db->from('organizationaccount oa, organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function changeStudPassword($id, $newstudpassword){
			$condition = "student_id = " .$id;

			$changes = array(
				'password' => md5($newstudpassword)
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function changeAdminPassword($id, $newadminpassword){
			$condition = "admin_id = " .$id;

			$changes = array(
				'password' => md5($newadminpassword)
			);

			$this->db->where($condition);
			$this->db->update('admin', $changes);
		}


		public function changeOrgPassword($id, $neworgpassword){
			$condition = "org_id = " .$id;

			$changes = array(
				'password' => md5($neworgpassword)
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function blockStudentAccount($id){

			$condition = "student_id = " .$id;

			$changes = array(
				'archived' => 1
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function blockOrgAccount($id){

			$condition = "org_id = " .$id;

			$changes = array(
				'archived' => 1
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function unblockStudentAccount($id){

			$condition = "student_id = " .$id;

			$changes = array(
				'archived' => 0
			);

			$this->db->where($condition);
			$this->db->update('studentaccount', $changes);
		}

		public function unblockOrgAccount($id){

			$condition = "org_id = " .$id;

			$changes = array(
				'archived' => 0
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}

		public function checkAdminPassword($id, $adminpassword){

			$condition = "admin_id = " .$id;

			$this->db->select('password');
			$this->db->from('admin');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->result_array()[0]['password'] == md5($adminpassword))
			{
				return true;
			} 
			else return false;
		}

	}
?>
