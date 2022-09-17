<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Technician extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model('TechnicianModel');
	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '9') {
			$headData['title'] = "Technician Dashboard";

			$data['allComplaints'] = $this->TechnicianModel->getAllComplaintsCount($this->session->userdata('user_id'));
			$data['resolvedComplaints'] = $this->TechnicianModel->getAllComplaintsCountWithRemarks($this->session->userdata('user_id'), "Resolved");
			$data['rejectedComplaints'] = $this->TechnicianModel->getAllComplaintsCountWithRemarks($this->session->userdata('user_id'), "Rejected");
			$data['pendingComplaints'] = $this->TechnicianModel->getAllComplaintsCountwithStatus($this->session->userdata('user_id'), 2);


			$this->load->view('technician/components/header', $headData);
			$this->load->view('technician/page_contents/dashboard', $data);
			$this->load->view('technician/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function tasks_performed()
	{
		if ($this->session->userdata('user_type') === '9') {
			$headData['title'] = "Tasks Performed";
			$data['allComplaints'] = $this->TechnicianModel->allComplaints($this->session->userdata('user_id'));
			$data['pendingComplaints'] = $this->TechnicianModel->pendingComplaints($this->session->userdata('user_id'));
			$data['resolvedComplaints'] = $this->TechnicianModel->ComplaintswithRemarks($this->session->userdata('user_id'), "Resolved");
			$data['rejectedComplaints'] = $this->TechnicianModel->ComplaintswithRemarks($this->session->userdata('user_id'), "Rejected");
			$this->load->view('technician/components/header', $headData);
			$this->load->view('technician/page_contents/technician_history', $data);
			$this->load->view('technician/components/footer');
		} else {
			echo "Access Denied!";
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user_type') === '9') {
			$headData['title'] = "Profile";
			$this->load->view('technician/components/header', $headData);
			$this->load->view('technician/page_contents/profile');
			$this->load->view('technician/components/footer');
		} else {
			echo "Access Denied!";
		}
	}
}
