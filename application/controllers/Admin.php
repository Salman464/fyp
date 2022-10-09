<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model('AdminModel');
		$this->load->model('ITAdminModel');
		$this->load->model('Email_model');
		$this->load->model('Users');
		$this->load->model('ComplainantModel');
		$this->load->library('encrypt');
	}

  
  public function cmm()
  {
    				$message = "abcd";
					$subject = "Upcoming scheduled maintenance events";
					$to = "kamalashrafgill@gmail.com";
					try{
						$this->load->model("email_model");
						$this->email_model->send_smtp_mail($to, $subject , $message);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
  }
  
	public function sem()
	{
		ini_set('display_errors', 1);
		$events = $this->AdminModel->getScheduledEvents();
      for ($i=0; $i < count($events); $i++) {
          $event = $events[$i];
			if($event->occurrence == "Yearly"){
				$last_update=date_create($event->last_update);
				$current_date=date_create(date("Y-m-d"));
				$diff=date_diff($last_update,$current_date);
              $diff = $diff->format("%a");
              if($diff >= 355){
					$message = "You have following events scheduled in next month:<br>Title: {$event->title}<br>Description: {$event->description}<br>Department: {$event->dept_name}<br>Occurrence: {$event->occurrence}";
					$subject = "Upcoming scheduled maintenance events";
					$to = "17137074@gift.edu.pk";
					try{
						$this->load->model("email_model");
						$this->email_model->send_smtp_mail($to, $subject , $message);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
				}
			}
			else if($event->occurrence == "Half-yearly"){
				$last_update=date_create($event->last_update);
				$current_date=date_create(date("Y-m-d"));
				$diff=date_diff($last_update,$current_date);
              $diff = $diff->format("%a");
              if($diff >= 170){
					$message = "You have following events scheduled in next month:<br>Title: {$event->title}<br>Description: {$event->description}<br>Department: {$event->dept_name}<br>Occurrence: {$event->occurrence}";
					$subject = "Upcoming scheduled maintenance events";
					$to = "17137074@gift.edu.pk";
					try{
						$this->load->model("email_model");
						$this->email_model->send_smtp_mail($to, $subject , $message);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
				}
			}

			else if($event->occurrence == "Quarterly"){
				$last_update=date_create($event->last_update);
				$current_date=date_create(date("Y-m-d"));
				$diff=date_diff($last_update,$current_date);
              $diff = $diff->format("%a");
              if($diff >= 80){
					$message = "You have following events scheduled in next month:<br>Title: {$event->title}<br>Description: {$event->description}<br>Department: {$event->dept_name}<br>Occurrence: {$event->occurrence}";
					$subject = "Upcoming scheduled maintenance events";
					$to = "17137074@gift.edu.pk";
					try{
						$this->load->model("email_model");
						$this->email_model->send_smtp_mail($to, $subject , $message);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
				}
			}
			else if($event->occurrence == "Monthly"){
				$last_update=date_create($event->last_update);
				$current_date=date_create(date("Y-m-d"));
				$diff=date_diff($last_update,$current_date);
              $diff = $diff->format("%a");
              if($diff >= 8){
					$message = "You have following events scheduled in next month:<br>Title: {$event->title}<br>Description: {$event->description}<br>Department: {$event->dept_name}<br>Occurrence: {$event->occurrence}";
					$subject = "Upcoming scheduled maintenance events";
					$to = "17137074@gift.edu.pk";
					try{
						$this->load->model("email_model");
						$this->email_model->send_smtp_mail($to, $subject , $message);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
				}
			}



		}

	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Admin Dashboard";
			$data["allComplaints"] = $this->AdminModel->getAllComplaintsCount();
			$data["allPendingComplaints"] = $this->AdminModel->getAllOpenComplaintsCount(0);
			$data["allInProcessComplaints"] = $this->AdminModel->getAllOpenComplaintsCount(1);
			$data["allMaterialRequestedComplaints"] = $this->AdminModel->getAllOpenComplaintsCount(2);
			$data["allResolvedComplaints"] = $this->AdminModel->getAllComplaintsWithRemarksCount("Resolved");
			$data["allRejectedComplaints"] = $this->AdminModel->getAllComplaintsWithRemarksCount("Rejected");
			$data["getAutoStat"] = $this->AdminModel->getAutoStat();

			// $this->AdminModel->autoGenerateComplaints();

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/dashboard', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaints()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "All Complaints";

			$start_date = $this->input->get("start_date", TRUE);
			$end_date = $this->input->get("end_date", TRUE);
			$dept_id = $this->input->get("dept_id", TRUE);

			if ($start_date == '')
				$start_date = date('Y-m-d', strtotime('-60 days'));

			if ($end_date == '')
				$end_date = date('Y-m-d', strtotime(' +1 day'));

			$data['misc'] = [
				'start_date' => $start_date,
				'end_date' => $end_date,
				'dept_id' => $dept_id
			];

			$data['complaints'] = $this->AdminModel->allComplaints($start_date, $end_date, $dept_id);
			$data['electricityDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(1, $start_date, $end_date);
			$data['furnitureDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(2, $start_date, $end_date);
			$data['HVACDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(3, $start_date, $end_date);
			$data['plumbingDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(4, $start_date, $end_date);
			$data['MechanicalDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(5, $start_date, $end_date);
			$data['civilDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(6, $start_date, $end_date);
			$data['SurveillanceDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(7, $start_date, $end_date);
			$data['ITDeptComplaints'] = $this->AdminModel->getAllComplaintsCountWithDept(8, $start_date, $end_date);
			$data['pendingComplaints'] = $this->AdminModel->getAllPendingComplaints($start_date, $end_date, $dept_id);
			$data['InProcessComplaints'] = $this->AdminModel->getAllInProcessComplaints($start_date, $end_date, $dept_id);
			$data['ReqAssetComplaints'] = $this->AdminModel->getAllReqAssetComplaints($start_date, $end_date, $dept_id);
			$data['Resolved'] = $this->AdminModel->getAllComplaintsWithRemarks("Resolved", $start_date, $end_date, $dept_id);
			$data['Rejected'] = $this->AdminModel->getAllComplaintsWithRemarks("Rejected", $start_date, $end_date, $dept_id);


			$begin = new DateTime($start_date);
			$end   = new DateTime($end_date);
			$dmc=array();
			for($i = $begin; $i <= new DateTime($end->format('Y-m-t')); $i->modify('+1 month -3 day')){
				$duration=['start_date'=>$i->format("Y-m-1 h:i:s"),
				'end_date'=> $i->format("Y-m-t h:i:s")];
				$dmc+=array($i->format("M Y")=>($this->AdminModel->getMonthlyDepartmentComplaint($dept_id,$duration)));
			}
			$data['departmentMonthlyComplaints']=$dmc;


			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/complaints', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function technicians()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Technicians";

			$data['tech'] = $this->AdminModel->getTechnicians();
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/technicians', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function addTechnician()
	{
		if ($this->session->userdata('user_type') === '1') {


			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[technician.email]');
			$this->form_validation->set_rules('id', 'Username', 'trim|required|is_unique[technician.technician_id]');

			if ($this->form_validation->run() == TRUE) {
				$technician_id = $this->input->post('id', TRUE);
				$department_id = $this->input->post('dept_name', TRUE);
				$user_type = 9;
				$name = $this->input->post('tech_name', TRUE);
				$phone_number = $this->input->post('phone_number');
				$email = $this->input->post('email');
				$password = $this->input->post('id', TRUE);

				$create = $this->AdminModel->addTechnician([
					"technician_id" => $technician_id,
					"department_id" => $department_id,
					"user_type" => $user_type,
					"name" => $name,
					"phone_number" => $phone_number,
					"email" => $email,
					"password" => $this->encrypt->encode($password)
				]);
				if ($create == true) {
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('Admin/technicians');
				} else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('Admin/technicians');
				}
				redirect('Admin/technicians');
			} else {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('Admin/technicians');
				}
			}
		} else {
			$this->session->set_flashdata('errors', 'Email and id should be unique');
			echo "Access Denied!";
		}
	}

	public function view_complaint($complaint_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = $complaint_id . "#: Complaint Details";

			

			$data['complaint_details'] = $this->AdminModel->getComplaint($complaint_id);
			$data['technicians'] = $this->AdminModel->getTechniciansDetails($complaint_id);
			$data['asset_details'] = $this->AdminModel->getAssetDetails($complaint_id);
			$data['complaint_feedback'] = $this->AdminModel->getComplaintFeedbackDetails($complaint_id);
			$data['complaint_detailsAsComp'] = $this->AdminModel->complaintDetails($complaint_id);
			$data['complaint_timeline'] = $this->AdminModel->complaintTimeline($complaint_id);
			$data['complaint_feedbackAsComp'] = $this->AdminModel->getComplaintFeedbackDetailsAsComp($complaint_id);
			

			

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_complaint', $data);

			

			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '1') {
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

			$q = $this->AdminModel->isEvent($complaint_id);
			if ($q['event_num'] > 0)
				redirect('Admin/view_event_complaint/' . $complaint_id);
			else
				redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function create_complaint()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Create Complaint";
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/create_complaint');
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function close_complaint()
	{
		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$remarks = $this->input->post('remarks', TRUE);
			$this->AdminModel->closeComplaint($complaint_id, $remarks);
			
			$to = $this->Users->getComplainantEmail($complaint_id)['email'];
			$subject1 = "Complaint id: " . $complaint_id . " (Closed)";
			$message = "
			<p><pre>*******************************************************
			THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
			*******************************************************</pre></p>

			<p>Complaint status has been updated against complaint Id.$complaint_id.</p>
				<a href=" . site_url('Complinant/view_complaint/') . $complaint_id . ">View Complaint</a>";

			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			$q = $this->AdminModel->isEvent($complaint_id);
			if ($q['event_num'] > 0)
				redirect('Admin/view_event_complaint/' . $complaint_id);
			else
				redirect('Admin/view_complaint/' . $complaint_id);
			
			if($remarks=='Rejected')
			{
				$this->AdminModel->removeTressurerRequest($complaint_id);
			}
		} else {
			echo "Access Denied!";
		}
	}

	public function req_to_treasurer()
	{
		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$asset_id = $this->input->post('asset_id', TRUE);
			$this->AdminModel->reqToTreasurer([
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
			$q = $this->AdminModel->isEvent($complaint_id);
			if ($q['event_num'] > 0)
				redirect('Admin/view_event_complaint/' . $complaint_id);
			else
				redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function manage_admin()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Manage Users";

			$data['allUsers'] = $this->AdminModel->getUsers();
			$data['admins'] = $this->AdminModel->getUsersWith(1);
			$data['itadmins'] = $this->AdminModel->getUsersWith(2);
			$data['complainant'] = $this->AdminModel->getUsersWith(3);
			$data['store'] = $this->AdminModel->getUsersWith(4);
			$data['treasurer'] = $this->AdminModel->getUsersWith(5);
			$data['purchaser'] = $this->AdminModel->getUsersWith(6);

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/manage_admins', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function add_admin()
	{
		if ($this->session->userdata('user_type') === '1') {

			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
			$this->form_validation->set_rules('id', 'ID', 'trim|required|is_unique[user.user_id]|max_length[10]');
			if($this->input->post('id', TRUE) > 2147483647)
			{
				
				$this->session->set_flashdata('errors', 'Invalid GIFT id length..!');
				redirect('Admin/manage_admin');
			}
			
			if ($this->form_validation->run() == TRUE) {
				$user_id = $this->input->post('id', TRUE);
				$user_type = $this->input->post('adminType', TRUE);
				$name = $this->input->post('admin_name', TRUE);
				$phone_number = $this->input->post('phone_number');
				$ext = $this->input->post('ext');
				$email = $this->input->post('email');
				$password = $this->input->post('id', TRUE);

				$create = $this->AdminModel->addUser([
					"user_id" => $user_id,
					"user_type" => $user_type,
					"name" => $name,
					"phone_number" => $phone_number,
					"ext" => $ext,
					"email" => $email,
					"password" => $this->encrypt->encode($password)
				]);
				if ($create == true) {
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('Admin/manage_admin');
				} else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('Admin/manage_admin');
				}
			} else {
				// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$this->session->set_flashdata('errors', 'Email or ID already exist..!');
					redirect('Admin/manage_admin');
				// }
			}
		} else {
			echo "Access Denied!";
		}
	}

	public function regComplaint()
	{
		if ($this->session->userdata('user_type') === '1') {
			$user_id = $this->input->post('user_id', TRUE);
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
				"user_id" => $user_id,
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
			redirect('Admin/view_complaint/' . $comp_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function assignTechnician()
	{
		if ($this->session->userdata('user_type') === '1') {
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
			redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function reAssignTechnician()
	{
		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$technician_id = $this->input->post('technician_id', TRUE);
			$technician_email = $this->input->post('technician_email', TRUE);
			
			
			$subject = "New Complaint Assigned";
			$message = "
<p><pre>
*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>

<p>New complaint assigned to you. id: (.$complaint_id.)</p>
<p>Open CMS Website to respond or click</p>
				<a href=" . site_url('Technician/index') . ">View Complaint</a>";
				
			$sent = $this->Email_model->send_smtp_mail($technician_email, $subject, $message);
			
			$this->AdminModel->reAssignTechnician($complaint_id, $technician_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function create_accidental_report()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Create Accidental Report";
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/create_accidental_report');
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function regAccidentalReport()
	{
		if ($this->session->userdata('user_type') === '1') {
			$department_id = $this->input->post('dept_name', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$description = $this->input->post('description', TRUE);
			$total_cost = $this->input->post('total_cost', TRUE);
			$start_date = $this->input->post('start_date', TRUE);
			$end_date = $this->input->post('end_date', TRUE);

			$this->AdminModel->create_accidental_reports([
				"department_id" => $department_id,
				"subject" => $subject,
				"description" => $description,
				"total_cost" => $total_cost,
				"start_date" => $start_date,
				"end_date" => $end_date
			]);
		} else {
			echo "Access Denied!";
		}
	}

	public function accidental_report()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Accidental Reports";
			$data['accidental_reports'] = $this->AdminModel->accidental_reports();
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/accidental_reports', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_accidental_report($id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = $id . "#: Accidental Report";

			$data['accidental_report_details'] = $this->AdminModel->getAccidentalReport($id);
			$data['accidental_asset_details'] = $this->AdminModel->getAccidentalAssetDetails($id);
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_accidental_report', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function track_request($asset_id)
	{

		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Track Request";
			$data['asset_id'] = $asset_id;
			$data['asset_timeline'] = $this->AdminModel->assetTimeline($asset_id);
			$data['treasurer_timeline'] = $this->AdminModel->treasurerTimeline($asset_id);
			$data['purchaser_timeline'] = $this->AdminModel->purchaserTimeline($asset_id);
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/track_material_request', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function addAsset()
	{
		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('c_id');
			$name = $this->input->post('name');
			$details = $this->input->post('detail');
			$quantity = $this->input->post('quantity');


			$this->AdminModel->addAssetDetails([
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
		if ($this->session->userdata('user_type') === '1') {
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

<p>Material Required against complaint: ($complaint_id)</p>
<p>Open CMS Website to respond</p>
				<a href=" . site_url('StoreMan/reqested_products') . ">View Requests</a>";

			$this->Email_model->send_smtp_mail($to, $subject1, $message);
			$q = $this->AdminModel->isEvent($complaint_id);
			if ($q['event_num'] > 0)
				redirect('Admin/view_event_complaint/' . $complaint_id);
			else
				redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function addAssetDetailsAccidentalReport()
	{
		if ($this->session->userdata('user_type') === '1') {
			$accidental_report_id = $this->input->post('accidental_report_id');
			$asset_name = $this->input->post('asset_name');
			$asset_details = $this->input->post('asset_details');
			$qty = $this->input->post('qty');

			$this->AdminModel->addAccidentalAssetDetails([
				'accidental_report_id' => $accidental_report_id,
				'asset_name' => $asset_name,
				'asset_details' => $asset_details,
				'qty' => $qty
			]);
		} else {
			echo "Access Denied!";
		}
	}

	public function view_technician_performance($technician_id)
	{
		$complaints['allComplaints']=$this->AdminModel->getAllComplaintsCountForTechnician($technician_id)->result_array();
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = $technician_id . " | Performance";

			//$status = $this->input->post("status", TRUE);
			$start_date = $this->input->get("start_date", TRUE);
			$end_date = $this->input->get("end_date", TRUE);

			$data = $this->AdminModel->getTechniciansPerformance([
				'technician_id' => $technician_id,
				
				'start_date' => $start_date,
				'end_date' => $end_date
			]);

			$data['misc'] = [
				'technician_id' => $technician_id,
				
				'start_date' => $start_date,
				'end_date' => $end_date
			];
			
			$begin = new DateTime($start_date);
			$end   = new DateTime($end_date);
			$monComplaints=array();
			for($i = $begin; $i <= new DateTime($end->format('Y-m-t')); $i->modify('+1 month -3 day')){
				$duration=['start_date'=>$i->format("Y-m-1 h:i:s"),
				'end_date'=> $i->format("Y-m-t h:i:s")];
				$monComplaints+=array($i->format("M Y")=>($this->AdminModel->getTechnicianPerformanceFor($technician_id,$duration)));
			}
			$data['monthlyComplaint']=$monComplaints;

			$data['allComplaints']=$this->AdminModel->getAllComplaintsCountForTechnician($technician_id)->result_array();

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_technician_performance', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function updateTime($complaint_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$date = $this->input->post("date", TRUE);
			$this->AdminModel->updateTime($date, $complaint_id);

			$q = $this->AdminModel->isEvent($complaint_id);
			if ($q['event_num'] > 0)
				redirect('Admin/view_event_complaint/' . $complaint_id);
			else
				redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Profile";
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/profile');
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function maintenance_schedules()
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Maintenance Schedules";

			$dept_id = $this->input->post("dept_id", TRUE);
			$data['misc'] = [
				'dept_id' => $dept_id
			];
			$data['allEvents'] = $this->AdminModel->getAllEvents($dept_id);
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/maintenance', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_event($event_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = $event_id . "#: Event Details";
			$data['event_details'] = $this->AdminModel->getEvent($event_id);
			$data['event_performed'] = $this->AdminModel->getAllEventOccurred($event_id);
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_event_details', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function view_event_complaint($event_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = $event_id . "#: Event Details";

			$data['complaint_details'] = $this->AdminModel->getComplaint($event_id);
			$data['technicians'] = $this->AdminModel->getAllTechnicians($event_id);
			$data['asset_details'] = $this->AdminModel->getAssetDetails($event_id);
			$data['complaint_feedback'] = $this->AdminModel->getComplaintFeedbackDetails($event_id);
			$data['complaint_feedbackAsComp'] = $this->AdminModel->getComplaintFeedbackDetailsAsComp($event_id);

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_event_complaint', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function addEvent()
	{
		if ($this->session->userdata('user_type') === '1') {
			$department_id = $this->input->post('dept_name', TRUE);
			$occurrence_id = $this->input->post('occ_id', TRUE);
			$title = $this->input->post('title', TRUE);
			$description = $this->input->post('description', TRUE);
			$start_month = $this->input->post('start_month', TRUE);
			if ($start_month == 1) {
				$last_update = date('Y-m-01');
			} else {
				$last_update = date('Y-01-01');
			}
			$this->AdminModel->addEvent([
				"department_id" => $department_id,
				"occurrence_id" => $occurrence_id,
				"title" => $title,
				"description" => $description,
				"last_update" => $last_update
			]);
			redirect('Admin/maintenance_schedules');
		} else {
			echo "Access Denied!";
		}
	}

	public function startEvent($event_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$data['event_details'] = $this->AdminModel->getEvent($event_id);
			$i = $this->AdminModel->addComplaint([
				"user_id" => $this->session->userdata('user_id'),
				"department_id" => $data['event_details']['department_id'],
				"subject" => $data['event_details']['title'],
				"description" => $data['event_details']['description'],
				"event_num" => $event_id
			]);

			$q = $this->AdminModel->getOccurrence($event_id);
			if ($q['occurrence_id'] == 1) {
				$updated_date = date('Y-m-01',strtotime('first day of +1 month'));
				$this->AdminModel->updateEvent([
					'last_update' => $updated_date
				], $event_id);
			}
			else if ($q['occurrence_id'] == 2) {
				$updated_date = date('Y-m-01',strtotime('first day of +3 month'));
				$this->AdminModel->updateEvent([
					'last_update' => $updated_date
				], $event_id);
			} else if ($q['occurrence_id'] == 3) {
				$updated_date = date('Y-m-01',strtotime('first day of +6 month'));
				$this->AdminModel->updateEvent([
					'last_update' => $updated_date
				], $event_id);
			} else {
				$updated_date = date('Y-m-01',strtotime('first day of +12 month'));
				$this->AdminModel->updateEvent([
					'last_update' => $updated_date
				], $event_id);
			}

			redirect('Admin/view_event_complaint/' . $i);
		} else {
			echo "Access Denied!";
		}
	}

	public function updateEvent()
	{
		if ($this->session->userdata('user_type') === '1') {
			$event_id = $this->input->post('event_id');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$occurrence = $this->input->post('occurrence');

			$this->AdminModel->updateEvent([
				'title' => $title,
				'description' => $description,
				'occurrence_id' => $occurrence
			], $event_id);
			redirect('Admin/view_event/' . $event_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function update_complaint_feedback($complaint_id)
	{
		if ($this->session->userdata('user_type') === '1') {
			$feedback = $this->input->post('feedback');
			$this->AdminModel->updateFeedback([
				'complaint_id' => $complaint_id,
				'feedback' => $feedback
			]);
			redirect('Admin/view_event_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	public function all_event_complaints()
	{

		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "All Events";

			$start_date = $this->input->post("start_date", TRUE);
			$end_date = $this->input->post("end_date", TRUE);
			$dept_id = $this->input->post("dept_id", TRUE);

			if ($start_date == '')
				$start_date = date('Y-m-d', strtotime('-60 days'));

			if ($end_date == '')
				$end_date = date('Y-m-d', strtotime(' +1 day'));

			$data['misc'] = [
				'start_date' => $start_date,
				'end_date' => $end_date,
				'dept_id' => $dept_id
			];

			$data['complaints'] = $this->AdminModel->getAllEventOccurreds($start_date, $end_date, $dept_id);
			$data['electricityDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(1, $start_date, $end_date);
			$data['furnitureDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(2, $start_date, $end_date);
			$data['HVACDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(3, $start_date, $end_date);
			$data['plumbingDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(4, $start_date, $end_date);
			$data['MechanicalDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(5, $start_date, $end_date);
			$data['civilDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(6, $start_date, $end_date);
			$data['SurveillanceDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(7, $start_date, $end_date);
			$data['ITDeptComplaints'] = $this->AdminModel->getAllEventsCountWithDept(8, $start_date, $end_date);
			$data['pendingComplaints'] = $this->AdminModel->getAllEventsWithStatus(0, $start_date, $end_date, $dept_id);
			$data['InProcessComplaints'] = $this->AdminModel->getAllEventsWithStatus(1, $start_date, $end_date, $dept_id);
			$data['ReqAssetComplaints'] = $this->AdminModel->getAllEventsWithStatus(2, $start_date, $end_date, $dept_id);
			$data['Resolved'] = $this->AdminModel->getAllEventsWithStatus(3, $start_date, $end_date, $dept_id);

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/events', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	function addEventTechnician($complaint_id)
	{

		if ($this->session->userdata('user_type') === '1') {
			$headData['title'] = "Assign Technician";

			$data['misc'] = [
				'complaint_id' => $complaint_id
			];

			$data['technicians_details'] = $this->AdminModel->getTechniciansDetails($complaint_id);

			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/assignTechnician', $data);
			$this->load->view('admin/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	function assignTech()
	{

		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$technician_id = $this->input->post('technician_id', TRUE);

			$this->AdminModel->assignEventTechnician($complaint_id, $technician_id);

			redirect('Admin/view_event_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	function removeFromJob()
	{

		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$technician_id = $this->input->post('technician_id', TRUE);

			$this->AdminModel->removeFromJob($complaint_id, $technician_id);

			redirect('Admin/view_event_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}

	function updateDepartment()
	{
		if ($this->session->userdata('user_type') === '1') {
			$complaint_id = $this->input->post('complaint_id', TRUE);
			$dept_name = $this->input->post('dept_name', TRUE);

			$this->AdminModel->updateDept($complaint_id, $dept_name);

			redirect('Admin/view_complaint/' . $complaint_id);
		} else {
			echo "Access Denied!";
		}
	}
	public function toStore()
	{
		redirect('StoreMan');
	}
	public function viewComplaintsType($type,$technician_id,$start_date,$end_date)
	{
		if($this->session->userdata('user_type') === '1' && $this->session->userdata('logged_in') === TRUE)
		{
			
			$data['complaints']=$this->AdminModel->getComplaintsWhereStatus($type,$technician_id,$start_date,$end_date)->result_array();
			$headData['title']=$type;
			$this->load->view('admin/components/header', $headData);
			$this->load->view('admin/page_contents/view_complaint_byType', $data);
			$this->load->view('admin/components/footer');
		}
		else 
		{
			echo "Access Denied!";
		}
		
	}
	public function automate()
	{
		$status = $this->input->get('checkboxx', TRUE);
		$this->AdminModel->updateAutomation($status);
		redirect("Admin/index");
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
				$comps=$this->AdminModel->getComplaintsForTheDay($s,$e);
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
				$comps=$this->AdminModel->getComplaintsForTheDay($s,$e);
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
				$comps=$this->AdminModel->getComplaintsForTheDay($s,$e);
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
				
				$comps=$this->AdminModel->getComplaintsForTheDay($s,$e);
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
