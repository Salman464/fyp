<?php
class AdminModel extends CI_Model
{
	function getUsers()
	{
		$this->db->select('*');
		$this->db->from('user');
		$row = $this->db->get();
		return $row->result();
	}

	function getUsersWith($user_type)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_type', $user_type);
		$row = $this->db->get();
		return $row->result();
	}

	function addUser($data)
	{
		$c = $this->db->insert('user', $data);
		return ($c == true) ? true : false;
	}

	// Complaints Tasks!

	function addComplaint($data)
	{
		$this->db->insert('complaint', $data);
		$i = $this->db->insert_id();
		$this->db->insert('complaint_status', [
			'complaint_id' => $i,
			'status' => 0,
			'remarks' => "Pending"
		]);
		return $i;
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

		//removed
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
		redirect('Admin/view_complaint/' . $complaint_id);
	}

	function closeComplaint($complaint_id, $remarks)
	{
		date_default_timezone_set("Asia/Karachi");//default timezone

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('status', 3);
		$this->db->set('completion_time',date("Y-m-d H:i:s"));
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		

		$this->db->insert('complaint_status', [
			'complaint_id' => $complaint_id,
			'status' => 3,
			'remarks' => $remarks
		]);
	}
	function removeTressurerRequest($complaint_id)
	{
		$this->db->select('*');
		$this->db->from('treasurer_request');
		$this->db->set('status', 2);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();
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

	function addFeedback($data)
	{
		$this->db->insert('complaint_feedback', $data);
	}

	function updateFeedback($data)
	{
		$this->db->select('*');
		$this->db->from('complaint_feedback');
		$this->db->set('feedback', $data['feedback']);
		$this->db->where('complaint_id', $data['complaint_id']);
		$this->db->update();
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

	function getAllComplaints()
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$query = $this->db->get();
		return $query->result();
	}

	function getAllComplaintsCount()
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllOpenComplaintsCount($status)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("status", $status);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getAllPendingComplaints($start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.status', 0);
		$this->db->where('complaint.event_num', 0);
		if ($dept_id != "") {
			$this->db->where('complaint.department_id', $dept_id);
		}

		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$query = $this->db->get();
		return $query->result();
	}

	function getAllInProcessComplaints($start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.status', 1);
		$this->db->where('complaint.event_num', 0);
		if ($dept_id != "") {
			$this->db->where('complaint.department_id', $dept_id);
		}

		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$query = $this->db->get();
		return $query->result();
	}

	function getAllReqAssetComplaints($start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.status', 2);
		$this->db->where('complaint.event_num', 0);
		if ($dept_id != "") {
			$this->db->where('complaint.department_id', $dept_id);
		}

		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$query = $this->db->get();
		return $query->result();
	}

	function getAllCloseComplaints()
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->where('complaint.status', 3);
		$query = $this->db->get();
		return $query->result();
	}

	function getAllComplaintsWithRemarks($remarks, $start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*,user.name,department.dept_name, complaint_status.remarks');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		$this->db->where('complaint.status', 3);
		$this->db->where('complaint.event_num', 0);
		if ($dept_id != "") {
			$this->db->where('complaint.department_id', $dept_id);
		}

		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint_status.remarks', $remarks);
		$query = $this->db->get();
		return $query->result();
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
		$this->db->where('complaint_status.remarks', $remarks);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function allComplaints($start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*,user.name,department.dept_name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->where('complaint.event_num', 0);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		if ($dept_id != "")
			$this->db->where('complaint.department_id', $dept_id);
		$query = $this->db->get();
		return $query->result();
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

	function getTreasurerReqInfo($complaint_id)
	{
		$this->db->select('*');
		$this->db->from('treasurer_request');
		$this->db->where('treasurer_request.complaint_id', $complaint_id);

		$row = $this->db->get();
		return $row->num_rows() > 0;
	}

	function getComplaintFeedbackDetails($complaint_id)
	{
		$this->db->select('*');
		$this->db->from('complaint_feedback');
		$this->db->where('complaint_feedback.complaint_id', $complaint_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	// Technician's Tasks!

	function getTechnicians()
	{
		$this->db->select('technician.*, department.dept_name');
		$this->db->from('technician');
		$this->db->where('technician_id !=', 1);
		$this->db->join('department', 'department.id = technician.department_id');
		$q = $this->db->get();
		$data = $q->result();
		return $data;
	}

	function getTechniciansDetails($complaint_id)
	{

		$this->db->select('technician_id');
		$this->db->from('event_technician');
		$this->db->where('complaint_id', $complaint_id);
		$q = $this->db->get()->result_array();

		foreach ($q as $key) {
			$arr = $key;
		}

		// print_r($arr);
		// die();




		$this->db->select('technician.*, department.dept_name as n, complaint.department_id');
		$this->db->from('technician');
		$this->db->join('department', 'department.id = technician.department_id');
		$this->db->join('complaint', 'complaint.department_id = department.id');
		$this->db->where('complaint_id', $complaint_id);
		if(!empty($arr))
			$this->db->where('technician.technician_id !=', $arr['technician_id']);
		$row = $this->db->get();
		return $row->result();
	}

	function addTechnician($data)
	{
		$c = $this->db->insert('technician', $data);
		return ($c == true) ? true : false;
	}

	public function create($data = '')
	{
		$create = $this->db->insert('user', $data);
		return $create == true;
	}

	// Accidental Report's Tasks!

	function create_accidental_reports($data)
	{
		$this->db->insert('accidental_report', $data);
		$i = $this->db->insert_id();
		redirect('Admin/view_accidental_report/' . $i);
	}

	function accidental_reports()
	{
		$this->db->select('accidental_report.*, dept_name');
		$this->db->from('accidental_report');
		$this->db->join('department', 'department.id = accidental_report.department_id');
		$this->db->order_by("id", "DESC");
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

	function addAccidentalAssetDetails($data)
	{
		$this->db->insert('accidental_report_asset', $data);
		redirect('Admin/view_accidental_report/' . $data['accidental_report_id']);
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

	function getAllComplaintsCountWithDept($dept, $start_date, $end_date)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint.department_id', $dept);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function getTechniciansPerformance($dataG)
	{
		$this->db->select('complaint.*, user.name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->where('complaint.technician_id', $dataG["technician_id"]);
		
		$this->db->where('complaint.status <=', 3);
		
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
		

		// $this->db->select('complaint.*, complaint_status.*');
		// $this->db->from('complaint');
		// $this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		// if ($dataG["status"] == 3) {
		// 	$this->db->where('complaint.status', $dataG["status"]);
		// 	$this->db->where('complaint_status.status', $dataG["status"]);
		// }
		// $this->db->where("complaint.technician_id", $dataG['technician_id']);
		// $this->db->where("complaint.expected_completion_time > complaint_status.date");
		// $this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		// $data["allCompletionsWithinTime"] = $this->db->get()->num_rows();
		// // } else {
		// // 	$data["allCompletionsWithinTime"] = 0;
		// // }
		// if ($dataG["status"] == 3) {
		// 	$this->db->select('complaint.*, complaint_status.*');
		// 	$this->db->from('complaint');
		// 	$this->db->join('complaint_status', 'complaint_status.complaint_id = complaint.complaint_id');
		// 	if ($dataG["status"] == 3) {
		// 		$this->db->where('complaint.status', $dataG["status"]);
		// 		$this->db->where('complaint_status.status', $dataG["status"]);
		// 		$this->db->where('complaint_status.remarks', "Resolved");
		// 	} else if ($dataG["status"] == 1) {
		// 		$this->db->where('complaint.status <', 3);
		// 		$this->db->where('complaint_status.status <', 3);
		// 	}
		// 	$this->db->where("complaint.expected_completion_time !=", "0");
		// 	$this->db->where("complaint.technician_id", $dataG['technician_id']);
		// 	$this->db->where("complaint.expected_completion_time <= complaint_status.date");
		// 	$this->db->where('complaint.complaint_date BETWEEN "' . $dataG['start_date'] . '" and "' . $dataG['end_date'] . '"');
		// 	$data["allCompletionsAfterTime"] = $this->db->get()->num_rows();
		// } else {
		// 	$data["allCompletionsAfterTime"] = 0;
		// }

		return $data;
	}
	public function getAllComplaintsCountForTechnician($id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('technician_id',$id);
		return $this->db->get();
	}
	function updateTime($date, $complaint_id)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('expected_completion_time', $date);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();
	}

	function getAllEvents($dept_id)
	{
		$this->db->select('maintainance_events_schedule.*, department.dept_name');
		$this->db->from('maintainance_events_schedule');
		$this->db->join('department', 'department.id = maintainance_events_schedule.department_id');
		if ($dept_id != "")
			$this->db->where('maintainance_events_schedule.department_id', $dept_id);
		$row = $this->db->get();
		return $row->result();
	}

	function getEvent($event_id)
	{
		$this->db->select('maintainance_events_schedule.*, department.dept_name');
		$this->db->from('maintainance_events_schedule');
		$this->db->join('department', 'department.id = maintainance_events_schedule.department_id');
		$this->db->where('maintainance_events_schedule.id', $event_id);
		$row = $this->db->get();
		return $row->row_array();
	}

	function addEvent($data)
	{
		$this->db->insert('maintainance_events_schedule', $data);
	}
	function updateEvent($data, $event_id)
	{
		$this->db->select('*');
		$this->db->from('maintainance_events_schedule');
		$this->db->set($data);
		$this->db->where('id', $event_id);
		$this->db->update();
	}

	function isEvent($event_id)
	{
		$this->db->select('complaint.event_num');
		$this->db->from('complaint');
		$this->db->where('complaint_id', $event_id);
		return $this->db->get()->row_array();
	}

	function getAllEventOccurred($event_id)
	{
		$this->db->select('complaint.*, user.user_id, user.name, complaint_feedback.feedback');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id', 'left');
		$this->db->join('complaint_feedback', 'complaint.complaint_id = complaint_feedback.complaint_id', 'left');
		$this->db->where('complaint.event_num', $event_id);
		return $this->db->get()->result();
	}

	function getAllEventOccurreds($start_date, $end_date, $dept_id)
	{
		$this->db->select('complaint.*, user.user_id, user.name, complaint_feedback.feedback, department.dept_name');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id', 'left');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('complaint_feedback', 'complaint.complaint_id = complaint_feedback.complaint_id', 'left');
		$this->db->where('complaint.event_num !=', 0);
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		if ($dept_id != "")
			$this->db->where('complaint.department_id', $dept_id);
		$query = $this->db->get();
		return $query->result();
		return $this->db->get()->result();
	}

	function getAllEventsWithStatus($status, $start_date, $end_date, $dept_id) {

		$this->db->select('complaint.*,user.name,complaint_feedback.feedback, department.dept_name');
		$this->db->from('complaint');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->join('user', 'user.user_id = complaint.user_id', 'left');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('complaint_feedback', 'complaint.complaint_id = complaint_feedback.complaint_id', 'left');
		$this->db->where('complaint.status', $status);
		$this->db->where('complaint.event_num !=', 0);
		if ($dept_id != "") {
			$this->db->where('complaint.department_id', $dept_id);
		}

		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$query = $this->db->get();
		return $query->result();

	}

	function getAllEventsCountWithDept($dept, $start_date, $end_date) {
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('complaint.complaint_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('complaint.department_id', $dept);
		$this->db->where('complaint.event_num !=', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function assignEventTechnician($complaint_id, $technician_id){

		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('status', 1);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();

		$this->db->insert('event_technician', [
			'complaint_id' => $complaint_id,
			'technician_id' => $technician_id
		]);

	}

	function getAllTechnicians($complaint_id){

		$this->db->select('event_technician.*, technician.*, department.dept_name');
		$this->db->from('event_technician');
		$this->db->join('technician', 'event_technician.technician_id = technician.technician_id');
		$this->db->join('department', 'department.id = technician.department_id');
		$this->db->where('complaint_id', $complaint_id);
		return $this->db->get()->result();

	}

	function removeFromJob($complaint_id, $technician_id) {

		$this->db->delete('event_technician', [
			'complaint_id' => $complaint_id,
			'technician_id' => $technician_id
		]);

	}

	function updateDept($complaint_id, $dept_id) {
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->set('department_id', $dept_id);
		$this->db->where('complaint_id', $complaint_id);
		$this->db->update();
	}

	function getOccurrence($event_id)
	{
		$this->db->select('occurrence_id');
		$this->db->from('maintainance_events_schedule');
		$this->db->where('id', $event_id);
		return $this->db->get()->row_array();
	}
	public function getTechnicianPerformanceFor($technician_id,$duration)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where("technician_id", $technician_id);
		$this->db->where("status",3);
		$this->db->where('complaint_date BETWEEN "' . $duration['start_date'] . '" and "' . $duration['end_date'] . '"');
		return $this->db->get()->num_rows();
		
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
	public function getMonthlyDepartmentComplaint($dept_id,$duration)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('department_id',$dept_id);
		$this->db->where('complaint_date BETWEEN "' . $duration['start_date'] . '" and "' . $duration['end_date'] . '"');
		return $this->db->get()->num_rows();
	}
	public function updateAutomation($status)
	{
		$this->db->select('*');
		$this->db->from('automate_status');
		$this->db->set('status',$status);
		$this->db->where('id', 0);
		$this->db->update();
	}
	public function getAutoStat()
	{
		$this->db->select('*');
		$this->db->from('automate_status');
		return $this->db->get()->row_array();
	}
	public function workingOnComplaintsCount($tid)
	{
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->where('technician_id',$tid);
		return $this->db->get()->num_rows();
	}
	public function getComplaintsForTheDay($start,$end)
	{
		// $this->db->select('*');
		// $this->db->from('complaint');
		// $this->db->where('complaint_date BETWEEN "' . $start . '" and "' . $end . '"');
		// $this->db->where('department_id !=8');
		// return $this->db->get()->result_array();
		$this->db->select('complaint.complaint_id,complaint.subject,complaint.description,user.name as complainant,department.dept_name as department,technician.name as Technician,complaint.status');
		$this->db->from('complaint');
		$this->db->join('user', 'user.user_id = complaint.user_id');
		$this->db->join('department', 'department.id = complaint.department_id');
		$this->db->join('technician', 'technician.technician_id = complaint.technician_id');
		$this->db->order_by("complaint_id", "DESC");
		$this->db->where('complaint.event_num', 0);
		$this->db->where('complaint.complaint_date BETWEEN "'.$start.'" and "'.$end.'"');
		$this->db->where('complaint.department_id !=8');
		$query = $this->db->get();
		return $query->result();
	}
	public function getComplainantsFrom($start,$end)
	{
		
	}
}
