<?php
class PurchaserModel extends CI_Model
{
	function getAllReqs()
	{
		$this->db->select('purchaser_request.*, asset.name, asset.quantity');
		$this->db->from('purchaser_request');
		$this->db->join('asset', 'asset.asset_id = purchaser_request.asset_id');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	// For Dashboard!

	function getAllReqsCount()
	{
		$this->db->select('*');
		$this->db->from('purchaser_request');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getSpecificReqsCount($status)
	{
		$this->db->select('*');
		$this->db->from('purchaser_request');
		$this->db->where("status", $status);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllPendingReqs()
	{
		$this->db->select('purchaser_request.*, asset.name, asset.quantity');
		$this->db->from('purchaser_request');
		$this->db->join('asset', 'asset.asset_id = purchaser_request.asset_id');
		$this->db->order_by("id", "desc");
		$this->db->where('purchaser_request.status', 0);
		$query = $this->db->get();
		return $query->result();
	}

	function getAllIssuedProducts()
	{
		$this->db->select('purchaser_request.*, asset.name, asset.quantity');
		$this->db->from('purchaser_request');
		$this->db->join('asset', 'asset.asset_id = purchaser_request.asset_id');
		$this->db->order_by("id", "desc");
		$this->db->where('purchaser_request.status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	function getAssetDetails($req) {

		$this->db->select('purchaser_request.*, asset.asset_id, asset.name, asset.details, asset.quantity, asset.total_amount');
		$this->db->from('purchaser_request');
		$this->db->join('asset', 'asset.asset_id = purchaser_request.asset_id');
		$this->db->where('purchaser_request.id', $req);
		$q = $this->db->get();
		return $q->row_array();
	}

	function issue($req, $asset_id) {
		$this->db->select('*');
		$this->db->from('purchaser_request');
		$this->db->set('status', 1);
		$this->db->where('purchaser_request.id', $req);
		$this->db->update();

		$this->db->insert('purchaser_request_status', [
			'purchase_req_id' => $req,
			'asset_id' => $asset_id,
			'status' => 1
		]);
		redirect('Purchaser/requested_products');
	}

	function getReqDetails($req) {

		$this->db->select('*');
		$this->db->from('purchaser_request');
		$this->db->where('purchaser_request.id', $req);
		$q = $this->db->get();

		return $q->result();
	}
}
