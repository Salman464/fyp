<?php


class Users extends CI_Model
{


	public function getUsers()
	{
		$q = $this->db->get('user');
		return $q->result();
	}

	public function getDetails($user, $password)
	{
		$q = $this->db->get_where('user', array('name' => $user));
		return $q->result();
	}

	public function getAdminsEmails()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 1);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getITAdminsEmails()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 2);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getComplainantEmail($complaint_id)
	{
		$this->db->select('user.email');
		$this->db->from('complaint');
		$this->db->join('user', 'complaint.user_id = user.user_id');
		$this->db->where('complaint.complaint_id', $complaint_id);
		$data = $this->db->get()->row_array();
		return $data;
	}

	public function getStoremanEmail()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 4);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getTreasurerMail()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 5);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getStoreManMail()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 4);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getPurchaserMail()
	{
		$this->db->select('email');
		$this->db->from('user');
		$this->db->where('user_type', 6);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getDeptOfComplaint($asset_id)
	{
		$this->db->select('complaint.department_id');
		$this->db->from('asset');
		$this->db->join('complaint', 'complaint.complaint_id = asset.complaint_id');
		$this->db->where('asset.asset_id', $asset_id);
		return $this->db->get()->row_array();
	}

	public function getDeptOfComplaintWithID($complaint_id)
	{
		$this->db->select('complaint.department_id');
		$this->db->from('complaint');
		$this->db->where('complaint_id', $complaint_id);
		return $this->db->get()->row_array();
	}

	public function updateInfo($user_id, $data)
	{

		$this->db->select('*');

		if ($this->session->userdata('user_type') === '9') {
			$this->db->from('technician');
			$this->db->set($data);
			$this->db->where('technician_id', $user_id);
		} else {
			$this->db->from('user');
			$this->db->set($data);
			$this->db->where('user_id', $user_id);
		}
		$this->db->update();
		$this->session->set_flashdata('success', 'Profile Update, Login back to view changes!');
		$this->load->view('login_view');
	}
}
