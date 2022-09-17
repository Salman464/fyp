<?php

ini_set('display_errors', 1);

require_once __DIR__.'/vendor/autoload.php';
   session_start();     


$client = new Google_Client();
$application_creds = __DIR__.'/cred.json';  //the Service Account generated cred in JSON
$credentials_file = file_exists($application_creds) ? $application_creds : false;
define("APP_NAME","Google Calendar API PHP");   //whatever
$client->setAuthConfig($credentials_file);
$client->setApplicationName(APP_NAME);
//$client->setSubject('kamalashrafgill@gmail.com');
$client->addScope(Google_Service_Calendar::CALENDAR);
//$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

//Setting Complete

//Go Google Calendar to set "Share with ..."  Created in Service Account (xxxxxxx@sustained-vine-198812.iam.gserviceaccount.com)

//Example of Use of API
$service = new Google_Service_Calendar($client);  


$calendarId = 'primary';   //NOT primary!! , but the email of calendar creator that you want to view
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => TRUE,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
  print "No upcoming events found.\n";
} else {
  echo "Upcoming events:";
  echo "<hr>";
  echo "<table>";
  foreach ($results->getItems() as $event) {
    $start = $event->start->dateTime;
    if (empty($start)) {
      $start = $event->start->date;
    }
    echo "<tr>";
    echo"<td>".$event->getSummary()."</td>";
    echo"<td>".$start."</td>";
    echo "</tr>";
  }
  echo "</table>";
}



$event = new Google_Service_Calendar_Event(array(
  'summary' => 'new test event',
  'description' => 'Test Event',
  'start' => array(
    'dateTime' => '2021-09-29T05:00:00-07:00'
  ),
  'end' => array(
    'dateTime' => '2021-09-29T06:00:00-07:00'
  )
));

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s\n', $event->htmlLink);