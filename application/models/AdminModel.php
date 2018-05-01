<?php
	class AdminModel extends CI_Model{
				
		public function searchStudents($string){
			$condition = "sa.student_id = sp.student_id AND sa.isActivated = 0 AND sa.isVerified = 1 AND (sp.last_name LIKE '%".$string."%' OR sp.first_name LIKE '%".$string."%' OR sa.up_id LIKE '%".$string."%') "; 
			
			$this->db->select('sa.student_id, sa.up_mail, sa.up_id, sp.first_name, sp.last_name');
			$this->db->from('studentaccount sa, studentprofile sp');
			$this->db->order_by('sp.last_name');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
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

			$this->db->select('oa.org_id, op.org_name, op.acronym, op.org_category, op.description, op.objectives, op.org_website, op.mailing_address, op.date_established');
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

		public function searchAllStudents($string){
			$condition = "sa.student_id = sp.student_id AND (sp.last_name LIKE '%".$string."%' OR sp.first_name LIKE '%".$string."%' OR sa.up_id LIKE '%".$string."%')"; 
			
			$this->db->select('sa.student_id, sa.up_mail, sa.up_id, sp.first_name, sp.last_name');
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
			$this->db->order_by('oa.org_id');
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

		public function searchAccredApp($string){
			$condition = "oa.org_id = op.org_id AND op.org_name LIKE '%".$string."%'";

			$this->db->select('oa.org_id, op.org_name, oa.org_status');
			$this->db->from('organizationprofile op, organizationaccount oa');
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
		}

		public function rejectOrg($id){
			$condition = "org_id = " .$id. " AND org_id = " .$id;

			$changes = array(
				'org_status' => 'Unaccredited'
			);

			$this->db->where($condition);
			$this->db->update('organizationaccount', $changes);
		}
		//

		public function sendNoticeSearch($string){
			$condition = "oa.org_id = op.org_id AND oa.isActivated = 1 AND oa.archived = 0 AND (oa.org_email LIKE '%".$string."%' OR op.org_name LIKE '%".$string."%')";
			
			$this->db->select('oa.org_id, oa.org_status, oa.org_email, op.org_name');
			$this->db->from('organizationaccount oa,organizationprofile op');
			$this->db->order_by('oa.org_id');
			$this->db->where ($condition);

			$query = $this->db->get();
			return  $query->result_array();
		}

		public function sendNotice($org_id, $noticeTitle, $noticeMessage, $noticeDate){
			$add = array(
				'title' => $noticeTitle,
				'content' => $noticeMessage,
				'date_posted' => $noticeDate,
				'recipient' => $org_id
			);

			$this->db->insert('announcement', $add);
		}

		public function sendNoticeToAll($noticeTitle, $noticeMessage, $noticeDate){
			$add = array(
				'title' => $noticeTitle,
				'content' => $noticeMessage,
				'date_posted' => $noticeDate,
				'recipient' => 0
				);

			$this->db->insert('announcement', $add);
		}

		public function viewAllNotices(){
			$condition = "op.org_id = a.recipient AND op.org_id = a.recipient";

			$this->db->select('a.notice_id, a.title, a.date_posted, op.org_name');
			$this->db->from('announcement a, organizationprofile op');
			$this->db->order_by('a.notice_ID');
			$this->db->where ($condition);
			$query = $this->db->get();
			$specificAnnouncements = $query->result_array();

			$condition2 = "a.recipient = 0 AND a.recipient = 0";

			$this->db->select('a.notice_id, a.title, a.date_posted');
			$this->db->from('announcement a');
			$this->db->order_by('a.notice_id');
			$this->db->where ($condition2);
			$query2 = $this->db->get();
			$result2 = $query2->result_array();

			$announcementsToAll = array();
			foreach($result2 as $res){
				$res['org_name'] = 'All Organizations';
				array_push($announcementsToAll, $res);
			}

			$finalresult = array_merge($announcementsToAll, $specificAnnouncements);
			array_multisort($finalresult);
			return $finalresult;
		}

		public function viewMessageDetails($id){
			$condition = "notice_id = " .$id. " AND notice_id = " .$id;

			$this->db->select('title, content, date_posted');
			$this->db->from('announcement');
			$this->db->order_by('notice_id');
			$this->db->where ($condition);
			$query = $this->db->get();
			return  $query->result_array();
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
			$condition = "admin_id = " .$id. " AND password = '" .$adminpassword. "'";

			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where ($condition);

			$query = $this->db->get();

			if ($query->num_rows() == 1)
				return true;
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
