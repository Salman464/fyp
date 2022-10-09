<?php
class TechnicianModel extends CI_Model
{
	function getAllComplaintsCount($technician_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('technician_id', $technician_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllComplaintsCountWithStatus($technician_id, $status)
	{
		$this->db->select('complaint.status');
		$this->db->from('complaint');
		$this->db->where('event_num', 0);
		$this->db->where('status < 3');
		$this->db->where('technician_id', $technician_id);

		if ($status === 3) {
			$this->db->where("complaint.status", $status);
			$this->db->where("complaint_status.remarks", "Resolved");
		} else {
			$this->db->where("complaint.status >=", 1);
			$this->db->where("complaint.status <=", $status);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllComplaintsCountWithRemarks($technician_id, $remarks)
	{
		$this->db->select('complaint.*, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint.complaint_id = complaint_status.complaint_id');
		$this->db->where('technician_id', $technician_id);
		$this->db->where("complaint_status.remarks", $remarks);

		$query = $this->db->get();
		return $query->num_rows();
	}

	function allComplaints($technician_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('technician_id', $technician_id);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function pendingComplaints($technician_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('status <=', 2);
		$this->db->where('technician_id', $technician_id);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function ComplaintswithRemarks($technician_id, $remarks)
	{
		$this->db->select('complaint.*, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint.complaint_id = complaint_status.complaint_id');
		$this->db->where('complaint.status', 3);
		$this->db->where('complaint_status.remarks', $remarks);
		$this->db->where('technician_id', $technician_id);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	public function checkFirstLogin($tid)
	{
		$this->db->select('*');
		$this->db->from('technician');
		$this->db->where('technician_id',$tid);
		$rs = $this->db->get()->row_array();
		return $rs['first_login'] == 0;
	}
	public function notFirstLogin($technician_id)
	{
		$this->db->set('first_login', 1);
		$this->db->where('technician_id', $technician_id);
		$this->db->update('technician');

	}
	public function getOldPass($id)
	{
		$this->db->select('*');
		$this->db->from('technician');
		$this->db->where('technician_id',$id);
		$rs = $this->db->get()->row_array();
		return $rs['password'];
	}
	public function updateNewPass($id,$new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('technician_id', $id);
		return $this->db->update('technician');
	}
}
