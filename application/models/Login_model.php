<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

	function check_user($user, $password)
	{
		$this->db->select('*'); //select all
		$this->db->from('user'); // table name
		$this->db->where('user_id', $user); // where username is equal to $username
		$this->db->where('password', $password); // and password is equal to  $password (md5 format)
		$query = $this->db->get(); //get data from DB
		
		if($query->num_rows() > 0)
		{
			return $query;
		}
		elseif($query->num_rows()==0)
		{
			$this->db->select('*'); //select all
			$this->db->from('user'); // table name
			$this->db->where('user_id', $user); // where username is equal to $username
			$query2 = $this->db->get(); //get data from DB
			if($query2->num_rows() > 0)
			{
				$pass=$query2->row_array()['password'];
				if($password == $this->encrypt->decode($pass))
				{
					return $query2;
				}
			}
		}
		return $query;
	}

	function check_technician($user, $password)
	{
		$this->db->select('*'); //select all
		$this->db->from('technician'); // table name
		$this->db->where('technician_id', $user); // where username is equal to $username
		$this->db->where('password', $password); // and password is equal to  $password (md5 format)
		$query = $this->db->get(); //get data from DB
		
		if($query->num_rows() > 0)
		{
			return $query;
		}
		elseif($query->num_rows()==0)
		{
			$this->db->select('*'); //select all
			$this->db->from('technician'); // table name
			$this->db->where('technician_id', $user); // where username is equal to $username
			$query2 = $this->db->get(); //get data from DB
			if($query2->num_rows() > 0)
			{
				$pass=$query2->row_array()['password'];
				if($password == $this->encrypt->decode($pass))
				{
					return $query2;
				}
			}
		}
		return $query;
	}

	public function create($data = '') {
		$create = $this->db->insert('user', $data);
		return ($create == true) ? true : false;
	}

	public function user_exist($email) {
		$this->db->select('*'); //select all
		$this->db->from('user'); // table name
		$this->db->where('email', $email);
		$query = $this->db->get(); //get data from DB
		return $query->result_array();
	}

	public function update_password($token, $email) {
		$this->db->select('*'); //select all
		$this->db->from('user'); // table name
		$this->db->set('password', $token);
		$this->db->where('email', $email);
		$this->db->update();
	}

	public function update_passwordWithMail($password, $token) {
		$this->db->select('*'); //select all
		$this->db->from('user'); // table name
		$this->db->set('password', $password);
		$this->db->where('password', $token);
		$this->db->update();
	}
}
