<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ITAdmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model('ITAdminModel');
		$this->load->model('AdminModel');
		$this->load->model('Email_model');
		$this->load->model('Users');
		$this->load->model('ComplainantModel');
	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "IT Admin Dashboard";
			$data["allComplaints"] = $this->ITAdminModel->getAllComplaintsCount();
			$data["allPendingComplaints"] = $this->ITAdminModel->getAllOpenComplaintsCount(0);
			$data["allInProcessComplaints"] = $this->ITAdminModel->getAllOpenComplaintsCount(1);
			$data["allMaterialRequestedComplaints"] = $this->ITAdminModel->getAllOpenComplaintsCount(2);
			$data["allResolvedComplaints"] = $this->ITAdminModel->getAllComplaintsWithRemarksCount("Resolved");
			$data["allRejectedComplaints"] = $this->ITAdminModel->getAllComplaintsWithRemarksCount("Rejected");
			$data["getAutoStat"] = $this->ITAdminModel->getAutoStat();

//			 $this->ITAdminModel->autoGenerateComplaints();

			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/dashboard', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaints()
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "All Complaints";

			$start_date = $this->input->post("start_date", TRUE);
			$end_date = $this->input->post("end_date", TRUE);
			$dept_id = $this->input->post("dept_id", TRUE);

			if($start_date == '')
				$start_date = date('Y-m-d', strtotime('-60 days'));

			if ($end_date == '')
				$end_date = date('Y-m-d', strtotime(' +1 day'));


			$data['misc'] = [
				'start_date' => $start_date,
				'end_date' => $end_date,
				'dept_id' => $dept_id
			];

			$user_id = $this->session->userdata('user_id');

			$data['allComplaints'] = $this->ITAdminModel->allComplaints($user_id, $start_date, $end_date);
//			print_r($data['complaints']);
//			die();
			$data['complaintsByMe'] = $this->ITAdminModel->allComplaintsByMe($user_id, $start_date, $end_date);
			$data['pendingComplaints'] = $this->ITAdminModel->getAllComplaintsWithStatus(0, $user_id, $start_date, $end_date);
			$data['InProcessComplaints'] = $this->ITAdminModel->getAllComplaintsWithStatus(1, $user_id, $start_date, $end_date);
			$data['ReqAssetComplaints'] = $this->ITAdminModel->getAllComplaintsWithStatus(2, $user_id, $start_date, $end_date);
			$data['Resolved'] = $this->ITAdminModel->getAllComplaintsWithRemarks("Resolved", $user_id, $start_date, $end_date);
			$data['Rejected'] = $this->ITAdminModel->getAllComplaintsWithRemarks("Rejected", $user_id, $start_date, $end_date);
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/complaints', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_complaint($complaint_id)
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = $complaint_id . "#: Complaint Details";

			$data['complaint_details'] = $this->ITAdminModel->getComplaint($complaint_id);
			$data['technicians'] = $this->ITAdminModel->getTechniciansDetails($complaint_id);
			$data['asset_details'] = $this->ITAdminModel->getAssetDetails($complaint_id);
			$data['complaint_feedback'] = $this->ITAdminModel->getComplaintFeedbackDetails($complaint_id);

			$data['complaint_detailsAsComp'] = $this->ITAdminModel->complaintDetails($complaint_id);
			$data['complaint_timeline'] = $this->ITAdminModel->complaintTimeline($complaint_id);
			$data['complaint_feedbackAsComp'] = $this->ITAdminModel->getComplaintFeedbackDetailsAsComp($complaint_id);

			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/view_complaint', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function create_complaint()
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "Create Complaint";
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/create_complaint');
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function regComplaint()
	{
		if ($this->session->userdata('user_type') === '2') {
			$user_id = $this->input->post('user_id', TRUE);
			$department_id = $this->input->post('dept_name', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$description = $this->input->post('details');

			$this->ITAdminModel->addComplaint([
				"user_id" => $user_id,
				"department_id" => $department_id,
				"subject" => $subject,
				"description" => $description
			]);
		} else {
			echo "Access Denied!";
		}
	}

	public function technicians()
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "Technicians";

			$data['tech'] = $this->ITAdminModel->getTechnicians();
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/technicians', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function addTechnician()
	{
		if ($this->session->userdata('user_type') === '2') {

			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[technician.email]');

			if ($this->form_validation->run() == TRUE) {
				$technician_id = $this->input->post('id', TRUE);
				$department_id = 8;
				$user_type = 9;
				$name = $this->input->post('tech_name', TRUE);
				$phone_number = $this->input->post('phone_number');
				$email = $this->input->post('email');
				$password = $technician_id;

				$create = $this->ITAdminModel->addTechnician([
					"technician_id" => $technician_id,
					"department_id" => $department_id,
					"user_type" => $user_type,
					"name" => $name,
					"phone_number" => $phone_number,
					"email" => $email,
					"password" => $password
				]);
				if ($create == true) {
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('ITAdmin/technicians');
				} else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('ITAdmin/technicians');
				}
				redirect('ITAdmin/technicians');
			} else {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('ITAdmin/technicians');
				}
			}
		} else {
			echo "Access Denied!";
		}
	}

	public function view_technician_performance($technician_id)
	{

		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = $technician_id . " | Performance";

			//$status = $this->input->get("status", TRUE);
			$start_date = $this->input->get("start_date", TRUE);
			$end_date = $this->input->get("end_date", TRUE);

			$begin = new DateTime($start_date);
			$end   = new DateTime($end_date);
			
			$data = $this->ITAdminModel->getTechniciansPerformance([
				'technician_id' => $technician_id,
				//'status' => $status,
				'start_date' => $start_date,
				'end_date' => $end->format('Y-m-t h:i:s')
			]);

			$data['misc'] = [
				'technician_id' => $technician_id,
				//'status' => $status,
				'start_date' => $start_date,
				'end_date' => $end_date
			];

			
			$monComplaints=array();
			for($i = $begin; $i <= new DateTime($end->format('Y-m-t')); $i->modify('+1 month -3 day')){
				$duration=['start_date'=>$i->format("Y-m-1 h:i:s"),
				'end_date'=> $i->format("Y-m-t h:i:s")];
				$monComplaints+=array($i->format("M Y")=>($this->AdminModel->getTechnicianPerformanceFor($technician_id,$duration)));
			}
			$data['monthlyComplaint']=$monComplaints;
			$data['allComplaints']=$this->AdminModel->getAllComplaintsCountForTechnician($technician_id)->result_array();


			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/view_technician_performance', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}

	}

	public function complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '2') {
			$feedback = $this->input->post('feedback');

			$this->ComplainantModel->addFeedback([
				'complaint_id' => $complaint_id,
				'feedback' => $feedback
			]);
			$department_id = $this->ComplainantModel->getComplaintDept($complaint_id);
			if ($department_id == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
			}

			$subject1 ="Complaint ID: ".$complaint_id." Feedback";
			if ($department_id == 8) {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint Feedback has been Given against Complaint ID: $complaint_id</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			} else {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint Feedback has been Given against Complaint ID: $complaint_id</p>
				<a href=" . site_url('Admin/view_complaint/') . $complaint_id . ">View Complaint</a>";
			}
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('ITAdmin/view_complaint/'.$complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function assignTechnician()
	{
		if ($this->session->userdata('user_type') === '2') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$technician_id = $this->input->post('technician_id', TRUE);
			$technician_email = $this->input->post('technician_email', TRUE);
			
			$this->AdminModel->assignTechnician($complaint_id, $technician_id);
			//Added
			$subject1 = "New Complaint Assigned";
			$message = "
<p><pre>
*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>New complaint assigned to you. id: (.$complaint_id.)</p>
<p>Open CMS Website to respond or click</p>
				<a href=" . site_url('Technician/index') . ">View Complaint</a>";

			$this->Email_model->send_smtp_mail($technician_email, $subject1, $message);
			redirect('ITAdmin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function reAssignTechnician()
	{
		if ($this->session->userdata('user_type') === '2') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$technician_id = $this->input->post('technician_id', TRUE);

			$this->ITAdminModel->reAssignTechnician($complaint_id, $technician_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function track_request($asset_id)
	{

		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "Track Request";
			$data['asset_id'] = $asset_id;
			$data['asset_timeline'] = $this->ITAdminModel->assetTimeline($asset_id);
			$data['treasurer_timeline'] = $this->ITAdminModel->treasurerTimeline($asset_id);
			$data['purchaser_timeline'] = $this->ITAdminModel->purchaserTimeline($asset_id);
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/track_material_request', $data);
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function addAsset()
	{
		if ($this->session->userdata('user_type') === '2') {
			$complaint_id = $this->input->post('c_id');
			$name = $this->input->post('name');
			$details = $this->input->post('detail');
			$quantity = $this->input->post('quantity');


			$this->ITAdminModel->addAssetDetails([
				'complaint_id' => $complaint_id,
				'name' => $name,
				'details' => $details,
				'quantity' => $quantity
			]);
		} else {
			echo "Access Denied!";
		}
	}

	public function sendMail($complaint_id)
	{
		if ($this->session->userdata('user_type') === '2') {
			$data = $this->Users->getStoremanEmail();
			$to = array();
			for ($i = 0; $i < count($data); $i++) {
				$to[$i] = $data[$i]['email'];
			}
			$subject1 = "Material Required";
			$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Material Required against complaint: (.$complaint_id.)</p>
<p>Open CMS Website to respond</p>
				<a href=" . site_url('StoreMan/reqested_products') . ">View Requests</a>";

			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('ITAdmin/view_complaint/'.$complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function close_complaint()
	{
		if ($this->session->userdata('user_type') === '2') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$remarks = $this->input->post('remarks', TRUE);
			$this->ITAdminModel->closeComplaint($complaint_id, $remarks);
			$to = $this->Users->getComplainantEmail($complaint_id)['email'];
			$subject1 = "Complaint id: " . $complaint_id . " (Closed)";
			$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint status has been updated against complaint Id.$complaint_id.</p>
				<a href=" . site_url('Complinant/view_complaint/') . $complaint_id . ">View Complaint</a>";

			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('ITAdmin/view_complaint/'.$complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function updateTime($complaint_id)
	{
		if ($this->session->userdata('user_type') === '2') {
			$date = $this->input->post("date", TRUE);
			$this->ITAdminModel->updateTime($date, $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function req_to_treasurer()
	{
		if ($this->session->userdata('user_type') === '2') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$asset_id = $this->input->post('asset_id', TRUE);
			$this->ITAdminModel->reqToTreasurer([
				'complaint_id' => $complaint_id,
				'asset_id' => $asset_id,
				'status' => 0
			], $asset_id);

			$data = $this->Users->getTreasurerMail();
			$to = array();
			for ($i = 0; $i < count($data); $i++) {
				$to[$i] = $data[$i]['email'];
			}
			$subject1 = "Material Required";
			$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Material Required against complaint: (.$complaint_id.)</p>
<p>Open CMS Website to respond</p>
				<a href=" . site_url('Treasurer/viewRequests') . ">View Requests</a>";

			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('ITAdmin/view_complaint/'.$complaint_id);

		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '2') {
			$headData['title'] = "Profile";
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/profile');
			$this->load->view('it_admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}
	public function viewComplaintsType($type,$technician_id,$start_date,$end_date)
	{
		if($this->session->userdata('user_type') === '2' && $this->session->userdata('logged_in') === TRUE)
		{
			$end   = new DateTime($end_date);
			$data['complaints']=$this->ITAdminModel->getComplaintsWhereStatus($type,$technician_id,$start_date,$end->format('Y-m-t h:i:s'))->result_array();
			$headData['title']=$type;
			$this->load->view('it_admin/components/header', $headData);
			$this->load->view('it_admin/page_contents/view_complaint_byType', $data);
			$this->load->view('it_admin/components/footer');
		}
		else 
		{
			echo "Access Denied!";
		}
		
	}
	public function automate()
	{
		$status = $this->input->get('checkboxx', TRUE);
		$this->ITAdminModel->updateAutomation($status);
		redirect("ITAdmin/index");
	}
	public function generateReport()
	{
		$dur = $this->input->get('report_duration', TRUE);
		
		$end = new DateTime(date('Y-m-d'));
		$duration['end_date']=$end->format('d M Y');
		$dailyComplaints=array();
		$days=0;
		if($dur==7)
		{
			//weekly
			$days=7;
			$start=$end->modify("-7 day");
			$duration['start_date'] = $start->format('d M Y');
			
			for($i = $start; $i <= new DateTime(date('Y-m-d')); $i->modify('+1 day'))
			{
				$s=$i->format('Y-m-d 00:00:00');
				$e=$i->format('Y-m-d 23:59:59');
				$comps=$this->ITAdminModel->getComplaintsForTheDay($s,$e);
				if(count($comps) > 0)
				{
					$dailyComplaints+=array($i->format("d M Y")=>$comps);
				}
			}
		}
		elseif($dur==15)
		{
			//half month
			$days=15;
			$start=$end->modify("-15 day");
			$duration['start_date'] = $start->format('d M Y');
			
			for($i = $start; $i <= new DateTime(date('Y-m-d')); $i->modify('+1 day'))
			{
				$s=$i->format('Y-m-d 00:00:00');
				$e=$i->format('Y-m-d 23:59:59');
				$comps=$this->ITAdminModel->getComplaintsForTheDay($s,$e);
				if(count($comps) > 0)
				{
					$dailyComplaints+=array($i->format("d M Y")=>$comps);
				}
			}
		}
		elseif($dur==30)
		{
			//monthly
			$days=30;
			$start=$end->modify("-30 day");
			$duration['start_date'] = $start->format('d M Y');
			
			for($i = $start; $i <= new DateTime(date('Y-m-d')); $i->modify('+1 day'))
			{
				$s=$i->format('Y-m-d 00:00:00');
				$e=$i->format('Y-m-d 23:59:59');
				$comps=$this->ITAdminModel->getComplaintsForTheDay($s,$e);
				if(count($comps) > 0)
				{
					$dailyComplaints+=array($i->format("d M Y")=>$comps);
				}
			}
		}
		elseif($dur==0)
		{
			//manual
			$start_date = $this->input->get("from_date", TRUE);
			$end_date = $this->input->get("to_date", TRUE);
			
			$start=new DateTime($start_date);
			$end = new DateTime($end_date);
			$duration = ['start_date'=>$start->format('d M Y'),'end_date'=>$end->format('d M Y')];

			for($i = $start; $i <= new DateTime($end->format('Y-m-d')); $i->modify('+1 day'))
			{
				$s=$i->format('Y-m-d 00:00:00');
				$e=$i->format('Y-m-d 23:59:59');
				
				$comps=$this->ITAdminModel->getComplaintsForTheDay($s,$e);
				if(count($comps) > 0)
				{
					$dailyComplaints+=array($i->format("d M Y")=>$comps);
				}
				$days=$days+1;
			}
			$days=$days-1;
		}
		else
		{
			echo "Invalid duration";
			die();
		}
		 
		$headData['title'] = "Generate Report";
		$data['dailyComplaints']=$dailyComplaints;
		$data['duration']=$duration;
		$data['days']=$days;

		$this->load->view('admin/components/header', $headData);
		$this->load->view('admin/page_contents/genrate_report', $data);
		$this->load->view('admin/components/footer');

		$message = "
		<p><pre>
*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************
		</pre></p>
		<h3>".print_r($days,'-days Complaints Report')."-days Complaints Report</h3>";

		foreach ($dailyComplaints as $key => $val) {
			$message.="<h3>".print_r($key,'n')."</h3>";
			foreach ($val as $comp) {
				$message.="<p>Complaint Id :".print_r($comp->complaint_id,'n')." | Complainant :".print_r($comp->complainant,'n')." | Department :".print_r($comp->department,'n')." | Technician :".print_r($comp->Technician,'n')." | Status :";
				if ($comp->status == 0) {
					$message.="Pending";
				} else if ($comp->status == 1) {
					$message.="In-Process";
				} else if ($comp->status == 2) {
					$message.="Product Requested";
				} else {
					$message.="Closed";
				}
				$message.=" | <a href=" . site_url('Admin/view_complaint/'.$comp->complaint_id) . ">View Complaint</a>";
				$message.="</p><br>";
				
			}
		}
		
		$message.="<p>Open CMS Website to view all Complaints</p>
		<a href=" . site_url('Admin/complaints') . ">View Complaints</a>";

		$data = $this->Users->getAdminsEmails();
		$to = array();
		for ($i = 0; $i < count($data); $i++) {
			$to[$i] = $data[$i]['email'];
		}
		
		echo $message;
		die();
		//$this->Email_model->send_smtp_mail('181370103@gift.edu.pk',"CMS ".$days." days Report", $message);
	}
}
