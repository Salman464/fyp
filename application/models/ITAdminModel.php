<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ITAdminModel extends CI_Model
{

	function getAllComplaintsCount()
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('complaint.department_id', 8);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllOpenComplaintsCount($status)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("status", $status);
		$this->db->where('complaint.department_id', 8);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllComplaintsWithRemarksCount($remarks)
	{
		$this->db->select('complaint.*,user.name,department.dept_name, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint.status', 3);
		$this->db->where('complaint.department_id', 8);
		$this->db->where('complaint_status.remarks', $remarks);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function allComplaints($id, $start_date, $end_date)
	{

		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.department_id', 8);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->order_by("complaint_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	}

	function allComplaintsByMe($id, $start_date, $end_date)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.user_id', $id);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint.complaint_date >=', $start_date);
		$this->db->where('complaint.complaint_date <=', $end_date);
		$query = $this->db->get();
		return $query->result();
	}

	function getAllComplaintsWithStatus($status, $id, $start_date, $end_date)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.status', $status);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint.department_id', 8);
		$query = $this->db->get();
		return $query->result();
	}

	function getAllComplaintsWithRemarks($remarks, $id, $start_date, $end_date)
	{
		$this->db->select('complaint.*,user.name,department.dept_name, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint.status', 3);
		$this->db->where('complaint.department_id', 8);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint_status.remarks', $remarks);
		$query = $this->db->get();
		return $query->result();
	}

	function getComplaint($complaint_id)
	{
		$this->db->select('complaint.*, user.user_id, user.name, user.phone_number, user.email, user.ext, technician.technician_id, technician.name as tname, technician.phone_number as tphone_number, technician.email as tmail, department.dept_name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id', 'left');
		$this->db->join('technician', 'technician.technician_id = complaint.technician_id', 'left');
		$this->db->join('department', 'department.id = complaint.department_id', 'left');
		$this->db->where('complaint.complaint_id', $complaint_id);

		$row = $this->db->get();
		return $row->row_array();
	}

	function getTechniciansDetails($complaint_id)
	{
		$this->db->select('technician.*, department.dept_name as n, complaint.department_id');
		$this->db->from('technician');
		$this->db->join('department', 'department.id = technician.department_id');
		$this->db->join('complaint', 'complaint.department_id = department.id');
		$this->db->where('complaint_id', $complaint_id);
		$row = $this->db->get();
		return $row->result();
	}

	function getAssetDetails($complaint_id)
	{
		$this->db->select('complaint.*, asset.asset_id ,asset.name as aname, asset.details, asset.quantity, asset.total_amount, asset.status, asset.reqToTreasurer');
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

	function getComplaintFeedbackDetails($complaint_id)
	{
		$this->db->select('*');
		$this->db->from('complaint_feedback');
		$this->db->where('complaint_feedback.complaint_id', $complaint_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function addComplaint($data)
	{
		$this->db->insert('complaint', $data);
		$i = $this->db->insert_id();
		$this->db->insert('complaint_status', [
			'complaint_id' => $i,
			'status' => 0,
			'remarks' => "Pending"
		]);
		redirect('ITAdmin/view_complaint/' . $i);
	}

	function complaintDetails($complaint_id)
	{
		$this->db->select('complaint.*, department.dept_name, technician.*');
		$this->db->from('complaint');
		$this->db->join('department', 'complaint.department_id = department.id');
		$this->db->join('technician', 'complaint.technician_id = technician.technician_id');
		$this->db->where('complaint.complaint_id', $complaint_id);
		$this->db->order_by("complaint_id", "DESC");
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

	function getComplaintFeedbackDetailsAsComp($complaint_id)
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

	function assignTechnician($complaint_id, $technician_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('status', 1);
		$this->db->set('technician_id', $technician_id);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		$this->db->insert('complaint_status', [
			'complaint_id' => $complaint_id,
			'status' => 1,
			'remarks' => "Assigned to Technician"
		]);

		redirect('ITAdmin/view_complaint/' . $complaint_id);
	}

	function reAssignTechnician($complaint_id, $technician_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('technician_id', $technician_id);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		$this->db->insert('complaint_status', [
			'complaint_id' => $complaint_id,
			'status' => 1,
			'remarks' => "Assigned the task to new Technician"
		]);
		redirect('ITAdmin/view_complaint/' . $complaint_id);
	}

	function getTechnicians()
	{
		$this->db->select('technician.*, department.dept_name');
		$this->db->from('technician');
		$this->db->where('technician_id !=', 1);
		$this->db->where('technician.department_id', 8);
		$this->db->join('department', 'department.id = technician.department_id');
		$q = $this->db->get();
		$data = $q->result();
		return $data;
	}

	function addTechnician($data)
	{
		$c = $this->db->insert('technician', $data);
		return ($c == true) ? true : false;
	}

	function getTechniciansPerformance($dataG)
	{
		$this->db->select('complaint.*, user.name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->where('complaint.technician_id', $dataG["technician_id"]);
		
		//$this->db->where('complaint.status <=', 3);
		
		$this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data['complaints'] = $this->db->get()->result();

		$this->db->select('technician.*, department.*');
		$this->db->from('technician');
		$this->db->join('department', 'technician.department_id = department.id');
		$this->db->where('technician.technician_id', $dataG['technician_id']);
		$data['technicianDetails'] = $this->db->get()->row_array();

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("technician_id", $dataG['technician_id']);
		// if ($dataG["status"] == 3) {
		// 	$this->db->where('complaint.status', $dataG["status"]);
		// } else if ($dataG["status"] == 1) {
		// 	$this->db->where('complaint.status <', 3);
		// }
		$this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allComplaintsCount"] = $this->db->get()->num_rows();

		$this->db->select('complaint.*, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint_status.remarks', "Resolved");
		$this->db->where('complaint.status',3);
		$this->db->where("technician_id", $dataG['technician_id']);
		$this->db->group_by('complaint.complaint_id');
		$this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allResolvedComplaint"] = $this->db->get()->num_rows();

		$this->db->select('complaint.*, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint_status.remarks', "Rejected");
		$this->db->where('complaint.status',3);
		$this->db->where("technician_id", $dataG['technician_id']);
		$this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allRejectedComplaint"] = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("technician_id", $dataG['technician_id']);
		$this->db->where("expected_completion_time > completion_time");
		$this->db->where("status",3);
		$this->db->group_by('complaint.complaint_id');
		$this->db->where('complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allCompletionsWithinTime"] = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("technician_id", $dataG['technician_id']);
		$this->db->where("expected_completion_time < completion_time");
		$this->db->where("status",3);
		$this->db->group_by('complaint.complaint_id');
		$this->db->where('complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allCompletionsAfterTime"] = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("technician_id", $dataG['technician_id']);
		$this->db->where("status <",3);
		$this->db->group_by('complaint.complaint_id');
		$this->db->where('complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		$data["allPendings"] = $this->db->get()->num_rows();

		return $data;
	}

	function updateTime($date, $complaint_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('expected_completion_time', $date);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		redirect('ITAdmin/view_complaint/' . $complaint_id);
	}

	function assetTimeline($asset_id)
	{
		$this->db->select('*');
		$this->db->from('asset_status');
		$this->db->where('asset_status.asset_id', $asset_id);
		$q = $this->db->get();
		return $q->result();
	}

	function treasurerTimeline($asset_id)
	{
		$this->db->select('treasurer_request.*, treasurer_request_status.*');
		$this->db->from('treasurer_request');
		$this->db->join('treasurer_request_status', 'treasurer_request.req_id = treasurer_request_status.req_id');
		$this->db->where('treasurer_request.asset_id', $asset_id);
		$q = $this->db->get();
		return $q->result();
	}

	function purchaserTimeline($asset_id)
	{
		$this->db->select('purchaser_request.*, purchaser_request_status.*');
		$this->db->from('purchaser_request');
		$this->db->join('purchaser_request_status', 'purchaser_request.asset_id = purchaser_request_status.asset_id');
		$this->db->where('purchaser_request.asset_id', $asset_id);
		$q = $this->db->get();
		return $q->result();
	}

	function addFeedback($data, $complaint_id)
	{
		$this->db->insert('complaint_feedback', $data);
		$i = $this->db->insert_id();
		redirect('ITAdmin/view_complaint/' . $complaint_id);
	}

	function addAssetDetails($data)
	{
		$this->db->insert('asset', $data);
		$i = $this->db->insert_id();
		$this->db->insert('asset_status', [
			'asset_id' => $i,
			'status' => 0
		]);

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('status', 2);
		$this->db->where('complaint_id', $data['complaint_id']);
		$this->db->update();

		$this->db->insert('complaint_status', [
			'complaint_id' => $data['complaint_id'],
			'status' => 2,
			'remarks' => "Material Requested"
		]);
	}

	function closeComplaint($complaint_id, $remarks)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('status', 3);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		$this->db->insert('complaint_status', [
			'complaint_id' => $complaint_id,
			'status' => 3,
			'remarks' => $remarks
		]);
	}

	function reqToTreasurer($data, $asset_id)
	{
		$this->db->select('*');
		$this->db->from('asset');
		$this->db->set('reqToTreasurer', 1);
		$this->db->where('asset_id', $asset_id);
		$this->db->update();

		$this->db->insert('treasurer_request', $data);
		$i = $this->db->insert_id();
		$this->db->insert('treasurer_request_status', [
			'req_id' => $i,
			'remarks' => "Pending",
			'status' => 0
		]);
	}
	public function getComplaintsWhereStatus($status,$technician_id,$start_date,$end_date)
	{
		if($status=='All')
		{
			$this->db->select('complaint.*, user.name');
			$this->db->from('complaint');
			$this->db->join('user', 'user.user_id = complaint.user_id');
			$this->db->where('complaint.status <=', 3);
			$this->db->where("complaint.technician_id", $technician_id);
			$this->db->where('complaint.complaint_date BETWEEN "' .$start_date. '" and "' . $end_date. '"');
			return $this->db->get();
		}
		$this->db->select('complaint.*, complaint_status.*,user.name');
		$this->db->from('complaint');
		$this->db->join('complaint_status', 'complaint.complaint_id = complaint_status.complaint_id');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->group_by('complaint.complaint_id');
		if($status=='Pending'):
			$this->db->where('complaint.status<',3);
		elseif($status=='Resolved'):
			$this->db->where('complaint_status.remarks', "Resolved");
		elseif($status=='Rejected'):
		 	$this->db->where('complaint_status.remarks', "Rejected");
		elseif($status=='Within-Due-Time'):
			$this->db->where("expected_completion_time > completion_time");
			$this->db->where("complaint_status.status =",3);
		elseif($status=='After-Due-Time'):
			$this->db->where("expected_completion_time < completion_time");
			$this->db->where("complaint_status.status",3);
		endif;

		$this->db->where("complaint.technician_id", $technician_id);
		$this->db->where('complaint.complaint_date BETWEEN "' .$start_date. '" and "' . $end_date. '"');
		return $this->db->get();
	}
	public function updateAutomation($status)
	{
		$this->db->select('*');
		$this->db->from('automate_status');
		$this->db->set('status',$status);
		$this->db->where('id', 1);
		$this->db->update();
	}
	public function getAutoStat()
	{
		$this->db->select('*');
		$this->db->from('automate_status');
		$this->db->where('id',1);
		return $this->db->get()->row_array();
	}
	public function getComplaintsForTheDay($start,$end)
	{
		$this->db->select('complaint.complaint_id,complaint.subject,complaint.description,user.name as complainant,department.dept_name as department,technician.name as Technician,complaint.status');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('technician', 'technician.technician_id = complaint.technician_id');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->where('complaint.event_num', 0);
		$this->db->where('complaint.complaint_date BETWEEN "'.$start.'" and "'.$end.'"');
		$this->db->where('complaint.department_id =8');
		$query = $this->db->get();
		return $query->result();
	}
}
