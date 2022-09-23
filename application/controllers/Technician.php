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
		$this->load->library('encrypt');
	}

	public function index()
	{
		if ($this->session->userdata('user_type') === '9') {

			$technician_id = $this->session->userdata('user_id');

			if($this->TechnicianModel->checkFirstLogin($technician_id)==1)
			{
				$this->TechnicianModel->notFirstLogin($technician_id);
				$this->change_password();
			}
			else
			{
				$headData['title'] = "Technician Dashboard";

				$data['allComplaints'] = $this->TechnicianModel->getAllComplaintsCount($this->session->userdata('user_id'));
				$data['resolvedComplaints'] = $this->TechnicianModel->getAllComplaintsCountWithRemarks($this->session->userdata('user_id'), "Resolved");
				$data['rejectedComplaints'] = $this->TechnicianModel->getAllComplaintsCountWithRemarks($this->session->userdata('user_id'), "Rejected");
				$data['pendingComplaints'] = $this->TechnicianModel->getAllComplaintsCountwithStatus($this->session->userdata('user_id'), 2);


				$this->load->view('technician/components/header', $headData);
				$this->load->view('technician/page_contents/dashboard', $data);
				$this->load->view('technician/components/footer');
			}
			
		} else {
			echo "Access Denied!";
		}
	}
	public function change_password()
	{
		
		$headData['title'] = "Change Password";
				
		$this->load->view('technician/components/header', $headData);
		$this->load->view('technician/page_contents/change_password');
		$this->load->view('technician/components/footer');
	}
	public function updatePassword()
	{
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$confirm_pass = $this->input->post('confirm_pass');
		
		if($new_pass == $confirm_pass)
		{
			$pass = $this->TechnicianModel->getOldPass($this->session->userdata('user_id'));
			$pass2= $this->encrypt->decode($pass);
			
			if($old_pass == $pass || $old_pass == $pass2)
			{
				if(strlen($new_pass)>=4)
				{
					if($this->TechnicianModel->updateNewPass($this->session->userdata('user_id'),$this->encrypt->encode($new_pass)))
					{
						redirect('Technician');
					}
				}
				else
				{
					$this->session->set_flashdata('errors','New password length must be 4 or more');
				}
				
			}
			else
			{
				$this->session->set_flashdata('errors','Old Password did not match');
			}

		}
		else
		{
			$this->session->set_flashdata('errors','Password and Confirm password did not match');
		}
		$this->change_password();
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
