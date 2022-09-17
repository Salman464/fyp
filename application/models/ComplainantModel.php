<?php
class ComplainantModel extends CI_Model
{
	function allComplaints($user_id) {
		$this->db->select('complaint.*, department.dept_name');
		$this->db->from('complaint');
		$this->db->join('department', 'complaint.department_id = department.id');
		$this->db->where('complaint.user_id', $user_id);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function allComplaintsWithStatus($user_id, $status) {
		$this->db->select('complaint.*, department.dept_name');
		$this->db->from('complaint');
		$this->db->join('department', 'complaint.department_id = department.id');
		$this->db->where('complaint.user_id', $user_id);
		$this->db->where('complaint.status', $status);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function allComplaintsWithRemarks($user_id, $remarks) {
		$this->db->select('complaint.*, department.dept_name, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->join('department', 'complaint.department_id = department.id');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint.user_id', $user_id);
		$this->db->where('complaint.status', 3);
		$this->db->where('complaint_status.remarks', $remarks);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function getAssetDetails($complaint_id)
	{
		$this->db->select('complaint.*, asset.asset_id ,asset.name as aname, asset.details, asset.quantity, asset.status');
		$this->db->from('complaint');
		$this->db->join('asset', 'asset.complaint_id = complaint.complaint_id', 'left');
		$this->db->where('asset.complaint_id', $complaint_id);

		$row = $this->db->get();
		if ($row->num_rows() > 0) {
			return $row->result();
		} else {
			return 0;
		}
	}

	function getAllComplaintsCount($user_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllOpenComplaintsCount($user_id, $status)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("status", $status);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllResolvedComplaintsCount($user_id, $remarks)
	{
		$this->db->select('complaint.*, complaint_status.*');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint.complaint_id = complaint_status.complaint_id');
		$this->db->where('user_id', $user_id);
		$this->db->where("complaint_status.remarks", $remarks);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function addComplaint($data)
	{
		$this->db->insert('complaint', $data);
		$i = $this->db->insert_id();
		$this->db->insert('complaint_status', [
			'complaint_id' => $i,
			'status' => 0,
			'remarks' => "Your Complaint will be resolved within 3 days!"
		]);
		
		return $i;
	}

	function complaintDetails($complaint_id)
	{
		$this->db->select('complaint.*, department.dept_name, technician.*');
		$this->db->from('complaint');
		$this->db->join('department', 'complaint.department_id = department.id');
		$this->db->join('technician', 'complaint.technician_id = technician.technician_id');
		$this->db->where('complaint.complaint_id', $complaint_id);
		$this->db->order_by("complaint_id", "desc");
		$query = $this->db->get();
		return $query->row_array();
	}

	function complaintTimeline($complaint_id)
	{
		$this->db->select('*');
		$this->db->from('complaint_status');
		$this->db->where('complaint_status.complaint_id', $complaint_id);
		$this->db->group_by('complaint_status.status');
		$q = $this->db->get();
		return $q->result();
	}

	function addFeedback($data)
	{
		$this->db->insert('complaint_feedback', $data);
	}

	function getComplaintDept($complaint_id) {
		$this->db->select('complaint.department_id');
		$this->db->from('complaint');
		$this->db->where('complaint_id', $complaint_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['department_id'];
		}
	}

	function getComplaintFeedbackDetails($complaint_id) {

		$this->db->select('*');
		$this->db->from('complaint_feedback');
		$this->db->where('complaint_feedback.complaint_id', $complaint_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return 0;
		}
	}
}
