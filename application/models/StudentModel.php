<?php
	class StudentModel extends CI_Model{

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
	}
?>
