<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Treasurer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model('treasurer_model');
		$this->load->model('Users');
		$this->load->model('Email_model');
		$this->load->model('ComplainantModel');
		$this->load->model('AdminModel');
		$this->load->model('ITAdminModel');
	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Treasurer Dashboard";
			$data['allReqs'] = $this->treasurer_model->allReqsCount();
			$data['accept'] = $this->treasurer_model->ReqsCount(1);
			$data['reject'] = $this->treasurer_model->ReqsCount(2);
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/dashboard', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function viewRequests()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "View Requests";
			$data['treasurer_request'] = $this->treasurer_model->requests();
			$data['pending_treasurer_request'] = $this->treasurer_model->requestsWhere(0);
			$data['approved_treasurer_request'] = $this->treasurer_model->requestsWhere(1);
			$data['rejected_treasurer_request'] = $this->treasurer_model->requestsWhere(2);
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/view_requests', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function detail($req)
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Details";
			$this->load->model('treasurer_model');
			// $req in the parameter is complaint_id!
			$data['treasurer_requests'] = $this->treasurer_model->assetDetail($req);
			$data['complainant'] = $this->treasurer_model->complainantDetails($req);
			$data['complaint'] = $this->treasurer_model->complaintDetail($req);
			$data['technicalReport'] = $this->treasurer_model->tReport($this->input->post('req_id'));

			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/detail', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function approveReq()
	{
		if ($this->session->userdata('user_type') === '5') {
			$complaint_id = $this->input->get('complaint', TRUE);
			$asset_id=$this->input->get('asset');
			

			if ($this->Users->getDeptOfComplaintWithID($complaint_id)['department_id'] == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Request for Item(s) Purchase against complaint ID: .$complaint_id. has been approved</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $complaint_id . ">Track Request</a>";
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Request for Item(s) Purchase against complaint ID: .$complaint_id. has been approved</p>
				<a href=" . site_url('Admin/view_complaint/') . $complaint_id . ">Track Request</a>";
			}
			$subject1 = "Approval for item purchase";
			$this->Email_model->send_smtp_mail($to, $subject1, $message);


			$pMail = $this->Users->getPurchaserMail();
			$purchasersMail = array();
			for ($i = 0; $i < count($pMail); $i++) {
				$purchasersMail[$i] = $pMail[$i]['email'];
			}

			$subject2 = "Item(s) to Purchase";
			$message2 = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Request for Item(s) Purchase against complaint ID: .$complaint_id. has been approved</p>
				<a href=" . site_url('Purchaser/requested_products') . ">View Requests</a>";
			$this->Email_model->send_smtp_mail($purchasersMail, $subject2, $message2);
			$this->treasurer_model->approve($complaint_id);

			redirect('Treasurer/detail/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function rejectReq()
	{
		if ($this->session->userdata('user_type') === '5') {
			$details = $this->input->post('report', TRUE);
			$complaint_id = $this->input->post('complaint', TRUE);

			if ($this->Users->getDeptOfComplaintWithID($complaint_id)['department_id'] == 8) {
				$data = $this->Users->getITAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>
*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Request for Item(s) Purchase against complaint ID: .$complaint_id. has been Rejected</p>
<dl>
<dt><b>Rejection Reason:</b></dt>
<dd>.$details.</dd>
</dl>";
			} else {
				$data = $this->Users->getAdminsEmails();
				$to = array();
				for ($i = 0; $i < count($data); $i++) {
					$to[$i] = $data[$i]['email'];
				}
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Request for Item(s) Purchase against complaint ID: .$complaint_id. has been Rejected</p>
<dl>
  <dt><b>Rejection Reason:</b></dt>
  <dd>.$details.</dd>
</dl>";
			}
			$subject1 = "Approval for item purchase";
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			$this->treasurer_model->reject($complaint_id, $details);
			redirect('Treasurer/detail/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function accidental_report()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Accidental Reports";
			$data['accidental_reports'] = $this->treasurer_model->accidental_reports();
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/accidental_reports', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_accidental_report($id)
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = $id . "#: Accidental Report";

			$data['accidental_report_details'] = $this->treasurer_model->getAccidentalReport($id);
			$data['accidental_asset_details'] = $this->treasurer_model->getAccidentalAssetDetails($id);
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/view_accidental_report', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function ApproveAccidentalReport($id)
	{

		if ($this->session->userdata('user_type') === '5') {
			$this->treasurer_model->ApproveAccidentalReport($id);
		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Profile";
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/profile');
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_complaint($complaint_id)
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = $complaint_id . "#: Complaint Details";

			$data['complaint_details'] = $this->ComplainantModel->complaintDetails($complaint_id);
			$data['asset_details'] = $this->ComplainantModel->getAssetDetails($complaint_id);
			$data['complaint_timeline'] = $this->ComplainantModel->complaintTimeline($complaint_id);
			$data['complaint_feedback'] = $this->ComplainantModel->getComplaintFeedbackDetails($complaint_id);
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/view_complaint', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function register_complaint()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Create Complaint";
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/register_complaint');
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function regComplaint()
	{
		if ($this->session->userdata('user_type') === '5') {
			$subject = $this->input->post('subject', TRUE);
			$description = $this->input->post('details');
			$result=exec("python CMS_MODEL.py $description");
			
			
			if($result=="Electrical")
			{
				$department_id=1;
			}
			else if($result=="Furniture")
			{
				$department_id=2;
			}
			else if($result=="HVAC")
			{
				$department_id=3;
			}
			else if($result=="Plumbing")
			{
				$department_id=4;
			}
			else if($result=="Mechanical")
			{
				$department_id=5;
			}
			else if($result=="Civil")
			{
				$department_id=6;
			}
			else if($result=="Surveillance")
			{
				$department_id=7;
			}
			else if($result=="IT")
			{
				$department_id=8;
			}

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
			

			$comp_id = $this->ComplainantModel->addComplaint([
				"user_id" => $this->session->userdata('user_id'),
				"department_id" => $department_id,
				"subject" => $subject,
				"description" => $description
			]);
			

			date_default_timezone_set('Asia/Karachi');
			$date=date("Y-m-d h:i:s",strtotime('+1 day'));
			// echo $department_id.'==='.$subject.'==='.$description.'==='.$date;
			// die();
			if($department_id==8)
			{
				if($this->ITAdminModel->getAutoStat()['status']==1)
				{
					$this->AdminModel->updateTime($date, $comp_id);
					$technician=$this->AdminModel->getTechniciansDetails($comp_id);

					if(sizeof($technician)!=0)
					{
						
						$smallest=$technician[0];
						foreach ($technician as $t) 
						{
							if($this->AdminModel->workingOnComplaintsCount($t->technician_id) < $smallest)
							{
								$smallest=$t;
							}
						}
						$technician=$smallest;
						
						$this->AdminModel->assignTechnician($comp_id, ($technician->technician_id));
					}
				}
			}
			else
			{
				if($this->AdminModel->getAutoStat()['status']==1)
				{
					
					$this->AdminModel->updateTime($date, $comp_id);
					$technician=$this->AdminModel->getTechniciansDetails($comp_id);

					if(sizeof($technician)!=0)
					{
						$technician=$technician[array_rand($technician)];
						$this->AdminModel->assignTechnician($comp_id, ($technician->technician_id));
					}		
				}
			}

			$subject1 = $comp_id . ": " . $subject;
			if ($department_id == 8) {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint has been registered against .$comp_id. Id</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $comp_id . ">View Complaint</a>";
			} else {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint has been registered against .$comp_id. Id</p>
				<a href=" . site_url('Admin/view_complaint/') . $comp_id . ">View Complaint</a>";
			}
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('Treasurer/view_complaint/' . $comp_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '5') {
			$feedback = $this->input->post('feedback');

			$this->treasurer_model->addFeedback([
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

			$subject1 = "Complaint ID: " . $complaint_id . " Feedback";
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
			redirect('Treasurer/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_history()
	{
		if ($this->session->userdata('user_type') === '5') {
			$headData['title'] = "Complaint History";
			$user_id = $this->session->userdata('user_id');
			$data['complaints'] = $this->ComplainantModel->allComplaints($user_id);
			$data['pendingComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 0);
			$data['InProcessComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 1);
			$data['ReqAssetComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 2);
			$data['Resolved'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Resolved");
			$data['Rejected'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Rejected");
			$this->load->view('Treasurer/components/header', $headData);
			$this->load->view('Treasurer/page_contents/complaint_history', $data);
			$this->load->view('Treasurer/components/footer');
		} else {
			echo "Access Denied!";
		}
	}
}
