<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('Login');
		}
		$this->load->model('Users');
	}

	public function updateInfo()
	{

		$user_id = $this->session->userdata('user_id');
		$user_type = $this->session->userdata('user_type');
		$name = $this->input->post('name');
		$phone_number = $this->input->post('phone_number');
		$ext = $this->input->post('ext');

		$this->Users->updateInfo($user_id, [
			'name' => $name,
			'phone_number' => $phone_number,
			'ext' => $ext
		]);
	}
}
