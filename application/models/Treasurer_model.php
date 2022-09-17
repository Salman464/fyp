<?php

class Treasurer_model extends CI_Model
{
	public function requests()
	{
		$this->db->select('treasurer_request.*,asset.name,asset.details,asset.quantity');
		$this->db->from('treasurer_request');
		$this->db->join('asset', 'asset.asset_id = treasurer_request.asset_id', 'left');
		$this->db->order_by("treasurer_request.req_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function requestsWhere($status)
	{
		$this->db->select('treasurer_request.*,asset.name,asset.details,asset.quantity');
		$this->db->from('treasurer_request');
		$this->db->join('asset', 'asset.asset_id = treasurer_request.asset_id');
		$this->db->where("treasurer_request.status", $status);
		$this->db->order_by("treasurer_request.req_id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function complaintDetail($complaint_id)
	{
		$this->db->select('*');
		$this->db->where('complaint_id', $complaint_id);
		$row = $this->db->get('complaint');
		return $row->row_array();
	}

	function complainantDetails($complaint_id)
	{
		$this->db->select('complaint.user_id as cname, user.user_id, user.name, user.email, user.phone_number');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->where("complaint.complaint_id", $complaint_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function assetDetail($req)
	{
		$this->db->select('treasurer_request.*,asset.asset_id,asset.name,asset.details,asset.quantity,asset.total_amount');
		$this->db->from('treasurer_request');
		$this->db->join('asset', 'asset.asset_id = treasurer_request.asset_id');
		$this->db->where('treasurer_request.complaint_id', $req);
		$query = $this->db->get();
		return $query;
	}

	public function approve($complaint_id)
	{
		$this->db->select('asset.asset_id, treasurer_request.req_id');
		$this->db->from('asset');
		$this->db->join('treasurer_request', 'treasurer_request.asset_id = asset.asset_id');
		$this->db->where('asset.complaint_id', $complaint_id);
		$this->db->where('asset.reqToTreasurer', 1);
		$q = $this->db->get();

		$arr = $q->result_array();
		
		for ($l = 0; $l < count($arr); $l++) {

			$this->db->select('*');
			$this->db->from('treasurer_request');
			$this->db->set('status', 1);
			$this->db->where('asset_id', $arr[$l]['asset_id']);
			$this->db->update();

			$this->db->insert('treasurer_request_status', [
				'req_id' => $arr[$l]['req_id'],
				'remarks' => "Approved",
				'status' => 1
			]);

			$this->db->insert('purchaser_request', [
				'asset_id' => $arr[$l]['asset_id'],
				'status' => 0
			]);

			$i = $this->db->insert_id();

			$this->db->insert('purchaser_request_status', [
				'purchase_req_id' => $i,
				'asset_id' => $arr[$l]['asset_id'],
				'status' => 0
			]);
		}
	}

	public function reject($complaint_id, $details)
	{

		$this->db->select('asset.asset_id, treasurer_request.req_id');
		$this->db->from('asset');
		$this->db->join('treasurer_request', 'treasurer_request.asset_id = asset.asset_id');
		$this->db->where('asset.complaint_id', $complaint_id);
		$this->db->where('asset.reqToTreasurer', 1);
		$q = $this->db->get();

		$arr = $q->result_array();

		for ($l = 0; $l < count($arr); $l++) {
			$this->db->select('*');
			$this->db->from('treasurer_request');
			$this->db->set('status', 2);
			$this->db->where('asset_id', $arr[$l]['asset_id']);
			$this->db->update();

			$this->db->insert('treasurer_request_status', [
				'req_id' => $arr[$l]['req_id'],
				'remarks' => $details,
				'status' => 2
			]);
		}
	}

	public function tReport($req)
	{
		$this->db->select('remarks');
		$this->db->from('treasurer_request_status');
		$this->db->where('treasurer_request_status.req_id', $req);
		$this->db->where('treasurer_request_status.status', 2);
		return $this->db->get()->result_array();
	}

	public function allReqsCount()
	{
		$this->db->select("*");
		$this->db->from("treasurer_request");
		$q = $this->db->get();
		return $q->num_rows();
	}

	public function ReqsCount($status)
	{
		$this->db->select("*");
		$this->db->from("treasurer_request");
		$this->db->where("status", $status);
		$q = $this->db->get();
		return $q->num_rows();
	}

	function accidental_reports()
	{
		$this->db->select('accidental_report.*, dept_name');
		$this->db->from('accidental_report');
		$this->db->join('department', 'department.id = accidental_report.department_id');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	function getAccidentalReport($id)
	{
		$this->db->select('accidental_report.*, department.dept_name');
		$this->db->from('accidental_report');
		$this->db->join('department', 'department.id = accidental_report.department_id', 'left');
		$this->db->where('accidental_report.id', $id);

		$row = $this->db->get();
		return $row->result();
	}

	function getAccidentalAssetDetails($id)
	{
		$this->db->select('*');
		$this->db->from('accidental_report_asset');
		$this->db->where('accidental_report_asset.accidental_report_id', $id);

		$row = $this->db->get();
		if ($row->num_rows() > 0) {
			return $row->result();
		} else {
			return 0;
		}
	}

	function ApproveAccidentalReport($id)
	{
		$this->db->select('*');
		$this->db->from('accidental_report');
		$this->db->where('accidental_report.id', $id);
		$this->db->set('status', 1);
		$this->db->update();

		redirect('Treasurer/view_accidental_report/' . $id);
	}

	function addFeedback($data)
	{
		$this->db->insert('complaint_feedback', $data);
	}

	function getComplaintFeedbackDetails($complaint_id)
	{
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
