<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Purchaser extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model("PurchaserModel");
		$this->load->model('Email_model');
		$this->load->model('Users');
		$this->load->model('ComplainantModel');
		$this->load->model('AdminModel');
		$this->load->model('ITAdminModel');
	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Purchaser Dashboard";
			$data['allReqs'] = $this->PurchaserModel->getAllReqsCount();
			$data['pendingReqs'] = $this->PurchaserModel->getSpecificReqsCount(0);
			$data['issued'] = $this->PurchaserModel->getSpecificReqsCount(1);

			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/dashboard', $data);
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function issued_productspurchase()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Purchaser Dashboard";
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/issued_productspurchase');
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function requested_products()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Requested Products";

			$data['allReqs'] = $this->PurchaserModel->getAllReqs();
			$data['pendingReqs'] = $this->PurchaserModel->getAllPendingReqs();
			$data['issued'] = $this->PurchaserModel->getAllIssuedProducts();

			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/requested_products', $data);
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function detail_product($req)
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = $req . "#: Product Details";
			$data['asset'] = $this->PurchaserModel->getAssetDetails($req);
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/detail_product', $data);
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function issueProduct()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Purchaser Dashboard";
			$asset_id = $this->input->post('asset_id');
			$data = $this->Users->getStoreManMail();
			$to = array();
			for ($i = 0; $i < count($data); $i++) {
				$to[$i] = $data[$i]['email'];
			}
			$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Product against Asset_Id :$asset_id has been purchased and issued to Store</p>
				<a href=" . site_url('StoreMan/view_request_product/') . $this->input->post('asset_id') . ">View Product Details</a>";

			$subject1 = "Asset id: " . $asset_id . " status updated";
			$this->Email_model->send_smtp_mail($to, $subject1, $message);

			$this->PurchaserModel->issue($this->input->post('req'), $this->input->post('asset_id'));
		} else {
			echo "Access Denied!";
		}
	}

	public function issueproductdetail()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Purchaser Dashboard";
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/issueproductdetail');
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Profile";
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/profile');
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_history()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Complaint History";
			$user_id = $this->session->userdata('user_id');
			$data['complaints'] = $this->ComplainantModel->allComplaints($user_id);
			$data['pendingComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 0);
			$data['InProcessComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 1);
			$data['ReqAssetComplaints'] = $this->ComplainantModel->allComplaintsWithStatus($user_id, 2);
			$data['Resolved'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Resolved");
			$data['Rejected'] = $this->ComplainantModel->allComplaintsWithRemarks($user_id, "Rejected");
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/complaint_history', $data);
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function register_complaint()
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = "Create Complaint";
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/register_complaint');
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function regComplaint()
	{
		if ($this->session->userdata('user_type') === '6') {
			
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

<p>Complaint has been registered against Complaint ID: $comp_id</p>
				<a href=" . site_url('ITAdmin/view_complaint/') . $comp_id . ">View Complaint</a>";
			} else {
				$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>Complaint has been registered against Complaint ID: $comp_id</p>
				<a href=" . site_url('Admin/view_complaint/') . $comp_id . ">View Complaint</a>";
			}
			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			redirect('Purchaser/view_complaint/'.$comp_id);

		} else {
			echo "Access Denied!";
		}
	}

	public function view_complaint($complaint_id)
	{
		if ($this->session->userdata('user_type') === '6') {
			$headData['title'] = $complaint_id . "#: Complaint Details";

			$data['complaint_details'] = $this->ComplainantModel->complaintDetails($complaint_id);
			$data['asset_details'] = $this->ComplainantModel->getAssetDetails($complaint_id);
			$data['complaint_timeline'] = $this->ComplainantModel->complaintTimeline($complaint_id);
			$data['complaint_feedback'] = $this->ComplainantModel->getComplaintFeedbackDetails($complaint_id);
			$this->load->view('purchaser/components/header', $headData);
			$this->load->view('purchaser/page_contents/view_complaint', $data);
			$this->load->view('purchaser/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '6') {
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
			redirect('Purchaser/view_complaint/'.$complaint_id);
		} else {
			echo "Access Denied!";
		}
	}
}
