<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo "aa";
		$this->load->view('welcome_message');
	}
	// }
	// public function validate()
	// {
	// 	$this->load->model('users');

	// 	$user = $this->input->post('username');
	// 	$pass = $this->input->post('password');

	// 	$res = $this->users->getDetails($user, $pass);

	// 	foreach ($res as $d) {

	// 		$data = [
	// 			'Id' => $d->user_id,
	// 			'User_Type' => $d->user_type,
	// 			'Name' => $d->name,
	// 			'Phone_Number' => $d->phone_number,
	// 			'Email' => $d->email,
	// 		];
	// 	}

	// 	$this->load->view('admin/components/header', $data);
	// 	$this->load->view('admin/page_contents/dashboard', $data);
	// 	$this->load->view('admin/components/footer');




	// 	// foreach ($this->users->getDetails($user, $pass) as $d) {
	// 	// 	if ($d->user_type == 1) {
	// 	// $this->load->view('admin/components/header');
	// 	// $this->load->view('admin/page_contents/dashboard');
	// 	// $this->load->view('admin/components/footer');
	// 	// 	} else {
	// 	// 		echo "Invalid";
	// 	// 	}
	// 	// }
	// }


	function getClient()
	{
		$client = new Google_Client();
		$client->setApplicationName('Google Calendar API PHP Quickstart');
		$client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
		$client->setAuthConfig('credentials.json');
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');
	
		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = 'token.json';
		if (file_exists($tokenPath)) {
			$accessToken = json_decode(file_get_contents($tokenPath), true);
			$client->setAccessToken($accessToken);
		}
	
		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {
				// Request authorization from the user.
				$authUrl = $client->createAuthUrl();
				printf("Open the following link in your browser:\n%s\n", $authUrl);
				print 'Enter verification code: ';
				$authCode = trim(fgets(STDIN));
	
				// Exchange authorization code for an access token.
				$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
				$client->setAccessToken($accessToken);
	
				// Check to see if there was an error.
				if (array_key_exists('error', $accessToken)) {
					throw new Exception(join(', ', $accessToken));
				}
			}
			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0700, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));
		}
		return $client;
	}

	public function c(){
			// Get the API client and construct the service object.
			$client = getClient();
			$service = new Google_Service_Calendar($client);
			
			// Print the next 10 events on the user's calendar.
			$calendarId = 'primary';
			$optParams = array(
			  'maxResults' => 10,
			  'orderBy' => 'startTime',
			  'singleEvents' => true,
			  'timeMin' => date('c'),
			);
			$results = $service->events->listEvents($calendarId, $optParams);
			$events = $results->getItems();
			
			if (empty($events)) {
				print "No upcoming events found.\n";
			} else {
				print "Upcoming events:\n";
				foreach ($events as $event) {
					$start = $event->start->dateTime;
					if (empty($start)) {
						$start = $event->start->date;
					}
					printf("%s (%s)\n", $event->getSummary(), $start);
				}
			}




		}

}
