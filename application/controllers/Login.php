<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('email_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
            {
	          $user_type = $this->session->userdata('user_type');
			if ($user_type === '1') {
				redirect('Admin');
			} else if ($user_type === '2') {
				redirect('ITAdmin');
			} else if ($user_type === '3') {
				redirect('Complinant');
			} else if ($user_type === '4') {
				redirect('StoreMan');
			} else if ($user_type === '5') {
				redirect('Treasurer');
			} else if ($user_type === '6') {
				redirect('Purchaser');
			} else if ($user_type === '7') {
				redirect('AssetKeeper');
            } else if ($user_type === '9') {
				redirect('Technician');
            }
        }
		else
          $this->load->view('login_view');
	}

	function auth()
	{

		$user_id = $this->input->post('id', TRUE);
		$password = $this->input->post('password', TRUE);
		$result = $this->Login_model->check_user($user_id, $password);

		if ($result->num_rows() > 0) {
			$data = $result->row_array();
			$user_id = $data['user_id'];
			$email = $data['email'];
			$user_type = $data['user_type'];
			$name = $data['name'];
			$phone_number = $data['phone_number'];
			$ext = $data['ext'];
			$sesdata = array(
				'user_id' => $user_id,
				'email' => $email,
				'user_type' => $user_type,
				'name' => $name,
				'phone_number' => $phone_number,
				'ext' => $ext,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			if ($user_type === '1') {
				redirect('Admin');
			} else if ($user_type === '2') {
				redirect('ITAdmin');
			} else if ($user_type === '3') {
				redirect('Complinant');
			} else if ($user_type === '4') {
				redirect('StoreMan');
			} else if ($user_type === '5') {
				redirect('Treasurer');
			} else if ($user_type === '6') {
				redirect('Purchaser');
			} else if($user_type === '7'){
				redirect('AssetKeeper');
			}
		} else {
			$result = $this->Login_model->check_technician($user_id, $password);
			if ($result->num_rows() > 0) {
				$data = $result->row_array();
				$technician_id = $data['technician_id'];
				$department_id = $data['department_id'];
				$user_type = $data['user_type'];
				$name = $data['name'];
				$email = $data['email'];
				$phone_number = $data['phone_number'];

				$sesdata = array(
					'user_id' => $technician_id,
					'department_id' => $department_id,
					'name' => $name,
					'email' => $email,
					'user_type' => $user_type,
					'phone_number' => $phone_number,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sesdata);
				redirect('Technician');
			} else {
				$this->session->set_flashdata('message', 'Email Sent, Follow Email to continue Process!');
				$this->load->view('login_view');
			}
			$this->session->set_flashdata('message', "Invalid Credentials!");
			$this->load->view('login_view');
		}
		$this->load->view('login_view');
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}

	function reset()
	{
		// send user email a verification code, verify if the user is in record!

		$email = $this->input->post("email");
		$user_exist = $this->Login_model->user_exist($email);
		// print_r($user_exist);
		// die();
		if (count($user_exist) > 0) {
			// User exists! send random token!

			$token = rand(1000, 9999);
			$this->Login_model->update_password($token, $email);
			$subject = "Reset Password Link!";
			$message = "
<p><pre>*******************************************************
THIS IS A SYSTEM GENERATED EMAIL - PLEASE DO NOT REPLY
*******************************************************</pre></p>
			<p>Click on button below to reset password</p>
			<a href=" . site_url('Login/verify?token=') . $token . ">Reset Password</a>
			";
			$this->email_model->send_smtp_mail($email, $subject, $message);
			$this->session->set_flashdata('message', 'Email Sent, Follow Email to continue Process!');
			redirect('Login');
		} else {
			$this->session->set_flashdata('message', 'Invalid User!!');
			$this->load->view('login_view');
		}
	}

	function verify()
	{
		// Verify code, and change here password
		$data['token'] = $this->input->get('token');
		$_SESSION['token'] = $data['token'];

		$this->load->view('resetForm');
	}

	function changePassword()
	{
		$_SESSION['token'];
		$data = $this->input->post();
		if ($data['password'] == $data['cpassword']) {
			$this->Login_model->update_passwordWithMail($data['password'], $_SESSION['token']);
		}
		$this->session->set_flashdata('success', 'Password Changed!');
		redirect('Login');
		$this->load->view('login_view');
	}

	function regView()
	{
		$this->load->view('registerUser');
	}

	function createUser()
	{
		$this->form_validation->set_rules('id', 'user_id', 'required|is_unique[user.user_id]');
		$this->form_validation->set_rules('username', 'Name', 'trim|required');
		$this->form_validation->set_rules('phone_number', 'User Phone Number', 'required');
		$this->form_validation->set_rules('ext', 'User Extension Number', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirmpassword', 'Confirm password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == TRUE) {
			// true case
			$data = array(
				'user_id' => $this->input->post('id'),
				'user_type' => 3,
				'name' => $this->input->post('username'),
				'phone_number' => $this->input->post('phone_number'),
				'ext' => $this->input->post('ext'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			$create = $this->Login_model->create($data);
			if ($create == true) {
				$this->session->set_flashdata('success', 'Successfully created');
				$this->load->view('login_view');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				$this->load->view('registerUser');
			}
		} else {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				$this->load->view('registerUser');
			}
		}
	}
	function test()
	{
		echo "Test function....!";
	}
}
