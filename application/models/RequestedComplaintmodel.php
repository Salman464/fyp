<?php

class RequestedComplaintmodel extends CI_model
{

	public function getrequest()
	{
		$this->db->select('complaint.* , asset.*');
		$this->db->from('complaint');
		$this->db->join('asset', 'complaint.complaint_id = asset.complaint_id');
		$this->db->order_by("asset_id", "desc");
		$query = $this->db->get('');
		return $query->result();
	}

	public function getrequests($where)
	{
		$this->db->select('complaint.* , asset.*');
		$this->db->from('complaint');
		$this->db->join('asset', 'complaint.complaint_id = asset.complaint_id');
		$this->db->where('asset.status', $where);
		$this->db->order_by("asset_id", "desc");
		$query = $this->db->get('');
		return $query->result();
	}

	public function view_request($asset_id)
	{
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->where('asset_id', $asset_id);
		$row = $this->db->get();
		return $row->row_array();
	}
	public function view_complaint($complaint_id)
	{
		$this->db->select('*');
		$this->db->where('complaint_id', $complaint_id);
		$this->db->order_by("complaint_id", "desc");
		$row = $this->db->get('complaint');
		return $row->row_array();
	}

	function getAllReqsCount() {
		$this->db->select('*');
		$this->db->from('asset');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllReqsCountWhere($status) {
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->where('status', $status);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function updateAmount($asset_id, $amount)
	{
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->set('total_amount', $amount);
		$this->db->where('asset_id', $asset_id);
		$this->db->update();

		redirect('StoreMan/view_request_product/' . $asset_id);
	}

	function updateAssetStatus($asset_id, $status)
	{

		$this->db->select('*');
		$this->db->from('asset');
		$this->db->set('status', $status);
		$this->db->where('asset_id', $asset_id);
		$this->db->update();
		$this->db->insert('asset_status', [
			'asset_id' => $asset_id,
			'status' => $status
		]);
		redirect('StoreMan/view_request_product/' . $asset_id);
	}
	function sendToTreasurer($data)
	{
		$this->db->insert('treasurer_request',$data);
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->set('reqToTreasurer', 1);
		$this->db->where('asset_id', $data['asset_id']);
		$this->db->update();
	}
}
