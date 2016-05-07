<?php
define('DS', DIRECTORY_SEPARATOR);

// echo "here"; die;
// Timezone: Set it to your timezone
date_default_timezone_set("Europe/Zurich"); 

// Do not autostart session
//ini_set("session.auto_start", "Off");

// Session path: Change is according to your liking or just remove it if you are using some other session management
//ini_set("session.save_path", dirname(__DIR__) . DS . "tmp" . DS . "sessions");

// Load the compose autoload
require_once (dirname(__DIR__) . DS . 'logbook/vendor' . 	DS . 'autoload.php');
use Parse\ParseClient;

$app_id ="96zu61vZ2JhRqpk89VjszyuYzU9JzcWjF36ZfwwI";

$rest_key = "aw0kJsmji9TfLZgftiQUC3kGsQ9XQNijkW92NLnu";

$master_key ="mUUEJNFNWzdYWQ7EdUSfyQxIYQPbteIPSlAwZkYv";
// ParseClient::initialize('z4L1HepwrtxsUeHlRhuI1sXghdYJYTXxvJqtrCcF', '98chs65eaOddM7H5XuHlv5FrX77aW7Dlia3k9OsJ', 'vxVmriTkJGYlPp49NxWSfaG6u0QlfmIEW8c1rew5');
ParseClient::initialize($app_id,$rest_key, $master_key);


//include('header.php');
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;



 //getReportData('3i8tkxRfAv');
function getReportData($obj_id){
	$querylog = new ParseQuery("logBookNewEntry");
	$query_supervisor = new ParseQuery("SupervisorInformation");
	$results = $querylog->get($obj_id);
	/*echo '<pre>';
	print_r($results); die;*/
	$supervisor_id = $results->get('supervisorObj')->getobjectId();
	$getSupervisor = $query_supervisor->get($supervisor_id);
	$addPermitPhoto = $getSupervisor->get('addPermitPhoto')->getUrl();
	// die;
	//learnersInfo
	$durationTrip = $results->get('durationOfTrip');
	$distanceRecorded = $results->get('distanceRecorded');
	if($durationTrip > 0){
	$percentageCompleted = ($distanceRecorded/$durationTrip)*100;
	
	}
	else{
	$percentageCompleted = 0;
	
	}
	$startTripOdometerImage =  $results->get('startTripOdometerImage')->getUrl();
	$endTripOdometerImage =  $results->get('endTripOdometerImage')->getUrl();
	//die;
	$data_return['supervisor'] =  $results->get('supervisor');
	$data_return['vehicle'] =  $results->get('vehicle');
	$userid=   $results->get('byUser')->getobjectId();
	// echo $userid; die;
	// GEt user Info
	$query_learnerinfo = new ParseQuery('learnersInfo');
	$query_learnerinfo->equalTo("byUser", $results->get('byUser'));
	$getLearnerinfo = $query_learnerinfo->find();
	// print_r($getLearnerinfo); die;
	$addPermitPhotoLearner = $getLearnerinfo[0]->get('addPermitPhoto')->getUrl();
	$emailAddressLearner = $getLearnerinfo[0]->get('emailAddress');
	$firstNameLearner = $getLearnerinfo[0]->get('firstName');
	$middleNameLearner = $getLearnerinfo[0]->get('middleName');
	$lastNameLearner = $getLearnerinfo[0]->get('lastName');
	$learnersLicenseNumber = $getLearnerinfo[0]->get('learnersLicenseNumber');
	//$querylog = new ParseQuery("logBookNewEntry");
	
	$data_return['distanceRecorded'] =  $results->get('distanceRecorded');
	$data_return['drivingMode'] =  $results->get('drivingMode');
	$data_return['durationOfTrip'] =  $results->get('durationOfTrip');
	$data_return['endJourneyReason'] =  $results->get('endJourneyReason');
	$data_return['startImageTakenAt'] =  $results->get('startImageTakenAt')->format('Y-m-d H:i:s');
	$data_return['endImageTakenAt'] =  $results->get('endImageTakenAt')->format('Y-m-d H:i:s');
	$data_return['endingTime'] =  $results->get('endingTime')->format('Y-m-d H:i:s');
	$data_return['initialTime'] =  $results->get('initialTime')->format('Y-m-d H:i:s');
	
	$data_return['user_email'] =  $emailAddressLearner;
	$data_return['username'] =  $firstNameLearner.' '.$middleNameLearner.' '.$lastNameLearner;
	$data_return['learnerPhoto'] =  $addPermitPhotoLearner;
	$data_return['learnersLicenseNumber'] =  $learnersLicenseNumber;
	$data_return['supervisor_name'] =  $results->get('supervisor');
	$data_return['addPermitPhoto'] =  $addPermitPhoto;
	$data_return['weather'] =  $results->get('weather');
	$data_return['percentageCompleted'] =  round($percentageCompleted,0);
	$data_return['startTripOdometerImage'] =  $startTripOdometerImage;
	$data_return['endTripOdometerImage'] =  $endTripOdometerImage;
	
	return $data_return;
}