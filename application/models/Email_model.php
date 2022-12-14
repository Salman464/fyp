<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function send_smtp_mail($to, $sub, $msg) {
		//Load email library
		$this->load->library('email');

		// SMTP & mail configuration
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://mail.appdemo.one',
			'smtp_port' => '465',
			'smtp_user' => 'cms@appdemo.one',
			'smtp_pass' => 'xYM7gPwe6wKmMbPQjP',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'smtp_timeout' => '10'
		);

		$from_email = $config['smtp_user'];
		$from_name = "GIFT CMS";
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$htmlContent = $msg;
		$this->email->to($to);

		$this->email->from($from_email, $from_name);
		$this->email->subject($sub);
		$this->email->message($htmlContent);
		$this->email->cc('181370103@gift.edu.pk');

		// print_r($this->email);
		// die();
		
		return $this->email->send();
	}
}
